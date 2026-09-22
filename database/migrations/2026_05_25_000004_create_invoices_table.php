<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $blueprint) {
            $blueprint->uuid('id')->primary(); // Primary Key is UUID!
            $blueprint->foreignId('user_id')->constrained()->onDelete('cascade');
            $blueprint->foreignId('client_id')->nullable()->constrained()->onDelete('set null');
            $blueprint->string('invoice_number');
            $blueprint->date('invoice_date');
            $blueprint->date('due_date')->nullable();
            $blueprint->string('currency_code', 3)->default('INR'); // e.g. INR, USD, AED, CAD, AUD
            $blueprint->string('currency_symbol', 10)->default('₹'); // e.g. ₹, $, د.إ, C$, A$
            $blueprint->decimal('subtotal', 15, 2)->default(0.00);
            $blueprint->decimal('tax_amount', 15, 2)->default(0.00);
            $blueprint->decimal('grand_total', 15, 2)->default(0.00);
            $blueprint->text('notes')->nullable();
            $blueprint->text('bank_notes')->nullable();
            $blueprint->string('status')->default('draft'); // draft, sent, paid, overdue
            $blueprint->timestamps();

            $blueprint->index(['user_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
