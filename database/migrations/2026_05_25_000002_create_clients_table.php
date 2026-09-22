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
        Schema::create('clients', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->uuid('uuid')->unique(); // For secure public reference
            $blueprint->foreignId('user_id')->constrained()->onDelete('cascade');
            $blueprint->string('name');
            $blueprint->string('email')->nullable();
            $blueprint->string('phone')->nullable();
            $blueprint->text('address')->nullable();
            $blueprint->string('gst_number')->nullable();
            $blueprint->timestamps();

            $blueprint->index(['user_id', 'uuid']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
