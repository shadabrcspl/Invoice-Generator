<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateCompanySettingRequest;
use App\Models\CompanySetting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CompanySettingController extends Controller
{
    /**
     * Show the company settings form.
     */
    public function edit()
    {
        $userId = Auth::id();
        $setting = CompanySetting::firstOrCreate(
            ['user_id' => $userId],
            [
                'company_name' => Auth::user()->name . ' Ltd',
                'email' => Auth::user()->email
            ]
        );

        $currencies = \App\Models\Currency::where('user_id', $userId)->orderBy('code')->get();

        return view('settings.edit', compact('setting', 'currencies'));
    }

    /**
     * Update the company settings.
     */
    public function update(UpdateCompanySettingRequest $request)
    {
        $userId = Auth::id();
        $setting = CompanySetting::where('user_id', $userId)->firstOrFail();

        $data = $request->except(['logo', 'signature']);

        // Secure file upload handling for Logo
        if ($request->hasFile('logo')) {
            // Delete old logo
            if ($setting->logo) {
                Storage::disk('public')->delete($setting->logo);
            }
            // Store new logo with unique name under secure prefix
            $path = $request->file('logo')->store('company/logos', 'public');
            $data['logo'] = $path;
        }

        // Secure file upload handling for Signature
        if ($request->hasFile('signature')) {
            // Delete old signature
            if ($setting->signature) {
                Storage::disk('public')->delete($setting->signature);
            }
            // Store new signature
            $path = $request->file('signature')->store('company/signatures', 'public');
            $data['signature'] = $path;
        }

        $setting->update($data);

        return redirect()->route('settings.edit')->with('success', 'Company profile settings updated successfully!');
    }

    /**
     * Update the user's name (Account Profile).
     */
    public function updateProfile(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        Auth::user()->update([
            'name' => $request->name,
        ]);

        return redirect()->route('settings.edit')->with('success', 'Account profile name updated successfully!');
    }
}
