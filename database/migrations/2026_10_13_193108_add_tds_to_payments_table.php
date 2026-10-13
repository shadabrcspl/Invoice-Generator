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
        Schema::table('payments', function (Blueprint $table) {
            $table->decimal('tds_deducted', 15, 2)->default(0.00)->after('inr_amount_received');
            $table->string('tds_section', 50)->nullable()->after('tds_deducted');
            $table->text('payment_notes')->nullable()->after('firc_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn(['tds_deducted', 'tds_section', 'payment_notes']);
        });
    }
};
