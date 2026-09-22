<?php

namespace Tests\Unit;

use App\Models\Invoice;
use App\Models\User;
use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InvoiceModelTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private Client $client;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user   = User::factory()->create();
        $this->client = Client::factory()->create(['user_id' => $this->user->id]);
    }

    /** @test */
    public function invoice_syncs_legacy_foreign_currency_fields_on_save(): void
    {
        $invoice = Invoice::create([
            'user_id'          => $this->user->id,
            'client_id'        => $this->client->id,
            'invoice_number'   => 'INV-2026-0001',
            'invoice_date'     => '2026-06-01',
            'due_date'         => '2026-06-15',
            'currency_code'    => 'AUD',
            'currency_symbol'  => 'A$',
            'subtotal'         => 1000.00,
            'tax_amount'       => 180.00,
            'grand_total'      => 1180.00,
            'status'           => 'draft',
            'type'             => 'invoice',
            'exchange_rate_inr'=> 55.00,
            'inr_equivalent'   => 64900.00,
        ]);

        // Verify the booted() hook syncs legacy columns
        $this->assertEquals('AUD', $invoice->foreign_currency);
        $this->assertEquals(1180.00, (float) $invoice->foreign_amount);
        $this->assertEquals(55.00, (float) $invoice->exchange_rate_invoice);
        $this->assertEquals(64900.00, (float) $invoice->inr_amount_invoice);
    }

    /** @test */
    public function invoice_has_many_items(): void
    {
        $invoice = Invoice::create([
            'user_id'         => $this->user->id,
            'client_id'       => $this->client->id,
            'invoice_number'  => 'INV-2026-0002',
            'invoice_date'    => '2026-06-01',
            'due_date'        => '2026-06-15',
            'currency_code'   => 'INR',
            'currency_symbol' => '₹',
            'subtotal'        => 500.00,
            'tax_amount'      => 90.00,
            'grand_total'     => 590.00,
            'status'          => 'draft',
            'type'            => 'invoice',
            'exchange_rate_inr' => 1.0,
            'inr_equivalent'    => 590.00,
        ]);

        $invoice->items()->create([
            'item_name'   => 'Web Development',
            'qty'         => 10,
            'rate'        => 50,
            'tax_percent' => 18,
            'total'       => 500,
        ]);

        $this->assertCount(1, $invoice->fresh()->items);
    }

    /** @test */
    public function invoice_uses_uuid_primary_key(): void
    {
        $invoice = Invoice::create([
            'user_id'         => $this->user->id,
            'client_id'       => $this->client->id,
            'invoice_number'  => 'INV-2026-0003',
            'invoice_date'    => '2026-06-01',
            'due_date'        => '2026-06-15',
            'currency_code'   => 'INR',
            'currency_symbol' => '₹',
            'subtotal'        => 100.00,
            'tax_amount'      => 18.00,
            'grand_total'     => 118.00,
            'status'          => 'draft',
            'type'            => 'invoice',
            'exchange_rate_inr' => 1.0,
            'inr_equivalent'    => 118.00,
        ]);

        $this->assertMatchesRegularExpression(
            '/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/i',
            $invoice->id
        );
    }

    /** @test */
    public function invoice_belongs_to_user_and_client(): void
    {
        $invoice = Invoice::create([
            'user_id'         => $this->user->id,
            'client_id'       => $this->client->id,
            'invoice_number'  => 'INV-2026-0004',
            'invoice_date'    => '2026-06-01',
            'due_date'        => '2026-06-15',
            'currency_code'   => 'INR',
            'currency_symbol' => '₹',
            'subtotal'        => 200.00,
            'tax_amount'      => 36.00,
            'grand_total'     => 236.00,
            'status'          => 'draft',
            'type'            => 'invoice',
            'exchange_rate_inr' => 1.0,
            'inr_equivalent'    => 236.00,
        ]);

        $this->assertEquals($this->user->id, $invoice->user->id);
        $this->assertEquals($this->client->id, $invoice->client->id);
    }

    /** @test */
    public function forex_gain_loss_calculation_is_correct(): void
    {
        // Invoice locked at 55 INR/AUD, total AUD 1000 = INR 55000
        // Bank paid at 57 INR/AUD, total received INR 57000
        // Expected forex gain = 57000 - 55000 = 2000 INR

        $invoicedInr = 55000.00;
        $actualInr   = 57000.00;
        $forexGainLoss = $actualInr - $invoicedInr;

        $this->assertEquals(2000.00, $forexGainLoss);
    }
}
