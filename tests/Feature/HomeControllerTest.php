<?php

namespace Tests\Feature;

use App\Mail\ContactUsMail;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_can_view_the_public_homepage(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertViewIs('home');
        $response->assertSee('Cod Xpert Invoices');
        $response->assertSee('Get Started');
        $response->assertSee('Sign In');
    }

    /** @test */
    public function authenticated_users_are_redirected_from_homepage_to_dashboard(): void
    {
        $user = User::factory()->create([
            'status' => 'approved',
        ]);

        $response = $this->actingAs($user)->get('/');

        $response->assertRedirect(route('dashboard'));
    }

    /** @test */
    public function contact_form_submission_requires_validation(): void
    {
        $response = $this->post('/contact', [
            'name' => '',
            'email' => 'invalid-email',
            'subject' => '',
            'message' => 'short',
        ]);

        $response->assertSessionHasErrors(['name', 'email', 'subject', 'message']);
    }

    /** @test */
    public function valid_contact_form_submission_dispatches_email_successfully(): void
    {
        Mail::fake();

        $response = $this->post('/contact', [
            'name' => 'Test Sender',
            'email' => 'sender@example.com',
            'subject' => 'Inquiry Subject',
            'message' => 'This is a message with sufficient character length.',
        ]);

        $response->assertRedirect();
        
        Mail::assertSent(ContactUsMail::class, function (ContactUsMail $mail) {
            return $mail->hasTo('shadabcse2020@gmail.com') &&
                   $mail->name === 'Test Sender' &&
                   $mail->email === 'sender@example.com' &&
                   $mail->mailSubject === 'Inquiry Subject' &&
                   $mail->messageContent === 'This is a message with sufficient character length.';
        });
    }

    /** @test */
    public function valid_json_contact_form_submission_returns_json_success(): void
    {
        Mail::fake();

        $response = $this->postJson('/contact', [
            'name' => 'AJAX Sender',
            'email' => 'ajax@example.com',
            'subject' => 'AJAX Inquiry',
            'message' => 'This message is sent asynchronously via JSON post.',
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => 'Thank you! Your message has been sent successfully.',
        ]);

        Mail::assertSent(ContactUsMail::class, function (ContactUsMail $mail) {
            return $mail->hasTo('shadabcse2020@gmail.com') &&
                   $mail->name === 'AJAX Sender' &&
                   $mail->email === 'ajax@example.com' &&
                   $mail->mailSubject === 'AJAX Inquiry' &&
                   $mail->messageContent === 'This message is sent asynchronously via JSON post.';
        });
    }
}
