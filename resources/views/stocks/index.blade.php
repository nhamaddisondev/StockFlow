<x-layout title="Stock Movements | StockFlow">
    <section class="space-y-6">
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
            <div>
                <p class="text-sm font-medium text-blue-600">Inventory</p>
                <h1 class="mt-1 text-3xl font-bold tracking-tight text-slate-900">Stock movements</h1>
                <p class="mt-2 text-sm text-slate-600">Review stock added to or removed from your products.</p>
            </div>
        </div>

        @if (session('success'))
            <div class="rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full min-w-[680px] text-left text-sm">
                    <thead class="bg-slate-50 text-xs uppercase tracking-wider text-slate-500">
                        <tr>
                            <th class="px-5 py-3">Product</th>
                            <th class="px-5 py-3">Movement</th>
                            <th class="px-5 py-3">Quantity</th>
                            <th class="px-5 py-3">Recorded by</th>
                            <th class="px-5 py-3">Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($stocks as $stock)
                            <tr class="hover:bg-slate-50">
                                <td class="px-5 py-4">
                                    <p class="font-semibold text-slate-900">{{ $stock->product?->name ?? 'Deleted product' }}</p>
                                    <p class="mt-1 text-xs text-slate-500">{{ $stock->product?->sku ?? '—' }}</p>
                                </td>
                                <td class="px-5 py-4">
                                    @if ($stock->movement_type === 'in')
                                        <span class="rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700">Stock in</span>
                                    @else
                                        <span class="rounded-full bg-rose-50 px-2.5 py-1 text-xs font-semibold text-rose-700">Stock out</span>
                                    @endif
                                </td>
                                <td class="px-5 py-4 font-semibold text-slate-700">{{ number_format($stock->quantity) }}</td>
                                <td class="px-5 py-4 text-slate-600">{{ $stock->user?->name ?? '—' }}</td>
                                <td class="px-5 py-4 text-slate-600">{{ $stock->created_at?->format('d M Y, H:i') ?? '—' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-5 py-12 text-center">
                                    <p class="font-semibold text-slate-700">No stock movements yet</p>
                                    <p class="mt-1 text-sm text-slate-500">Recorded stock in and stock out activity will appear here.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($stocks->hasPages())
                <div class="border-t border-slate-100 px-5 py-4">{{ $stocks->links() }}</div>
            @endif
        </div>
    </section>
</x-layout>
