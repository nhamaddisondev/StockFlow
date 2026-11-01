<x-layout title="Sign in to StockFlow">
    <section class="-mx-6 -my-10 flex min-h-[calc(100vh-64px)] items-center justify-center bg-gradient-to-br from-blue-50 via-white to-sky-100 px-6 py-12">

        <div class="w-full max-w-md overflow-hidden rounded-3xl border border-blue-100/80 bg-white shadow-2xl shadow-blue-900/5">

            {{-- Header --}}
            <div class="px-8 pt-10 text-center sm:px-10">
                <a href="/" class="mb-8 inline-flex items-center gap-2 text-xl font-extrabold tracking-tight text-slate-900">
                    <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-600 text-white shadow-lg shadow-blue-200">
                        S
                    </span>
                    Stock<span class="-ml-2 text-blue-600">Flow</span>
                </a>

                <div class="mx-auto mb-6 flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-600 shadow-lg shadow-blue-200">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.8" stroke="white" class="h-7 w-7">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20.1a7.5 7.5 0 0 1 15 0A17.9 17.9 0 0 1 12 21.75a17.9 17.9 0 0 1-7.5-1.65Z" />
                    </svg>
                </div>

                <h1 class="text-3xl font-bold tracking-tight text-slate-900">
                    Welcome back
                </h1>

                <p class="mt-3 text-sm leading-6 text-slate-500">
                    Sign in to manage your products and keep track of your inventory.
                </p>
            </div>

            {{-- Validation Errors --}}
            @if ($errors->any())
                <div class="mx-8 mt-6 rounded-xl border border-red-100 bg-red-50 px-4 py-3 text-sm text-red-600 sm:mx-10"
                    role="alert">
                    <ul class="list-inside list-disc space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Login Form --}}
            <form class="space-y-5 px-8 pb-10 pt-8 sm:px-10"
                action="{{ route('login') }}" method="POST">

                @csrf

                <div>
                    <label for="email" class="mb-2 block text-sm font-semibold text-slate-700">
                        Email address
                    </label>

                    <input
                        id="email"
                        name="email"
                        type="email"
                        autocomplete="email"
                        value="{{ old('email') }}"
                        placeholder="you@example.com"
                        required
                        autofocus
                        class="block w-full rounded-xl border border-slate-200 bg-slate-50/70 px-4 py-3.5 text-sm text-slate-900 outline-none transition duration-200 placeholder:text-slate-400 hover:border-blue-200 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10">
                </div>

                <div>
                    <label for="password" class="mb-2 block text-sm font-semibold text-slate-700">
                        Password
                    </label>

                    <input
                        id="password"
                        name="password"
                        type="password"
                        autocomplete="current-password"
                        placeholder="Enter your password"
                        required
                        class="block w-full rounded-xl border border-slate-200 bg-slate-50/70 px-4 py-3.5 text-sm text-slate-900 outline-none transition duration-200 placeholder:text-slate-400 hover:border-blue-200 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10">
                </div>

                {{-- Submit Button --}}
                <button type="submit"
                    class="group flex w-full items-center justify-center gap-2 rounded-xl bg-blue-600 px-5 py-3.5 text-sm font-semibold text-white shadow-lg shadow-blue-600/20 transition duration-200 hover:-translate-y-0.5 hover:bg-blue-700 hover:shadow-xl hover:shadow-blue-600/25 focus:outline-none focus:ring-4 focus:ring-blue-500/20 active:translate-y-0">

                    Sign in to StockFlow

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor"
                        class="h-4 w-4 transition-transform group-hover:translate-x-1">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                </button>

                {{-- Register Link --}}
                <p class="pt-2 text-center text-sm text-slate-500">
                    Don't have an account?

                    <a href="{{ route('register') }}"
                        class="font-semibold text-blue-600 transition hover:text-blue-800 hover:underline">
                        Create one
                    </a>
                </p>
            </form>

        </div>
    </section>
</x-layout>