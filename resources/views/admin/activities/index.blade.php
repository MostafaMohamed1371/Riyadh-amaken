@extends('admin.layout')

@section('title', 'Activities')

@section('header_action')
    <x-admin.btn href="{{ route('admin.activities.create') }}" variant="primary">Add Activity</x-admin.btn>
@endsection

@section('content')
<div class="space-y-6">
    <p class="text-slate-500">Manage activities and places.</p>

    <x-admin.card>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50/80">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Title</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Category</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Location</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Rate</th>
                        <th scope="col" class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 bg-white">
                    @forelse($activities as $activity)
                    <tr class="transition hover:bg-slate-50/50">
                        <td class="px-6 py-4 text-sm font-medium text-slate-900">{{ $activity->title }}</td>
                        <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-600">{{ $activity->category?->title ?? '—' }}</td>
                        <td class="max-w-[12rem] truncate px-6 py-4 text-sm text-slate-600">{{ $activity->location ?: '—' }}</td>
                        <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-600">{{ $activity->rate ?? '—' }}</td>
                        <td class="whitespace-nowrap px-6 py-4 text-right text-sm">
                            <a href="{{ route('admin.activities.edit', $activity) }}" class="font-medium text-emerald-600 hover:text-emerald-700">Edit</a>
                            <span class="mx-2 text-slate-300">·</span>
                            <form action="{{ route('admin.activities.destroy', $activity) }}" method="POST" class="inline" onsubmit="return confirm('Delete this activity?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="font-medium text-red-600 hover:text-red-700">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-slate-500">No activities yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($activities->hasPages())
            <div class="border-t border-slate-200 px-6 py-4">{{ $activities->links() }}</div>
        @endif
    </x-admin.card>
</div>
@endsection
