<?php

namespace App\Console\Commands;

use App\Mail\InvoiceSentToClientMail;
use App\Models\ExchangeRate;
use App\Models\Invoice;
use App\Services\UserMailer;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProcessRecurringInvoices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'invoices:process-recurring';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process and generate upcoming recurring invoices and subscriptions.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting recurring invoice generator...');
        $today = Carbon::today()->format('Y-m-d');

        // Fetch recurring template invoices whose next recurring date is today or earlier
        $recurringTemplates = Invoice::with(['items', 'client', 'user.companySetting', 'user.emailSetting'])
            ->where('is_recurring', true)
            ->whereNotNull('recurring_next_date')
            ->where('recurring_next_date', '<=', $today)
            ->get();

        if ($recurringTemplates->isEmpty()) {
            $this->info('No recurring invoices due for generation today.');
            return 0;
        }

        $this->info("Found {$recurringTemplates->count()} recurring invoice(s) due. Processing...");

        foreach ($recurringTemplates as $template) {
            // Check if past end date
            if ($template->recurring_end_date && $template->recurring_next_date > $template->recurring_end_date) {
                $template->update(['is_recurring' => false]);
                $this->warn("Subscription for template {$template->invoice_number} reached its end date. Marked as completed.");
                continue;
            }

            try {
                DB::transaction(function () use ($template, $today) {
                    $userId = $template->user_id;
                    $year = date('Y');
                    $month = date('m');
                    $prefix = 'INV';

                    // Determine next invoice sequence number for this user
                    $lastInvoice = Invoice::where('user_id', $userId)
                        ->where('type', 'invoice')
                        ->where('invoice_number', 'like', "{$prefix}-%")
                        ->get(['invoice_number'])
                        ->sortByDesc(function ($inv) {
                            $parts = explode('-', $inv->invoice_number);
                            return (int) end($parts);
                        })
                        ->first();

                    $nextSeq = 1;
                    if ($lastInvoice) {
                        $parts = explode('-', $lastInvoice->invoice_number);
                        $nextSeq = ((int) end($parts)) + 1;
                    }
                    $nextNumber = str_pad($nextSeq, 4, '0', STR_PAD_LEFT);
                    $newInvoiceNumber = "{$prefix}-{$year}{$month}-{$nextNumber}";

                    // Currency & Exchange Rate
                    $currencyCode = $template->currency_code;
                    $exchangeRateInr = 1.0;
                    if ($currencyCode !== 'INR') {
                        $exchangeRateInr = ExchangeRate::getRateForDate($currencyCode, $today)
                            ?? $template->exchange_rate_inr
                            ?? 1.0;
                    }
                    $inrEquivalent = round($template->grand_total * $exchangeRateInr, 2);

                    // Create cloned invoice for this cycle
                    $newInvoice = Invoice::create([
                        'user_id'              => $userId,
                        'client_id'            => $template->client_id,
                        'invoice_number'       => $newInvoiceNumber,
                        'invoice_date'         => $today,
                        'due_date'             => Carbon::parse($today)->addDays(14)->toDateString(),
                        'currency_code'        => $currencyCode,
                        'currency_symbol'      => $template->currency_symbol,
                        'subtotal'             => $template->subtotal,
                        'tax_amount'           => $template->tax_amount,
                        'grand_total'          => $template->grand_total,
                        'notes'                => $template->notes,
                        'bank_notes'           => $template->bank_notes,
                        'status'               => 'sent',
                        'type'                 => 'invoice',
                        'is_recurring'         => false,
                        'exchange_rate_inr'    => $exchangeRateInr,
                        'inr_equivalent'       => $inrEquivalent,
                    ]);

                    // Clone items
                    foreach ($template->items as $item) {
                        $newInvoice->items()->create([
                            'item_name'   => $item->item_name,
                            'description' => $item->description,
                            'sac_code'    => $item->sac_code,
                            'qty'         => $item->qty,
                            'rate'        => $item->rate,
                            'tax_percent' => $item->tax_percent,
                            'total'       => $item->total,
                        ]);
                    }

                    // Advance recurring_next_date on template
                    $nextDate = Carbon::parse($template->recurring_next_date);
                    match ($template->recurring_frequency) {
                        'weekly'    => $nextDate->addWeek(),
                        'quarterly' => $nextDate->addMonths(3),
                        'yearly'    => $nextDate->addYear(),
                        default     => $nextDate->addMonth(),
                    };

                    $templateUpdate = [
                        'recurring_next_date' => $nextDate->toDateString(),
                    ];

                    if ($template->recurring_end_date && $nextDate->gt($template->recurring_end_date)) {
                        $templateUpdate['is_recurring'] = false;
                    }

                    $template->update($templateUpdate);

                    $this->info("Generated recurring invoice {$newInvoiceNumber} for Client: {$template->client?->name}");

                    // Auto-send email if enabled
                    if ($template->recurring_auto_send && $template->client?->email) {
                        try {
                            $newInvoice->load(['client', 'items', 'user.companySetting']);
                            UserMailer::for($template->user)
                                ->to($template->client->email)
                                ->send(new InvoiceSentToClientMail($newInvoice));

                            $newInvoice->update([
                                'emailed_to' => $template->client->email,
                                'emailed_at' => now(),
                            ]);
                            $this->info("Auto-sent invoice email to {$template->client->email}");
                        } catch (\Exception $mailEx) {
                            Log::warning("Auto-send failed for recurring invoice {$newInvoiceNumber}: " . $mailEx->getMessage());
                            $this->warn("Failed auto-sending email: " . $mailEx->getMessage());
                        }
                    }
                });
            } catch (\Exception $e) {
                Log::error("Failed to process recurring template {$template->id}: " . $e->getMessage());
                $this->error("Error processing template {$template->invoice_number}: " . $e->getMessage());
            }
        }

        $this->info('Recurring invoices processing completed.');
        return 0;
    }
}
