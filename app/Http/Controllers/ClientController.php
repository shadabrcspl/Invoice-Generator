<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Mail\ClientCreatedAdminMail;
use App\Models\Client;
use App\Services\UserMailer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Client::where('user_id', Auth::id());

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $clients = $query->orderBy('name')->paginate(10);

        return view('clients.index', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClientRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();

        $client = Client::create($validated);

        // Notify admin of new client creation (using user's custom SMTP if configured)
        try {
            UserMailer::for(Auth::user())
                ->to(Auth::user()->email)
                ->send(new ClientCreatedAdminMail($client, Auth::user()));
        } catch (\Exception $e) {
            // Fail silently
        }

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Client created successfully!',
                'client' => $client
            ]);
        }

        return redirect()->route('clients.index')->with('success', 'Client created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        $this->authorize('view', $client);
        return view('clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreClientRequest $request, Client $client)
    {
        $this->authorize('update', $client);
        $client->update($request->validated());

        return redirect()->route('clients.index')->with('success', 'Client updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $this->authorize('delete', $client);
        $client->delete();

        return redirect()->route('clients.index')->with('success', 'Client deleted successfully!');
    }
}
