<x-layout title="Edit Category | StockFlow">
    <section class="mx-auto max-w-2xl space-y-6"><div><a href="{{ route('categories.show', $category) }}" class="text-sm font-semibold text-blue-600">← Category details</a><h1 class="mt-3 text-3xl font-bold tracking-tight text-slate-900">Edit category</h1></div><div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-7">@include('categories._form')</div></section>
</x-layout>
