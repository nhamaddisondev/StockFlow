@php($isEditing = isset($stock))

<form action="{{ $isEditing ? route('stocks.update', $stock) : route('stocks.store') }}" method="POST" class="space-y-6">
    @csrf
    @if ($isEditing)
        @method('PUT')
    @endif

    <div>
        <label for="product_id" class="mb-2 block text-sm font-semibold text-slate-700">Product</label>
        <select id="product_id" name="product_id" required class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100">
            <option value="">Choose a product</option>
            @foreach ($products as $product)
                <option value="{{ $product->id }}" @selected((string) old('product_id', $stock->product_id ?? request('product_id', '')) === (string) $product->id)>
                    {{ $product->name }} ({{ $product->sku }}) — {{ number_format($product->stock_quantity) }} in stock
                </option>
            @endforeach
        </select>
        @error('product_id') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
    </div>

    <div class="grid gap-5 sm:grid-cols-2">
        <div>
            <label for="movement_type" class="mb-2 block text-sm font-semibold text-slate-700">Movement type</label>
            <select id="movement_type" name="movement_type" required class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100">
                <option value="in" @selected(old('movement_type', $stock->movement_type ?? '') === 'in')>Stock in</option>
                <option value="out" @selected(old('movement_type', $stock->movement_type ?? '') === 'out')>Stock out</option>
            </select>
            @error('movement_type') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="quantity" class="mb-2 block text-sm font-semibold text-slate-700">Quantity</label>
            <input id="quantity" name="quantity" type="number" min="1" step="1" value="{{ old('quantity', $stock->quantity ?? '') }}" required class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100">
            @error('quantity') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
        </div>
    </div>

    <div>
        <label for="note" class="mb-2 block text-sm font-semibold text-slate-700">Note <span class="font-normal text-slate-400">(optional)</span></label>
        <textarea id="note" name="note" rows="4" maxlength="1000" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100">{{ old('note', $stock->note ?? '') }}</textarea>
        @error('note') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
    </div>

    <div class="flex flex-col-reverse gap-3 border-t border-slate-100 pt-5 sm:flex-row sm:justify-between">
        <a href="{{ route('stocks.index') }}" class="rounded-lg px-4 py-2.5 text-center text-sm font-semibold text-slate-600 hover:bg-slate-100">Cancel</a>
        <button type="submit" class="rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-blue-700">
            {{ $isEditing ? 'Save changes' : 'Record movement' }}
        </button>
    </div>
</form>
