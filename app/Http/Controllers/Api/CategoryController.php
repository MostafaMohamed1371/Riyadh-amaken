<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $perPage = min((int) $request->get('per_page', 15), 100);
        $categories = Category::latest()->paginate($perPage);
        $categories->getCollection()->transform(fn (Category $c) => $this->formatCategory($c));
        return response()->json($categories);
    }

    public function show(Category $category): JsonResponse
    {
        return response()->json(['data' => $this->formatCategory($category)]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:5000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'no_places' => 'nullable|integer|min:0',
            'type' => 'nullable|string|max:255',
        ], [
            'title.required' => 'The title field is required.',
            'no_places.integer' => 'The number of places must be an integer.',
            'image.max' => 'The image may not be greater than 2MB.',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('categories', 'public');
        }

        $category = Category::create($validated);
        return response()->json(['data' => $this->formatCategory($category)], 201);
    }

    public function update(Request $request, Category $category): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string|max:5000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'no_places' => 'nullable|integer|min:0',
            'type' => 'nullable|string|max:255',
        ], [
            'title.required' => 'The title field is required.',
            'image.max' => 'The image may not be greater than 2MB.',
        ]);

        if ($request->hasFile('image')) {
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            $validated['image'] = $request->file('image')->store('categories', 'public');
        }

        $category->update($validated);
        return response()->json(['data' => $this->formatCategory($category)]);
    }

    public function destroy(Category $category): JsonResponse
    {
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }
        $category->delete();
        return response()->json([
            'success' => true,
            'message' => 'Category deleted successfully.',
        ]);
    }

    private function formatCategory(Category $category): array
    {
        return [
            'id' => $category->id,
            'title' => $category->title,
            'description' => $category->description,
            'image' => $category->image ? asset('storage/' . $category->image) : null,
            'no_places' => $category->no_places,
            'type' => $category->type,
            'created_at' => $category->created_at?->toIso8601String(),
            'updated_at' => $category->updated_at?->toIso8601String(),
        ];
    }
}
