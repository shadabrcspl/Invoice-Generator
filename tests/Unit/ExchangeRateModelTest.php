<?php

namespace Tests\Unit;

use App\Models\ExchangeRate;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExchangeRateModelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_1_for_inr_base_currency(): void
    {
        $rate = ExchangeRate::getRateForDate('INR');
        $this->assertEquals(1.0, $rate);
    }

    /** @test */
    public function it_returns_exact_date_rate_when_available(): void
    {
        ExchangeRate::create([
            'base_currency'   => 'INR',
            'target_currency' => 'AUD',
            'rate'            => 55.1234,
            'fetched_date'    => '2026-06-01',
        ]);

        $rate = ExchangeRate::getRateForDate('AUD', '2026-06-01');
        $this->assertEquals(55.1234, $rate);
    }

    /** @test */
    public function it_falls_back_to_most_recent_rate_when_date_not_found(): void
    {
        ExchangeRate::create([
            'base_currency'   => 'INR',
            'target_currency' => 'AUD',
            'rate'            => 54.5000,
            'fetched_date'    => '2026-05-28',
        ]);

        // Request a date AFTER the stored one — should fall back
        $rate = ExchangeRate::getRateForDate('AUD', '2026-06-05');
        $this->assertEquals(54.5000, $rate);
    }

    /** @test */
    public function it_returns_null_when_no_rate_exists(): void
    {
        $rate = ExchangeRate::getRateForDate('GBP');
        $this->assertNull($rate);
    }

    /** @test */
    public function it_picks_most_recent_over_older_when_multiple_exist(): void
    {
        ExchangeRate::create([
            'base_currency'   => 'INR',
            'target_currency' => 'USD',
            'rate'            => 82.0000,
            'fetched_date'    => '2026-05-01',
        ]);
        ExchangeRate::create([
            'base_currency'   => 'INR',
            'target_currency' => 'USD',
            'rate'            => 83.5000,
            'fetched_date'    => '2026-06-01',
        ]);

        $rate = ExchangeRate::getRateForDate('USD', '2026-06-05');
        $this->assertEquals(83.5000, $rate);
    }
}
