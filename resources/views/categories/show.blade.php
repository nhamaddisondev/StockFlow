<x-layout title="{{ $category->name }} | StockFlow">
    <section class="space-y-6">
        <div><a href="{{ route('categories.index') }}" class="text-sm font-semibold text-blue-600">← Categories</a><div class="mt-3 flex flex-col justify-between gap-4 sm:flex-row sm:items-start"><div><h1 class="text-3xl font-bold tracking-tight text-slate-900">{{ $category->name }}</h1><p class="mt-2 text-sm text-slate-600">{{ $category->description ?: 'No description provided.' }}</p></div><div class="flex gap-2"><a href="{{ route('categories.edit', $category) }}" class="rounded-lg border border-slate-200 px-4 py-2.5 text-sm font-semibold text-slate-700">Edit</a><form action="{{ route('categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Delete this category?')">@csrf @method('DELETE')<button class="rounded-lg border border-rose-200 px-4 py-2.5 text-sm font-semibold text-rose-700">Delete</button></form></div></div></div>
        @foreach (['success' => 'emerald', 'error' => 'rose'] as $key => $color)
            @if (session($key)) <div class="rounded-xl border border-{{ $color }}-200 bg-{{ $color }}-50 px-4 py-3 text-sm text-{{ $color }}-800">{{ session($key) }}</div> @endif
        @endforeach
        <div class="flex items-center justify-between"><h2 class="text-lg font-bold text-slate-900">Products in this category</h2><a href="{{ route('products.create') }}" class="text-sm font-semibold text-blue-600">Add product</a></div>
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white"><div class="overflow-x-auto"><table class="w-full min-w-[550px] text-left text-sm"><thead class="bg-slate-50 text-xs uppercase text-slate-500"><tr><th class="px-5 py-3">Product</th><th class="px-5 py-3">SKU</th><th class="px-5 py-3">Price</th><th class="px-5 py-3">Stock</th></tr></thead><tbody class="divide-y divide-slate-100">
            @forelse ($products as $product)
                <tr><td class="px-5 py-4"><a href="{{ route('products.show', $product) }}" class="font-semibold text-blue-700">{{ $product->name }}</a></td><td class="px-5 py-4">{{ $product->sku }}</td><td class="px-5 py-4">{{ number_format((float) $product->price, 2) }}</td><td class="px-5 py-4">{{ number_format($product->stock_quantity) }}</td></tr>
            @empty
                <tr><td colspan="4" class="px-5 py-10 text-center text-slate-500">No products in this category yet.</td></tr>
            @endforelse
        </tbody></table></div>@if ($products->hasPages())<div class="border-t border-slate-100 p-4">{{ $products->links() }}</div>@endif</div>
    </section>
</x-layout>
