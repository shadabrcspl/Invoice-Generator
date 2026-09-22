<?php

namespace App\Http\Controllers;

use App\Models\EmailSetting;
use App\Services\UserMailer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class EmailSettingController extends Controller
{
    /**
     * Show the email settings form.
     */
    public function edit()
    {
        $setting = EmailSetting::where('user_id', Auth::id())->first();
        return view('email-settings.edit', compact('setting'));
    }

    /**
     * Save or update the user's SMTP configuration.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'mail_host'         => ['required', 'string', 'max:255'],
            'mail_port'         => ['required', 'integer', 'min:1', 'max:65535'],
            'mail_username'     => ['required', 'string', 'max:255'],
            'mail_from_address' => ['required', 'email', 'max:255'],
            'mail_from_name'    => ['required', 'string', 'max:255'],
            'mail_encryption'   => ['required', 'in:ssl,tls,none'],
        ]);

        // Only validate password if provided (allow updating without re-entering)
        if ($request->filled('mail_password')) {
            $request->validate([
                'mail_password' => ['string', 'min:4', 'max:255'],
            ]);
        }

        $data = [
            'mail_host'         => $validated['mail_host'],
            'mail_port'         => (int) $validated['mail_port'],
            'mail_username'     => $validated['mail_username'],
            'mail_from_address' => $validated['mail_from_address'],
            'mail_from_name'    => $validated['mail_from_name'],
            'mail_encryption'   => $validated['mail_encryption'] === 'none' ? null : $validated['mail_encryption'],
            'is_verified'       => false, // Reset verification after any config change
        ];

        if ($request->filled('mail_password')) {
            $data['mail_password'] = $request->mail_password;
        }

        $setting = EmailSetting::updateOrCreate(
            ['user_id' => Auth::id()],
            $data
        );

        return redirect()->route('email-settings.edit')
            ->with('success', '✅ Email settings saved! Use "Send Test Email" to verify your configuration.');
    }

    /**
     * Send a test email using the user's configured SMTP to verify connectivity.
     */
    public function test(Request $request)
    {
        $request->validate([
            'test_email' => ['required', 'email', 'max:255'],
        ]);

        $setting = EmailSetting::where('user_id', Auth::id())->first();

        if (!$setting) {
            return redirect()->route('email-settings.edit')
                ->with('error', '⚠️ Please save your SMTP configuration first before testing.');
        }

        try {
            UserMailer::for(Auth::user())->to($request->test_email)->send(
                new \App\Mail\TestConnectionMail(Auth::user())
            );

            // Mark as verified
            $setting->update([
                'is_verified' => true,
                'last_tested_at' => now(),
            ]);

            return redirect()->route('email-settings.edit')
                ->with('success', "✅ Test email sent successfully to {$request->test_email}! Your SMTP is working correctly.");
        } catch (\Exception $e) {
            // Mark as failed
            $setting->update(['is_verified' => false]);

            return redirect()->route('email-settings.edit')
                ->with('error', '❌ Test email failed: ' . $e->getMessage() . ' — Please check your SMTP settings.');
        }
    }

    /**
     * Clear the user's custom email settings (revert to system default).
     */
    public function destroy()
    {
        EmailSetting::where('user_id', Auth::id())->delete();

        return redirect()->route('email-settings.edit')
            ->with('success', '🔄 Custom email settings cleared. The system default mailer will now be used.');
    }
}
