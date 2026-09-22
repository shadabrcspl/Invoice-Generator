<?php

namespace Database\Factories;

use App\Models\Payment;
use App\Models\Invoice;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    protected $model = Payment::class;

    public function definition(): array
    {
        return [
            'id' => (string) \Illuminate\Support\Str::uuid(),
            'invoice_id' => Invoice::factory(),
            'payment_date' => now()->format('Y-m-d'),
            'exchange_rate_payment' => 1.0,
            'inr_amount_received' => 100.0,
            'forex_gain_loss' => 0.0,
            'firc_number' => 'FIRC-' . $this->faker->unique()->numberBetween(10000, 99999),
        ];
    }
}
