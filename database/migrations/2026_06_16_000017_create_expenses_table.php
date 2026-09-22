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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('expense_date');
            $table->string('vendor_name');
            $table->string('vendor_gstin', 15)->nullable();
            $table->string('category');
            $table->decimal('base_amount', 15, 2);
            $table->decimal('cgst', 10, 2)->default(0.00);
            $table->decimal('sgst', 10, 2)->default(0.00);
            $table->decimal('igst', 10, 2)->default(0.00);
            $table->decimal('total_amount', 15, 2);
            $table->string('payment_mode')->nullable();
            $table->boolean('is_itc_eligible')->default(false);
            $table->string('receipt_url', 512)->nullable();
            $table->timestamps();

            $table->index(['user_id', 'expense_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
