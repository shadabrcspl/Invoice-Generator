<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\ExchangeRate;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CurrencyControllerTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        Mail::fake();
        $this->user = User::factory()->create();
    }

    // ─── GET /currencies redirect ─────────────────────────────

    /** @test */
    public function get_currencies_redirects_to_settings(): void
    {
        $this->actingAs($this->user)
            ->get(route('currencies.index'))
            ->assertRedirect(route('settings.edit'));
    }

    // ─── Store — validation ───────────────────────────────────

    /** @test */
    public function adding_currency_requires_a_3_letter_code(): void
    {
        $this->actingAs($this->user)
            ->post(route('currencies.store'), ['code' => 'AU', 'symbol' => 'A$'])
            ->assertSessionHasErrors('code');
    }

    /** @test */
    public function currency_code_must_be_alpha_only(): void
    {
        $this->actingAs($this->user)
            ->post(route('currencies.store'), ['code' => '1AU', 'symbol' => 'A$'])
            ->assertSessionHasErrors('code');
    }

    /** @test */
    public function inr_cannot_be_added_as_custom_currency(): void
    {
        $this->actingAs($this->user)
            ->post(route('currencies.store'), ['code' => 'INR', 'symbol' => '₹'])
            ->assertSessionHasErrors('code');
    }

    /** @test */
    public function duplicate_currency_for_same_user_is_rejected(): void
    {
        // AUD is already seeded by User::booted()
        Http::fake([
            '*' => Http::response([
                'result'           => 'success',
                'conversion_rates' => ['AUD' => 0.01818],
            ], 200),
        ]);

        $this->actingAs($this->user)
            ->post(route('currencies.store'), ['code' => 'AUD', 'symbol' => 'A$'])
            ->assertSessionHasErrors('code');
    }

    // ─── Store — happy path ───────────────────────────────────

    /** @test */
    public function user_can_add_a_new_valid_currency_with_mocked_api(): void
    {
        Http::fake([
            '*' => Http::response([
                'result'           => 'success',
                'conversion_rates' => ['GBP' => 0.009524],
            ], 200),
        ]);

        $this->actingAs($this->user)
            ->post(route('currencies.store'), ['code' => 'GBP', 'symbol' => '£'])
            ->assertSessionHasNoErrors()
            ->assertSessionHas('success');

        $this->assertDatabaseHas('currencies', [
            'user_id' => $this->user->id,
            'code'    => 'GBP',
            'symbol'  => '£',
        ]);
    }

    /** @test */
    public function adding_currency_stores_exchange_rate_in_db(): void
    {
        Http::fake([
            '*' => Http::response([
                'result'           => 'success',
                'conversion_rates' => ['EUR' => 0.01075],
            ], 200),
        ]);

        $this->actingAs($this->user)
            ->post(route('currencies.store'), ['code' => 'EUR', 'symbol' => '€']);

        $this->assertDatabaseHas('exchange_rates', [
            'target_currency' => 'EUR',
            'base_currency'   => 'INR',
        ]);
    }

    /** @test */
    public function invalid_currency_code_api_failure_shows_user_friendly_error(): void
    {
        Http::fake([
            '*' => Http::response([
                'result'           => 'success',
                'conversion_rates' => [], // GBX not in rates
            ], 200),
        ]);

        $this->actingAs($this->user)
            ->post(route('currencies.store'), ['code' => 'GBX', 'symbol' => '?'])
            ->assertSessionHasErrors('code');

        // Confirm no DB row was inserted
        $this->assertDatabaseMissing('currencies', [
            'user_id' => $this->user->id,
            'code'    => 'GBX',
        ]);
    }

    // ─── Destroy ─────────────────────────────────────────────

    /** @test */
    public function user_can_remove_a_currency(): void
    {
        // Get any seeded currency
        $currency = \App\Models\Currency::where('user_id', $this->user->id)->first();

        $this->actingAs($this->user)
            ->delete(route('currencies.destroy', $currency))
            ->assertRedirect()
            ->assertSessionHas('success');

        $this->assertDatabaseMissing('currencies', ['id' => $currency->id]);
    }

    /** @test */
    public function user_cannot_delete_another_users_currency(): void
    {
        $otherUser     = User::factory()->create();
        $otherCurrency = \App\Models\Currency::where('user_id', $otherUser->id)->first();

        $this->actingAs($this->user)
            ->delete(route('currencies.destroy', $otherCurrency))
            ->assertForbidden();
    }
}
