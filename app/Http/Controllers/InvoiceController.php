<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInvoiceRequest;
use App\Mail\InvoiceCreatedAdminMail;
use App\Models\Client;
use App\Models\CompanySetting;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\ExchangeRate;
use App\Services\ExchangeRateService;
use App\Services\UserMailer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $type = $request->get('type', 'invoice');
        $query = Invoice::with('client')
            ->where('user_id', Auth::id())
            ->where('type', $type);

        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        if ($request->has('start_date') && $request->start_date !== '') {
            $query->whereDate('invoice_date', '>=', $request->start_date);
        }

        if ($request->has('end_date') && $request->end_date !== '') {
            $query->whereDate('invoice_date', '<=', $request->end_date);
        }

        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('invoice_number', 'like', "%{$search}%")
                  ->orWhereHas('client', function($cq) use ($search) {
                      $cq->where('name', 'like', "%{$search}%");
                  });
            });
        }

        $invoices = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('invoices.index', compact('invoices', 'type'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $userId = Auth::id();
        $clients = Client::where('user_id', $userId)->orderBy('name')->get();
        $companySetting = CompanySetting::where('user_id', $userId)->first();
        
        $type = $request->get('type', 'invoice');

        // Dynamic Default Invoice/Quotation Number (e.g. INV-202507-0001)
        // Strategy: find the highest sequence number ever used for this user+type,
        // then increment it. This is month-agnostic and gap-proof.
        $year = date('Y');
        $month = date('m');
        $prefix = $type === 'quotation' ? 'QUO' : 'INV';

        // Pull all invoice_numbers for this user+type that match the prefix pattern
        $lastInvoice = Invoice::where('user_id', $userId)
            ->where('type', $type)
            ->where('invoice_number', 'like', "{$prefix}-%")
            ->get(['invoice_number'])
            ->sortByDesc(function ($invoice) {
                $parts = explode('-', $invoice->invoice_number);
                return (int) end($parts);
            })
            ->first();

        if ($lastInvoice) {
            // Extract the trailing sequence segment (e.g. "0007" from "INV-202506-0007")
            $parts = explode('-', $lastInvoice->invoice_number);
            $lastSeq = (int) end($parts);
            $nextSeq = $lastSeq + 1;
        } else {
            $nextSeq = 1;
        }

        $nextNumber = str_pad($nextSeq, 4, '0', STR_PAD_LEFT);
        $defaultInvoiceNumber = "{$prefix}-{$year}{$month}-{$nextNumber}";

        // Get latest rates for frontend JS preview calculations.
        // Use DB rates in bulk; only call API once for the full set if any are missing.
        $activeCurrencies = \App\Models\Currency::where('user_id', $userId)->where('is_active', true)->orderBy('code')->get();

        $latestRates = ['INR' => 1.0];
        $missingCodes = [];

        foreach ($activeCurrencies as $curr) {
            $dbRate = ExchangeRate::getRateForDate($curr->code);
            if ($dbRate !== null) {
                $latestRates[$curr->code] = $dbRate;
            } else {
                $missingCodes[] = $curr->code;
            }
        }

        // Make a single API call to get all missing rates at once
        if (!empty($missingCodes)) {
            try {
                $apiKey  = config('app.exchangerate.key');
                $baseUrl = config('app.exchangerate.url');
                if ($apiKey) {
                    $response = \Illuminate\Support\Facades\Http::timeout(8)->get("{$baseUrl}/{$apiKey}/latest/INR");
                    if ($response->successful() && $response->json('result') === 'success') {
                        $rates = $response->json('conversion_rates') ?? [];
                        foreach ($missingCodes as $code) {
                            if (isset($rates[$code]) && (float) $rates[$code] > 0) {
                                $latestRates[$code] = round(1.0 / (float) $rates[$code], 6);
                            } else {
                                $latestRates[$code] = null;
                            }
                        }
                    }
                }
            } catch (\Exception $e) {
                foreach ($missingCodes as $code) {
                    $latestRates[$code] = null;
                }
            }
        }

        return view('invoices.create', compact('clients', 'companySetting', 'defaultInvoiceNumber', 'type', 'latestRates', 'activeCurrencies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInvoiceRequest $request)
    {
        $validated = $request->validated();
        $userId = Auth::id();
        $type = $validated['type'] ?? 'invoice';

        // Perform calculation security check in backend controller
        $subtotal = 0;
        $taxAmount = 0;
        
        $itemsData = [];
        foreach ($validated['items'] as $item) {
            $qty = floatval($item['qty']);
            $rate = floatval($item['rate']);
            $taxPercent = floatval($item['tax_percent']);
            
            $itemSubtotal = $qty * $rate;
            $itemTax = $itemSubtotal * ($taxPercent / 100);
            $itemTotal = $itemSubtotal + $itemTax; // Tax-inclusive row total
            
            $subtotal += $itemSubtotal;
            $taxAmount += $itemTax;

            $itemsData[] = [
                'item_name' => $item['item_name'],
                'description' => $item['description'] ?? null,
                'sac_code' => $item['sac_code'] ?? '998315',
                'qty' => $qty,
                'rate' => $rate,
                'tax_percent' => $taxPercent,
                'total' => round($itemTotal, 2)
            ];
        }

        // Round at the final storage step to prevent rounding drift
        $subtotalStored = round($subtotal, 2);
        $taxAmountStored = round($taxAmount, 2);
        $grandTotal = $subtotalStored + $taxAmountStored;

        // Determine the locked exchange rate and INR equivalent on invoice date.
        // Order of resolution: Override → DB stored rate → live API rate → 1.0 (safe no-op)
        $currencyCode = $validated['currency_code'];
        $invoiceDate  = $validated['invoice_date'];
        if ($currencyCode === 'INR') {
            $exchangeRateInr = 1.0;
        } else {
            $exchangeRateInr = isset($validated['exchange_rate_inr']) && $validated['exchange_rate_inr'] > 0 
                            ? floatval($validated['exchange_rate_inr']) 
                            : (ExchangeRate::getRateForDate($currencyCode, $invoiceDate)
                                ?? ExchangeRateService::getLiveRate($currencyCode)
                                ?? 1.0);
        }
        $inrEquivalent = round($grandTotal * $exchangeRateInr, 2);

        // Perform transactional write
        $invoice = DB::transaction(function () use ($validated, $userId, $subtotalStored, $taxAmountStored, $grandTotal, $itemsData, $type, $exchangeRateInr, $inrEquivalent) {
            $invoice = Invoice::create([
                'user_id' => $userId,
                'client_id' => $validated['client_id'],
                'invoice_number' => $validated['invoice_number'],
                'invoice_date' => $validated['invoice_date'],
                'due_date' => $validated['due_date'],
                'currency_code' => $validated['currency_code'],
                'currency_symbol' => $validated['currency_symbol'],
                'subtotal' => $subtotalStored,
                'tax_amount' => $taxAmountStored,
                'grand_total' => $grandTotal,
                'notes' => $validated['notes'] ?? null,
                'bank_notes' => $validated['bank_notes'] ?? null,
                'status' => $validated['status'],
                'type' => $type,
                'exchange_rate_inr' => $exchangeRateInr,
                'inr_equivalent' => $inrEquivalent,
                'firc_number' => $validated['firc_number'] ?? null,
                'actual_exchange_rate' => isset($validated['actual_exchange_rate']) ? floatval($validated['actual_exchange_rate']) : null,
                'actual_inr_received' => isset($validated['actual_inr_received']) ? floatval($validated['actual_inr_received']) : null,
            ]);

            foreach ($itemsData as $item) {
                $invoice->items()->create($item);
            }

            return $invoice;
        });

        // Fire admin notification email (using user's custom SMTP if configured) - Only for invoices
        if ($invoice->type === 'invoice') {
            try {
                $invoice->load(['client', 'user']);
                UserMailer::for(Auth::user())
                    ->to(Auth::user()->email)
                    ->send(new InvoiceCreatedAdminMail($invoice));
            } catch (\Exception $e) {
                // Fail silently — don't block invoice creation
            }
        }



        return redirect()->route('invoices.show', $invoice->id)->with('success', $type === 'quotation' ? 'Quotation generated successfully!' : 'Invoice generated successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        $this->authorize('view', $invoice);
        $invoice->load(['client', 'items', 'user.companySetting', 'payment']);
        return view('invoices.show', compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        $this->authorize('view', $invoice);
        $invoice->load(['items', 'payment']);
        
        $userId = Auth::id();
        $clients = Client::where('user_id', $userId)->orderBy('name')->get();
        $companySetting = CompanySetting::where('user_id', $userId)->first();

        // Get latest rates for frontend JS preview calculations.
        // Use DB rates in bulk; only call API once for the full set if any are missing.
        $activeCurrencies = \App\Models\Currency::where('user_id', $userId)->where('is_active', true)->orderBy('code')->get();

        $latestRates = ['INR' => 1.0];
        $missingCodes = [];

        foreach ($activeCurrencies as $curr) {
            $dbRate = ExchangeRate::getRateForDate($curr->code);
            if ($dbRate !== null) {
                $latestRates[$curr->code] = $dbRate;
            } else {
                $missingCodes[] = $curr->code;
            }
        }

        // Make a single API call to get all missing rates at once
        if (!empty($missingCodes)) {
            try {
                $apiKey  = config('app.exchangerate.key');
                $baseUrl = config('app.exchangerate.url');
                if ($apiKey) {
                    $response = \Illuminate\Support\Facades\Http::timeout(8)->get("{$baseUrl}/{$apiKey}/latest/INR");
                    if ($response->successful() && $response->json('result') === 'success') {
                        $rates = $response->json('conversion_rates') ?? [];
                        foreach ($missingCodes as $code) {
                            if (isset($rates[$code]) && (float) $rates[$code] > 0) {
                                $latestRates[$code] = round(1.0 / (float) $rates[$code], 6);
                            } else {
                                $latestRates[$code] = null;
                            }
                        }
                    }
                }
            } catch (\Exception $e) {
                foreach ($missingCodes as $code) {
                    $latestRates[$code] = null;
                }
            }
        }

        return view('invoices.edit', compact('invoice', 'clients', 'companySetting', 'latestRates', 'activeCurrencies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreInvoiceRequest $request, Invoice $invoice)
    {
        $this->authorize('update', $invoice);
        $validated = $request->validated();

        $subtotal = 0;
        $taxAmount = 0;
        
        $itemsData = [];
        foreach ($validated['items'] as $item) {
            $qty = floatval($item['qty']);
            $rate = floatval($item['rate']);
            $taxPercent = floatval($item['tax_percent']);
            
            $itemSubtotal = $qty * $rate;
            $itemTax = $itemSubtotal * ($taxPercent / 100);
            $itemTotal = $itemSubtotal + $itemTax; // Tax-inclusive row total
            
            $subtotal += $itemSubtotal;
            $taxAmount += $itemTax;

            $itemsData[] = [
                'item_name' => $item['item_name'],
                'description' => $item['description'] ?? null,
                'sac_code' => $item['sac_code'] ?? '998315',
                'qty' => $qty,
                'rate' => $rate,
                'tax_percent' => $taxPercent,
                'total' => round($itemTotal, 2)
            ];
        }

        // Round at the final storage step to prevent rounding drift
        $subtotalStored = round($subtotal, 2);
        $taxAmountStored = round($taxAmount, 2);
        $grandTotal = $subtotalStored + $taxAmountStored;

        // Determine the locked exchange rate and INR equivalent on invoice date.
        // Order of resolution: Override → DB stored rate → live API rate → 1.0 (safe no-op)
        $currencyCode = $validated['currency_code'];
        $invoiceDate  = $validated['invoice_date'];
        if ($currencyCode === 'INR') {
            $exchangeRateInr = 1.0;
        } else {
            $exchangeRateInr = isset($validated['exchange_rate_inr']) && $validated['exchange_rate_inr'] > 0 
                            ? floatval($validated['exchange_rate_inr']) 
                            : (ExchangeRate::getRateForDate($currencyCode, $invoiceDate)
                                ?? ExchangeRateService::getLiveRate($currencyCode)
                                ?? 1.0);
        }
        $inrEquivalent = round($grandTotal * $exchangeRateInr, 2);

        DB::transaction(function () use ($invoice, $validated, $subtotalStored, $taxAmountStored, $grandTotal, $itemsData, $exchangeRateInr, $inrEquivalent) {
            $fircNumberInput = $validated['firc_number'] ?? null;
            $actualExchangeRate = isset($validated['actual_exchange_rate']) ? floatval($validated['actual_exchange_rate']) : null;
            $actualInrReceived = isset($validated['actual_inr_received']) ? floatval($validated['actual_inr_received']) : null;

            $invoice->update([
                'client_id' => $validated['client_id'],
                'invoice_number' => $validated['invoice_number'],
                'invoice_date' => $validated['invoice_date'],
                'due_date' => $validated['due_date'],
                'currency_code' => $validated['currency_code'],
                'currency_symbol' => $validated['currency_symbol'],
                'subtotal' => $subtotalStored,
                'tax_amount' => $taxAmountStored,
                'grand_total' => $grandTotal,
                'notes' => $validated['notes'] ?? null,
                'bank_notes' => $validated['bank_notes'] ?? null,
                'status' => $validated['status'],
                'type' => $validated['type'] ?? $invoice->type,
                'exchange_rate_inr' => $exchangeRateInr,
                'inr_equivalent' => $inrEquivalent,
                'firc_number' => $fircNumberInput,
                'actual_exchange_rate' => $actualExchangeRate,
                'actual_inr_received' => $actualInrReceived,
            ]);

            // Synchronize with payment record if payment exists
            if ($invoice->payment) {
                $paymentUpdates = [];
                if ($fircNumberInput !== null) {
                    $paymentUpdates['firc_number'] = $fircNumberInput;
                }
                if ($actualExchangeRate !== null && $actualExchangeRate > 0) {
                    $paymentUpdates['exchange_rate_payment'] = $actualExchangeRate;
                }
                if ($actualInrReceived !== null && $actualInrReceived > 0) {
                    $paymentUpdates['inr_amount_received'] = $actualInrReceived;
                    $paymentUpdates['forex_gain_loss'] = $actualInrReceived - $inrEquivalent;
                }
                if (!empty($paymentUpdates)) {
                    $invoice->payment->update($paymentUpdates);
                }
            }

            // Recreate line items
            $invoice->items()->delete();
            foreach ($itemsData as $item) {
                $invoice->items()->create($item);
            }
        });

        $docName = ($validated['type'] ?? $invoice->type) === 'quotation' ? 'Quotation' : 'Invoice';
        return redirect()->route('invoices.show', $invoice->id)->with('success', "{$docName} updated successfully!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        $this->authorize('delete', $invoice);
        $type = $invoice->type;
        $invoice->delete();

        $redirectRoute = $type === 'quotation' ? route('invoices.index', ['type' => 'quotation']) : route('invoices.index');
        return redirect()->to($redirectRoute)->with('success', ($type === 'quotation' ? 'Quotation' : 'Invoice') . ' deleted successfully!');
    }

    /**
     * Convert a quotation to a formal invoice.
     */
    public function convertToInvoice(Invoice $invoice)
    {
        $this->authorize('update', $invoice);

        if ($invoice->type !== 'quotation') {
            return redirect()->back()->with('error', 'Only quotations can be converted to invoices.');
        }

        $userId = Auth::id();

        $newInvoiceNumber = DB::transaction(function () use ($invoice, $userId) {
            // Lock the row to prevent race conditions on concurrent conversions
            $invoice = Invoice::lockForUpdate()->findOrFail($invoice->id);

            $year = date('Y');
            $month = date('m');
            // Count only within the transaction lock to prevent duplicates
            $invoiceCount = Invoice::where('user_id', $userId)
                ->where('type', 'invoice')
                ->whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->count();
            $nextNumber = str_pad($invoiceCount + 1, 4, '0', STR_PAD_LEFT);
            $newInvoiceNumber = "INV-{$year}{$month}-{$nextNumber}";

            $invoice->update([
                'type'           => 'invoice',
                'invoice_number' => $newInvoiceNumber,
                'status'         => 'draft',
                'invoice_date'   => now()->format('Y-m-d'),
                'due_date'       => now()->addDays(14)->format('Y-m-d'),
            ]);

            return $newInvoiceNumber;
        });



        return redirect()->route('invoices.show', $invoice->id)
            ->with('success', 'Quotation successfully converted to Invoice ' . $newInvoiceNumber);
    }

    /**
     * Record a payment receipt for this invoice.
     */
    public function recordPayment(Request $request, Invoice $invoice)
    {
        $this->authorize('update', $invoice);

        $rules = [
            'payment_date'        => ['required', 'date'],
            'inr_amount_received' => ['required', 'numeric', 'min:0'],
            'firc_number'         => ['nullable', 'string', 'max:255'],
        ];

        if ($invoice->currency_code !== 'INR') {
            $rules['exchange_rate_payment'] = ['required', 'numeric', 'min:0'];
        } else {
            $rules['exchange_rate_payment'] = ['nullable', 'numeric'];
        }

        $validated = $request->validate($rules);

        $currency = $invoice->currency_code;
        $invoicedInr = floatval($invoice->inr_equivalent ?? $invoice->grand_total);
        
        $inrReceived = floatval($validated['inr_amount_received']);
        $exchangeRatePayment = $currency === 'INR' ? 1.0 : floatval($validated['exchange_rate_payment'] ?? 1.0);
        
        // Calculate Forex Gain/Loss: Received INR - Locked Invoice INR
        $forexGainLoss = $currency === 'INR' ? 0.00 : ($inrReceived - $invoicedInr);

        DB::transaction(function () use ($invoice, $validated, $exchangeRatePayment, $inrReceived, $forexGainLoss) {
            // Update invoice status and inline FIRC fields (for backward compatibility)
            $invoice->update([
                'status' => 'paid',
                'firc_number' => $validated['firc_number'] ?? null,
                'actual_exchange_rate' => $exchangeRatePayment,
                'actual_inr_received' => $inrReceived,
            ]);

            // Save in payments table
            $invoice->payment()->updateOrCreate(
                ['invoice_id' => $invoice->id],
                [
                    'payment_date'          => $validated['payment_date'],
                    'exchange_rate_payment' => $exchangeRatePayment,
                    'inr_amount_received'   => $inrReceived,
                    'forex_gain_loss'       => $forexGainLoss,
                    'firc_number'           => $validated['firc_number'] ?? null,
                ]
            );
        });

        // Flag warning if there is a variance of more than 10%
        $percentDifference = $invoicedInr > 0 ? (abs($inrReceived - $invoicedInr) / $invoicedInr) : 0;
        $warningMsg = '';
        if ($percentDifference > 0.10) {
            $warningMsg = ' Note: The payment is flagged because the actual received amount has a variation of ' . number_format($percentDifference * 100, 1) . '% from the invoiced amount.';
        }



        return redirect()->route('invoices.show', $invoice->id)
            ->with('success', 'Payment recorded successfully!' . $warningMsg);
    }
}
