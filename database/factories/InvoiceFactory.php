<?php

namespace Database\Factories;

use App\Models\Invoice;
use App\Models\User;
use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceFactory extends Factory
{
    protected $model = Invoice::class;

    public function definition(): array
    {
        $subtotal = $this->faker->randomFloat(2, 100, 1000);
        $tax = $subtotal * 0.18; // 18% GST standard
        $total = $subtotal + $tax;

        return [
            'id' => (string) \Illuminate\Support\Str::uuid(),
            'user_id' => User::factory(),
            'client_id' => Client::factory(),
            'invoice_number' => 'INV-' . $this->faker->unique()->numberBetween(1000, 9999),
            'invoice_date' => now()->format('Y-m-d'),
            'due_date' => now()->addDays(15)->format('Y-m-d'),
            'currency_code' => 'INR',
            'currency_symbol' => '₹',
            'subtotal' => $subtotal,
            'tax_amount' => $tax,
            'grand_total' => $total,
            'notes' => $this->faker->sentence(),
            'status' => 'pending',
            'type' => 'invoice',
            'exchange_rate_inr' => 1.0,
            'inr_equivalent' => $total,
        ];
    }
}
