<x-layout title="Edit Product | StockFlow">
    <section class="mx-auto max-w-3xl space-y-6">
        <div><a href="{{ route('products.show', $product) }}" class="text-sm font-semibold text-blue-600">← Product details</a><h1 class="mt-3 text-3xl font-bold tracking-tight text-slate-900">Edit product</h1></div>
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-7">@include('products._form')</div>
    </section>
</x-layout>
