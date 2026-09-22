<?php

namespace Database\Factories;

use App\Models\Expense;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExpenseFactory extends Factory
{
    protected $model = Expense::class;

    public function definition(): array
    {
        $baseAmount = $this->faker->randomFloat(2, 100, 5000);
        $cgst = round($baseAmount * 0.09, 2);
        $sgst = round($baseAmount * 0.09, 2);
        $totalAmount = $baseAmount + $cgst + $sgst;

        return [
            'user_id' => User::factory(),
            'expense_date' => $this->faker->date(),
            'vendor_name' => $this->faker->company(),
            'vendor_gstin' => '27AAPCS' . $this->faker->numerify('####') . 'F1Z' . $this->faker->numerify('#'),
            'category' => $this->faker->randomElement([
                'Software & Subscriptions',
                'Domain & Hosting',
                'Utilities & Internet',
                'Office Supplies',
                'Rent & Workspace',
                'Marketing & Advertising'
            ]),
            'base_amount' => $baseAmount,
            'cgst' => $cgst,
            'sgst' => $sgst,
            'igst' => 0.00,
            'total_amount' => $totalAmount,
            'payment_mode' => $this->faker->randomElement([
                'Current Account Debit Card',
                'Net Banking',
                'Credit Card',
                'UPI / GPay / PhonePe'
            ]),
            'is_itc_eligible' => $this->faker->boolean(),
            'receipt_url' => null,
        ];
    }
}
