<x-layout title="Users | StockFlow">
    <section class="space-y-6">
        <div><p class="text-sm font-medium text-blue-600">Administration</p><h1 class="mt-1 text-3xl font-bold tracking-tight text-slate-900">Users</h1><p class="mt-2 text-sm text-slate-600">Accounts registered in StockFlow.</p></div>
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm"><div class="overflow-x-auto"><table class="w-full min-w-[600px] text-left text-sm"><thead class="bg-slate-50 text-xs uppercase tracking-wider text-slate-500"><tr><th class="px-5 py-3">Name</th><th class="px-5 py-3">Email</th><th class="px-5 py-3">Role</th><th class="px-5 py-3">Stock movements</th><th class="px-5 py-3">Joined</th></tr></thead><tbody class="divide-y divide-slate-100">
            @foreach ($users as $user)
                <tr><td class="px-5 py-4 font-semibold text-slate-900">{{ $user->name }}</td><td class="px-5 py-4 text-slate-600">{{ $user->email }}</td><td class="px-5 py-4">@if ($user->isAdmin())<span class="rounded-full bg-violet-50 px-2.5 py-1 text-xs font-semibold text-violet-700">Admin</span>@else<span class="rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-600">User</span>@endif</td><td class="px-5 py-4 text-slate-600">{{ $user->stock_movements_count }}</td><td class="px-5 py-4 text-slate-600">{{ $user->created_at?->format('d M Y') ?? '—' }}</td></tr>
            @endforeach
        </tbody></table></div>@if ($users->hasPages())<div class="border-t border-slate-100 p-4">{{ $users->links() }}</div>@endif</div>
    </section>
</x-layout>
