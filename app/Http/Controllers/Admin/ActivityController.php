<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ActivityController extends Controller
{
    public function index(): View
    {
        $activities = Activity::with('category')->latest()->paginate(15);
        return view('admin.activities.index', compact('activities'));
    }

    public function create(): View
    {
        $categories = Category::orderBy('title')->get();
        return view('admin.activities.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'tags' => 'nullable|string|max:500',
            'location' => 'nullable|string|max:255',
            'working_hours' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
            'rate' => 'nullable|numeric|min:0',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        Activity::create($validated);
        return redirect()->route('admin.activities.index')->with('success', 'Activity created successfully.');
    }

    public function edit(Activity $activity): View
    {
        $categories = Category::orderBy('title')->get();
        return view('admin.activities.edit', compact('activity', 'categories'));
    }

    public function update(Request $request, Activity $activity): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'tags' => 'nullable|string|max:500',
            'location' => 'nullable|string|max:255',
            'working_hours' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
            'rate' => 'nullable|numeric|min:0',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $activity->update($validated);
        return redirect()->route('admin.activities.index')->with('success', 'Activity updated successfully.');
    }

    public function destroy(Activity $activity): RedirectResponse
    {
        $activity->delete();
        return redirect()->route('admin.activities.index')->with('success', 'Activity deleted successfully.');
    }
}
