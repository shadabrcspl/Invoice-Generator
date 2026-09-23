<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\CompanySettingController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmailSettingController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\InvoiceEmailController;
use App\Http\Controllers\InvoicePdfController;
use App\Http\Controllers\Gstr1ExportController;
use App\Http\Controllers\ExpenseController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Authentication Locked Group (Breeze Setup)
Route::middleware(['auth', 'verified', 'approved'])->group(function () {
    
    // Dashboard Route
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Clients CRUD Directory
    Route::resource('clients', ClientController::class)->except(['create', 'show']);

    // Expenses CRUD Directory
    Route::get('expenses/export', [ExpenseController::class, 'export'])->name('expenses.export');
    Route::resource('expenses', ExpenseController::class)->except(['show']);

    // Company profile settings
    Route::get('settings', [CompanySettingController::class, 'edit'])->name('settings.edit');
    Route::put('settings', [CompanySettingController::class, 'update'])->name('settings.update');
    Route::put('profile', [CompanySettingController::class, 'updateProfile'])->name('profile.update');

    // Currencies management
    Route::get('currencies', fn() => redirect()->route('settings.edit'))->name('currencies.index');
    Route::post('currencies', [CurrencyController::class, 'store'])->name('currencies.store');
    Route::delete('currencies/{currency}', [CurrencyController::class, 'destroy'])->name('currencies.destroy');
    Route::post('currencies/fetch-rates', [CurrencyController::class, 'fetchRates'])->name('currencies.fetch-rates');

    // PDF triggers
    Route::get('invoices/{invoice}/pdf', [InvoicePdfController::class, 'download'])->name('invoices.pdf');
    Route::get('invoices/{invoice}/stream', [InvoicePdfController::class, 'stream'])->name('invoices.pdf-stream');

    // Invoices CRUD Resource (using UUIDs implicitly via Eloquent model binding)
    Route::resource('invoices', InvoiceController::class);
    Route::post('invoices/{invoice}/convert', [InvoiceController::class, 'convertToInvoice'])->name('quotations.convert');
    Route::post('invoices/{invoice}/record-payment', [InvoiceController::class, 'recordPayment'])->name('invoices.record-payment');

    // GSTR-1 & Forex Reconciliation Dashboard
    Route::get('gstr1', [Gstr1ExportController::class, 'index'])->name('gstr1.index');
    Route::get('gstr1/export', [Gstr1ExportController::class, 'export'])->name('gstr1.export');

    // Send Invoice Email (with logging)
    Route::post('invoices/{invoice}/send-email', [InvoiceEmailController::class, 'send'])->name('invoices.send-email');
    Route::post('invoices/{invoice}/send-reminder', [InvoiceEmailController::class, 'reminder'])->name('invoices.send-reminder');

    // Email Settings (per-user SMTP configuration)
    Route::get('email-settings', [EmailSettingController::class, 'edit'])->name('email-settings.edit');
    Route::put('email-settings', [EmailSettingController::class, 'update'])->name('email-settings.update');
    Route::post('email-settings/test', [EmailSettingController::class, 'test'])->name('email-settings.test');
    Route::delete('email-settings', [EmailSettingController::class, 'destroy'])->name('email-settings.destroy');



    // Admin User Approval Panel
    Route::middleware(['admin'])->group(function () {
        Route::get('admin/users', [App\Http\Controllers\AdminUserController::class, 'index'])->name('admin.users.index');
        Route::post('admin/users/{user}/approve', [App\Http\Controllers\AdminUserController::class, 'approve'])->name('admin.users.approve');
        Route::post('admin/users/{user}/reject', [App\Http\Controllers\AdminUserController::class, 'reject'])->name('admin.users.reject');
    });

});

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/pricing', [App\Http\Controllers\HomeController::class, 'pricing'])->name('pricing');
Route::get('/for/freelancers', [App\Http\Controllers\HomeController::class, 'forFreelancers'])->name('for.freelancers');
Route::get('/for/contractors', [App\Http\Controllers\HomeController::class, 'forContractors'])->name('for.contractors');
Route::get('/features/e-invoicing', [App\Http\Controllers\HomeController::class, 'featuresEInvoicing'])->name('features.e-invoicing');
Route::get('/free-invoice-generator', [App\Http\Controllers\HomeController::class, 'freeInvoiceGenerator'])->name('free-invoice-generator');

// Contact Desk (GET renders dedicated page, POST handles submission)
Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contactView'])->name('contact.view');
Route::post('/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact');

// Public Legal and Compliance Pages
Route::get('/privacy', [App\Http\Controllers\HomeController::class, 'privacy'])->name('privacy');
Route::get('/privacy-policy', [App\Http\Controllers\HomeController::class, 'privacy']);
Route::get('/terms', [App\Http\Controllers\HomeController::class, 'terms'])->name('terms');
Route::get('/terms-of-use', [App\Http\Controllers\HomeController::class, 'terms']);

Route::get('/pending-approval', [App\Http\Controllers\Auth\RegisteredUserController::class, 'pendingView'])->name('auth.pending');

// Auth Routes placeholder (will be handled by Breeze)
require __DIR__.'/auth.php';
