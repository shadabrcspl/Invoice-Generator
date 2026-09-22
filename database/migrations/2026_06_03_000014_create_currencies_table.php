<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('code', 3);
            $table->string('symbol', 10);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->unique(['user_id', 'code']);
        });

        // Seed default active currencies for existing users
        try {
            $users = DB::table('users')->get();
            $defaults = [
                ['code' => 'USD', 'symbol' => '$'],
                ['code' => 'AUD', 'symbol' => 'A$'],
                ['code' => 'CAD', 'symbol' => 'C$'],
                ['code' => 'AED', 'symbol' => 'د.إ'],
            ];

            foreach ($users as $user) {
                foreach ($defaults as $curr) {
                    DB::table('currencies')->insert([
                        'user_id' => $user->id,
                        'code' => $curr['code'],
                        'symbol' => $curr['symbol'],
                        'is_active' => true,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        } catch (\Exception $e) {
            // Safe ignore if testing / seeding fails in clean state
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currencies');
    }
};
