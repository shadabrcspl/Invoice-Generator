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
        Schema::table('invoices', function (Blueprint $table) {
            $table->decimal('exchange_rate_inr', 15, 6)->nullable()->after('currency_symbol');
            $table->decimal('inr_equivalent', 15, 2)->nullable()->after('exchange_rate_inr');
            $table->string('firc_number')->nullable()->after('reminder_count');
            $table->decimal('actual_exchange_rate', 15, 6)->nullable()->after('firc_number');
            $table->decimal('actual_inr_received', 15, 2)->nullable()->after('actual_exchange_rate');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn([
                'exchange_rate_inr',
                'inr_equivalent',
                'firc_number',
                'actual_exchange_rate',
                'actual_inr_received'
            ]);
        });
    }
};
