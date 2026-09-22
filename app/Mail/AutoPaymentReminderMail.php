<?php

namespace App\Mail;

use App\Models\Invoice;
use App\Traits\ConvertsImageToBase64;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AutoPaymentReminderMail extends Mailable
{
    use Queueable, SerializesModels, ConvertsImageToBase64;

    /**
     * Create a new message instance.
     */
    public function __construct(public Invoice $invoice) {}

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $companyName = $this->invoice->user->companySetting->company_name ?? config('app.name');
        return new Envelope(
            subject: '⏰ PAYMENT REMINDER: Invoice ' . $this->invoice->invoice_number . ' from ' . $companyName,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.auto_payment_reminder',
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        // Enforce eager relations for PDF render scoping
        $this->invoice->load(['client', 'items', 'user.companySetting']);

        // Load the print/pdf blade view
        $setting = $this->invoice->user->companySetting;
        $logoBase64      = $this->imageToBase64($setting?->logo);
        $signatureBase64 = $this->imageToBase64($setting?->signature);
        $pdf = Pdf::loadView('invoices.pdf', ['invoice' => $this->invoice, 'logoBase64' => $logoBase64, 'signatureBase64' => $signatureBase64]);

        // Optional PDF configs for high-fidelity rendering
        $pdf->setPaper('a4', 'portrait')
            ->setWarnings(false)
            ->setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled'      => false, // SEC-06: Prevent SSRF
                'defaultFont' => 'DejaVu Sans'
            ]);

        $filename = 'invoice_' . str_replace('-', '_', strtolower($this->invoice->invoice_number)) . '.pdf';

        return [
            Attachment::fromData(fn () => $pdf->output(), $filename)
                ->withMime('application/pdf'),
        ];
    }
}
