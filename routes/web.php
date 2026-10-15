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
    Route::post('invoices/fema-declaration/consolidated', [InvoiceController::class, 'downloadConsolidatedFemaDeclaration'])->name('invoices.fema-declaration.consolidated');
    Route::resource('invoices', InvoiceController::class);
    Route::post('invoices/{invoice}/convert', [InvoiceController::class, 'convertToInvoice'])->name('quotations.convert');
    Route::post('invoices/{invoice}/record-payment', [InvoiceController::class, 'recordPayment'])->name('invoices.record-payment');
    Route::get('invoices/{invoice}/fema-declaration', [InvoiceController::class, 'downloadFemaDeclaration'])->name('invoices.fema-declaration');

    // GSTR-1 & Forex Reconciliation Dashboard
    Route::get('gstr1', [Gstr1ExportController::class, 'index'])->name('gstr1.index');
    Route::get('gstr1/export', [Gstr1ExportController::class, 'export'])->name('gstr1.export');
    Route::get('gstr1/export-json', [Gstr1ExportController::class, 'exportJson'])->name('gstr1.export-json');

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

// Solutions by Persona & Industry (Enterprise Silo)
Route::get('/solutions/freelancers', [App\Http\Controllers\HomeController::class, 'forFreelancers'])->name('solutions.freelancers');
Route::get('/solutions/contractors', [App\Http\Controllers\HomeController::class, 'forContractors'])->name('solutions.contractors');
Route::get('/solutions/small-business', [App\Http\Controllers\HomeController::class, 'forSmallBusiness'])->name('solutions.small-business');
Route::get('/solutions/agencies', [App\Http\Controllers\HomeController::class, 'forAgencies'])->name('solutions.agencies');
Route::get('/solutions/consultants', [App\Http\Controllers\HomeController::class, 'forConsultants'])->name('solutions.consultants');

// 301 Redirects for Legacy /for/ URLs
Route::permanentRedirect('/for/freelancers', '/solutions/freelancers');
Route::permanentRedirect('/for/contractors', '/solutions/contractors');
Route::permanentRedirect('/for/small-business', '/solutions/small-business');
Route::permanentRedirect('/for/agencies', '/solutions/agencies');
Route::permanentRedirect('/for/consultants', '/solutions/consultants');

// Feature Pillars
Route::get('/features/e-invoicing', [App\Http\Controllers\HomeController::class, 'featuresEInvoicing'])->name('features.e-invoicing');
Route::get('/features/recurring-invoices', [App\Http\Controllers\HomeController::class, 'featuresRecurringInvoices'])->name('features.recurring-invoices');
Route::get('/features/invoice-tracking', [App\Http\Controllers\HomeController::class, 'featuresInvoiceTracking'])->name('features.invoice-tracking');
Route::get('/features/multi-currency', [App\Http\Controllers\HomeController::class, 'featuresMultiCurrency'])->name('features.multi-currency');
Route::get('/features/quotations', [App\Http\Controllers\HomeController::class, 'featuresQuotations'])->name('features.quotations');

// Statutory Guides (Enterprise Silo)
Route::get('/guides/gst-lut', [App\Http\Controllers\HomeController::class, 'gstLutGuide'])->name('guides.gst-lut');
Route::get('/guides/firc-e-brc', [App\Http\Controllers\HomeController::class, 'fircEBrcGuide'])->name('guides.firc-e-brc');
Route::get('/guides/fema-23r', [App\Http\Controllers\HomeController::class, 'fema23rGuide'])->name('guides.fema-23r');

// Blog Hub & Regulatory Articles
Route::get('/blog', [App\Http\Controllers\HomeController::class, 'blogIndex'])->name('blog.index');
Route::get('/blog/how-to-file-gst-lut-rfd-11-2026', [App\Http\Controllers\HomeController::class, 'blogGstLutRfd11'])->name('blog.gst-lut-rfd-11');
Route::get('/blog/top-rbi-purpose-codes-software-exporters', [App\Http\Controllers\HomeController::class, 'blogRbiPurposeCodes'])->name('blog.rbi-purpose-codes');
Route::get('/blog/sac-code-998311-vs-998312', [App\Http\Controllers\HomeController::class, 'blogSacCodeComparison'])->name('blog.sac-code-comparison');

// 301 Redirects for Legacy Guide URLs
Route::permanentRedirect('/gst-lut-guide', '/guides/gst-lut');
Route::permanentRedirect('/firc-e-brc-guide', '/guides/firc-e-brc');
Route::permanentRedirect('/fema-23r-guide', '/guides/fema-23r');

// Competitor Comparisons
Route::get('/vs/zoho-invoice', [App\Http\Controllers\HomeController::class, 'vsZohoInvoice'])->name('vs.zoho-invoice');
Route::get('/vs/tally-prime', [App\Http\Controllers\HomeController::class, 'vsTallyPrime'])->name('vs.tally-prime');

// Free Tools & Calculators (Enterprise Silo)
Route::get('/tools/invoice-generator', [App\Http\Controllers\HomeController::class, 'freeInvoiceGenerator'])->name('tools.invoice-generator');
Route::get('/tools/forex-calculator', [App\Http\Controllers\HomeController::class, 'toolsForexCalculator'])->name('tools.forex-calculator');
Route::permanentRedirect('/free-invoice-generator', '/tools/invoice-generator');

// Templates (Standardized Format-First Hierarchy)
Route::get('/templates/word-invoice-template', [App\Http\Controllers\HomeController::class, 'templatesWord'])->name('templates.word');
Route::get('/templates/excel-invoice-template', [App\Http\Controllers\HomeController::class, 'templatesExcel'])->name('templates.excel');
Route::permanentRedirect('/templates/invoice-template-word', '/templates/word-invoice-template');
Route::get('/downloads/template/{filename}', [App\Http\Controllers\HomeController::class, 'downloadTemplate'])->name('templates.download');

// Contact Desk (GET renders dedicated page, POST handles submission)
Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contactView'])->name('contact.view');
Route::post('/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact');

// Public Legal and Compliance Pages
Route::get('/privacy', [App\Http\Controllers\HomeController::class, 'privacy'])->name('privacy');
Route::get('/privacy-policy', [App\Http\Controllers\HomeController::class, 'privacy']);
Route::get('/terms', [App\Http\Controllers\HomeController::class, 'terms'])->name('terms');
Route::get('/terms-of-use', [App\Http\Controllers\HomeController::class, 'terms']);

Route::get('/pending-approval', [App\Http\Controllers\Auth\RegisteredUserController::class, 'pendingView'])->name('auth.pending');

// 301 Permanent Redirect: Never allow /public prefix in URLs
Route::any('/public/{any?}', function ($any = null) {
    return redirect($any ? '/' . $any : '/', 301);
})->where('any', '.*');

// Auth Routes placeholder (will be handled by Breeze)
require __DIR__.'/auth.php';
