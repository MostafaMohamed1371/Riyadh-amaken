<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $perPage = min((int) $request->get('per_page', 15), 100);
        $activities = Activity::with('category')->latest()->paginate($perPage);
        $activities->getCollection()->transform(fn (Activity $a) => $this->formatActivity($a));
        return response()->json($activities);
    }

    public function show(Activity $activity): JsonResponse
    {
        $activity->load('category');
        return response()->json(['data' => $this->formatActivity($activity)]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:5000',
            'tags' => 'nullable|string|max:500',
            'location' => 'nullable|string|max:255',
            'working_hours' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
            'rate' => 'nullable|numeric|min:0|max:5',
            'category_id' => 'nullable|exists:categories,id',
        ], [
            'title.required' => 'The title field is required.',
            'category_id.exists' => 'The selected category does not exist.',
            'rate.numeric' => 'The rate must be a number.',
        ]);

        $activity = Activity::create($validated);
        $activity->load('category');
        return response()->json(['data' => $this->formatActivity($activity)], 201);
    }

    public function update(Request $request, Activity $activity): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string|max:5000',
            'tags' => 'nullable|string|max:500',
            'location' => 'nullable|string|max:255',
            'working_hours' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
            'rate' => 'nullable|numeric|min:0|max:5',
            'category_id' => 'nullable|exists:categories,id',
        ], [
            'title.required' => 'The title field is required.',
            'category_id.exists' => 'The selected category does not exist.',
        ]);

        $activity->update($validated);
        $activity->load('category');
        return response()->json(['data' => $this->formatActivity($activity)]);
    }

    public function destroy(Activity $activity): JsonResponse
    {
        $activity->delete();
        return response()->json([
            'success' => true,
            'message' => 'Activity deleted successfully.',
        ]);
    }

    private function formatActivity(Activity $activity): array
    {
        return [
            'id' => $activity->id,
            'title' => $activity->title,
            'description' => $activity->description,
            'tags' => $activity->tags,
            'location' => $activity->location,
            'working_hours' => $activity->working_hours,
            'phone' => $activity->phone,
            'rate' => $activity->rate !== null ? (float) $activity->rate : null,
            'category_id' => $activity->category_id,
            'category' => $activity->relationLoaded('category') && $activity->category
                ? [
                    'id' => $activity->category->id,
                    'title' => $activity->category->title,
                ]
                : null,
            'created_at' => $activity->created_at?->toIso8601String(),
            'updated_at' => $activity->updated_at?->toIso8601String(),
        ];
    }
}
