<header class="sticky top-0 z-50 border-b border-slate-100 bg-white/95 backdrop-blur">
    <nav class="mx-auto flex max-w-7xl items-center justify-between px-5 py-4 lg:px-8" aria-label="Main navigation">
        <a href="{{ auth()->check() ? route('dashboard') : route('welcome') }}" class="flex items-center gap-2 text-xl font-extrabold tracking-tight">
            <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-blue-600 text-white">
                <svg viewBox="0 0 24 24" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="m12 2 9 5v10l-9 5-9-5V7l9-5Z" />
                    <path d="m3.5 7.5 8.5 5 8.5-5M12 22V12.5" />
                </svg>
            </span>
            <span>Stock<span class="text-blue-600">Flow</span></span>
        </a>

        <div class="flex items-center gap-3 text-sm font-medium">
            @guest
                <a href="{{ route('welcome') }}" class="rounded-lg px-4 py-2 text-slate-700 transition hover:bg-slate-100">Home</a>
                <a href="{{ route('login') }}" class="rounded-lg px-4 py-2 text-slate-700 transition hover:bg-slate-100">Login</a>
                <a href="{{ route('register') }}" class="rounded-lg bg-blue-600 px-4 py-2.5 font-semibold text-white shadow-sm shadow-blue-200 transition hover:bg-blue-700">Register</a>
            @endguest

            @auth
                <a href="{{ route('dashboard') }}" class="rounded-lg px-4 py-2 text-slate-700 transition hover:bg-slate-100">Dashboard</a>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="rounded-lg px-4 py-2 text-slate-700 transition hover:bg-slate-100">Logout</button>
                </form>
            @endauth
        </div>
    </nav>
</header>
