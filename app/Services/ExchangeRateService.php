<?php

namespace App\Services;

use App\Models\ExchangeRate;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ExchangeRateService
{
    /**
     * Supported foreign currencies for INR conversion.
     */
    public const SUPPORTED_CURRENCIES = ['USD', 'AED', 'EUR', 'GBP', 'AUD', 'CAD'];

    /**
     * Fetch the daily exchange rates against INR and store them in the database.
     * API base is INR. The response gives: 1 INR = X foreign_currency.
     * We store the reciprocal: 1 foreign_currency = (1/X) INR.
     */
    public function fetchAndStore(): array
    {
        $apiKey = config('app.exchangerate.key');
        $baseUrl = config('app.exchangerate.url');

        if (!$apiKey) {
            Log::error('ExchangeRate-API: Missing API key in configuration.');
            return ['success' => false, 'error' => 'Missing API key.'];
        }

        // Fetch with INR as base — response: conversion_rates[AUD] = 0.01462 means 1 INR = 0.01462 AUD
        $url = "{$baseUrl}/{$apiKey}/latest/INR";

        try {
            $response = Http::timeout(15)->get($url);

            if (!$response->successful() || $response->json('result') !== 'success') {
                $errorMsg = $response->json('error-type') ?? 'HTTP ' . $response->status();
                Log::error("ExchangeRate-API: Failed to fetch rates: {$errorMsg}");
                return ['success' => false, 'error' => $errorMsg];
            }

            $data     = $response->json();
            $rates    = $data['conversion_rates'] ?? [];
            $date     = date('Y-m-d');
            $stored   = [];

            $currencies = \App\Models\Currency::where('is_active', true)
                ->pluck('code')
                ->unique()
                ->toArray();

            if (empty($currencies)) {
                $currencies = self::SUPPORTED_CURRENCIES;
            }

            foreach ($currencies as $target) {
                if (isset($rates[$target]) && (float) $rates[$target] > 0) {
                    // 1 INR = rates[$target] units of $target
                    // => 1 $target = 1 / rates[$target] INR
                    $inrPerTarget = round(1.0 / (float) $rates[$target], 6);

                    ExchangeRate::updateOrCreate(
                        ['target_currency' => $target, 'fetched_date' => $date],
                        ['base_currency'   => 'INR',   'rate'         => $inrPerTarget]
                    );

                    $stored[$target] = $inrPerTarget;
                } else {
                    Log::warning("ExchangeRate-API: Rate for {$target} was missing or zero.");
                }
            }

            Log::info('ExchangeRate-API: Rates stored.', $stored);
            return ['success' => true, 'rates' => $stored];

        } catch (\Exception $e) {
            Log::error('ExchangeRate-API Exception: ' . $e->getMessage());
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Fetch a LIVE rate directly from the API for a single currency right now.
     * Used as a fallback when the DB has no stored rates yet.
     * Returns INR per 1 unit of $currency, or null on failure.
     */
    public static function getLiveRate(string $currency): ?float
    {
        if ($currency === 'INR') {
            return 1.0;
        }

        $apiKey  = config('app.exchangerate.key');
        $baseUrl = config('app.exchangerate.url');

        if (!$apiKey) {
            return null;
        }

        try {
            // Fetch with INR as base for a single call covering all currencies
            $response = Http::timeout(10)->get("{$baseUrl}/{$apiKey}/latest/INR");

            if ($response->successful() && $response->json('result') === 'success') {
                $rates = $response->json('conversion_rates') ?? [];
                if (isset($rates[$currency]) && (float) $rates[$currency] > 0) {
                    return round(1.0 / (float) $rates[$currency], 6);
                }
            }
        } catch (\Exception $e) {
            Log::warning('ExchangeRateService::getLiveRate failed: ' . $e->getMessage());
        }

        return null;
    }
}
