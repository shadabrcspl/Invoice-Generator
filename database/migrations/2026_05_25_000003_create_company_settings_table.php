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
        Schema::create('company_settings', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->foreignId('user_id')->unique()->constrained()->onDelete('cascade');
            $blueprint->string('company_name');
            $blueprint->string('logo')->nullable(); // File path
            $blueprint->string('email')->nullable();
            $blueprint->string('phone')->nullable();
            $blueprint->text('address')->nullable();
            $blueprint->string('gst_number')->nullable();
            $blueprint->string('website')->nullable();
            $blueprint->string('signature')->nullable(); // File path
            $blueprint->text('bank_notes')->nullable(); // Default bank notes / details
            $blueprint->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_settings');
    }
};
