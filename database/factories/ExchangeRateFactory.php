<?php

namespace Database\Factories;

use App\Models\ExchangeRate;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExchangeRateFactory extends Factory
{
    protected $model = ExchangeRate::class;

    public function definition(): array
    {
        return [
            'base_currency' => 'INR',
            'target_currency' => $this->faker->currencyCode(),
            'rate' => $this->faker->randomFloat(6, 0.5, 90),
            'fetched_date' => now()->format('Y-m-d'),
        ];
    }
}
