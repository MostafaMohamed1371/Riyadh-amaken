<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(): View
    {
        $items = Gallery::latest()->paginate(15);
        return view('admin.gallery.index', compact('items'));
    }

    public function create(): View
    {
        return view('admin.gallery.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'image' => 'nullable|image|max:2048',
            'link' => 'nullable|string|max:500',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('gallery', 'public');
        }

        Gallery::create($validated);
        return redirect()->route('admin.gallery.index')->with('success', 'Gallery item created successfully.');
    }

    public function edit(Gallery $gallery): View
    {
        return view('admin.gallery.edit', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery): RedirectResponse
    {
        $validated = $request->validate([
            'image' => 'nullable|image|max:2048',
            'link' => 'nullable|string|max:500',
        ]);

        if ($request->hasFile('image')) {
            if ($gallery->image) {
                Storage::disk('public')->delete($gallery->image);
            }
            $validated['image'] = $request->file('image')->store('gallery', 'public');
        }

        $gallery->update($validated);
        return redirect()->route('admin.gallery.index')->with('success', 'Gallery item updated successfully.');
    }

    public function destroy(Gallery $gallery): RedirectResponse
    {
        if ($gallery->image) {
            Storage::disk('public')->delete($gallery->image);
        }
        $gallery->delete();
        return redirect()->route('admin.gallery.index')->with('success', 'Gallery item deleted successfully.');
    }
}
