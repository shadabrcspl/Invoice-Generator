<?php

namespace App\Console\Commands;

use App\Services\ExchangeRateService;
use Illuminate\Console\Command;

class FetchExchangeRates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'exchange-rates:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch daily exchange rates against INR for all active foreign currencies in the database from ExchangeRate-API';

    /**
     * Execute the console command.
     */
    public function handle(ExchangeRateService $exchangeRateService)
    {
        $this->info('Starting exchange rate fetch from ExchangeRate-API...');
        
        $result = $exchangeRateService->fetchAndStore();

        if ($result['success']) {
            $this->info('Daily exchange rates updated successfully:');
            foreach ($result['rates'] as $currency => $rate) {
                $this->line("1 {$currency} = {$rate} INR");
            }
            return 0;
        } else {
            $this->error('Failed to fetch exchange rates: ' . $result['error']);
            return 1;
        }
    }
}
