<x-layout title="Products | StockFlow">
    <section class="space-y-6">
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
            <div><p class="text-sm font-medium text-blue-600">Inventory</p><h1 class="mt-1 text-3xl font-bold tracking-tight text-slate-900">Products</h1><p class="mt-2 text-sm text-slate-600">Manage your product catalogue and stock levels.</p></div>
            <a href="{{ route('products.create') }}" class="rounded-lg bg-blue-600 px-4 py-2.5 text-center text-sm font-semibold text-white hover:bg-blue-700">Add product</a>
        </div>

        @foreach (['success' => 'emerald', 'error' => 'rose'] as $key => $color)
            @if (session($key)) <div class="rounded-xl border border-{{ $color }}-200 bg-{{ $color }}-50 px-4 py-3 text-sm text-{{ $color }}-800">{{ session($key) }}</div> @endif
        @endforeach

        <div class="overflow-x-auto rounded-2xl border border-slate-200 bg-white shadow-sm">
            <table class="w-full min-w-[700px] text-left text-sm">
                <thead class="bg-slate-50 text-xs uppercase tracking-wider text-slate-500"><tr><th class="px-5 py-3">Product</th><th class="px-5 py-3">Category</th><th class="px-5 py-3">Price</th><th class="px-5 py-3">In stock</th><th class="px-5 py-3">Status</th><th class="px-5 py-3"></th></tr></thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($products as $product)
                        <tr class="hover:bg-slate-50">
                            <td class="px-5 py-4"><a href="{{ route('products.show', $product) }}" class="font-semibold text-slate-900 hover:text-blue-700">{{ $product->name }}</a><p class="mt-1 text-xs text-slate-500">{{ $product->sku }}</p></td>
                            <td class="px-5 py-4 text-slate-600">{{ $product->category?->name ?? '—' }}</td>
                            <td class="px-5 py-4 text-slate-600">{{ number_format((float) $product->price, 2) }}</td>
                            <td class="px-5 py-4 font-semibold text-slate-700">{{ number_format($product->stock_quantity) }}</td>
                            <td class="px-5 py-4">@if ($product->stock_quantity <= $product->min_stock)<span class="rounded-full bg-amber-50 px-2.5 py-1 text-xs font-semibold text-amber-700">Low stock</span>@else<span class="rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700">In stock</span>@endif</td>
                            <td class="px-5 py-4 text-right"><a href="{{ route('products.show', $product) }}" class="font-semibold text-blue-600">View</a></td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="px-5 py-12 text-center"><p class="font-semibold text-slate-700">No products yet</p><p class="mt-1 text-sm text-slate-500">Add a product to start tracking inventory.</p></td></tr>
                    @endforelse
                </tbody>
            </table>
            @if ($products->hasPages()) <div class="border-t border-slate-100 p-4">{{ $products->links() }}</div> @endif
        </div>
    </section>
</x-layout>
