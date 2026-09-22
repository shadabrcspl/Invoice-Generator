<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Traits\ConvertsImageToBase64;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class InvoicePdfController extends Controller
{
    use ConvertsImageToBase64;

    /**
     * Generate and download the PDF for the specified invoice.
     */
    public function download(Invoice $invoice)
    {
        // Enforce user ownership security checks
        $this->authorize('view', $invoice);

        $invoice->load(['client', 'items', 'user.companySetting', 'payment']);

        $setting = $invoice->user->companySetting;
        $logoBase64      = $this->imageToBase64($setting?->logo);
        $signatureBase64 = $this->imageToBase64($setting?->signature);

        // Load the print/pdf blade view
        $pdf = Pdf::loadView('invoices.pdf', compact('invoice', 'logoBase64', 'signatureBase64'));

        // Optional PDF configs for high-fidelity rendering
        $pdf->setPaper('a4', 'portrait')
            ->setWarnings(false)
            ->setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled'      => false, // SEC-06: Disabled to prevent SSRF attacks
                'defaultFont' => 'DejaVu Sans'
            ]);

        $filename = 'invoice_' . str_replace('-', '_', strtolower($invoice->invoice_number)) . '.pdf';

        return $pdf->download($filename);
    }

    /**
     * Preview the PDF directly in the browser tab.
     */
    public function stream(Invoice $invoice)
    {
        $this->authorize('view', $invoice);

        $invoice->load(['client', 'items', 'user.companySetting', 'payment']);

        $setting = $invoice->user->companySetting;
        $logoBase64      = $this->imageToBase64($setting?->logo);
        $signatureBase64 = $this->imageToBase64($setting?->signature);

        $pdf = Pdf::loadView('invoices.pdf', compact('invoice', 'logoBase64', 'signatureBase64'));
        
        $pdf->setPaper('a4', 'portrait')
            ->setWarnings(false)
            ->setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled'      => false, // SEC-06: Disabled to prevent SSRF
                'defaultFont'          => 'DejaVu Sans'
            ]);

        return $pdf->stream();
    }
}
