<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExchangeRate extends Model
{
    use HasFactory;

    protected $fillable = [
        'base_currency',
        'target_currency',
        'rate',
        'fetched_date',
    ];

    protected $casts = [
        'rate' => 'decimal:6',
        'fetched_date' => 'date',
    ];

    /**
     * Helper to get the exchange rate from target currency to base (INR) for a given date.
     * If no rate is found for that specific date, it falls back to the most recent rate.
     */
    public static function getRateForDate(string $targetCurrency, $date = null): ?float
    {
        if ($targetCurrency === 'INR') {
            return 1.0;
        }

        $date = $date ? \Carbon\Carbon::parse($date)->format('Y-m-d') : now()->format('Y-m-d');

        // Try exact date rate first
        $rate = self::where('target_currency', $targetCurrency)
            ->where('fetched_date', $date)
            ->first();

        if ($rate) {
            return (float) $rate->rate;
        }

        // Fallback: get the most recent rate before or equal to the date
        $fallback = self::where('target_currency', $targetCurrency)
            ->where('fetched_date', '<=', $date)
            ->orderBy('fetched_date', 'desc')
            ->first();

        if ($fallback) {
            return (float) $fallback->rate;
        }

        // Absolute fallback: get the latest rate overall
        $latest = self::where('target_currency', $targetCurrency)
            ->orderBy('fetched_date', 'desc')
            ->first();

        return $latest ? (float) $latest->rate : null;
    }
}
