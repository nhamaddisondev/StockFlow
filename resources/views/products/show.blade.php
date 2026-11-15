<x-layout title="{{ $product->name }} | StockFlow">
    <section class="space-y-6">
        <div><a href="{{ route('products.index') }}" class="text-sm font-semibold text-blue-600">← Products</a>
            <div class="mt-3 flex flex-col justify-between gap-4 sm:flex-row sm:items-start"><div><p class="text-sm font-medium text-blue-600">{{ $product->category?->name ?? 'Uncategorized' }}</p><h1 class="mt-1 text-3xl font-bold tracking-tight text-slate-900">{{ $product->name }}</h1><p class="mt-2 text-sm text-slate-500">SKU: {{ $product->sku }}</p></div>
                <div class="flex flex-wrap gap-2"><a href="{{ route('stocks.create', ['product_id' => $product->id]) }}" class="rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-blue-700">Record stock</a><a href="{{ route('products.edit', $product) }}" class="rounded-lg border border-slate-200 px-4 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-50">Edit</a>
                    <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Delete this product?')">@csrf @method('DELETE')<button class="rounded-lg border border-rose-200 px-4 py-2.5 text-sm font-semibold text-rose-700 hover:bg-rose-50">Delete</button></form>
                </div>
            </div>
        </div>
        @foreach (['success' => 'emerald', 'error' => 'rose'] as $key => $color)
            @if (session($key)) <div class="rounded-xl border border-{{ $color }}-200 bg-{{ $color }}-50 px-4 py-3 text-sm text-{{ $color }}-800">{{ session($key) }}</div> @endif
        @endforeach
        <div class="grid gap-4 sm:grid-cols-3">
            <article class="rounded-2xl border border-slate-200 bg-white p-5"><p class="text-sm text-slate-500">Price</p><p class="mt-2 text-2xl font-bold text-slate-900">{{ number_format((float) $product->price, 2) }}</p></article>
            <article class="rounded-2xl border border-slate-200 bg-white p-5"><p class="text-sm text-slate-500">Available units</p><p class="mt-2 text-2xl font-bold text-slate-900">{{ number_format($product->stock_quantity) }}</p></article>
            <article class="rounded-2xl border border-slate-200 bg-white p-5"><p class="text-sm text-slate-500">Low stock alert at</p><p class="mt-2 text-2xl font-bold text-slate-900">{{ number_format($product->min_stock) }}</p></article>
        </div>
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white">
            <div class="border-b border-slate-100 px-5 py-4"><h2 class="font-bold text-slate-900">Stock history</h2></div>
            <div class="overflow-x-auto"><table class="w-full min-w-[600px] text-left text-sm"><thead class="bg-slate-50 text-xs uppercase text-slate-500"><tr><th class="px-5 py-3">Type</th><th class="px-5 py-3">Quantity</th><th class="px-5 py-3">Note</th><th class="px-5 py-3">Date</th></tr></thead><tbody class="divide-y divide-slate-100">
                @forelse ($stockMovements as $movement)
                    <tr><td class="px-5 py-4">{{ $movement->movement_type === 'in' ? 'Stock in' : 'Stock out' }}</td><td class="px-5 py-4 font-semibold">{{ number_format($movement->quantity) }}</td><td class="px-5 py-4 text-slate-600">{{ $movement->note ?: '—' }}</td><td class="px-5 py-4 text-slate-600">{{ $movement->created_at?->format('d M Y, H:i') ?? '—' }}</td></tr>
                @empty
                    <tr><td colspan="4" class="px-5 py-10 text-center text-slate-500">No stock movements recorded for this product.</td></tr>
                @endforelse
            </tbody></table></div>
            @if ($stockMovements->hasPages()) <div class="border-t border-slate-100 p-4">{{ $stockMovements->links() }}</div> @endif
        </div>
    </section>
</x-layout>
