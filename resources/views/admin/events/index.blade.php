@extends('admin.layout')

@section('title', 'Events')

@section('header_action')
    <x-admin.btn href="{{ route('admin.events.create') }}" variant="primary">Add Event</x-admin.btn>
@endsection

@section('content')
<div class="space-y-6">
    <p class="text-slate-500">Manage events and dates.</p>

    <x-admin.card>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50/80">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Title</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Date</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Time</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Location</th>
                        <th scope="col" class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 bg-white">
                    @forelse($events as $event)
                    <tr class="transition hover:bg-slate-50/50">
                        <td class="px-6 py-4 text-sm font-medium text-slate-900">{{ $event->title }}</td>
                        <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-600">{{ $event->date?->format('M j, Y') ?? '—' }}</td>
                        <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-600">{{ $event->time ? \Carbon\Carbon::parse($event->time)->format('g:i A') : '—' }}</td>
                        <td class="max-w-[12rem] truncate px-6 py-4 text-sm text-slate-600">{{ $event->location ?: '—' }}</td>
                        <td class="whitespace-nowrap px-6 py-4 text-right text-sm">
                            <a href="{{ route('admin.events.edit', $event) }}" class="font-medium text-emerald-600 hover:text-emerald-700">Edit</a>
                            <span class="mx-2 text-slate-300">·</span>
                            <form action="{{ route('admin.events.destroy', $event) }}" method="POST" class="inline" onsubmit="return confirm('Delete this event?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="font-medium text-red-600 hover:text-red-700">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-slate-500">No events yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($events->hasPages())
            <div class="border-t border-slate-200 px-6 py-4">{{ $events->links() }}</div>
        @endif
    </x-admin.card>
</div>
@endsection
