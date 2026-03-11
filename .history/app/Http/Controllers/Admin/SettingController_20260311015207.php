<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingController extends Controller
{
    public function index(): View
    {
        $settings = Setting::orderBy('key')->get()->keyBy('key');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'settings' => 'required|array',
            'settings.*.key' => 'required|string|max:255',
            'settings.*.value' => 'nullable|string',
        ]);

        foreach ($validated['settings'] as $item) {
            Setting::updateOrCreate(
                ['key' => $item['key']],
                ['value' => $item['value'] ?? '']
            );
        }

        return redirect()->route('admin.settings.index')->with('success', 'Settings updated successfully.');
    }
}
