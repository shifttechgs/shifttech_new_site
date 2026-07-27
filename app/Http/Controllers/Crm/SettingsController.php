<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use App\Models\BusinessSetup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function index()
    {
        $setup = BusinessSetup::first() ?? new BusinessSetup();
        return view('crm.settings.index', compact('setup'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'business_name'         => 'required|string|max:255',
            'trading_name'          => 'nullable|string|max:255',
            'registration_number'   => 'nullable|string|max:100',
            'vat_number'            => 'nullable|string|max:100',
            'email'                 => 'required|email',
            'phone'                 => 'nullable|string|max:30',
            'website'               => 'nullable|string|max:255',
            'street'                => 'nullable|string|max:255',
            'city'                  => 'nullable|string|max:100',
            'province'              => 'nullable|string|max:100',
            'postal_code'           => 'nullable|string|max:20',
            'country'               => 'nullable|string|max:100',
            'bank_name'             => 'nullable|string|max:100',
            'account_name'          => 'nullable|string|max:255',
            'account_number'        => 'nullable|string|max:50',
            'branch_code'           => 'nullable|string|max:20',
            'account_type'          => 'nullable|string|max:50',
            'payment_instructions'  => 'nullable|string',
            'logo'                  => 'nullable|image|max:2048',
        ]);

        $setup = BusinessSetup::firstOrNew([]);

        if ($request->hasFile('logo')) {
            if ($setup->logo) {
                Storage::disk('public')->delete($setup->logo);
            }
            $data['logo'] = $request->file('logo')->store('business', 'public');
        }

        $setup->fill($data)->save();

        return back()->with('success', 'Business settings saved.');
    }
}

