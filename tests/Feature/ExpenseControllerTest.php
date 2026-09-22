<?php

namespace Tests\Feature;

use App\Models\Expense;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ExpenseControllerTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private User $otherUser;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->user = User::factory()->create(['status' => 'approved']);
        $this->otherUser = User::factory()->create(['status' => 'approved']);
    }

    /** @test */
    public function guests_cannot_access_expenses(): void
    {
        $this->get(route('expenses.index'))->assertRedirect(route('login'));
        $this->post(route('expenses.store'), [])->assertRedirect(route('login'));
    }

    /** @test */
    public function approved_user_can_view_expense_index_and_create_expense(): void
    {
        $response = $this->actingAs($this->user)
            ->get(route('expenses.index'));

        $response->assertOk();
        $response->assertViewIs('expenses.index');
        $response->assertViewHasAll(['expenses', 'categories', 'totalExpensesSum', 'totalItcSum']);
    }

    /** @test */
    public function user_can_store_valid_expense(): void
    {
        Storage::fake('public');
        $file = UploadedFile::fake()->create('receipt.pdf', 500, 'application/pdf');

        $payload = [
            'expense_date' => '2026-06-16',
            'vendor_name' => 'Hostinger',
            'vendor_gstin' => '27AAPCS1234F1Z5',
            'category' => 'Domain & Hosting',
            'base_amount' => 1000.00,
            'cgst' => 90.00,
            'sgst' => 90.00,
            'igst' => 0.00,
            'total_amount' => 1180.00,
            'payment_mode' => 'Credit Card',
            'is_itc_eligible' => '1',
            'receipt' => $file,
        ];

        $response = $this->actingAs($this->user)
            ->post(route('expenses.store'), $payload);

        $response->assertRedirect(route('expenses.index'));
        $response->assertSessionHas('success');

        $expense = Expense::where('vendor_name', 'Hostinger')->first();
        $this->assertNotNull($expense);
        $this->assertEquals($this->user->id, $expense->user_id);
        $this->assertEquals(1000.00, $expense->base_amount);
        $this->assertEquals(90.00, $expense->cgst);
        $this->assertEquals(90.00, $expense->sgst);
        $this->assertTrue($expense->is_itc_eligible);
        $this->assertNotNull($expense->receipt_url);

        // Check file stored
        Storage::disk('public')->assertExists($expense->receipt_url);
    }

    /** @test */
    public function user_can_edit_and_update_their_expense(): void
    {
        Storage::fake('public');
        
        $expense = Expense::factory()->create([
            'user_id' => $this->user->id,
            'vendor_name' => 'Old Vendor',
            'receipt_url' => 'receipts/old.pdf'
        ]);
        
        Storage::disk('public')->put('receipts/old.pdf', 'content');

        $newFile = UploadedFile::fake()->create('receipt_new.jpg', 100, 'image/jpeg');

        $payload = [
            'expense_date' => '2026-06-16',
            'vendor_name' => 'New Vendor',
            'category' => 'Utilities & Internet',
            'base_amount' => 500.00,
            'cgst' => 0.00,
            'sgst' => 0.00,
            'igst' => 90.00,
            'total_amount' => 590.00,
            'payment_mode' => 'Net Banking',
            'receipt' => $newFile,
        ];

        $response = $this->actingAs($this->user)
            ->put(route('expenses.update', $expense), $payload);

        $response->assertRedirect(route('expenses.index'));
        
        $updatedExpense = $expense->fresh();
        $this->assertEquals('New Vendor', $updatedExpense->vendor_name);
        $this->assertEquals(500.00, $updatedExpense->base_amount);
        $this->assertEquals(90.00, $updatedExpense->igst);
        $this->assertFalse($updatedExpense->is_itc_eligible);

        // Old file deleted, new file exists
        Storage::disk('public')->assertMissing('receipts/old.pdf');
        Storage::disk('public')->assertExists($updatedExpense->receipt_url);
    }

    /** @test */
    public function user_cannot_view_edit_or_update_another_users_expense(): void
    {
        $otherExpense = Expense::factory()->create([
            'user_id' => $this->otherUser->id,
            'vendor_name' => 'Other Vendor'
        ]);

        $this->actingAs($this->user)
            ->get(route('expenses.edit', $otherExpense))
            ->assertForbidden();

        $this->actingAs($this->user)
            ->put(route('expenses.update', $otherExpense), [
                'expense_date' => '2026-06-16',
                'vendor_name' => 'Hacked Vendor',
                'category' => 'Utilities & Internet',
                'base_amount' => 500.00,
                'total_amount' => 500.00,
            ])
            ->assertForbidden();
    }

    /** @test */
    public function user_can_delete_their_expense(): void
    {
        Storage::fake('public');
        
        $expense = Expense::factory()->create([
            'user_id' => $this->user->id,
            'receipt_url' => 'receipts/delete.pdf'
        ]);
        
        Storage::disk('public')->put('receipts/delete.pdf', 'content');

        $response = $this->actingAs($this->user)
            ->delete(route('expenses.destroy', $expense));

        $response->assertRedirect(route('expenses.index'));
        $this->assertDatabaseMissing('expenses', ['id' => $expense->id]);
        
        // Check file purged
        Storage::disk('public')->assertMissing('receipts/delete.pdf');
    }

    /** @test */
    public function user_cannot_delete_another_users_expense(): void
    {
        $otherExpense = Expense::factory()->create([
            'user_id' => $this->otherUser->id
        ]);

        $this->actingAs($this->user)
            ->delete(route('expenses.destroy', $otherExpense))
            ->assertForbidden();

        $this->assertDatabaseHas('expenses', ['id' => $otherExpense->id]);
    }

    /** @test */
    public function user_can_export_expenses_to_csv(): void
    {
        Expense::factory()->create([
            'user_id' => $this->user->id,
            'vendor_name' => 'Vercel Inc',
            'category' => 'Cloud Hosting',
            'base_amount' => 2000.00,
            'cgst' => 180.00,
            'sgst' => 180.00,
            'igst' => 0.00,
            'total_amount' => 2360.00,
            'payment_mode' => 'Credit Card',
            'is_itc_eligible' => true,
        ]);

        $response = $this->actingAs($this->user)
            ->get(route('expenses.export'));

        $response->assertOk();
        $this->assertStringContainsString('text/csv', $response->headers->get('Content-Type'));
        $this->assertStringContainsString('attachment; filename=Business_Expenses_', $response->headers->get('Content-Disposition'));

        // Verify CSV contents
        $content = $response->streamedContent();
        $this->assertStringContainsString('Vercel Inc', $content);
        $this->assertStringContainsString('Cloud Hosting', $content);
        $this->assertStringContainsString('2360.00', $content);
        $this->assertStringContainsString('YES', $content);
    }

    /** @test */
    public function user_cannot_export_another_users_expenses(): void
    {
        Expense::factory()->create([
            'user_id' => $this->otherUser->id,
            'vendor_name' => 'Secret Other Vendor',
            'base_amount' => 9999.00,
        ]);

        $response = $this->actingAs($this->user)
            ->get(route('expenses.export'));

        // User has 0 expenses of their own, should redirect with message or return only user's items
        if ($response->isRedirect()) {
            $response->assertSessionHas('error');
        } else {
            $content = $response->streamedContent();
            $this->assertStringNotContainsString('Secret Other Vendor', $content);
        }
    }
}
