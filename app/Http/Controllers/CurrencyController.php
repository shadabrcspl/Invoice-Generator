<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\ExchangeRate;
use App\Services\ExchangeRateService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CurrencyController extends Controller
{
    /**
     * Store a new custom active currency.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code'   => ['required', 'string', 'size:3', 'regex:/^[A-Za-z]{3}$/'],
            'symbol' => ['required', 'string', 'max:10'],
        ]);

        $code   = strtoupper($validated['code']);
        $symbol = $validated['symbol'];
        $userId = Auth::id();

        // 1. Prevent base currency (INR) duplicate
        if ($code === 'INR') {
            return redirect()->back()->withErrors(['code' => 'INR is the default base currency and cannot be added.']);
        }

        // 2. Check if already active for this user
        $exists = Currency::where('user_id', $userId)
            ->where('code', $code)
            ->exists();

        if ($exists) {
            return redirect()->back()->withErrors(['code' => "Currency {$code} is already added in your active list."]);
        }

        // 3. Test API connectivity and fetch today's rate to validate the currency code
        try {
            $liveRate = ExchangeRateService::getLiveRate($code);
        } catch (\Exception $e) {
            Log::error('CurrencyController::store - getLiveRate exception: ' . $e->getMessage());
            $liveRate = null;
        }

        if ($liveRate === null) {
            return redirect()->back()->withErrors([
                'code' => "Could not fetch a live rate for '{$code}'. Please check the currency code is valid (e.g. AUD, CAD, AED, USD) or try again in a moment.",
            ]);
        }

        // 4. Create the custom currency row
        try {
            Currency::create([
                'user_id'   => $userId,
                'code'      => $code,
                'symbol'    => $symbol,
                'is_active' => true,
            ]);

            // 5. Store the rate immediately in exchange_rates so it is instantly usable
            ExchangeRate::updateOrCreate(
                ['target_currency' => $code, 'fetched_date' => date('Y-m-d')],
                ['base_currency'   => 'INR', 'rate' => $liveRate]
            );
        } catch (\Exception $e) {
            Log::error('CurrencyController::store - DB exception: ' . $e->getMessage());
            return redirect()->back()->withErrors([
                'code' => 'A database error occurred while saving the currency. Please try again.',
            ]);
        }

        return redirect()->back()->with(
            'success',
            "Currency {$code} ({$symbol}) successfully added! Live rate: 1 {$code} = ₹" . number_format($liveRate, 2) . " INR"
        );
    }

    /**
     * Manually refresh rates for all active currencies.
     */
    public function fetchRates(Request $request)
    {
        try {
            $service = new ExchangeRateService();
            $result  = $service->fetchAndStore();

            if ($result['success']) {
                $rateCount = count($result['rates'] ?? []);
                return redirect()->back()->with('success', "Successfully refreshed exchange rates for {$rateCount} currencies.");
            }

            return redirect()->back()->withErrors(['rate' => 'Failed to fetch rates: ' . ($result['error'] ?? 'Unknown error')]);
        } catch (\Exception $e) {
            Log::error('CurrencyController::fetchRates exception: ' . $e->getMessage());
            return redirect()->back()->withErrors(['rate' => 'An error occurred while refreshing rates. Please try again.']);
        }
    }

    /**
     * Delete/remove an active currency.
     */
    public function destroy(Currency $currency)
    {
        // Policy owner check
        if ($currency->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $code = $currency->code;
        $currency->delete();

        return redirect()->back()->with('success', "Currency {$code} has been removed from your active list.");
    }
}
