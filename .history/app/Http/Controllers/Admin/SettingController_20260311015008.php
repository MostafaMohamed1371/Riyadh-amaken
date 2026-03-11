<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingController extends Controller
{
    /** Known setting keys and their display labels */
    protected array $settingKeys = [
        'site_name' => 'Site Name',
        'contact_email' => 'Contact Email',
    ];

    public function index(): View
    {
        $values = Setting::whereIn('key', array_keys($this->settingKeys))->pluck('value', 'key');
        return view('admin.settings.index', [
            'settingKeys' => $this->settingKeys,
            'values' => $values,
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'settings' => 'required|array',
            'settings.*.key' => 'required|string|max:255|in:'.implode(',', array_keys($this->settingKeys)),
            'settings.*.value' => 'nullable|string|max:500',
        ]);

        $contactEmailItem = collect($validated['settings'])->firstWhere('key', 'contact_email');
        $contactEmail = $contactEmailItem['value'] ?? '';
        if ($contactEmail !== '' && ! filter_var($contactEmail, FILTER_VALIDATE_EMAIL)) {
            return back()->withErrors(['contact_email' => 'Contact Email must be a valid email address.'])->withInput();
        }

        foreach ($validated['settings'] as $item) {
            Setting::updateOrCreate(
                ['key' => $item['key']],
                ['value' => $item['value'] ?? '']
            );
        }

        return redirect()->route('admin.settings.index')->with('success', 'Settings updated successfully.');
    }
}
