<x-layout title="Create Category | StockFlow">
    <section class="mx-auto max-w-2xl space-y-6"><div><a href="{{ route('categories.index') }}" class="text-sm font-semibold text-blue-600">← Categories</a><h1 class="mt-3 text-3xl font-bold tracking-tight text-slate-900">Create category</h1></div><div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-7">@include('categories._form')</div></section>
</x-layout>
