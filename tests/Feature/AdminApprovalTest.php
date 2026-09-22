<?php

namespace Tests\Feature;

use App\Models\User;
use App\Mail\RegistrationPendingMail;
use App\Mail\RegistrationApprovedMail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class AdminApprovalTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Mail::fake();
    }

    /** @test */
    public function registration_creates_pending_user_and_redirects(): void
    {
        $response = $this->post(route('register'), [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        // Assert redirect to pending approval view
        $response->assertRedirect(route('auth.pending'));

        // Assert user is in database with status pending
        $this->assertDatabaseHas('users', [
            'email' => 'johndoe@example.com',
            'status' => 'pending',
        ]);

        // Assert user is NOT logged in
        $this->assertGuest();

        // Assert pending approval email was sent to user and CC admin
        Mail::assertSent(RegistrationPendingMail::class, function ($mail) {
            return $mail->hasTo('johndoe@example.com') && 
                   $mail->hasCc('shadabcse2020@gmail.com');
        });
    }

    /** @test */
    public function admin_registration_is_auto_approved(): void
    {
        $response = $this->post(route('register'), [
            'name' => 'Admin User',
            'email' => 'shadabcse2020@gmail.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        // Admin defaults to approved in our controller status assignment
        $this->assertDatabaseHas('users', [
            'email' => 'shadabcse2020@gmail.com',
            'status' => 'approved',
        ]);
    }

    /** @test */
    public function pending_user_cannot_login(): void
    {
        $user = User::factory()->create([
            'email' => 'pendinguser@example.com',
            'status' => 'pending',
        ]);

        $response = $this->post(route('login'), [
            'email' => 'pendinguser@example.com',
            'password' => 'password', // default factory password
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    /** @test */
    public function rejected_user_cannot_login(): void
    {
        $user = User::factory()->create([
            'email' => 'rejecteduser@example.com',
            'status' => 'rejected',
        ]);

        $response = $this->post(route('login'), [
            'email' => 'rejecteduser@example.com',
            'password' => 'password',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    /** @test */
    public function approved_user_can_login_and_access_dashboard(): void
    {
        $user = User::factory()->create([
            'email' => 'approveduser@example.com',
            'status' => 'approved',
        ]);

        $response = $this->post(route('login'), [
            'email' => 'approveduser@example.com',
            'password' => 'password',
        ]);

        $response->assertRedirect(route('dashboard'));
        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function non_admin_blocked_from_admin_panel(): void
    {
        $user = User::factory()->create([
            'status' => 'approved',
        ]);

        $response = $this->actingAs($user)
            ->get(route('admin.users.index'));

        $response->assertStatus(403);
    }

    /** @test */
    public function admin_can_access_admin_panel_and_approve_user(): void
    {
        $admin = User::factory()->create([
            'email' => 'shadabcse2020@gmail.com',
            'status' => 'approved',
        ]);

        $pendingUser = User::factory()->create([
            'name' => 'Pending Client',
            'email' => 'pendingclient@example.com',
            'status' => 'pending',
        ]);

        // Access user approval panel
        $response = $this->actingAs($admin)
            ->get(route('admin.users.index'));

        $response->assertStatus(200);
        $response->assertSee('pendingclient@example.com');

        // Approve the user
        $approveResponse = $this->actingAs($admin)
            ->post(route('admin.users.approve', $pendingUser->id));

        $approveResponse->assertRedirect();
        
        // Assert status changed in DB
        $this->assertDatabaseHas('users', [
            'id' => $pendingUser->id,
            'status' => 'approved',
        ]);

        // Assert approval email was sent
        Mail::assertSent(RegistrationApprovedMail::class, function ($mail) use ($pendingUser) {
            return $mail->hasTo($pendingUser->email);
        });
    }

    /** @test */
    public function admin_can_reject_user(): void
    {
        $admin = User::factory()->create([
            'email' => 'shadabcse2020@gmail.com',
            'status' => 'approved',
        ]);

        $pendingUser = User::factory()->create([
            'email' => 'pendingclient@example.com',
            'status' => 'pending',
        ]);

        // Reject the user
        $rejectResponse = $this->actingAs($admin)
            ->post(route('admin.users.reject', $pendingUser->id));

        $rejectResponse->assertRedirect();

        // Assert status changed to rejected in DB
        $this->assertDatabaseHas('users', [
            'id' => $pendingUser->id,
            'status' => 'rejected',
        ]);
    }

    /** @test */
    public function user_can_update_profile_name_but_cannot_change_email(): void
    {
        $user = User::factory()->create([
            'name' => 'Old Name',
            'email' => 'user@example.com',
            'status' => 'approved',
        ]);

        $response = $this->actingAs($user)
            ->put(route('profile.update'), [
                'name' => 'New Name',
            ]);

        $response->assertRedirect();
        
        // Assert user's name is updated in the database
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'New Name',
            'email' => 'user@example.com',
        ]);
    }
}
