<?php

namespace App\Http\Controllers;

use App\Mail\InvoiceSentToClientMail;
use App\Models\Invoice;
use App\Services\UserMailer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceEmailController extends Controller
{
    /**
     * Send invoice email to the specified address and log it.
     * Uses the authenticated user's custom SMTP settings if configured.
     */
    public function send(Request $request, Invoice $invoice)
    {
        $this->authorize('view', $invoice);

        $request->validate([
            'recipient_email' => ['required', 'email', 'max:255'],
        ]);

        $invoice->load(['client', 'items', 'user.companySetting']);

        // Use user's custom SMTP if configured, otherwise fall back to system default
        UserMailer::for(Auth::user())
            ->to($request->recipient_email)
            ->send(new InvoiceSentToClientMail($invoice));

        // Log the email dispatch on the invoice record
        $invoice->update([
            'emailed_to' => $request->recipient_email,
            'emailed_at' => now(),
        ]);

        return redirect()
            ->route('invoices.show', $invoice->id)
            ->with('success', "✅ Invoice emailed successfully to {$request->recipient_email}!");
    }

    /**
     * Send follow-up / reminder email to the specified address and attach the PDF.
     * Uses the authenticated user's custom SMTP settings if configured.
     */
    public function reminder(Request $request, Invoice $invoice)
    {
        $this->authorize('view', $invoice);

        $request->validate([
            'recipient_email' => ['required', 'email', 'max:255'],
        ]);

        $invoice->load(['client', 'items', 'user.companySetting']);

        // Use user's custom SMTP if configured, otherwise fall back to system default
        UserMailer::for(Auth::user())
            ->to($request->recipient_email)
            ->send(new \App\Mail\InvoiceReminderMail($invoice));

        // Log the reminder separately — do NOT overwrite the original emailed_to/emailed_at record
        $invoice->reminder_sent_at = now();
        $invoice->reminder_count   = ($invoice->reminder_count ?? 0) + 1;
        $invoice->save();

        return redirect()
            ->route('invoices.show', $invoice->id)
            ->with('success', "✅ Payment follow-up reminder emailed successfully to {$request->recipient_email}!");
    }
}
