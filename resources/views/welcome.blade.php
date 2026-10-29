<x-layout>
    <body class="bg-white text-slate-900 antialiased">
        <main>
            {{-- Hero --}}
            <section id="home" class="overflow-hidden bg-gradient-to-br from-blue-50 via-white to-sky-50">
                <div
                    class="mx-auto grid max-w-7xl items-center gap-14 px-5 py-16 sm:py-20 lg:grid-cols-2 lg:px-8 lg:py-24">
                    <div>
                        <div
                            class="mb-6 inline-flex items-center gap-2 rounded-full border border-blue-100 bg-white px-4 py-2 text-sm font-semibold text-blue-700 shadow-sm">
                            <span class="h-2 w-2 rounded-full bg-blue-600"></span>
                            Smart inventory management
                        </div>
                        <h1
                            class="max-w-xl text-4xl font-extrabold leading-tight tracking-tight text-slate-900 sm:text-5xl lg:text-6xl">
                            Manage Your Inventory <span class="text-blue-600">Smarter.</span>
                        </h1>
                        <p class="mt-6 max-w-xl text-lg leading-8 text-slate-600">
                            Track products, organize categories, and keep an eye on stock levels — all from one simple,
                            easy-to-use system.
                        </p>
                        <div class="mt-8 flex flex-wrap gap-3">
                            <a href="{{ url('/register') }}"
                                class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-6 py-3.5 font-semibold text-white shadow-lg shadow-blue-200 transition hover:-translate-y-0.5 hover:bg-blue-700">
                                Get Started Free
                                <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <path d="M5 12h14M13 6l6 6-6 6" />
                                </svg>
                            </a>
                            <a href="{{ url('/login') }}"
                                class="rounded-xl border border-slate-200 bg-white px-6 py-3.5 font-semibold text-slate-700 transition hover:border-blue-300 hover:text-blue-700">Login</a>
                        </div>
                        <div class="mt-7 flex flex-wrap gap-x-5 gap-y-2 text-sm text-slate-600">
                            <span class="inline-flex items-center gap-2"><span class="text-blue-600">✓</span> Easy to
                                use</span>
                            <span class="inline-flex items-center gap-2"><span class="text-blue-600">✓</span> Organized
                                stock</span>
                            <span class="inline-flex items-center gap-2"><span class="text-blue-600">✓</span> Built with
                                Laravel</span>
                        </div>
                    </div>

                    {{-- Decorative dashboard preview; replace sample values with real data in the authenticated
                    dashboard
                    --}}
                    <div class="relative mx-auto w-full max-w-xl">
                        <div class="absolute -inset-5 rounded-[2rem] bg-blue-200/40 blur-2xl"></div>
                        <div
                            class="relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-4 shadow-2xl shadow-blue-900/10 sm:p-6">
                            <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                                <div>
                                    <p class="text-xs font-semibold uppercase tracking-widest text-blue-600">StockFlow
                                    </p>
                                    <h2 class="mt-1 text-xl font-bold">Dashboard preview</h2>
                                </div>
                                <div
                                    class="flex h-9 w-9 items-center justify-center rounded-full bg-blue-100 text-sm font-bold text-blue-700">
                                    JD</div>
                            </div>
                            <div class="mt-5 grid grid-cols-3 gap-3">
                                <div class="rounded-xl bg-blue-50 p-3">
                                    <p class="text-xs text-slate-500">Products</p>
                                    <p class="mt-2 text-2xl font-extrabold">124</p>
                                    <p class="mt-1 text-xs text-blue-700">In catalogue</p>
                                </div>
                                <div class="rounded-xl bg-emerald-50 p-3">
                                    <p class="text-xs text-slate-500">Categories</p>
                                    <p class="mt-2 text-2xl font-extrabold">08</p>
                                    <p class="mt-1 text-xs text-emerald-700">Organized</p>
                                </div>
                                <div class="rounded-xl bg-rose-50 p-3">
                                    <p class="text-xs text-slate-500">Low stock</p>
                                    <p class="mt-2 text-2xl font-extrabold">05</p>
                                    <p class="mt-1 text-xs text-rose-700">Need attention</p>
                                </div>
                            </div>
                            <div class="mt-5 rounded-xl border border-slate-100 p-4">
                                <div class="mb-4 flex items-center justify-between">
                                    <h3 class="font-bold">Recent stock movements</h3>
                                    <span class="text-xs font-semibold text-blue-600">Sample data</span>
                                </div>
                                <div class="space-y-4 text-sm">
                                    <div class="grid grid-cols-[1fr_auto_auto] items-center gap-4"><span
                                            class="font-medium">Wireless Mouse</span><span
                                            class="rounded-md bg-emerald-50 px-2 py-1 text-xs font-semibold text-emerald-700">Stock
                                            in</span><span class="font-semibold text-emerald-700">+20</span></div>
                                    <div class="grid grid-cols-[1fr_auto_auto] items-center gap-4"><span
                                            class="font-medium">USB Keyboard</span><span
                                            class="rounded-md bg-rose-50 px-2 py-1 text-xs font-semibold text-rose-700">Stock
                                            out</span><span class="font-semibold text-rose-700">−5</span></div>
                                    <div class="grid grid-cols-[1fr_auto_auto] items-center gap-4"><span
                                            class="font-medium">Laptop Stand</span><span
                                            class="rounded-md bg-emerald-50 px-2 py-1 text-xs font-semibold text-emerald-700">Stock
                                            in</span><span class="font-semibold text-emerald-700">+12</span></div>
                                </div>
                            </div>
                            <div class="mt-4 flex items-center gap-3 rounded-xl bg-slate-50 p-3">
                                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-amber-100 text-lg">
                                    !
                                </div>
                                <div>
                                    <p class="text-sm font-bold">Low-stock reminder</p>
                                    <p class="text-xs text-slate-500">Review products below their minimum quantity.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Features --}}
            <section id="features" class="mx-auto max-w-7xl px-5 py-20 lg:px-8 lg:py-24">
                <div class="mx-auto max-w-2xl text-center">
                    <p class="text-sm font-bold uppercase tracking-[0.2em] text-blue-600">Key features</p>
                    <h2 class="mt-3 text-3xl font-extrabold tracking-tight sm:text-4xl">Everything you need to manage
                        inventory</h2>
                    <p class="mt-4 leading-7 text-slate-600">Keep your products organized and make everyday stock tasks
                        easier with one central workspace.</p>
                </div>
                <div class="mt-12 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                    @php
                        $features = [
                            ['icon' => '▦', 'title' => 'Product Management', 'description' => 'Create, update, search, and organize products with prices, SKUs, and quantities.'],
                            ['icon' => '◇', 'title' => 'Category Management', 'description' => 'Group products into clear categories to keep your catalogue organized.'],
                            ['icon' => '↕', 'title' => 'Stock Tracking', 'description' => 'Record stock in and stock out, and review movement history.'],
                            ['icon' => '◎', 'title' => 'User Roles', 'description' => 'Help protect inventory actions with appropriate access permissions.'],
                        ];
                    @endphp
                    @foreach ($features as $feature)
                        <article
                            class="rounded-2xl border border-slate-200 bg-white p-6 transition hover:-translate-y-1 hover:border-blue-200 hover:shadow-xl hover:shadow-blue-900/5">
                            <div
                                class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-2xl font-bold text-blue-600">
                                {{ $feature['icon'] }}
                            </div>
                            <h3 class="mt-5 text-lg font-bold">{{ $feature['title'] }}</h3>
                            <p class="mt-3 text-sm leading-6 text-slate-600">{{ $feature['description'] }}</p>
                        </article>
                    @endforeach
                </div>
            </section>

            {{-- How it works --}}
            <section id="how-it-works" class="bg-slate-50">
                <div class="mx-auto grid max-w-7xl items-center gap-12 px-5 py-20 lg:grid-cols-2 lg:px-8 lg:py-24">
                    <div>
                        <p class="text-sm font-bold uppercase tracking-[0.2em] text-blue-600">How it works</p>
                        <h2 class="mt-3 text-3xl font-extrabold tracking-tight sm:text-4xl">Get started in three simple
                            steps</h2>
                        <div class="mt-9 space-y-7">
                            <div class="flex gap-4"><span
                                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-blue-600 font-bold text-white">1</span>
                                <div>
                                    <h3 class="font-bold">Set up your account</h3>
                                    <p class="mt-1 text-sm leading-6 text-slate-600">Sign in and prepare your workspace.
                                    </p>
                                </div>
                            </div>
                            <div class="flex gap-4"><span
                                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-blue-600 font-bold text-white">2</span>
                                <div>
                                    <h3 class="font-bold">Add your products</h3>
                                    <p class="mt-1 text-sm leading-6 text-slate-600">Enter product details and organize
                                        them
                                        by category.</p>
                                </div>
                            </div>
                            <div class="flex gap-4"><span
                                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-blue-600 font-bold text-white">3</span>
                                <div>
                                    <h3 class="font-bold">Track your stock</h3>
                                    <p class="mt-1 text-sm leading-6 text-slate-600">Record stock movements and keep an
                                        eye
                                        on low quantities.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="rounded-3xl border border-blue-100 bg-gradient-to-br from-blue-100 to-white p-6 sm:p-10">
                        <div class="rounded-2xl bg-slate-900 p-4 shadow-2xl sm:p-6">
                            <div class="flex items-center gap-2 border-b border-white/10 pb-4"><span
                                    class="h-2.5 w-2.5 rounded-full bg-rose-400"></span><span
                                    class="h-2.5 w-2.5 rounded-full bg-amber-400"></span><span
                                    class="h-2.5 w-2.5 rounded-full bg-emerald-400"></span><span
                                    class="ml-3 text-xs text-slate-400">StockFlow workspace</span></div>
                            <div class="mt-5 grid grid-cols-2 gap-3">
                                <div class="rounded-xl bg-white p-4">
                                    <p class="text-xs text-slate-500">Total products</p>
                                    <p class="mt-2 text-3xl font-extrabold text-slate-900">124</p>
                                </div>
                                <div class="rounded-xl bg-white p-4">
                                    <p class="text-xs text-slate-500">Low-stock items</p>
                                    <p class="mt-2 text-3xl font-extrabold text-rose-600">05</p>
                                </div>
                            </div>
                            <div class="mt-3 rounded-xl bg-white p-4">
                                <p class="text-sm font-bold">Inventory activity</p>
                                <div class="mt-5 flex h-24 items-end gap-2">
                                    @foreach ([35, 60, 45, 80, 55, 95, 68, 85, 50, 72, 100, 78] as $height)<span
                                        class="flex-1 rounded-t-md bg-blue-500/80"
                                    style="height: {{ $height }}%"></span>@endforeach
                                </div>
                                <div class="mt-2 flex justify-between text-xs text-slate-400"><span>Week
                                        1</span><span>Week
                                        2</span><span>Week 3</span><span>Week 4</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Call to action --}}
            <section class="px-5 py-16 lg:px-8">
                <div
                    class="mx-auto flex max-w-7xl flex-col gap-8 overflow-hidden rounded-3xl bg-gradient-to-r from-blue-700 to-blue-500 px-7 py-10 text-white shadow-xl shadow-blue-200 sm:px-12 lg:flex-row lg:items-center lg:justify-between">
                    <div class="max-w-2xl">
                        <p class="text-sm font-bold uppercase tracking-[0.18em] text-blue-100">Ready to get started?</p>
                        <h2 class="mt-2 text-3xl font-extrabold tracking-tight">Take control of your inventory today.
                        </h2>
                        <p class="mt-3 leading-7 text-blue-100">Bring your products and stock movements together with
                            StockFlow.</p>
                    </div>
                    <a href="#register"
                        class="inline-flex shrink-0 items-center justify-center gap-2 rounded-xl bg-white px-6 py-3.5 font-bold text-blue-700 transition hover:bg-blue-50">
                        Get Started Free <span aria-hidden="true">→</span>
                    </a>
                </div>
            </section>
        </main>

        {{-- Footer --}}
        <footer class="bg-slate-950 text-slate-300">
            <div
                class="mx-auto flex max-w-7xl flex-col gap-8 px-5 py-10 sm:flex-row sm:items-center sm:justify-between lg:px-8">
                <div>
                    <a href="#" class="text-xl font-extrabold text-white">Stock<span
                            class="text-blue-400">Flow</span></a>
                    <p class="mt-2 text-sm text-slate-400">Simple inventory. Better business.</p>
                </div>
                <div class="flex flex-wrap gap-x-6 gap-y-3 text-sm">
                    <a href="#home" class="transition hover:text-white">Home</a>
                    <a href="#features" class="transition hover:text-white">Features</a>
                    <a href="#how-it-works" class="transition hover:text-white">How it works</a>
                    <a href="#login" class="transition hover:text-white">Login</a>
                    <a href="#register" class="transition hover:text-white">Register</a>
                </div>
            </div>
        </footer>
    </body>
</x-layout>