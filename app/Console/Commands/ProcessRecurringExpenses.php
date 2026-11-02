<?php

namespace App\Console\Commands;

use App\Models\Expense;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProcessRecurringExpenses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expenses:process-recurring';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process and generate upcoming recurring business expenses (e.g. rent, payroll, subscriptions).';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting recurring expense generator...');
        $today = Carbon::today()->format('Y-m-d');

        // Fetch recurring expense templates whose next recurring date is today or earlier
        $recurringTemplates = Expense::with('user')
            ->where('is_recurring', true)
            ->whereNotNull('recurring_next_date')
            ->where('recurring_next_date', '<=', $today)
            ->get();

        if ($recurringTemplates->isEmpty()) {
            $this->info('No recurring expenses due for generation today.');
            return 0;
        }

        $this->info("Found {$recurringTemplates->count()} recurring expense(s) due. Processing...");

        foreach ($recurringTemplates as $template) {
            // Check if past end date
            if ($template->recurring_end_date && $template->recurring_next_date > $template->recurring_end_date) {
                $template->update(['is_recurring' => false]);
                $this->warn("Recurring schedule for {$template->vendor_name} reached its end date. Marked as completed.");
                continue;
            }

            try {
                DB::transaction(function () use ($template, $today) {
                    $cycleDate = $template->recurring_next_date ? $template->recurring_next_date->format('Y-m-d') : $today;

                    // Create cloned expense for this cycle
                    $newExpense = Expense::create([
                        'user_id'             => $template->user_id,
                        'expense_date'        => $cycleDate,
                        'vendor_name'         => $template->vendor_name,
                        'vendor_gstin'        => $template->vendor_gstin,
                        'category'            => $template->category,
                        'base_amount'         => $template->base_amount,
                        'cgst'                => $template->cgst,
                        'sgst'                => $template->sgst,
                        'igst'                => $template->igst,
                        'total_amount'        => $template->total_amount,
                        'payment_mode'        => $template->payment_mode,
                        'is_itc_eligible'     => $template->is_itc_eligible,
                        'is_recurring'        => false,
                        'recurring_parent_id' => $template->id,
                        'receipt_url'         => null,
                    ]);

                    // Advance recurring_next_date on template
                    $nextDate = Carbon::parse($cycleDate);
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

                    $this->info("Generated recurring expense #{$newExpense->id} ({$template->vendor_name} - ₹{$newExpense->total_amount}) for cycle: {$cycleDate}. Next due: {$nextDate->toDateString()}");
                });
            } catch (\Exception $e) {
                Log::error("Failed to process recurring expense template #{$template->id}: " . $e->getMessage());
                $this->error("Error processing expense template #{$template->id}: " . $e->getMessage());
            }
        }

        $this->info('Recurring expenses processing completed successfully.');
        return 0;
    }
}
