<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\WelcomeUserMail;
use App\Models\User;
use App\Services\UserMailer;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => $request->email === 'shadabcse2020@gmail.com' ? 'approved' : 'pending',
        ]);

        event(new Registered($user));

        // Fire pending email to user with CC to shadabcse2020@gmail.com
        try {
            Mail::to($user->email)
                ->cc('shadabcse2020@gmail.com')
                ->send(new \App\Mail\RegistrationPendingMail($user));
        } catch (\Exception $e) {
            // Fail silently
        }

        // Send alert email to system administrator if different
        try {
            $adminEmail = config('app.admin_email');
            if ($adminEmail && $adminEmail !== 'shadabcse2020@gmail.com') {
                Mail::to($adminEmail)->send(new \App\Mail\UserCreatedAdminMail($user));
            }
        } catch (\Exception $e) {
            // Fail silently
        }

        // Store registration details in session for the pending screen
        $request->session()->put('pending_user_name', $user->name);
        $request->session()->put('pending_user_email', $user->email);
        $request->session()->put('pending_user_date', $user->created_at->format('M d, Y h:i A'));

        return redirect()->route('auth.pending');
    }

    /**
     * Display the pending approval view.
     */
    public function pendingView(Request $request): View|RedirectResponse
    {
        if (!$request->session()->has('pending_user_email')) {
            return redirect()->route('login');
        }

        return view('auth.pending-approval', [
            'name' => $request->session()->get('pending_user_name'),
            'email' => $request->session()->get('pending_user_email'),
            'date' => $request->session()->get('pending_user_date'),
        ]);
    }
}
