@extends('admin.layout')

@section('title', 'Categories')

@section('header_action')
    <x-admin.btn href="{{ route('admin.categories.create') }}" variant="primary">Add Category</x-admin.btn>
@endsection

@section('content')
<div class="space-y-6">
    <p class="text-slate-500">Manage categories (e.g. place types).</p>

    <x-admin.card>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50/80">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Title</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Type</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Places</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Image</th>
                        <th scope="col" class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 bg-white">
                    @forelse($categories as $category)
                    <tr class="transition hover:bg-slate-50/50">
                        <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-slate-900">{{ $category->title }}</td>
                        <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-600">{{ $category->type ?? '—' }}</td>
                        <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-600">{{ $category->no_places }}</td>
                        <td class="px-6 py-4">
                            @if($category->image)
                                <img src="{{ asset('storage/' . $category->image) }}" alt="" class="h-12 w-20 rounded-lg object-cover shadow-sm">
                            @else
                                <span class="text-slate-400">—</span>
                            @endif
                        </td>
                        <td class="whitespace-nowrap px-6 py-4 text-right text-sm">
                            <a href="{{ route('admin.categories.edit', $category) }}" class="font-medium text-emerald-600 hover:text-emerald-700">Edit</a>
                            <span class="mx-2 text-slate-300">·</span>
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline" onsubmit="return confirm('Delete this category?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="font-medium text-red-600 hover:text-red-700">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-slate-500">No categories yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($categories->hasPages())
            <div class="border-t border-slate-200 px-6 py-4">{{ $categories->links() }}</div>
        @endif
    </x-admin.card>
</div>
@endsection
