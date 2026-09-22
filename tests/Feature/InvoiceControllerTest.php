<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\Currency;
use App\Models\ExchangeRate;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class InvoiceControllerTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private Client $client;

    protected function setUp(): void
    {
        parent::setUp();
        Mail::fake();

        $this->user   = User::factory()->create();
        $this->client = Client::factory()->create(['user_id' => $this->user->id]);

        // Seed a rate so the form doesn't try a live API call
        ExchangeRate::create([
            'base_currency'   => 'INR',
            'target_currency' => 'AUD',
            'rate'            => 55.00,
            'fetched_date'    => now()->format('Y-m-d'),
        ]);
    }

    // ─── Auth Guard ────────────────────────────────────────────

    /** @test */
    public function guests_cannot_access_invoices(): void
    {
        $this->get(route('invoices.index'))->assertRedirect(route('login'));
    }

    // ─── Index ─────────────────────────────────────────────────

    /** @test */
    public function user_can_list_their_invoices(): void
    {
        $this->actingAs($this->user)
            ->get(route('invoices.index'))
            ->assertOk()
            ->assertViewIs('invoices.index');
    }

    /** @test */
    public function invoice_list_is_scoped_to_current_user(): void
    {
        $otherUser = User::factory()->create();
        $otherClient = Client::factory()->create(['user_id' => $otherUser->id]);
        $this->makeInvoice($otherUser, $otherClient, 'INV-OTHER-0001');

        $this->actingAs($this->user)
            ->get(route('invoices.index'))
            ->assertDontSee('INV-OTHER-0001');
    }

    // ─── Create ────────────────────────────────────────────────

    /** @test */
    public function user_can_view_create_invoice_form(): void
    {
        $this->actingAs($this->user)
            ->get(route('invoices.create'))
            ->assertOk()
            ->assertViewIs('invoices.create');
    }

    // ─── Store (INR Invoice) ────────────────────────────────────

    /** @test */
    public function user_can_create_an_inr_invoice(): void
    {
        $payload = $this->invoicePayload('INR', '₹');

        $this->actingAs($this->user)
            ->post(route('invoices.store'), $payload)
            ->assertRedirect();

        $this->assertDatabaseHas('invoices', [
            'user_id'        => $this->user->id,
            'invoice_number' => 'INV-2026-TEST',
            'currency_code'  => 'INR',
            'status'         => 'draft',
        ]);
    }

    /** @test */
    public function inr_invoice_sets_exchange_rate_to_1(): void
    {
        $this->actingAs($this->user)
            ->post(route('invoices.store'), $this->invoicePayload('INR', '₹'));

        $invoice = Invoice::where('invoice_number', 'INV-2026-TEST')->first();
        $this->assertEquals(1.0, (float) $invoice->exchange_rate_inr);
    }

    /** @test */
    public function inr_invoice_grand_total_equals_inr_equivalent(): void
    {
        $this->actingAs($this->user)
            ->post(route('invoices.store'), $this->invoicePayload('INR', '₹'));

        $invoice = Invoice::where('invoice_number', 'INV-2026-TEST')->first();
        $this->assertEquals((float) $invoice->grand_total, (float) $invoice->inr_equivalent);
    }

    // ─── Store (Foreign Currency Invoice) ──────────────────────

    /** @test */
    public function user_can_create_a_foreign_currency_invoice(): void
    {
        $payload = $this->invoicePayload('AUD', 'A$');
        $payload['invoice_number'] = 'INV-AUD-0001';

        $this->actingAs($this->user)
            ->post(route('invoices.store'), $payload)
            ->assertRedirect();

        $invoice = Invoice::where('invoice_number', 'INV-AUD-0001')->first();
        $this->assertNotNull($invoice);
        $this->assertEquals('AUD', $invoice->currency_code);
        $this->assertGreaterThan(0, (float) $invoice->exchange_rate_inr);
        $this->assertGreaterThan(0, (float) $invoice->inr_equivalent);
    }

    /** @test */
    public function inr_equivalent_is_calculated_correctly_for_foreign_invoice(): void
    {
        // Rate = 55 INR/AUD, grand_total = 1180 AUD
        // Expected inr_equivalent = 1180 * 55 = 64900
        $payload = $this->invoicePayload('AUD', 'A$');
        $payload['invoice_number'] = 'INV-AUD-CALC';

        $this->actingAs($this->user)
            ->post(route('invoices.store'), $payload);

        $invoice = Invoice::where('invoice_number', 'INV-AUD-CALC')->first();
        $this->assertEqualsWithDelta(64900.00, (float) $invoice->inr_equivalent, 1.0);
    }

    // ─── Validation ────────────────────────────────────────────

    /** @test */
    public function invoice_requires_client_id(): void
    {
        $payload = $this->invoicePayload('INR', '₹');
        unset($payload['client_id']);

        $this->actingAs($this->user)
            ->post(route('invoices.store'), $payload)
            ->assertSessionHasErrors('client_id');
    }

    /** @test */
    public function invoice_requires_at_least_one_line_item(): void
    {
        $payload = $this->invoicePayload('INR', '₹');
        $payload['items'] = [];

        $this->actingAs($this->user)
            ->post(route('invoices.store'), $payload)
            ->assertSessionHasErrors('items');
    }

    /** @test */
    public function invoice_number_must_be_unique_per_user(): void
    {
        $payload = $this->invoicePayload('INR', '₹');

        $this->actingAs($this->user)->post(route('invoices.store'), $payload);
        $this->actingAs($this->user)
            ->post(route('invoices.store'), $payload)
            ->assertSessionHasErrors('invoice_number');
    }

    /** @test */
    public function due_date_must_be_on_or_after_invoice_date(): void
    {
        $payload = $this->invoicePayload('INR', '₹');
        $payload['invoice_date'] = '2026-06-15';
        $payload['due_date']     = '2026-06-01'; // Before invoice date

        $this->actingAs($this->user)
            ->post(route('invoices.store'), $payload)
            ->assertSessionHasErrors('due_date');
    }

    /** @test */
    public function unsupported_currency_is_rejected(): void
    {
        $payload = $this->invoicePayload('XYZ', 'X');

        $this->actingAs($this->user)
            ->post(route('invoices.store'), $payload)
            ->assertSessionHasErrors('currency_code');
    }

    // ─── Show ──────────────────────────────────────────────────

    /** @test */
    public function user_can_view_their_own_invoice(): void
    {
        $invoice = $this->makeInvoice($this->user, $this->client);

        $this->actingAs($this->user)
            ->get(route('invoices.show', $invoice))
            ->assertOk()
            ->assertViewIs('invoices.show');
    }

    /** @test */
    public function user_cannot_view_another_users_invoice(): void
    {
        $otherUser   = User::factory()->create();
        $otherClient = Client::factory()->create(['user_id' => $otherUser->id]);
        $otherInvoice = $this->makeInvoice($otherUser, $otherClient);

        $this->actingAs($this->user)
            ->get(route('invoices.show', $otherInvoice))
            ->assertForbidden();
    }

    // ─── Update ────────────────────────────────────────────────

    /** @test */
    public function user_can_update_their_invoice(): void
    {
        $invoice = $this->makeInvoice($this->user, $this->client);
        $payload = $this->invoicePayload('INR', '₹');
        $payload['invoice_number'] = $invoice->invoice_number;
        $payload['status'] = 'sent';

        $this->actingAs($this->user)
            ->put(route('invoices.update', $invoice), $payload)
            ->assertRedirect(route('invoices.show', $invoice));

        $this->assertDatabaseHas('invoices', ['id' => $invoice->id, 'status' => 'sent']);
    }

    // ─── Destroy ───────────────────────────────────────────────

    /** @test */
    public function user_can_delete_their_invoice(): void
    {
        $invoice = $this->makeInvoice($this->user, $this->client);

        $this->actingAs($this->user)
            ->delete(route('invoices.destroy', $invoice))
            ->assertRedirect();

        $this->assertDatabaseMissing('invoices', ['id' => $invoice->id]);
    }

    /** @test */
    public function user_cannot_delete_another_users_invoice(): void
    {
        $otherUser    = User::factory()->create();
        $otherClient  = Client::factory()->create(['user_id' => $otherUser->id]);
        $otherInvoice = $this->makeInvoice($otherUser, $otherClient);

        $this->actingAs($this->user)
            ->delete(route('invoices.destroy', $otherInvoice))
            ->assertForbidden();
    }

    // ─── Convert Quotation → Invoice ────────────────────────────

    /** @test */
    public function quotation_can_be_converted_to_invoice(): void
    {
        $quotation = $this->makeInvoice($this->user, $this->client, 'QUO-2026-0001', 'quotation');

        $this->actingAs($this->user)
            ->post(route('quotations.convert', $quotation))
            ->assertRedirect();

        $this->assertDatabaseHas('invoices', [
            'id'   => $quotation->id,
            'type' => 'invoice',
        ]);
    }

    /** @test */
    public function converting_an_invoice_to_invoice_is_rejected(): void
    {
        $invoice = $this->makeInvoice($this->user, $this->client);

        $this->actingAs($this->user)
            ->post(route('quotations.convert', $invoice))
            ->assertRedirect()
            ->assertSessionHas('error');
    }

    // ─── Record Payment ─────────────────────────────────────────

    /** @test */
    public function user_can_record_payment_on_inr_invoice(): void
    {
        $invoice = $this->makeInvoice($this->user, $this->client);

        $this->actingAs($this->user)
            ->post(route('invoices.record-payment', $invoice), [
                'payment_date'        => now()->format('Y-m-d'),
                'inr_amount_received' => 1180.00,
                'firc_number'         => null,
            ])
            ->assertRedirect(route('invoices.show', $invoice));

        $this->assertDatabaseHas('invoices', ['id' => $invoice->id, 'status' => 'paid']);
    }

    /** @test */
    public function payment_inr_amount_is_required(): void
    {
        $invoice = $this->makeInvoice($this->user, $this->client);

        $this->actingAs($this->user)
            ->post(route('invoices.record-payment', $invoice), [
                'payment_date' => now()->format('Y-m-d'),
            ])
            ->assertSessionHasErrors('inr_amount_received');
    }

    // ─── Search & Filter ───────────────────────────────────────

    /** @test */
    public function user_can_filter_invoices_by_status(): void
    {
        $this->makeInvoice($this->user, $this->client, 'INV-DRAFT-01', 'invoice', 'draft');
        $this->makeInvoice($this->user, $this->client, 'INV-PAID-01', 'invoice', 'paid');

        $response = $this->actingAs($this->user)
            ->get(route('invoices.index', ['status' => 'paid']));

        $response->assertSee('INV-PAID-01');
        $response->assertDontSee('INV-DRAFT-01');
    }

    /** @test */
    public function user_can_filter_invoices_by_date_range(): void
    {
        $invoice1 = Invoice::create([
            'user_id'          => $this->user->id,
            'client_id'        => $this->client->id,
            'invoice_number'   => 'INV-DATE-01',
            'invoice_date'     => '2026-06-01',
            'due_date'         => '2026-06-15',
            'currency_code'    => 'INR',
            'currency_symbol'  => '₹',
            'subtotal'         => 1000.00,
            'tax_amount'       => 180.00,
            'grand_total'      => 1180.00,
            'status'           => 'draft',
            'type'             => 'invoice',
            'exchange_rate_inr'=> 1.0,
            'inr_equivalent'   => 1180.00,
        ]);

        $invoice2 = Invoice::create([
            'user_id'          => $this->user->id,
            'client_id'        => $this->client->id,
            'invoice_number'   => 'INV-DATE-02',
            'invoice_date'     => '2026-06-10',
            'due_date'         => '2026-06-24',
            'currency_code'    => 'INR',
            'currency_symbol'  => '₹',
            'subtotal'         => 1000.00,
            'tax_amount'       => 180.00,
            'grand_total'      => 1180.00,
            'status'           => 'draft',
            'type'             => 'invoice',
            'exchange_rate_inr'=> 1.0,
            'inr_equivalent'   => 1180.00,
        ]);

        $invoice3 = Invoice::create([
            'user_id'          => $this->user->id,
            'client_id'        => $this->client->id,
            'invoice_number'   => 'INV-DATE-03',
            'invoice_date'     => '2026-06-20',
            'due_date'         => '2026-07-04',
            'currency_code'    => 'INR',
            'currency_symbol'  => '₹',
            'subtotal'         => 1000.00,
            'tax_amount'       => 180.00,
            'grand_total'      => 1180.00,
            'status'           => 'draft',
            'type'             => 'invoice',
            'exchange_rate_inr'=> 1.0,
            'inr_equivalent'   => 1180.00,
        ]);

        $response = $this->actingAs($this->user)
            ->get(route('invoices.index', [
                'start_date' => '2026-06-05',
                'end_date'   => '2026-06-15',
            ]));

        $response->assertSee('INV-DATE-02');
        $response->assertDontSee('INV-DATE-01');
        $response->assertDontSee('INV-DATE-03');
    }

    // ─── Helper ─────────────────────────────────────────────────

    private function makeInvoice(
        User $user,
        Client $client,
        string $number = 'INV-2026-0099',
        string $type   = 'invoice',
        string $status = 'draft'
    ): Invoice {
        $invoice = Invoice::create([
            'user_id'          => $user->id,
            'client_id'        => $client->id,
            'invoice_number'   => $number,
            'invoice_date'     => now()->format('Y-m-d'),
            'due_date'         => now()->addDays(14)->format('Y-m-d'),
            'currency_code'    => 'INR',
            'currency_symbol'  => '₹',
            'subtotal'         => 1000.00,
            'tax_amount'       => 180.00,
            'grand_total'      => 1180.00,
            'status'           => $status,
            'type'             => $type,
            'exchange_rate_inr'=> 1.0,
            'inr_equivalent'   => 1180.00,
        ]);

        $invoice->items()->create([
            'item_name'   => 'Service',
            'qty'         => 10,
            'rate'        => 100,
            'tax_percent' => 18,
            'total'       => 1000,
        ]);

        return $invoice;
    }

    /** @test */
    public function default_invoice_number_has_correct_format(): void
    {
        $year = date('Y');
        $month = date('m');

        // 1. Initially with no invoices, default should be INV-{YYYYMM}-0001
        $response = $this->actingAs($this->user)
            ->get(route('invoices.create'));
        
        $response->assertOk();
        $response->assertViewHas('defaultInvoiceNumber', "INV-{$year}{$month}-0001");

        // 2. Create an invoice for current month
        Invoice::create([
            'user_id' => $this->user->id,
            'client_id' => $this->client->id,
            'invoice_number' => "INV-{$year}{$month}-0001",
            'invoice_date' => now()->format('Y-m-d'),
            'due_date' => now()->addDays(14)->format('Y-m-d'),
            'currency_code' => 'INR',
            'currency_symbol' => '₹',
            'subtotal' => 100,
            'tax_amount' => 18,
            'grand_total' => 118,
            'status' => 'draft',
            'type' => 'invoice',
            'exchange_rate_inr' => 1.0,
            'inr_equivalent' => 118,
            'created_at' => now(), // within this month
        ]);

        // Now, next should be INV-{YYYYMM}-0002
        $response = $this->actingAs($this->user)
            ->get(route('invoices.create'));
        
        $response->assertOk();
        $response->assertViewHas('defaultInvoiceNumber', "INV-{$year}{$month}-0002");

        // 3. Create a quotation for current month, default quotation should be QUO-{YYYYMM}-0001
        $response = $this->actingAs($this->user)
            ->get(route('invoices.create', ['type' => 'quotation']));
        
        $response->assertOk();
        $response->assertViewHas('defaultInvoiceNumber', "QUO-{$year}{$month}-0001");
    }

    /** @test */
    public function quotation_conversion_resets_invoice_number_monthly_and_increments_correctly(): void
    {
        $year = date('Y');
        $month = date('m');

        // Create a quotation
        $quotation = Invoice::create([
            'user_id' => $this->user->id,
            'client_id' => $this->client->id,
            'invoice_number' => "QUO-{$year}{$month}-0001",
            'invoice_date' => now()->format('Y-m-d'),
            'due_date' => now()->addDays(14)->format('Y-m-d'),
            'currency_code' => 'INR',
            'currency_symbol' => '₹',
            'subtotal' => 100,
            'tax_amount' => 18,
            'grand_total' => 118,
            'status' => 'draft',
            'type' => 'quotation',
            'exchange_rate_inr' => 1.0,
            'inr_equivalent' => 118,
        ]);

        // Convert quotation to invoice
        $response = $this->actingAs($this->user)
            ->post(route('quotations.convert', $quotation));

        $response->assertRedirect();
        
        // Assert the converted invoice has the number INV-{YYYYMM}-0001 (since there are no other invoices)
        $this->assertDatabaseHas('invoices', [
            'id' => $quotation->id,
            'type' => 'invoice',
            'invoice_number' => "INV-{$year}{$month}-0001",
        ]);
    }

    /** @test */
    public function editing_invoice_synchronizes_firc_number_with_existing_payment_record(): void
    {
        $invoice = Invoice::create([
            'user_id' => $this->user->id,
            'client_id' => $this->client->id,
            'invoice_number' => 'INV-AED-0001',
            'invoice_date' => '2026-08-01',
            'due_date' => '2026-08-15',
            'currency_code' => 'AED',
            'currency_symbol' => 'AED ',
            'subtotal' => 950,
            'tax_amount' => 0,
            'grand_total' => 950,
            'status' => 'paid',
            'type' => 'invoice',
            'exchange_rate_inr' => 24.91,
            'inr_equivalent' => 23664.50,
        ]);

        $invoice->items()->create([
            'item_name' => 'SEO Services',
            'qty' => 1,
            'rate' => 950,
            'tax_percent' => 0,
            'total' => 950,
        ]);

        // Payment record created without FIRC
        $payment = $invoice->payment()->create([
            'payment_date' => '2026-08-05',
            'exchange_rate_payment' => 24.91,
            'inr_amount_received' => 23664.50,
            'forex_gain_loss' => 0.00,
            'firc_number' => null,
        ]);

        // Edit invoice and submit FIRC number
        $payload = [
            'client_id' => $this->client->id,
            'invoice_number' => 'INV-AED-0001',
            'invoice_date' => '2026-08-01',
            'due_date' => '2026-08-15',
            'currency_code' => 'AED',
            'currency_symbol' => 'AED ',
            'status' => 'paid',
            'type' => 'invoice',
            'firc_number' => '010926I049909936',
            'actual_exchange_rate' => 24.91,
            'actual_inr_received' => 23664.50,
            'items' => [
                [
                    'item_name' => 'SEO Services',
                    'qty' => 1,
                    'rate' => 950,
                    'tax_percent' => 0,
                ],
            ],
        ];

        $response = $this->actingAs($this->user)->put(route('invoices.update', $invoice), $payload);
        $response->assertRedirect(route('invoices.show', $invoice));

        // Verify invoice was updated
        $this->assertDatabaseHas('invoices', [
            'id' => $invoice->id,
            'firc_number' => '010926I049909936',
        ]);

        // Verify payment record was synchronized with the new FIRC number
        $this->assertDatabaseHas('payments', [
            'invoice_id' => $invoice->id,
            'firc_number' => '010926I049909936',
        ]);

        // Verify show page displays the FIRC number
        $this->actingAs($this->user)
            ->get(route('invoices.show', $invoice))
            ->assertSee('010926I049909936');
    }

    private function invoicePayload(string $currency, string $symbol): array
    {
        return [
            'client_id'       => $this->client->id,
            'invoice_number'  => 'INV-2026-TEST',
            'invoice_date'    => '2026-06-01',
            'due_date'        => '2026-06-15',
            'currency_code'   => $currency,
            'currency_symbol' => $symbol,
            'status'          => 'draft',
            'type'            => 'invoice',
            'notes'           => 'Test invoice',
            'bank_notes'      => 'Pay via NEFT',
            'items'           => [
                [
                    'item_name'   => 'Web Development',
                    'description' => 'Monthly retainer',
                    'qty'         => 10,
                    'rate'        => 100,
                    'tax_percent' => 18,
                ],
            ],
        ];
    }
}
