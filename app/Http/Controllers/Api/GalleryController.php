<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $perPage = min((int) $request->get('per_page', 15), 100);
        $items = Gallery::latest()->paginate($perPage);
        $items->getCollection()->transform(fn (Gallery $g) => $this->formatGallery($g));
        return response()->json($items);
    }

    public function show(Gallery $gallery): JsonResponse
    {
        return response()->json(['data' => $this->formatGallery($gallery)]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'link' => 'nullable|string|url|max:500',
        ], [
            'image.image' => 'The file must be an image.',
            'image.max' => 'The image may not be greater than 2MB.',
            'link.url' => 'The link must be a valid URL.',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('gallery', 'public');
        }

        $gallery = Gallery::create($validated);
        return response()->json(['data' => $this->formatGallery($gallery)], 201);
    }

    public function update(Request $request, Gallery $gallery): JsonResponse
    {
        $validated = $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'link' => 'nullable|string|url|max:500',
        ], [
            'image.image' => 'The file must be an image.',
            'image.max' => 'The image may not be greater than 2MB.',
            'link.url' => 'The link must be a valid URL.',
        ]);

        if ($request->hasFile('image')) {
            if ($gallery->image) {
                Storage::disk('public')->delete($gallery->image);
            }
            $validated['image'] = $request->file('image')->store('gallery', 'public');
        }

        $gallery->update($validated);
        return response()->json(['data' => $this->formatGallery($gallery)]);
    }

    public function destroy(Gallery $gallery): JsonResponse
    {
        if ($gallery->image) {
            Storage::disk('public')->delete($gallery->image);
        }
        $gallery->delete();
        return response()->json([
            'success' => true,
            'message' => 'Gallery item deleted successfully.',
        ]);
    }

    private function formatGallery(Gallery $gallery): array
    {
        return [
            'id' => $gallery->id,
            'image' => $gallery->image ? asset('storage/' . $gallery->image) : null,
            'link' => $gallery->link,
            'created_at' => $gallery->created_at?->toIso8601String(),
            'updated_at' => $gallery->updated_at?->toIso8601String(),
        ];
    }
}
