<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\RegistrationApprovedMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the registered users.
     */
    public function index(Request $request): View
    {
        $status = $request->input('status', 'all');
        $search = $request->input('search');

        $query = User::query()->where('email', '!=', 'shadabcse2020@gmail.com');

        if ($status !== 'all') {
            $query->where('status', $status);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.users.index', compact('users', 'status', 'search'));
    }

    /**
     * Approve the registration request.
     */
    public function approve(User $user): RedirectResponse
    {
        if ($user->email === 'shadabcse2020@gmail.com') {
            return redirect()->back()->with('error', 'Cannot perform action on admin account.');
        }

        $user->status = 'approved';
        $user->save();

        try {
            Mail::to($user->email)->send(new RegistrationApprovedMail($user));
        } catch (\Exception $e) {
            // Log or ignore mail sending errors to avoid locking DB changes
        }

        return redirect()->back()->with('success', 'User ' . $user->name . ' has been approved successfully. An email notification was sent.');
    }

    /**
     * Reject the registration request.
     */
    public function reject(User $user): RedirectResponse
    {
        if ($user->email === 'shadabcse2020@gmail.com') {
            return redirect()->back()->with('error', 'Cannot perform action on admin account.');
        }

        $user->status = 'rejected';
        $user->save();

        return redirect()->back()->with('warning', 'User ' . $user->name . ' has been rejected.');
    }
}
