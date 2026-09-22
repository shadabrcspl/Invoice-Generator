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
        Schema::create('invoice_items', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->foreignUuid('invoice_id')->constrained('invoices')->onDelete('cascade');
            $blueprint->string('item_name');
            $blueprint->text('description')->nullable();
            $blueprint->decimal('qty', 12, 2)->default(1.00);
            $blueprint->decimal('rate', 15, 2)->default(0.00);
            $blueprint->decimal('tax_percent', 5, 2)->default(0.00); // e.g. 18.00%
            $blueprint->decimal('total', 15, 2)->default(0.00);
            $blueprint->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_items');
    }
};
