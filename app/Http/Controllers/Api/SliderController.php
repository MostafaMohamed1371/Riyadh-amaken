<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $perPage = min((int) $request->get('per_page', 15), 100);
        $sliders = Slider::latest()->paginate($perPage);
        $sliders->getCollection()->transform(fn (Slider $s) => $this->formatSlider($s));
        return response()->json($sliders);
    }

    public function show(Slider $slider): JsonResponse
    {
        return response()->json(['data' => $this->formatSlider($slider)]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:5000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ], [
            'title.required' => 'The title field is required.',
            'image.image' => 'The file must be an image.',
            'image.max' => 'The image may not be greater than 2MB.',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('sliders', 'public');
        }

        $slider = Slider::create($validated);
        return response()->json(['data' => $this->formatSlider($slider)], 201);
    }

    public function update(Request $request, Slider $slider): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string|max:5000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ], [
            'title.required' => 'The title field is required.',
            'image.image' => 'The file must be an image.',
            'image.max' => 'The image may not be greater than 2MB.',
        ]);

        if ($request->hasFile('image')) {
            if ($slider->image) {
                Storage::disk('public')->delete($slider->image);
            }
            $validated['image'] = $request->file('image')->store('sliders', 'public');
        }

        $slider->update($validated);
        return response()->json(['data' => $this->formatSlider($slider)]);
    }

    public function destroy(Slider $slider): JsonResponse
    {
        if ($slider->image) {
            Storage::disk('public')->delete($slider->image);
        }
        $slider->delete();
        return response()->json([
            'success' => true,
            'message' => 'Slider deleted successfully.',
        ]);
    }

    private function formatSlider(Slider $slider): array
    {
        return [
            'id' => $slider->id,
            'title' => $slider->title,
            'description' => $slider->description,
            'image' => $slider->image ? asset('storage/' . $slider->image) : null,
            'created_at' => $slider->created_at?->toIso8601String(),
            'updated_at' => $slider->updated_at?->toIso8601String(),
        ];
    }
}
