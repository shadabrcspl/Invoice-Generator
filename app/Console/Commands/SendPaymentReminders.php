<?php

namespace App\Console\Commands;

use App\Mail\AutoPaymentReminderMail;
use App\Models\Invoice;
use App\Services\UserMailer;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SendPaymentReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'invoices:send-payment-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically send email payment reminders for outstanding sent/overdue invoices past their due dates.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting automatic payment reminder scheduler...');

        $today = Carbon::today()->format('Y-m-d');
        
        // Fetch active invoices that are outstanding and past due
        $invoices = Invoice::with(['client', 'user.companySetting', 'user.emailSetting'])
            ->where('type', 'invoice')
            ->whereIn('status', ['sent', 'overdue'])
            ->where('due_date', '<=', $today)
            ->where('reminder_count', '<', 3)
            ->where(function($query) {
                $query->whereNull('reminder_sent_at')
                      ->orWhere('reminder_sent_at', '<', Carbon::now()->subDays(7));
            })
            ->get();

        if ($invoices->isEmpty()) {
            $this->info('No eligible outstanding invoices found for reminders today.');
            return 0;
        }

        $this->info("Found {$invoices->count()} eligible invoice(s) for reminders. Dispatching emails...");

        foreach ($invoices as $invoice) {
            if (!$invoice->client || !$invoice->client->email) {
                $this->warn("Skipping Invoice {$invoice->invoice_number}: Client email is empty.");
                continue;
            }

            try {
                // Fire reminder email using user's customized SMTP service
                UserMailer::for($invoice->user)
                    ->to($invoice->client->email)
                    ->send(new AutoPaymentReminderMail($invoice));

                // Mark the invoice as overdue if it was sent, and update counts
                $invoice->status = 'overdue';
                $invoice->reminder_sent_at = Carbon::now();
                $invoice->reminder_count += 1;
                $invoice->save();

                $this->info("Successfully sent reminder #{$invoice->reminder_count} for Invoice {$invoice->invoice_number} to {$invoice->client->email}.");
                Log::info("Auto Reminders: Sent email to {$invoice->client->email} for Invoice {$invoice->invoice_number}.");

            } catch (\Exception $e) {
                $this->error("Error sending reminder for Invoice {$invoice->invoice_number}: " . $e->getMessage());
                Log::error("Auto Reminders Error: " . $e->getMessage());
            }
        }

        $this->info('Automatic payment reminder processing complete.');
        return 0;
    }
}
