@extends('admin.layout')

@section('title', 'Sliders')

@section('header_action')
    <x-admin.btn href="{{ route('admin.sliders.create') }}" variant="primary">Add Slider</x-admin.btn>
@endsection

@section('content')
<div class="space-y-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <p class="text-slate-500">Manage homepage sliders.</p>
    </div>

    <x-admin.card>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50/80">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Title</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Image</th>
                        <th scope="col" class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 bg-white">
                    @forelse($sliders as $slider)
                    <tr class="transition hover:bg-slate-50/50">
                        <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-slate-900">{{ $slider->title }}</td>
                        <td class="px-6 py-4">
                            @if($slider->image)
                                <img src="{{ asset('storage/' . $slider->image) }}" alt="" class="h-12 w-20 rounded-lg object-cover shadow-sm">
                            @else
                                <span class="text-slate-400">—</span>
                            @endif
                        </td>
                        <td class="whitespace-nowrap px-6 py-4 text-right text-sm">
                            <a href="{{ route('admin.sliders.edit', $slider) }}" class="font-medium text-emerald-600 hover:text-emerald-700">Edit</a>
                            <span class="mx-2 text-slate-300">·</span>
                            <form action="{{ route('admin.sliders.destroy', $slider) }}" method="POST" class="inline" onsubmit="return confirm('Delete this slider?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="font-medium text-red-600 hover:text-red-700">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-12 text-center text-slate-500">No sliders yet. Add your first one above.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($sliders->hasPages())
            <div class="border-t border-slate-200 px-6 py-4">{{ $sliders->links() }}</div>
        @endif
    </x-admin.card>
</div>
@endsection
