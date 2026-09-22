<?php

namespace App\Services;

use App\Models\EmailSetting;
use App\Models\User;
use Illuminate\Contracts\Mail\Mailer;

class UserMailer
{
    /**
     * Return a mailer instance configured with the user's stored SMTP settings.
     * Falls back to the system default 'smtp' mailer if the user has no custom config.
     *
     * Usage:
     *   UserMailer::for(Auth::user())->to($email)->send(new SomeMail());
     */
    public static function for(?User $user): Mailer
    {
        // Safety: if user is null (e.g. from scheduler with unloaded relation), use system mailer
        if (!$user) {
            return \Illuminate\Support\Facades\Mail::mailer('smtp');
        }

        $emailSetting = EmailSetting::where('user_id', $user->id)->first();

        if (!$emailSetting) {
            // No custom config — use the system default mailer as-is
            return \Illuminate\Support\Facades\Mail::mailer('smtp');
        }

        // Build a unique named mailer for this user for this request
        $mailerName = 'user_smtp_' . $user->id;

        // Dynamically push SMTP config at runtime (request-scoped, not persisted)
        config([
            "mail.mailers.{$mailerName}" => [
                'transport'  => 'smtp',
                'host'       => $emailSetting->mail_host,
                'port'       => (int) $emailSetting->mail_port,
                'encryption' => $emailSetting->mail_encryption ?: null,
                'username'   => $emailSetting->mail_username,
                'password'   => $emailSetting->mail_password,
                'timeout'    => 15,
            ],
            'mail.from' => [
                'address' => $emailSetting->mail_from_address,
                'name'    => $emailSetting->mail_from_name,
            ],
        ]);

        return \Illuminate\Support\Facades\Mail::mailer($mailerName);
    }
}
