<?php

namespace Database\Factories;

use App\Models\Currency;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CurrencyFactory extends Factory
{
    protected $model = Currency::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'code' => $this->faker->currencyCode(),
            'symbol' => '$',
            'is_active' => true,
        ];
    }
}
