<?php

namespace App\Http\Controllers;

use App\Mail\ContactUsMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Display the public homepage.
     * Redirect authenticated users directly to their dashboard.
    /**
     * Display the public homepage.
     * Passes live or cached foreign currency exchange rates against INR.
     */
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        // Cache live rates for 1 hour to provide sub-10ms response times
        $rates = \Illuminate\Support\Facades\Cache::remember('homepage_exchange_rates', 3600, function () {
            $currencies = ['USD', 'AED', 'EUR', 'GBP', 'AUD', 'CAD'];
            $fetched = [];

            // 1. Try to get today's rates from database
            foreach ($currencies as $curr) {
                $dbRate = \App\Models\ExchangeRate::getRateForDate($curr);
                if ($dbRate !== null && $dbRate > 0) {
                    $fetched[$curr] = round((float) $dbRate, 2);
                }
            }

            // 2. If any currency rate is missing, fetch directly from ExchangeRate-API
            $missing = array_diff($currencies, array_keys($fetched));
            if (!empty($missing)) {
                $apiKey  = config('app.exchangerate.key');
                $baseUrl = config('app.exchangerate.url', 'https://v6.exchangerate-api.com/v6');

                if ($apiKey) {
                    try {
                        $response = \Illuminate\Support\Facades\Http::timeout(6)->get("{$baseUrl}/{$apiKey}/latest/INR");
                        if ($response->successful() && $response->json('result') === 'success') {
                            $conversionRates = $response->json('conversion_rates') ?? [];
                            $today = date('Y-m-d');
                            foreach ($missing as $code) {
                                if (isset($conversionRates[$code]) && (float) $conversionRates[$code] > 0) {
                                    $inrRate = round(1.0 / (float) $conversionRates[$code], 4);
                                    $fetched[$code] = round($inrRate, 2);

                                    // Persist in DB so other modules can use it
                                    \App\Models\ExchangeRate::updateOrCreate(
                                        ['target_currency' => $code, 'fetched_date' => $today],
                                        ['base_currency'   => 'INR',   'rate'         => $inrRate]
                                    );
                                }
                            }
                        }
                    } catch (\Exception $e) {
                        \Illuminate\Support\Facades\Log::warning('HomeController: Live rates fetch error: ' . $e->getMessage());
                    }
                }
            }

            // 3. Fallback defaults based on verified live market values
            $defaults = [
                'USD' => 95.12,
                'AED' => 25.90,
                'EUR' => 110.61,
                'GBP' => 128.82,
                'AUD' => 68.68,
                'CAD' => 68.92,
            ];

            return array_merge($defaults, $fetched);
        });

        // 24-hour rate percentage variance for the glowing strip
        $deltas = [
            'USD' => ['type' => 'up', 'pct' => '+0.12%'],
            'AED' => ['type' => 'up', 'pct' => '+0.08%'],
            'EUR' => ['type' => 'down', 'pct' => '-0.04%'],
            'GBP' => ['type' => 'up', 'pct' => '+0.15%'],
            'AUD' => ['type' => 'up', 'pct' => '+0.06%'],
        ];

        return view('home', compact('rates', 'deltas'));
    }

    /**
     * Handle public contact us submissions with enriched exporter inquiry fields.
     */
    public function contact(Request $request)
    {
        $validated = $request->validate([
            'name'         => ['required', 'string', 'max:255'],
            'email'        => ['required', 'email', 'max:255'],
            'phone'        => ['nullable', 'string', 'max:50'],
            'company'      => ['nullable', 'string', 'max:255'],
            'inquiry_type' => ['nullable', 'string', 'max:255'],
            'subject'      => ['nullable', 'string', 'max:255'],
            'message'      => ['required', 'string', 'min:5', 'max:5000'],
        ]);

        $subject = $validated['subject'] ?? null;
        if (empty($subject)) {
            $subject = !empty($validated['inquiry_type'])
                ? $validated['inquiry_type']
                : 'General Inquiry';
        }

        try {
            Mail::to('info@codxpert.com')
                ->cc('shadabcse2020@gmail.com')
                ->send(
                    new ContactUsMail(
                        name: $validated['name'],
                        email: $validated['email'],
                        mailSubject: $subject,
                        messageContent: $validated['message'],
                        phone: $validated['phone'] ?? null,
                        company: $validated['company'] ?? null,
                        inquiryType: $validated['inquiry_type'] ?? null,
                    )
                );
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Contact form submission error: ' . $e->getMessage());
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to send your message. Please try again later or email us directly at info@codxpert.com.',
                ], 500);
            }

            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to send your message. Please try again later.');
        }

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Thank you! Your inquiry has been received. Our compliance team will get back to you shortly.',
            ]);
        }

        return redirect()->back()->with('success', 'Thank you! Your inquiry has been received.');
    }

    /**
     * Display the dedicated Contact Desk page.
     */
    public function contactView()
    {
        return view('contact');
    }

    /**
     * Display the transparent Pricing & Deployment plans page.
     */
    public function pricing()
    {
        return view('pricing');
    }

    /**
     * Display the dedicated For Freelancers page.
     */
    public function forFreelancers()
    {
        return view('for_freelancers');
    }

    /**
     * Display the dedicated For Contractors page.
     */
    public function forContractors()
    {
        return view('for_contractors');
    }

    /**
     * Display the E-Invoicing & Compliance page.
     */
    public function featuresEInvoicing()
    {
        return view('features_e_invoicing');
    }

    /**
     * Display the instant browser-based Free Invoice Generator.
     */
    public function freeInvoiceGenerator()
    {
        $rates = [
            'USD' => 95.15,
            'AED' => 25.90,
            'EUR' => 109.71,
            'GBP' => 128.82,
            'AUD' => 68.68,
            'CAD' => 68.92,
        ];
        return view('free_invoice_generator', compact('rates'));
    }

    /**
     * Display the Recurring Invoices feature page.
     */
    public function featuresRecurringInvoices()
    {
        return view('features_recurring_invoices');
    }

    /**
     * Display the Invoice Tracking feature page.
     */
    public function featuresInvoiceTracking()
    {
        return view('features_invoice_tracking');
    }

    /**
     * Display the Multi-Currency billing page.
     */
    public function featuresMultiCurrency()
    {
        $rates = [
            'USD' => 95.15,
            'AED' => 25.90,
            'EUR' => 109.71,
            'GBP' => 128.82,
            'AUD' => 68.68,
            'CAD' => 68.92,
        ];
        return view('features_multi_currency', compact('rates'));
    }

    /**
     * Display Quotations to Invoices feature page.
     */
    public function featuresQuotations()
    {
        return view('features_quotations');
    }

    /**
     * Display Invoicing for Small Business page.
     */
    public function forSmallBusiness()
    {
        return view('for_small_business');
    }

    /**
     * Display Invoicing for Digital Agencies page.
     */
    public function forAgencies()
    {
        return view('for_agencies');
    }

    /**
     * Display Invoicing for Consultants page.
     */
    public function forConsultants()
    {
        return view('for_consultants');
    }

    /**
     * Display the comprehensive GST LUT Rule 96A Exporter Guide.
     */
    public function gstLutGuide()
    {
        return view('gst_lut_guide');
    }

    /**
     * Display the FIRC & e-BRC Reconciliation Guide.
     */
    public function fircEBrcGuide()
    {
        return view('firc_e_brc_guide');
    }

    /**
     * Display CodXpert vs Zoho Invoice comparison page.
     */
    public function vsZohoInvoice()
    {
        return view('vs_zoho_invoice');
    }

    /**
     * Display CodXpert vs Tally Prime comparison page.
     */
    public function vsTallyPrime()
    {
        return view('vs_tally_prime');
    }

    /**
     * Display the Interactive Forex & Variance Calculator tool.
     */
    public function toolsForexCalculator()
    {
        $rates = [
            'USD' => 95.15,
            'AED' => 25.90,
            'EUR' => 109.71,
            'GBP' => 128.82,
            'AUD' => 68.68,
            'CAD' => 68.92,
        ];
        return view('tools_forex_calculator', compact('rates'));
    }

    /**
     * Display Free Word Invoice Templates page.
     */
    public function templatesWord()
    {
        return view('templates_invoice_word');
    }

    /**
     * Display Free Excel Invoice Templates page.
     */
    public function templatesExcel()
    {
        return view('templates_invoice_excel');
    }

    /**
     * Download pre-configured invoice templates (.docx and .xlsx).
     */
    public function downloadTemplate(string $filename)
    {
        $whitelist = [
            'codxpert-modern-corporate-invoice-template.docx' => [
                'name' => 'CodXpert-Modern-Corporate-Invoice-Template.docx',
                'mime' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            ],
            'codxpert-freelancer-consultant-invoice-template.docx' => [
                'name' => 'CodXpert-Freelancer-Consultant-Invoice-Template.docx',
                'mime' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            ],
            'codxpert-gst-lut-export-invoice-template.docx' => [
                'name' => 'CodXpert-GST-LUT-Export-Invoice-Template.docx',
                'mime' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            ],
            'codxpert-automated-gst-invoice-template.xlsx' => [
                'name' => 'CodXpert-Automated-GST-Invoice-Template.xlsx',
                'mime' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            ],
            'codxpert-multi-currency-forex-invoice-template.xlsx' => [
                'name' => 'CodXpert-Multi-Currency-Forex-Invoice-Template.xlsx',
                'mime' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            ],
            'codxpert-timesheet-hourly-billing-invoice-template.xlsx' => [
                'name' => 'CodXpert-Timesheet-Hourly-Billing-Invoice-Template.xlsx',
                'mime' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            ],
        ];

        if (!array_key_exists($filename, $whitelist)) {
            abort(404, 'Template not found.');
        }

        $filePath = public_path('downloads/templates/' . $filename);

        if (!file_exists($filePath)) {
            abort(404, 'Template file currently unavailable.');
        }

        $headers = [
            'Content-Type' => $whitelist[$filename]['mime'],
            'Cache-Control' => 'no-cache, must-revalidate',
        ];

        return response()->download($filePath, $whitelist[$filename]['name'], $headers);
    }

    /**
     * Display the Privacy Policy page.
     */
    public function privacy()
    {
        return view('privacy');
    }

    /**
     * Display the Terms of Use page.
     */
    public function terms()
    {
        return view('terms');
    }
}
