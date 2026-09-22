<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('email_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // SMTP Configuration
            $table->string('mail_host')->default('mail.example.com');
            $table->unsignedSmallInteger('mail_port')->default(465);
            $table->string('mail_username');
            $table->text('mail_password'); // encrypted at application layer
            $table->string('mail_encryption')->default('ssl'); // ssl | tls | null
            $table->string('mail_from_address');
            $table->string('mail_from_name');

            // Test status
            $table->boolean('is_verified')->default(false);
            $table->timestamp('last_tested_at')->nullable();

            $table->timestamps();

            $table->unique('user_id'); // one SMTP config per user
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('email_settings');
    }
};
