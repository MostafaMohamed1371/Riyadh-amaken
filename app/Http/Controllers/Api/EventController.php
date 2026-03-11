<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $perPage = min((int) $request->get('per_page', 15), 100);
        $events = Event::latest('date')->paginate($perPage);
        $events->getCollection()->transform(fn (Event $e) => $this->formatEvent($e));
        return response()->json($events);
    }

    public function show(Event $event): JsonResponse
    {
        return response()->json(['data' => $this->formatEvent($event)]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:5000',
            'date' => 'nullable|date',
            'time' => 'nullable|date_format:H:i',
            'location' => 'nullable|string|max:255',
        ], [
            'title.required' => 'The title field is required.',
            'date.date' => 'The date is not valid (use YYYY-MM-DD).',
            'time.date_format' => 'The time must be in HH:mm format.',
        ]);

        $event = Event::create($validated);
        return response()->json(['data' => $this->formatEvent($event)], 201);
    }

    public function update(Request $request, Event $event): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string|max:5000',
            'date' => 'nullable|date',
            'time' => 'nullable|date_format:H:i',
            'location' => 'nullable|string|max:255',
        ], [
            'title.required' => 'The title field is required.',
            'date.date' => 'The date is not valid (use YYYY-MM-DD).',
            'time.date_format' => 'The time must be in HH:mm format.',
        ]);

        $event->update($validated);
        return response()->json(['data' => $this->formatEvent($event)]);
    }

    public function destroy(Event $event): JsonResponse
    {
        $event->delete();
        return response()->json([
            'success' => true,
            'message' => 'Event deleted successfully.',
        ]);
    }

    private function formatEvent(Event $event): array
    {
        return [
            'id' => $event->id,
            'title' => $event->title,
            'description' => $event->description,
            'date' => $event->date?->format('Y-m-d'),
            'time' => $event->time ? \Carbon\Carbon::parse($event->time)->format('H:i') : null,
            'location' => $event->location,
            'created_at' => $event->created_at?->toIso8601String(),
            'updated_at' => $event->updated_at?->toIso8601String(),
        ];
    }
}
