<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index(): JsonResponse
    {
        $settings = Setting::orderBy('key')->get()->mapWithKeys(fn (Setting $s) => [$s->key => $s->value]);
        return response()->json(['data' => $settings]);
    }

    public function update(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'settings' => 'required|array',
            'settings.*.key' => 'required|string|max:255',
            'settings.*.value' => 'nullable|string|max:5000',
        ], [
            'settings.required' => 'The settings array is required.',
            'settings.*.key.required' => 'Each setting must have a key.',
        ]);

        foreach ($validated['settings'] as $item) {
            Setting::updateOrCreate(
                ['key' => $item['key']],
                ['value' => $item['value'] ?? '']
            );
        }

        $settings = Setting::orderBy('key')->get()->mapWithKeys(fn (Setting $s) => [$s->key => $s->value]);
        return response()->json(['data' => $settings]);
    }
}
