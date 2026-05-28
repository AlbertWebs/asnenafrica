<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PaymentSettingController extends Controller
{
    public function edit(): View
    {
        $settings = PaymentSetting::query()->orderBy('sort_order')->get()->groupBy('group');

        return view('admin.payment-settings.edit', compact('settings'));
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'settings' => ['required', 'array'],
            'settings.*' => ['required', 'string', 'max:500'],
        ]);

        foreach ($validated['settings'] as $key => $value) {
            PaymentSetting::query()->where('key', $key)->update(['value' => $value]);
        }

        PaymentSetting::clearCache();

        return redirect()
            ->route('admin.payment-settings.edit')
            ->with('success', 'Payment settings saved. The public registration form will use these values.');
    }
}
