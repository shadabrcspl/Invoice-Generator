<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsApproved
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();
            
            if (!$user->isApproved()) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                $message = 'Your registration is pending approval. You will receive an email once it is approved. If you have any queries, please directly reach to the admin, shadabcse2020@gmail.com.';
                if ($user->status === 'rejected') {
                    $message = 'Your registration request has been rejected by the admin. Please reach out to shadabcse2020@gmail.com for details.';
                }

                return redirect()->route('login')->withErrors([
                    'email' => $message,
                ]);
            }
        }

        return $next($request);
    }
}
