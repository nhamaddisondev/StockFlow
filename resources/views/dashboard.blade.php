<x-layout>
    <div class="min-h-screen bg-slate-50">
        <div class="mx-auto flex max-w-[1600px]">
            {{-- Sidebar --}}
            <aside class="hidden min-h-screen w-64 shrink-0 border-r border-slate-200 bg-white lg:block">
                <div class="sticky top-0 flex h-screen flex-col px-5 py-6">
                    <a href="{{ url('/dashboard') }}" class="flex items-center gap-3 px-2">
                        <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-600 text-white text-xl font-bold">S</span>
                        <span class="text-xl font-extrabold text-slate-900">Stock<span class="text-blue-600">Flow</span></span>
                    </a>

                    <p class="mb-3 mt-10 px-3 text-xs font-bold uppercase tracking-wider text-slate-400">Workspace</p>
                    <nav class="space-y-1 text-sm font-medium">
                        <a href="{{ url('/dashboard') }}" class="flex items-center gap-3 rounded-xl bg-blue-50 px-3 py-3 text-blue-700">▦ Dashboard</a>
                        <a href="{{ url('/products') }}" class="flex items-center gap-3 rounded-xl px-3 py-3 text-slate-600 hover:bg-slate-100">◇ Products</a>
                        <a href="{{ url('/categories') }}" class="flex items-center gap-3 rounded-xl px-3 py-3 text-slate-600 hover:bg-slate-100">▤ Categories</a>
                        <a href="{{ url('/stock-movements') }}" class="flex items-center gap-3 rounded-xl px-3 py-3 text-slate-600 hover:bg-slate-100">↕ Stock Movements</a>
                    </nav>

                    <p class="mb-3 mt-9 px-3 text-xs font-bold uppercase tracking-wider text-slate-400">Administration</p>
                    <nav class="space-y-1 text-sm font-medium">
                        <a href="{{ url('/users') }}" class="flex items-center gap-3 rounded-xl px-3 py-3 text-slate-600 hover:bg-slate-100">♙ Users</a>
                    </nav>

                    <div class="mt-auto rounded-2xl bg-blue-50 p-4">
                        <p class="text-sm font-bold text-slate-900">Need a hand?</p>
                        <p class="mt-1 text-xs leading-5 text-slate-600">Keep your inventory organized with StockFlow.</p>
                    </div>
                    <div class="mt-5 flex items-center gap-3 border-t border-slate-100 pt-5">
                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-slate-200 font-bold text-slate-600">{{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}</div>
                        <div class="min-w-0">
                            <p class="truncate text-sm font-semibold text-slate-900">{{ auth()->user()->name ?? 'StockFlow User' }}</p>
                            <p class="truncate text-xs text-slate-500">{{ auth()->user()->email ?? 'user@example.com' }}</p>
                        </div>
                    </div>
                </div>
            </aside>

            {{-- Main content --}}
            <main class="min-w-0 flex-1">
                <header class="sticky top-0 z-30 flex items-center justify-between border-b border-slate-200 bg-white/95 px-5 py-4 backdrop-blur sm:px-8">
                    <div>
                        <p class="text-xs text-slate-500">Workspace / Overview</p>
                        <h1 class="mt-1 text-xl font-bold text-slate-900 sm:text-2xl">Dashboard</h1>
                    </div>
                    <a href="{{ url('/products/create') }}" class="rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-blue-700">+ Add Product</a>
                </header>

                <div class="space-y-7 p-5 sm:p-8">
                    <section class="flex flex-col justify-between gap-3 sm:flex-row sm:items-end">
                        <div>
                            <h2 class="text-2xl font-bold tracking-tight text-slate-900">Good day, {{ auth()->user()->name ?? 'there' }} 👋</h2>
                            <p class="mt-1 text-sm text-slate-500">Here's what's happening with your inventory today.</p>
                        </div>
                        <p class="text-sm text-slate-500">{{ now()->format('l, d M Y') }}</p>
                    </section>

                    {{-- Summary cards: values are passed from the controller --}}
                    @php
                        $totalProducts = $totalProducts ?? 0;
                        $totalCategories = $totalCategories ?? 0;
                        $lowStockCount = $lowStockCount ?? 0;
                        $totalStockUnits = $totalStockUnits ?? 0;

                        $summaryCards = [
                            ['label' => 'Total Products', 'value' => $totalProducts, 'note' => 'Products in catalogue', 'icon' => '▦', 'style' => 'bg-blue-50 text-blue-600'],
                            ['label' => 'Categories', 'value' => $totalCategories, 'note' => 'Product groups', 'icon' => '◇', 'style' => 'bg-violet-50 text-violet-600'],
                            ['label' => 'Low Stock Items', 'value' => $lowStockCount, 'note' => 'Need your attention', 'icon' => '!', 'style' => 'bg-amber-50 text-amber-600'],
                            ['label' => 'Total Stock Units', 'value' => $totalStockUnits, 'note' => 'Units currently available', 'icon' => '↗', 'style' => 'bg-emerald-50 text-emerald-600'],
                        ];
                    @endphp

                    <section class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
                        @foreach ($summaryCards as $card)
                            <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                                <div class="flex items-center justify-between">
                                    <p class="text-sm font-medium text-slate-500">{{ $card['label'] }}</p>
                                    <span class="flex h-10 w-10 items-center justify-center rounded-xl text-xl font-bold {{ $card['style'] }}">{{ $card['icon'] }}</span>
                                </div>
                                <p class="mt-4 text-3xl font-extrabold text-slate-900">{{ number_format($card['value']) }}</p>
                                <p class="mt-1 text-xs text-slate-500">{{ $card['note'] }}</p>
                            </article>
                        @endforeach
                    </section>

                    {{-- Quick actions --}}
                    <section class="grid gap-4 sm:grid-cols-3">
                        <a href="{{ url('/products/create') }}" class="flex items-center gap-4 rounded-2xl border border-slate-200 bg-white p-4 hover:border-blue-300 hover:shadow-md">
                            <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50 text-2xl font-bold text-blue-600">+</span>
                            <span><span class="block text-sm font-bold text-slate-900">Add a product</span><span class="mt-1 block text-xs text-slate-500">Create a new product</span></span>
                        </a>
                        <a href="{{ url('/categories/create') }}" class="flex items-center gap-4 rounded-2xl border border-slate-200 bg-white p-4 hover:border-blue-300 hover:shadow-md">
                            <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-violet-50 text-2xl font-bold text-violet-600">◇</span>
                            <span><span class="block text-sm font-bold text-slate-900">Create category</span><span class="mt-1 block text-xs text-slate-500">Organize your products</span></span>
                        </a>
                        <a href="{{ url('/stock-movements/create') }}" class="flex items-center gap-4 rounded-2xl border border-slate-200 bg-white p-4 hover:border-blue-300 hover:shadow-md">
                            <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-50 text-2xl font-bold text-emerald-600">↕</span>
                            <span><span class="block text-sm font-bold text-slate-900">Record stock</span><span class="mt-1 block text-xs text-slate-500">Stock in or stock out</span></span>
                        </a>
                    </section>

                    {{-- Recent movements and low-stock list --}}
                    <section class="grid gap-6 xl:grid-cols-3">
                        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white xl:col-span-2">
                            <div class="flex items-center justify-between border-b border-slate-100 px-5 py-4">
                                <div><h3 class="font-bold text-slate-900">Recent stock movements</h3><p class="mt-1 text-xs text-slate-500">Latest inventory activity</p></div>
                                <a href="{{ url('/stock-movements') }}" class="text-sm font-semibold text-blue-600">View all</a>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="w-full min-w-[580px] text-left text-sm">
                                    <thead class="bg-slate-50 text-xs uppercase tracking-wider text-slate-500">
                                        <tr><th class="px-5 py-3">Product</th><th class="px-5 py-3">Type</th><th class="px-5 py-3">Quantity</th><th class="px-5 py-3">Date</th></tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-100">
                                        @forelse (($recentMovements ?? collect()) as $movement)
                                            <tr class="hover:bg-slate-50">
                                                <td class="px-5 py-4"><p class="font-semibold text-slate-900">{{ $movement->product->name ?? 'Product' }}</p><p class="mt-1 text-xs text-slate-500">{{ $movement->product->sku ?? '—' }}</p></td>
                                                <td class="px-5 py-4">
                                                    @if (($movement->type ?? '') === 'in')
                                                        <span class="rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700">Stock in</span>
                                                    @else
                                                        <span class="rounded-full bg-rose-50 px-2.5 py-1 text-xs font-semibold text-rose-700">Stock out</span>
                                                    @endif
                                                </td>
                                                <td class="px-5 py-4 font-semibold text-slate-700">{{ $movement->quantity ?? 0 }}</td>
                                                <td class="px-5 py-4 text-slate-500">{{ $movement->created_at?->format('d M Y') ?? '—' }}</td>
                                            </tr>
                                        @empty
                                            <tr><td colspan="4" class="px-5 py-10 text-center"><p class="font-semibold text-slate-700">No stock movements yet</p><p class="mt-1 text-xs text-slate-500">Your latest stock activity will appear here.</p></td></tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white">
                            <div class="flex items-center justify-between border-b border-slate-100 px-5 py-4">
                                <div><h3 class="font-bold text-slate-900">Low stock alerts</h3><p class="mt-1 text-xs text-slate-500">At or below minimum quantity</p></div>
                                <span class="rounded-full bg-amber-50 px-2.5 py-1 text-xs font-bold text-amber-700">{{ $lowStockCount }}</span>
                            </div>
                            <div class="divide-y divide-slate-100">
                                @forelse (($lowStockProducts ?? collect()) as $product)
                                    <div class="flex items-center justify-between gap-3 px-5 py-4">
                                        <div class="min-w-0"><p class="truncate text-sm font-semibold text-slate-900">{{ $product->name }}</p><p class="mt-1 text-xs text-slate-500">{{ $product->sku }}</p></div>
                                        <div class="shrink-0 text-right"><p class="text-sm font-bold text-amber-700">{{ $product->quantity }} left</p><p class="mt-1 text-xs text-slate-500">Min. {{ $product->minimum_stock }}</p></div>
                                    </div>
                                @empty
                                    <div class="px-5 py-10 text-center"><span class="text-2xl text-emerald-500">✓</span><p class="mt-2 text-sm font-semibold text-slate-700">All looking good!</p><p class="mt-1 text-xs text-slate-500">No low-stock products to show.</p></div>
                                @endforelse
                            </div>
                            <div class="border-t border-slate-100 px-5 py-3"><a href="{{ url('/products') }}" class="text-sm font-semibold text-blue-600">View products →</a></div>
                        </div>
                    </section>

                    <footer class="pb-3 text-center text-xs text-slate-400">© {{ date('Y') }} StockFlow. Simple inventory. Better business.</footer>
                </div>
            </main>
        </div>
    </div>
</x-layout>