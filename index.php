<?php
/**
 * Single File Invoice Generator (PHP + HTML + JS)
 * Features: Auth, JSON Database, Multi-currency, Emailing, Analytics, PDF Download, Settings
 */

// Prevent HTML errors from breaking JSON response
error_reporting(E_ALL);
ini_set('display_errors', 0);

session_start();

// --- CONFIGURATION ---
$DATA_FILE = 'invoice_data.json';
$ADMIN_USER = 'admin';
$ADMIN_PASS = 'admin123'; // Change this!

// --- PHP BACKEND LOGIC ---

// Helper: Get Data with Auto-Repair
function getData() {
    global $DATA_FILE;
    
    $defaultData = [
        'invoices' => [],
        'clients' => [], 
        'settings' => [
            'company_name' => 'My Agency',
            'company_email' => 'billing@agency.com',
            'company_address' => '123 Business Road, Tech City',
            'company_phone' => '+91 98765 43210'
        ]
    ];

    if (!file_exists($DATA_FILE)) {
        return $defaultData;
    }

    $content = @file_get_contents($DATA_FILE);
    if ($content === false) return $defaultData;

    $data = json_decode($content, true);

    // If JSON is invalid or structure is wrong, return default to prevent crash
    if (json_last_error() !== JSON_ERROR_NONE || !is_array($data)) {
        return $defaultData;
    }

    // Ensure all keys exist
    $data['invoices'] = $data['invoices'] ?? [];
    $data['clients'] = $data['clients'] ?? [];
    $data['settings'] = $data['settings'] ?? $defaultData['settings'];

    return $data;
}

function saveData($data) {
    global $DATA_FILE;
    file_put_contents($DATA_FILE, json_encode($data, JSON_PRETTY_PRINT));
}

