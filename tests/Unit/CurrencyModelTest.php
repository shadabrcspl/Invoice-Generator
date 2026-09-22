<?php

namespace Tests\Unit;

use App\Models\Currency;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CurrencyModelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_registration_seeds_default_currencies(): void
    {
        $user = User::factory()->create();

        $codes = Currency::where('user_id', $user->id)->pluck('code')->toArray();

        $this->assertContains('USD', $codes);
        $this->assertContains('AUD', $codes);
        $this->assertContains('CAD', $codes);
        $this->assertContains('AED', $codes);
        $this->assertCount(4, $codes);
    }

    /** @test */
    public function currency_is_active_by_default(): void
    {
        $user = User::factory()->create();

        $currencies = Currency::where('user_id', $user->id)->get();

        foreach ($currencies as $currency) {
            $this->assertTrue((bool) $currency->is_active);
        }
    }

    /** @test */
    public function currency_belongs_to_user(): void
    {
        $user = User::factory()->create();
        $currency = Currency::where('user_id', $user->id)->first();

        $this->assertEquals($user->id, $currency->user->id);
    }

    /** @test */
    public function multiple_users_have_independent_currencies(): void
    {
        $userA = User::factory()->create();
        $userB = User::factory()->create();

        $codesA = Currency::where('user_id', $userA->id)->pluck('code')->toArray();
        $codesB = Currency::where('user_id', $userB->id)->pluck('code')->toArray();

        // Both get the same default set, but they are independent rows
        $this->assertCount(4, $codesA);
        $this->assertCount(4, $codesB);

        $idsA = Currency::where('user_id', $userA->id)->pluck('id')->toArray();
        $idsB = Currency::where('user_id', $userB->id)->pluck('id')->toArray();

        // Confirm no shared IDs
        $this->assertEmpty(array_intersect($idsA, $idsB));
    }
}
