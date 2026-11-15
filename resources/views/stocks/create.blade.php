<x-layout title="Record Stock Movement | StockFlow">
    <section class="mx-auto max-w-3xl space-y-6">
        <div>
            <a href="{{ route('stocks.index') }}" class="text-sm font-semibold text-blue-600 hover:text-blue-800">← Stock movements</a>
            <h1 class="mt-3 text-3xl font-bold tracking-tight text-slate-900">Record stock movement</h1>
            <p class="mt-2 text-sm text-slate-600">Record stock received or removed. The product quantity updates automatically.</p>
        </div>

        @if ($errors->has('stock'))
            <div role="alert" class="rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">{{ $errors->first('stock') }}</div>
        @endif

        @if ($products->isEmpty())
            <div class="rounded-2xl border border-amber-200 bg-amber-50 p-5 text-sm text-amber-900">
                You need to add a product before recording a stock movement.
                <a href="{{ route('products.create') }}" class="ml-1 font-semibold underline">Create a product</a>
            </div>
        @else
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-7">
                @include('stocks._form')
            </div>
        @endif
    </section>
</x-layout>
