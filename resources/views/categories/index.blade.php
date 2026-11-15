<x-layout title="Categories | StockFlow">
    <section class="space-y-6">
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-end"><div><p class="text-sm font-medium text-blue-600">Inventory</p><h1 class="mt-1 text-3xl font-bold tracking-tight text-slate-900">Categories</h1><p class="mt-2 text-sm text-slate-600">Group products so they are easier to organize.</p></div><a href="{{ route('categories.create') }}" class="rounded-lg bg-blue-600 px-4 py-2.5 text-center text-sm font-semibold text-white hover:bg-blue-700">Create category</a></div>
        @foreach (['success' => 'emerald', 'error' => 'rose'] as $key => $color)
            @if (session($key)) <div class="rounded-xl border border-{{ $color }}-200 bg-{{ $color }}-50 px-4 py-3 text-sm text-{{ $color }}-800">{{ session($key) }}</div> @endif
        @endforeach
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm"><div class="overflow-x-auto"><table class="w-full min-w-[560px] text-left text-sm"><thead class="bg-slate-50 text-xs uppercase tracking-wider text-slate-500"><tr><th class="px-5 py-3">Category</th><th class="px-5 py-3">Products</th><th class="px-5 py-3">Description</th><th></th></tr></thead><tbody class="divide-y divide-slate-100">
            @forelse ($categories as $category)
                <tr class="hover:bg-slate-50"><td class="px-5 py-4"><a href="{{ route('categories.show', $category) }}" class="font-semibold text-slate-900 hover:text-blue-700">{{ $category->name }}</a></td><td class="px-5 py-4 text-slate-600">{{ $category->products_count }}</td><td class="px-5 py-4 text-slate-600">{{ $category->description ?: '—' }}</td><td class="px-5 py-4 text-right"><a href="{{ route('categories.show', $category) }}" class="font-semibold text-blue-600">View</a></td></tr>
            @empty
                <tr><td colspan="4" class="px-5 py-12 text-center"><p class="font-semibold text-slate-700">No categories yet</p><p class="mt-1 text-sm text-slate-500">Create one before adding products.</p></td></tr>
            @endforelse
        </tbody></table></div>@if ($categories->hasPages())<div class="border-t border-slate-100 p-4">{{ $categories->links() }}</div>@endif</div>
    </section>
</x-layout>
