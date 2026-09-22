<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClientControllerTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    // ─── Auth Guard Tests ──────────────────────────────────────

    /** @test */
    public function guests_cannot_access_clients(): void
    {
        $this->get(route('clients.index'))->assertRedirect(route('login'));
    }

    // ─── Index ─────────────────────────────────────────────────

    /** @test */
    public function authenticated_user_can_view_their_clients(): void
    {
        Client::factory()->count(3)->create(['user_id' => $this->user->id]);

        $this->actingAs($this->user)
            ->get(route('clients.index'))
            ->assertOk()
            ->assertViewIs('clients.index');
    }

    /** @test */
    public function user_cannot_see_another_users_clients(): void
    {
        $otherUser   = User::factory()->create();
        $otherClient = Client::factory()->create(['user_id' => $otherUser->id, 'name' => 'Spy Corp']);

        $response = $this->actingAs($this->user)
            ->get(route('clients.index'));

        $response->assertDontSee('Spy Corp');
    }

    // ─── Store ─────────────────────────────────────────────────

    /** @test */
    public function user_can_create_a_client(): void
    {
        $this->actingAs($this->user)
            ->post(route('clients.store'), [
                'name'  => 'Acme Corp',
                'email' => 'acme@example.com',
                'phone' => '+91 9876543210',
            ])
            ->assertRedirect(route('clients.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('clients', [
            'user_id' => $this->user->id,
            'name'    => 'Acme Corp',
            'email'   => 'acme@example.com',
        ]);
    }

    /** @test */
    public function client_name_is_required(): void
    {
        $this->actingAs($this->user)
            ->post(route('clients.store'), ['name' => ''])
            ->assertSessionHasErrors('name');
    }

    /** @test */
    public function client_email_must_be_valid_when_provided(): void
    {
        $this->actingAs($this->user)
            ->post(route('clients.store'), [
                'name'  => 'Test Client',
                'email' => 'not-an-email',
            ])
            ->assertSessionHasErrors('email');
    }

    // ─── Update ────────────────────────────────────────────────

    /** @test */
    public function user_can_update_their_own_client(): void
    {
        $client = Client::factory()->create(['user_id' => $this->user->id, 'name' => 'Old Name']);

        $this->actingAs($this->user)
            ->put(route('clients.update', $client), ['name' => 'New Name', 'email' => 'new@example.com'])
            ->assertRedirect(route('clients.index'));

        $this->assertDatabaseHas('clients', ['id' => $client->id, 'name' => 'New Name']);
    }

    /** @test */
    public function user_cannot_update_another_users_client(): void
    {
        $otherUser   = User::factory()->create();
        $otherClient = Client::factory()->create(['user_id' => $otherUser->id]);

        $this->actingAs($this->user)
            ->put(route('clients.update', $otherClient), ['name' => 'Hacked'])
            ->assertForbidden();
    }

    // ─── Destroy ───────────────────────────────────────────────

    /** @test */
    public function user_can_delete_their_own_client(): void
    {
        $client = Client::factory()->create(['user_id' => $this->user->id]);

        $this->actingAs($this->user)
            ->delete(route('clients.destroy', $client))
            ->assertRedirect(route('clients.index'));

        $this->assertDatabaseMissing('clients', ['id' => $client->id]);
    }

    /** @test */
    public function user_cannot_delete_another_users_client(): void
    {
        $otherUser   = User::factory()->create();
        $otherClient = Client::factory()->create(['user_id' => $otherUser->id]);

        $this->actingAs($this->user)
            ->delete(route('clients.destroy', $otherClient))
            ->assertForbidden();
    }

    // ─── Search ────────────────────────────────────────────────

    /** @test */
    public function user_can_search_clients_by_name(): void
    {
        Client::factory()->create(['user_id' => $this->user->id, 'name' => 'Alpha Corp']);
        Client::factory()->create(['user_id' => $this->user->id, 'name' => 'Beta Ltd']);

        $this->actingAs($this->user)
            ->get(route('clients.index', ['search' => 'Alpha']))
            ->assertSee('Alpha Corp')
            ->assertDontSee('Beta Ltd');
    }
}
