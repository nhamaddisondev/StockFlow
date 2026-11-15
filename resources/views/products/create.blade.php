<x-layout title="Add Product | StockFlow">
    <section class="mx-auto max-w-3xl space-y-6">
        <div><a href="{{ route('products.index') }}" class="text-sm font-semibold text-blue-600">← Products</a><h1 class="mt-3 text-3xl font-bold tracking-tight text-slate-900">Add product</h1><p class="mt-2 text-sm text-slate-600">Add catalogue details, then record the initial stock as a movement.</p></div>
        @if ($categories->isEmpty())
            <div class="rounded-2xl border border-amber-200 bg-amber-50 p-5 text-sm text-amber-900">Create a category before adding a product. <a href="{{ route('categories.create') }}" class="font-semibold underline">Create category</a></div>
        @else
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-7">@include('products._form')</div>
        @endif
    </section>
</x-layout>
