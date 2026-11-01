<x-layout title="Create your StockFlow account">
    <section class="-mx-6 -my-10 min-h-[calc(100vh-64px)] bg-slate-50 lg:grid lg:grid-cols-2">
        {{-- Brand panel --}}
        <div class="relative hidden overflow-hidden bg-gradient-to-br from-blue-800 via-blue-700 to-cyan-600 p-12 text-white lg:flex lg:flex-col lg:justify-between xl:p-16">
            <div class="absolute -right-24 -top-24 h-80 w-80 rounded-full bg-white/10 blur-2xl"></div>
            <div class="absolute -bottom-28 -left-20 h-80 w-80 rounded-full bg-cyan-300/20 blur-2xl"></div>

            <a href="{{ url('/') }}" class="relative flex items-center gap-3 text-xl font-extrabold tracking-tight">
                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-white/15 ring-1 ring-white/20">
                    <svg viewBox="0 0 24 24" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="m12 2 9 5v10l-9 5-9-5V7l9-5Z"/><path d="m3.5 7.5 8.5 5 8.5-5M12 22V12.5"/>
                    </svg>
                </span>
                <span>StockFlow</span>
            </a>

            <div class="relative max-w-xl">
                <p class="mb-4 text-sm font-bold uppercase tracking-[0.2em] text-blue-100">Inventory made simple</p>
                <h1 class="text-5xl font-extrabold leading-tight tracking-tight xl:text-6xl">
                    Take control of your <span class="text-cyan-200">inventory.</span>
                </h1>
                <p class="mt-6 max-w-md text-lg leading-8 text-blue-100">
                    Create your StockFlow account to organize products, monitor stock levels, and keep every movement in one place.
                </p>

                <div class="mt-10 space-y-4 text-sm text-blue-50">
                    <div class="flex items-center gap-3">
                        <span class="flex h-7 w-7 items-center justify-center rounded-full bg-white/15">✓</span>
                        Keep products and categories organized
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="flex h-7 w-7 items-center justify-center rounded-full bg-white/15">✓</span>
                        Track stock in and stock out
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="flex h-7 w-7 items-center justify-center rounded-full bg-white/15">✓</span>
                        Spot low-stock items more easily
                    </div>
                </div>
            </div>

            <p class="relative text-sm text-blue-100">&copy; {{ date('Y') }} StockFlow. Simple inventory. Better business.</p>
        </div>

        {{-- Registration form --}}
        <div class="flex items-center justify-center px-6 py-12 sm:px-10 lg:px-14 xl:px-20">
            <div class="w-full max-w-lg">
                <a href="{{ url('/') }}" class="flex items-center gap-2 text-lg font-extrabold text-slate-900 lg:hidden">
                    <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-600 text-white">S</span>
                    Stock<span class="-ml-2 text-blue-600">Flow</span>
                </a>

                <div class="mt-8 lg:mt-0">
                    <p class="text-sm font-bold uppercase tracking-[0.18em] text-blue-600">Get started</p>
                    <h2 class="mt-2 text-3xl font-extrabold tracking-tight text-slate-900 sm:text-4xl">Create your account</h2>
                    <p class="mt-3 text-slate-600">Set up your account and start managing your inventory with StockFlow.</p>
                </div>

                @if ($errors->any())
                    <div class="mt-6 rounded-xl border border-rose-200 bg-rose-50 p-4 text-sm text-rose-700">
                        <p class="font-semibold">Please check the information you entered.</p>
                        <ul class="mt-2 list-inside list-disc space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form class="mt-8 space-y-5" action="{{ route('register') }}" method="POST">
                    @csrf

                    <div>
                        <label for="name" class="mb-2 block text-sm font-semibold text-slate-700">Full name</label>
                        <input
                            id="name"
                            name="name"
                            type="text"
                            value="{{ old('name') }}"
                            autocomplete="name"
                            placeholder="Enter your full name"
                            required
                            autofocus
                            class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 @error('name') border-rose-400 @enderror"
                        >
                        @error('name')
                            <p class="mt-1.5 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="mb-2 block text-sm font-semibold text-slate-700">Email address</label>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            value="{{ old('email') }}"
                            autocomplete="email"
                            placeholder="you@example.com"
                            required
                            class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 @error('email') border-rose-400 @enderror"
                        >
                        @error('email')
                            <p class="mt-1.5 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid gap-5 sm:grid-cols-2">
                        <div>
                            <label for="password" class="mb-2 block text-sm font-semibold text-slate-700">Password</label>
                            <input
                                id="password"
                                name="password"
                                type="password"
                                autocomplete="new-password"
                                placeholder="At least 8 characters"
                                required
                                class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 @error('password') border-rose-400 @enderror"
                            >
                            @error('password')
                                <p class="mt-1.5 text-sm text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="mb-2 block text-sm font-semibold text-slate-700">Confirm password</label>
                            <input
                                id="password_confirmation"
                                name="password_confirmation"
                                type="password"
                                autocomplete="new-password"
                                placeholder="Repeat password"
                                required
                                class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                            >
                        </div>
                    </div>

                    <button type="submit" class="flex w-full items-center justify-center gap-2 rounded-xl bg-blue-600 px-5 py-3.5 font-bold text-white shadow-lg shadow-blue-200 transition hover:-translate-y-0.5 hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-200">
                        Create StockFlow account
                        <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
                    </button>

                    <p class="text-center text-sm text-slate-600">
                        Already have an account?
                        <a href="{{ route('login') }}" class="font-bold text-blue-600 hover:text-blue-700">Sign in</a>
                    </p>
                </form>

                <p class="mt-8 text-center text-xs leading-5 text-slate-400">
                    By creating an account, you can start organizing and tracking your inventory in StockFlow.
                </p>
            </div>
        </div>
    </section>
</x-layout>