// Global Exception Handler for JSON responses
try {
    // 1. Initialize File safely
    if (!file_exists($DATA_FILE)) {
        saveData(getData()); // Saves defaults
    }

    // 2. Handle Requests
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        header('Content-Type: application/json'); // Force JSON header

        $rawInput = file_get_contents('php://input');
        $input = json_decode($rawInput, true);
        
        // Fallback for standard form posts if JSON fails
        if (!$input) $input = $_POST;

        $response = ['status' => 'error', 'message' => 'Unknown action'];

        // LOGIN
        if (isset($input['action']) && $input['action'] === 'login') {
            if ($input['username'] === $ADMIN_USER && $input['password'] === $ADMIN_PASS) {
                $_SESSION['logged_in'] = true;
                $response = ['status' => 'success'];
            } else {
                $response = ['status' => 'error', 'message' => 'Invalid credentials'];
            }
            echo json_encode($response);
            exit;
        }

        // LOGOUT
        if (isset($input['action']) && $input['action'] === 'logout') {
            session_destroy();
            echo json_encode(['status' => 'success']);
            exit;
        }

        // GUARD: Require Login
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
            echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
            exit;
        }

        // SAVE SETTINGS
        if (isset($input['action']) && $input['action'] === 'save_settings') {
            $data = getData();
            if(isset($input['settings'])) {
                $data['settings'] = $input['settings'];
                saveData($data);
                echo json_encode(['status' => 'success', 'message' => 'Settings Saved']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'No settings data provided']);
            }
            exit;
        }

        // SAVE INVOICE
        if (isset($input['action']) && $input['action'] === 'save_invoice') {
            $data = getData();
            
            if (!isset($input['invoice_data'])) {
                throw new Exception("Missing invoice data");
            }

            $newInvoice = $input['invoice_data'];
            $isUpdate = false;

            // Check if ID exists (Update mode)
            if (!empty($newInvoice['id'])) {
                foreach ($data['invoices'] as $key => $inv) {
                    if ($inv['id'] === $newInvoice['id']) {
                        // Preserve meta data
                        $newInvoice['created_at'] = $inv['created_at'];
                        $newInvoice['status'] = $inv['status'];
                        $newInvoice['paid_at'] = $inv['paid_at'] ?? null;
                        $data['invoices'][$key] = $newInvoice;
                        $isUpdate = true;
                        break;
                    }
                }
            }

            // Create New
            if (!$isUpdate) {
                $newInvoice['id'] = uniqid(); 
                $newInvoice['created_at'] = date('Y-m-d H:i:s');
                $newInvoice['status'] = 'Pending';
                $newInvoice['paid_at'] = null;
                array_unshift($data['invoices'], $newInvoice);
            }

            // Update Clients
            $clientExists = false;
            foreach($data['clients'] as $k => $c) {
                if ($c['name'] === $newInvoice['client_name']) {
                    $data['clients'][$k] = [
                        'name' => $newInvoice['client_name'],
                        'email' => $newInvoice['client_email'],
                        'address' => $newInvoice['client_address']
                    ];
                    $clientExists = true;
                }
            }
            if (!$clientExists) {
                $data['clients'][] = [
                    'name' => $newInvoice['client_name'],
                    'email' => $newInvoice['client_email'],
                    'address' => $newInvoice['client_address']
                ];
            }

            saveData($data);
            echo json_encode(['status' => 'success', 'message' => $isUpdate ? 'Invoice Updated' : 'Invoice Created']);
            exit;
        }

        // DELETE INVOICE
        if (isset($input['action']) && $input['action'] === 'delete_invoice') {
            $data = getData();
            $data['invoices'] = array_filter($data['invoices'], function($inv) use ($input) {
                return $inv['id'] !== $input['id'];
            });
            $data['invoices'] = array_values($data['invoices']); // Re-index
            saveData($data);
            echo json_encode(['status' => 'success']);
            exit;
        }

        // UPDATE STATUS
        if (isset($input['action']) && $input['action'] === 'mark_paid') {
            $data = getData();
            foreach ($data['invoices'] as &$inv) {
                if ($inv['id'] === $input['id']) {
                    $inv['status'] = 'Paid';
                    $inv['paid_at'] = date('Y-m-d H:i:s');
                    break;
                }
            }
            saveData($data);
            echo json_encode(['status' => 'success']);
            exit;
        }

        // SEND EMAIL
        if (isset($input['action']) && $input['action'] === 'send_email') {
            $to = $input['email'];
            $subject = "Invoice #" . $input['inv_number'];
            $message = "Hello, please find attached details for invoice #" . $input['inv_number'];
            $headers = "From: no-reply@invoiceapp.com";
            
            // Suppress errors for mail to prevent 500 on localhosts
            if(@mail($to, $subject, $message, $headers)) {
                echo json_encode(['status' => 'success', 'message' => 'Email sent']);
            } else {
                echo json_encode(['status' => 'success', 'message' => 'Email simulated (Server mail() not configured)']);
            }
            exit;
        }

        // GET DATA
        if (isset($input['action']) && $input['action'] === 'get_data') {
            echo json_encode(getData());
            exit;
        }
    }
} catch (Throwable $e) {
    http_response_code(500);
    header('Content-Type: application/json');
    echo json_encode(['status' => 'error', 'message' => 'Server Error: ' . $e->getMessage()]);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Global Invoice Manager</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <style>
        @media print {
            body * { visibility: hidden; }
            #printable-invoice, #printable-invoice * { visibility: visible; }
            #printable-invoice { position: absolute; left: 0; top: 0; width: 100%; margin: 0; padding: 0; }
            .no-print { display: none !important; }
        }
        .fade-in { animation: fadeIn 0.3s ease-in-out; }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
    </style>
</head>
<body class="bg-gray-100 text-gray-800 font-sans">

    <!-- LOGIN SCREEN -->
    <?php if (!isset($_SESSION['logged_in'])): ?>
    <div class="min-h-screen flex items-center justify-center bg-gray-900">
        <div class="bg-white p-8 rounded-lg shadow-xl w-96">
            <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Invoice Login</h2>
            <form onsubmit="handleLogin(event)">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Username</label>
                    <input type="text" id="username" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                    <input type="password" id="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition">
                    Sign In
                </button>
                <p id="login-error" class="text-red-500 text-xs italic mt-4 hidden text-center"></p>
            </form>
        </div>
    </div>
    <script>
        async function handleLogin(e) {
            e.preventDefault();
            const u = document.getElementById('username').value;
            const p = document.getElementById('password').value;
            try {
                const res = await fetch('index.php', { 
                    method: 'POST', 
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify({action: 'login', username: u, password: p}) 
                });
                const text = await res.text();
                try {
                    const data = JSON.parse(text);
                    if(data.status === 'success') location.reload();
                    else {
                        document.getElementById('login-error').innerText = data.message;
                        document.getElementById('login-error').classList.remove('hidden');
                    }
                } catch(e) {
                    console.error("Server raw response:", text);
                    alert("Server Error. Check console.");
                }
            } catch (err) { alert("Network Error"); }
        }
    </script>
    <?php else: ?>

    <!-- MAIN APP -->
    <div id="app" class="flex min-h-screen">
        
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-900 text-white flex flex-col hidden md:flex">
            <div class="p-6 text-2xl font-bold border-b border-gray-800 flex items-center gap-2">
                <i class="fa-solid fa-file-invoice-dollar"></i> Invoicr
            </div>
            <nav class="flex-1 p-4 space-y-2">
                <button onclick="router('dashboard')" class="w-full text-left px-4 py-3 rounded hover:bg-gray-800 transition flex items-center gap-3">
                    <i class="fa-solid fa-chart-pie"></i> Dashboard
                </button>
                <button onclick="resetForm(); router('create')" class="w-full text-left px-4 py-3 rounded hover:bg-gray-800 transition flex items-center gap-3">
                    <i class="fa-solid fa-plus-circle"></i> Create Invoice
                </button>
                <button onclick="router('history')" class="w-full text-left px-4 py-3 rounded hover:bg-gray-800 transition flex items-center gap-3">
                    <i class="fa-solid fa-clock-rotate-left"></i> History
                </button>
                <button onclick="router('settings')" class="w-full text-left px-4 py-3 rounded hover:bg-gray-800 transition flex items-center gap-3">
                    <i class="fa-solid fa-cog"></i> Company Settings
                </button>
            </nav>
            <div class="p-4 border-t border-gray-800">
                <button onclick="logout()" class="w-full text-left px-4 py-2 text-red-400 hover:text-red-300 transition">
                    <i class="fa-solid fa-sign-out-alt"></i> Logout
                </button>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 bg-gray-100 overflow-y-auto">
            <!-- Mobile Toggle -->
            <div class="md:hidden bg-gray-900 text-white p-4 flex justify-between items-center">
                <h1 class="font-bold">Invoicr</h1>
                <button onclick="document.querySelector('aside').classList.toggle('hidden'); document.querySelector('aside').classList.toggle('absolute'); document.querySelector('aside').classList.toggle('h-full'); document.querySelector('aside').classList.toggle('z-50');"><i class="fa-solid fa-bars"></i></button>
            </div>

            <div class="p-8 max-w-7xl mx-auto">
                
                <!-- DASHBOARD -->
                <div id="view-dashboard" class="view-section fade-in">
                    <h2 class="text-3xl font-bold text-gray-800 mb-6">Dashboard</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                        <div class="bg-white p-6 rounded-lg shadow border-l-4 border-blue-500">
                            <h3 class="text-gray-500 text-sm">Total Invoices</h3>
                            <p class="text-3xl font-bold" id="stat-total-count">0</p>
                        </div>
                        <div class="bg-white p-6 rounded-lg shadow border-l-4 border-yellow-500">
                            <h3 class="text-gray-500 text-sm">Pending (Approx ~₹)</h3>
                            <p class="text-3xl font-bold text-yellow-600" id="stat-pending">₹0</p>
                        </div>
                        <div class="bg-white p-6 rounded-lg shadow border-l-4 border-green-500">
                            <h3 class="text-gray-500 text-sm">Paid (Approx ~₹)</h3>
                            <p class="text-3xl font-bold text-green-600" id="stat-paid">₹0</p>
                        </div>
                        <div class="bg-white p-6 rounded-lg shadow border-l-4 border-purple-500">
                            <h3 class="text-gray-500 text-sm">This Month</h3>
                            <p class="text-3xl font-bold" id="stat-month">0</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <div class="bg-white p-6 rounded-lg shadow">
                            <h3 class="font-bold mb-4">Invoice Status</h3>
                            <canvas id="statusChart"></canvas>
                        </div>
                        <div class="bg-white p-6 rounded-lg shadow">
                            <h3 class="font-bold mb-4">Recent Clients</h3>
                            <ul id="client-list-widget" class="space-y-3"></ul>
                        </div>
                    </div>
                </div>

                <!-- SETTINGS -->
                <div id="view-settings" class="view-section hidden fade-in">
                    <h2 class="text-3xl font-bold text-gray-800 mb-6">Company Settings</h2>
                    <div class="bg-white rounded-lg shadow-lg p-8 max-w-2xl">
                        <form onsubmit="saveSettings(event)">
                            <div class="mb-4">
                                <label class="block text-gray-700 font-bold mb-2">Company Name</label>
                                <input type="text" id="set-name" class="w-full border p-2 rounded" required>
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 font-bold mb-2">Email Address</label>
                                <input type="email" id="set-email" class="w-full border p-2 rounded" required>
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 font-bold mb-2">Phone Number</label>
                                <input type="text" id="set-phone" class="w-full border p-2 rounded">
                            </div>
                            <div class="mb-6">
                                <label class="block text-gray-700 font-bold mb-2">Address</label>
                                <textarea id="set-address" rows="3" class="w-full border p-2 rounded"></textarea>
                            </div>
                            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Save Settings</button>
                        </form>
                    </div>
                </div>

                <!-- CREATE/EDIT INVOICE -->
                <div id="view-create" class="view-section hidden fade-in">
                    <h2 class="text-3xl font-bold text-gray-800 mb-6" id="create-title">Create New Invoice</h2>
                    
                    <div class="bg-white rounded-lg shadow-lg p-8">
                        <form onsubmit="saveInvoice(event)">
                            <input type="hidden" id="inv-id"> <!-- Hidden ID for updates -->
                            
                            <!-- Header Info -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div>
                                    <label class="block text-gray-700 font-bold mb-2">Client Name</label>
                                    <input type="text" id="inv-client-name" list="client-datalist" onchange="autoFillClient()" class="w-full border p-2 rounded" placeholder="Search or enter new client..." required>
                                    <datalist id="client-datalist"></datalist>
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-bold mb-2">Invoice Number</label>
                                    <input type="text" id="inv-number" class="w-full border p-2 rounded" required>
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-bold mb-2">Client Email</label>
                                    <input type="email" id="inv-client-email" class="w-full border p-2 rounded" required>
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-bold mb-2">Currency</label>
                                    <select id="inv-currency" class="w-full border p-2 rounded bg-white">
                                        <option value="USD">USD ($) - United States</option>
                                        <option value="AUD">AUD ($) - Australia</option>
                                        <option value="CAD">CAD ($) - Canada</option>
                                        <option value="AED">AED (د.إ) - Dubai/UAE</option>
                                        <option value="INR">INR (₹) - India</option>
                                        <option value="GBP">GBP (£) - UK</option>
                                    </select>
                                </div>
                                <div class="col-span-1 md:col-span-2">
                                    <label class="block text-gray-700 font-bold mb-2">Client Address</label>
                                    <textarea id="inv-client-address" class="w-full border p-2 rounded" rows="2"></textarea>
                                </div>
                            </div>

                            <!-- Line Items -->
                            <div class="mb-6">
                                <h3 class="font-bold text-lg mb-2 border-b pb-2">Items</h3>
                                <table class="w-full text-left" id="items-table">
                                    <thead>
                                        <tr class="text-sm text-gray-600">
                                            <th class="py-2">Description</th>
                                            <th class="w-24">Qty</th>
                                            <th class="w-32">Rate</th>
                                            <th class="w-32">Amount</th>
                                            <th class="w-10"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="items-body"></tbody>
                                </table>
                                <button type="button" onclick="addItemRow()" class="mt-2 text-blue-600 hover:underline text-sm">+ Add Item</button>
                            </div>

                            <!-- Totals -->
                            <div class="flex justify-end">
                                <div class="w-64 space-y-2">
                                    <div class="flex justify-between"><span>Subtotal:</span><span id="display-subtotal">0.00</span></div>
                                    <div class="flex justify-between items-center">
                                        <span>Tax (%):</span>
                                        <input type="number" id="inv-tax-rate" value="0" oninput="calculateTotals()" class="w-16 border p-1 rounded text-right">
                                    </div>
                                    <div class="flex justify-between font-bold text-xl border-t pt-2"><span>Total:</span><span id="display-total">0.00</span></div>
                                </div>
                            </div>

                            <div class="mt-8 flex justify-end gap-4">
                                <button type="button" onclick="router('dashboard')" class="px-6 py-2 border rounded hover:bg-gray-50">Cancel</button>
                                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 shadow">Save Invoice</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- HISTORY -->
                <div id="view-history" class="view-section hidden fade-in">
                    <h2 class="text-3xl font-bold text-gray-800 mb-6">Invoice History</h2>
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <div class="p-4 border-b flex justify-between items-center">
                            <input type="text" id="search-history" placeholder="Search client or number..." class="border p-2 rounded w-64" onkeyup="renderHistory()">
                            <span class="text-sm text-gray-500">Manage all invoices</span>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                                    <tr>
                                        <th class="p-4">Status</th>
                                        <th class="p-4">Inv #</th>
                                        <th class="p-4">Client</th>
                                        <th class="p-4">Date</th>
                                        <th class="p-4 text-right">Amount</th>
                                        <th class="p-4 text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="history-body"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- PREVIEW MODAL -->
    <div id="invoice-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4 overflow-y-auto">
        <div class="bg-white rounded shadow-2xl w-full max-w-4xl relative min-h-screen md:min-h-0 md:h-auto">
            
            <div class="p-4 border-b flex justify-between items-center bg-gray-50 no-print">
                <h3 class="font-bold">Preview Invoice</h3>
                <div class="flex gap-2">
                    <button onclick="downloadPDF()" class="bg-red-600 text-white px-4 py-2 rounded text-sm hover:bg-red-700">
                        <i class="fa-solid fa-file-pdf"></i> Download PDF
                    </button>
                    <button onclick="closeModal()" class="text-gray-500 hover:text-gray-800 px-4">Close</button>
                </div>
            </div>

            <!-- Printable Content -->
            <div id="printable-invoice" class="p-10 bg-white text-gray-800">
                <div class="flex justify-between items-start mb-10">
                    <div>
                        <h1 class="text-4xl font-bold text-blue-800 mb-2">INVOICE</h1>
                        <p class="text-gray-600 text-sm">#<span id="modal-inv-num"></span></p>
                        <div id="modal-status-badge" class="mt-2 inline-block px-3 py-1 text-xs font-bold uppercase rounded bg-yellow-100 text-yellow-800 border border-yellow-200"></div>
                    </div>
                    <div class="text-right">
                        <h2 class="font-bold text-xl" id="modal-company-name"></h2>
                        <p id="modal-company-address" class="whitespace-pre-line text-sm"></p>
                        <p id="modal-company-email" class="text-sm"></p>
                        <p id="modal-company-phone" class="text-sm"></p>
                    </div>
                </div>

                <div class="flex justify-between mb-10 border-b pb-8">
                    <div>
                        <h3 class="font-bold text-gray-500 text-sm uppercase mb-2">Bill To:</h3>
                        <p class="font-bold text-lg" id="modal-client-name"></p>
                        <p class="text-gray-600 whitespace-pre-line" id="modal-client-address"></p>
                        <p class="text-blue-600" id="modal-client-email"></p>
                    </div>
                    <div class="text-right">
                        <div class="mb-2"><span class="text-gray-500 text-sm font-bold">Date:</span> <span id="modal-date"></span></div>
                        <div id="paid-date-container" class="hidden"><span class="text-gray-500 text-sm font-bold">Paid On:</span> <span id="modal-paid-date"></span></div>
                    </div>
                </div>

                <table class="w-full mb-8">
                    <thead class="bg-gray-100 border-b border-gray-300">
                        <tr>
                            <th class="text-left py-3 px-2 font-bold text-gray-600">Description</th>
                            <th class="text-right py-3 px-2 font-bold text-gray-600">Qty</th>
                            <th class="text-right py-3 px-2 font-bold text-gray-600">Rate</th>
                            <th class="text-right py-3 px-2 font-bold text-gray-600">Amount</th>
                        </tr>
                    </thead>
                    <tbody id="modal-items-body"></tbody>
                </table>

                <div class="flex justify-end">
                    <div class="w-1/2 md:w-1/3">
                        <div class="flex justify-between py-2 border-b"><span class="font-bold text-gray-600">Subtotal</span><span id="modal-subtotal"></span></div>
                        <div class="flex justify-between py-2 border-b"><span class="font-bold text-gray-600">Tax</span><span id="modal-tax"></span></div>
                        <div class="flex justify-between py-2 text-xl font-bold text-blue-900 mt-2"><span>Total</span><span id="modal-total"></span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT LOGIC -->
    <script>
        // Init with safe defaults to prevent 'undefined' errors
        let appData = { invoices: [], clients: [], settings: {} };
        let currentStatusChart = null;

        document.addEventListener('DOMContentLoaded', () => {
            fetchData();
        });

        async function fetchData() {
            try {
                const res = await fetch('index.php', { 
                    method: 'POST', 
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify({action: 'get_data'}) 
                });
                
                // Robust error handling for non-JSON responses (e.g., PHP warnings)
                const text = await res.text();
                try {
                    const data = JSON.parse(text);
                    // Ensure core structure exists
                    if (data && data.invoices && Array.isArray(data.invoices)) {
                        appData = data;
                    } else {
                        console.warn("Invalid data structure received, using defaults.");
                        appData = { invoices: [], clients: [], settings: {} };
                    }
                } catch (e) {
                    console.error("JSON Parse Error. Server sent:", text);
                }

                // Fill UI
                if(appData.settings) {
                    document.getElementById('set-name').value = appData.settings.company_name || '';
                    document.getElementById('set-email').value = appData.settings.company_email || '';
                    document.getElementById('set-address').value = appData.settings.company_address || '';
                    document.getElementById('set-phone').value = appData.settings.company_phone || '';
                }

                updateDashboard();
                renderHistory();
                populateClientDatalist();
            } catch (e) { console.error("Network error:", e); }
        }

        async function logout() {
            await fetch('index.php', { 
                method: 'POST', 
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({action: 'logout'}) 
            });
            location.reload();
        }

        function router(viewName) {
            document.querySelectorAll('.view-section').forEach(el => el.classList.add('hidden'));
            document.getElementById(`view-${viewName}`).classList.remove('hidden');
            if (viewName === 'history') renderHistory();
            if (viewName === 'dashboard') updateDashboard();
        }

        // --- DASHBOARD (RUPEE CONVERSION) ---
        function updateDashboard() {
            // Guard clause to prevent crash if data is missing
            if (!appData.invoices) return;

            const invoices = appData.invoices;
            
            // Rates (Convert TO INR)
            const rates = { 'USD': 84.5, 'AUD': 55.2, 'CAD': 60.1, 'AED': 23.0, 'INR': 1.0, 'GBP': 105.5 };
            
            let pendingSum = 0, paidSum = 0, paidCount = 0, pendingCount = 0, monthCount = 0;
            const thisMonth = new Date().getMonth();

            invoices.forEach(inv => {
                const amount = parseFloat(inv.total.replace(/,/g, ''));
                const rate = rates[inv.currency] || 1;
                const converted = amount * rate;
                
                if (inv.status === 'Paid') { paidSum += converted; paidCount++; }
                else { pendingSum += converted; pendingCount++; }
                if (new Date(inv.created_at).getMonth() === thisMonth) monthCount++;
            });

            document.getElementById('stat-total-count').innerText = invoices.length;
            document.getElementById('stat-pending').innerText = '₹' + pendingSum.toLocaleString('en-IN', {maximumFractionDigits: 0});
            document.getElementById('stat-paid').innerText = '₹' + paidSum.toLocaleString('en-IN', {maximumFractionDigits: 0});
            document.getElementById('stat-month').innerText = monthCount;

            const clientList = document.getElementById('client-list-widget');
            clientList.innerHTML = '';
            // Safe slice check
            if (appData.clients) {
                appData.clients.slice(0, 5).forEach(c => {
                    clientList.innerHTML += `<li class="flex justify-between border-b pb-2"><span class="font-medium">${c.name}</span> <span class="text-xs text-gray-500">${c.email}</span></li>`;
                });
            }

            const ctx = document.getElementById('statusChart').getContext('2d');
            if(currentStatusChart) currentStatusChart.destroy();
            currentStatusChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Paid', 'Pending'],
                    datasets: [{ data: [paidCount, pendingCount], backgroundColor: ['#22c55e', '#eab308'] }]
                }
            });
        }

        // --- SETTINGS ---
        async function saveSettings(e) {
            e.preventDefault();
            const settings = {
                company_name: document.getElementById('set-name').value,
                company_email: document.getElementById('set-email').value,
                company_address: document.getElementById('set-address').value,
                company_phone: document.getElementById('set-phone').value
            };
            const res = await fetch('index.php', { 
                method: 'POST', 
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({action: 'save_settings', settings: settings}) 
            });
            const data = await res.json();
            alert(data.message);
            fetchData();
        }

        // --- CRUD ---
        function resetForm() {
            document.getElementById('create-title').innerText = 'Create New Invoice';
            document.querySelector('#view-create form').reset();
            document.getElementById('inv-id').value = '';
            document.getElementById('inv-number').value = 'INV-' + Math.floor(Math.random()*100000);
            document.getElementById('items-body').innerHTML = '';
            addItemRow();
        }

        function editInvoice(id) {
            const inv = appData.invoices.find(i => i.id === id);
            if(!inv) return;

            resetForm();
            document.getElementById('create-title').innerText = 'Edit Invoice';
            document.getElementById('inv-id').value = inv.id;
            document.getElementById('inv-number').value = inv.number;
            document.getElementById('inv-client-name').value = inv.client_name;
            document.getElementById('inv-client-email').value = inv.client_email;
            document.getElementById('inv-client-address').value = inv.client_address;
            document.getElementById('inv-currency').value = inv.currency;
            document.getElementById('inv-tax-rate').value = inv.tax_rate;
            
            document.getElementById('items-body').innerHTML = '';
            inv.items.forEach(item => {
                addItemRow(item.desc, item.qty, item.rate);
            });
            calculateTotals();
            router('create');
        }

        async function deleteInvoice(id) {
            if(!confirm("Are you sure you want to delete this invoice?")) return;
            await fetch('index.php', { 
                method: 'POST', 
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({action: 'delete_invoice', id: id}) 
            });
            fetchData();
        }

        async function saveInvoice(e) {
            e.preventDefault();
            const items = [];
            document.querySelectorAll('#items-body tr').forEach(row => {
                items.push({
                    desc: row.querySelector('input[name="item_desc[]"]').value,
                    qty: row.querySelector('input[name="item_qty[]"]').value,
                    rate: row.querySelector('input[name="item_rate[]"]').value,
                    amount: row.querySelector('.row-amount').innerText
                });
            });

            const invoiceData = {
                id: document.getElementById('inv-id').value,
                number: document.getElementById('inv-number').value,
                client_name: document.getElementById('inv-client-name').value,
                client_email: document.getElementById('inv-client-email').value,
                client_address: document.getElementById('inv-client-address').value,
                currency: document.getElementById('inv-currency').value,
                items: items,
                subtotal: document.getElementById('display-subtotal').innerText,
                tax_rate: document.getElementById('inv-tax-rate').value,
                total: document.getElementById('display-total').innerText
            };

            try {
                const res = await fetch('index.php', { 
                    method: 'POST', 
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify({action: 'save_invoice', invoice_data: invoiceData}) 
                });
                
                // Parse safely
                const text = await res.text();
                let result;
                try {
                     result = JSON.parse(text);
                } catch(e) {
                    throw new Error("Server returned non-JSON: " + text);
                }

                if(result.status === 'success') {
                    alert(result.message);
                    fetchData();
                    router('history');
                } else {
                    alert('Error: ' + result.message);
                }
            } catch(err) {
                console.error(err);
                alert("Failed to save. See console for details.");
            }
        }

        function addItemRow(desc='', qty=1, rate=0) {
            const tbody = document.getElementById('items-body');
            const row = document.createElement('tr');
            row.className = "border-b";
            row.innerHTML = `
                <td class="py-2 pr-2"><input type="text" name="item_desc[]" class="w-full border p-1 rounded" placeholder="Item name" required></td>
                <td class="py-2 pr-2"><input type="number" name="item_qty[]" oninput="calculateTotals()" class="w-full border p-1 rounded text-right" required></td>
                <td class="py-2 pr-2"><input type="number" name="item_rate[]" step="0.01" oninput="calculateTotals()" class="w-full border p-1 rounded text-right" required></td>
                <td class="py-2 pr-2 text-right font-medium row-amount">0.00</td>
                <td class="py-2 text-center"><button type="button" onclick="this.closest('tr').remove(); calculateTotals()" class="text-red-500"><i class="fa-solid fa-trash"></i></button></td>
            `;

            // Set values securely to prevent quote truncation issues
            row.querySelector('input[name="item_desc[]"]').value = desc;
            row.querySelector('input[name="item_qty[]"]').value = qty;
            row.querySelector('input[name="item_rate[]"]').value = rate;

            tbody.appendChild(row);
            if(desc) calculateTotals();
        }

        function calculateTotals() {
            let subtotal = 0;
            document.querySelectorAll('#items-body tr').forEach(row => {
                const qty = parseFloat(row.querySelector('input[name="item_qty[]"]').value) || 0;
                const rate = parseFloat(row.querySelector('input[name="item_rate[]"]').value) || 0;
                const amount = qty * rate;
                row.querySelector('.row-amount').innerText = amount.toFixed(2);
                subtotal += amount;
            });
            const taxRate = parseFloat(document.getElementById('inv-tax-rate').value) || 0;
            const total = subtotal + (subtotal * (taxRate / 100));
            document.getElementById('display-subtotal').innerText = subtotal.toFixed(2);
            document.getElementById('display-total').innerText = total.toFixed(2);
        }

        // --- HISTORY VIEW ---
        function renderHistory() {
            const tbody = document.getElementById('history-body');
            tbody.innerHTML = '';
            // Safe guard
            if (!appData.invoices) return;

            const search = document.getElementById('search-history').value.toLowerCase();

            appData.invoices.forEach(inv => {
                if(inv.client_name.toLowerCase().includes(search) || inv.number.toLowerCase().includes(search)) {
                    const statusColor = inv.status === 'Paid' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800';
                    const paidBtn = inv.status === 'Pending' ? `<button onclick="markPaid('${inv.id}')" class="text-green-600 hover:text-green-800 mx-1" title="Mark Paid"><i class="fa-solid fa-check"></i></button>` : '';

                    tbody.innerHTML += `
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-4"><span class="px-2 py-1 rounded text-xs font-bold uppercase ${statusColor}">${inv.status}</span></td>
                            <td class="p-4 font-mono text-sm">${inv.number}</td>
                            <td class="p-4 font-bold">${inv.client_name}</td>
                            <td class="p-4 text-sm text-gray-500">${new Date(inv.created_at).toLocaleDateString()}</td>
                            <td class="p-4 text-right font-mono">${inv.total} ${inv.currency}</td>
                            <td class="p-4 text-center">
                                ${paidBtn}
                                <button onclick="editInvoice('${inv.id}')" class="text-blue-500 hover:text-blue-700 mx-1" title="Edit"><i class="fa-solid fa-pen"></i></button>
                                <button onclick="viewInvoice('${inv.id}')" class="text-gray-600 hover:text-gray-800 mx-1" title="View/PDF"><i class="fa-solid fa-eye"></i></button>
                                <button onclick="deleteInvoice('${inv.id}')" class="text-red-500 hover:text-red-700 mx-1" title="Delete"><i class="fa-solid fa-trash"></i></button>
                            </td>
                        </tr>
                    `;
                }
            });
        }

        // --- MODAL & PDF ---
        function viewInvoice(id) {
            const inv = appData.invoices.find(i => i.id === id);
            
            // Fill Company Details
            document.getElementById('modal-company-name').innerText = appData.settings.company_name || 'My Agency';
            document.getElementById('modal-company-email').innerText = appData.settings.company_email || '';
            document.getElementById('modal-company-address').innerText = appData.settings.company_address || '';
            document.getElementById('modal-company-phone').innerText = appData.settings.company_phone || '';

            // Fill Invoice Details
            document.getElementById('modal-inv-num').innerText = inv.number;
            document.getElementById('modal-client-name').innerText = inv.client_name;
            document.getElementById('modal-client-address').innerText = inv.client_address;
            document.getElementById('modal-client-email').innerText = inv.client_email;
            document.getElementById('modal-date').innerText = new Date(inv.created_at).toLocaleDateString();
            
            // Status
            const badge = document.getElementById('modal-status-badge');
            badge.innerText = inv.status;
            badge.className = inv.status === 'Paid' ? "mt-2 inline-block px-3 py-1 text-xs font-bold uppercase rounded bg-green-100 text-green-800 border border-green-200" : "mt-2 inline-block px-3 py-1 text-xs font-bold uppercase rounded bg-yellow-100 text-yellow-800 border border-yellow-200";

            const tbody = document.getElementById('modal-items-body');
            tbody.innerHTML = '';
            inv.items.forEach(item => {
                tbody.innerHTML += `
                    <tr class="border-b border-gray-100">
                        <td class="py-2 px-2">${item.desc}</td>
                        <td class="text-right py-2 px-2">${item.qty}</td>
                        <td class="text-right py-2 px-2">${item.rate}</td>
                        <td class="text-right py-2 px-2">${item.amount}</td>
                    </tr>`;
            });

            document.getElementById('modal-subtotal').innerText = inv.subtotal + ' ' + inv.currency;
            document.getElementById('modal-tax').innerText = `(${inv.tax_rate}%)`;
            document.getElementById('modal-total').innerText = inv.total + ' ' + inv.currency;

            document.getElementById('invoice-modal').classList.remove('hidden');
        }

        function downloadPDF() {
            const element = document.getElementById('printable-invoice');
            const opt = {
                margin: 0.5,
                filename: `Invoice_${document.getElementById('modal-inv-num').innerText}.pdf`,
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
            };
            html2pdf().set(opt).from(element).save();
        }

        function closeModal() { document.getElementById('invoice-modal').classList.add('hidden'); }
        async function markPaid(id) {
            if(!confirm("Mark this invoice as Paid?")) return;
            await fetch('index.php', { 
                method: 'POST', 
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({action: 'mark_paid', id: id}) 
            });
            fetchData();
        }
        function populateClientDatalist() {
            const dl = document.getElementById('client-datalist'); dl.innerHTML = '';
            // Safe guard
            if(appData.clients) {
                appData.clients.forEach(c => { const opt = document.createElement('option'); opt.value = c.name; dl.appendChild(opt); });
            }
        }
        function autoFillClient() {
            const name = document.getElementById('inv-client-name').value;
            // Prevent finding undefined
            if(!appData.clients) return;

            const client = appData.clients.find(c => c.name === name);
            if (client) {
                document.getElementById('inv-client-email').value = client.email;
                document.getElementById('inv-client-address').value = client.address;
            }
        }
    </script>
    <?php endif; ?>
</body>
</html>