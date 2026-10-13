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
            $table->uuid('original_invoice_id')->nullable()->after('type');
            $table->string('note_reason', 100)->nullable()->after('original_invoice_id');
            
            $table->foreign('original_invoice_id')
                ->references('id')
                ->on('invoices')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropForeign(['original_invoice_id']);
            $table->dropColumn(['original_invoice_id', 'note_reason']);
        });
    }
};
