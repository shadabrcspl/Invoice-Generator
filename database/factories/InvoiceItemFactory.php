<?php

namespace Database\Factories;

use App\Models\InvoiceItem;
use App\Models\Invoice;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceItemFactory extends Factory
{
    protected $model = InvoiceItem::class;

    public function definition(): array
    {
        $qty = $this->faker->numberBetween(1, 5);
        $rate = $this->faker->randomFloat(2, 50, 200);
        $taxPercent = 18.0;
        $total = ($qty * $rate) * (1 + $taxPercent / 100);

        return [
            'invoice_id' => Invoice::factory(),
            'item_name' => $this->faker->words(3, true),
            'description' => $this->faker->sentence(),
            'qty' => $qty,
            'rate' => $rate,
            'tax_percent' => $taxPercent,
            'total' => $total,
        ];
    }
}
