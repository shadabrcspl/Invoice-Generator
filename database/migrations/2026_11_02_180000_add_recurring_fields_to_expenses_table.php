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
        Schema::table('expenses', function (Blueprint $table) {
            $table->boolean('is_recurring')->default(false)->after('is_itc_eligible');
            $table->string('recurring_frequency', 20)->nullable()->after('is_recurring'); // weekly, monthly, quarterly, yearly
            $table->date('recurring_next_date')->nullable()->after('recurring_frequency');
            $table->date('recurring_end_date')->nullable()->after('recurring_next_date');
            $table->foreignId('recurring_parent_id')->nullable()->after('recurring_end_date')->constrained('expenses')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('expenses', function (Blueprint $table) {
            $table->dropForeign(['recurring_parent_id']);
            $table->dropColumn([
                'is_recurring',
                'recurring_frequency',
                'recurring_next_date',
                'recurring_end_date',
                'recurring_parent_id'
            ]);
        });
    }
};
