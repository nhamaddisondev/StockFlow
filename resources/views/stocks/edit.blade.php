<x-layout title="Edit Stock Movement | StockFlow">
    <section class="mx-auto max-w-3xl space-y-6">
        <div>
            <a href="{{ route('stocks.show', $stock) }}" class="text-sm font-semibold text-blue-600 hover:text-blue-800">← Movement details</a>
            <h1 class="mt-3 text-3xl font-bold tracking-tight text-slate-900">Edit stock movement</h1>
            <p class="mt-2 text-sm text-slate-600">The current stock total will be adjusted to reflect your changes.</p>
        </div>

        @if ($errors->has('stock'))
            <div role="alert" class="rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">{{ $errors->first('stock') }}</div>
        @endif

        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-7">
            @include('stocks._form')
        </div>
    </section>
</x-layout>
