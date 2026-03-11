<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EventController extends Controller
{
    public function index(): View
    {
        $events = Event::latest('date')->paginate(15);
        return view('admin.events.index', compact('events'));
    }

    public function create(): View
    {
        return view('admin.events.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'nullable|date',
            'time' => 'nullable|date_format:H:i',
            'location' => 'nullable|string|max:255',
        ]);

        Event::create($validated);
        return redirect()->route('admin.events.index')->with('success', 'Event created successfully.');
    }

    public function edit(Event $event): View
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'nullable|date',
            'time' => 'nullable|date_format:H:i',
            'location' => 'nullable|string|max:255',
        ]);

        $event->update($validated);
        return redirect()->route('admin.events.index')->with('success', 'Event updated successfully.');
    }

    public function destroy(Event $event): RedirectResponse
    {
        $event->delete();
        return redirect()->route('admin.events.index')->with('success', 'Event deleted successfully.');
    }
}
