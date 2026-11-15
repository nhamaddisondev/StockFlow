<x-layout title="Stock Movement Details | StockFlow">
    <section class="mx-auto max-w-3xl space-y-6">
        <div>
            <a href="{{ route('stocks.index') }}" class="text-sm font-semibold text-blue-600 hover:text-blue-800">← Stock movements</a>
            <div class="mt-3 flex flex-col justify-between gap-4 sm:flex-row sm:items-start">
                <div>
                    <h1 class="text-3xl font-bold tracking-tight text-slate-900">Movement details</h1>
                    <p class="mt-2 text-sm text-slate-600">Recorded {{ $stock->created_at?->format('d M Y, H:i') ?? '—' }}</p>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('stocks.edit', $stock) }}" class="rounded-lg border border-slate-200 px-4 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-50">Edit</a>
                    <form action="{{ route('stocks.destroy', $stock) }}" method="POST" onsubmit="return confirm('Delete this movement and reverse its stock change?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="rounded-lg border border-rose-200 px-4 py-2.5 text-sm font-semibold text-rose-700 hover:bg-rose-50">Delete</button>
                    </form>
                </div>
            </div>
        </div>

        @if ($errors->has('stock'))
            <div role="alert" class="rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">{{ $errors->first('stock') }}</div>
        @endif

        <dl class="grid gap-px overflow-hidden rounded-2xl border border-slate-200 bg-slate-200 sm:grid-cols-2">
            <div class="bg-white p-5"><dt class="text-sm text-slate-500">Product</dt><dd class="mt-1 font-semibold text-slate-900">{{ $stock->product?->name ?? 'Deleted product' }}</dd></div>
            <div class="bg-white p-5"><dt class="text-sm text-slate-500">SKU</dt><dd class="mt-1 font-semibold text-slate-900">{{ $stock->product?->sku ?? '—' }}</dd></div>
            <div class="bg-white p-5"><dt class="text-sm text-slate-500">Movement type</dt><dd class="mt-1 font-semibold {{ $stock->movement_type === 'in' ? 'text-emerald-700' : 'text-rose-700' }}">{{ $stock->movement_type === 'in' ? 'Stock in' : 'Stock out' }}</dd></div>
            <div class="bg-white p-5"><dt class="text-sm text-slate-500">Quantity</dt><dd class="mt-1 font-semibold text-slate-900">{{ number_format($stock->quantity) }}</dd></div>
            <div class="bg-white p-5"><dt class="text-sm text-slate-500">Recorded by</dt><dd class="mt-1 font-semibold text-slate-900">{{ $stock->user?->name ?? '—' }}</dd></div>
            <div class="bg-white p-5"><dt class="text-sm text-slate-500">Note</dt><dd class="mt-1 whitespace-pre-wrap text-slate-900">{{ $stock->note ?: 'No note' }}</dd></div>
        </dl>
    </section>
</x-layout>
