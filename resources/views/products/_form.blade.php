@php($isEditing = isset($product))

<form action="{{ $isEditing ? route('products.update', $product) : route('products.store') }}" method="POST" class="space-y-5">
    @csrf
    @if ($isEditing) @method('PUT') @endif

    <div>
        <label for="name" class="mb-2 block text-sm font-semibold text-slate-700">Product name</label>
        <input id="name" name="name" value="{{ old('name', $product->name ?? '') }}" required maxlength="255" class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100">
        @error('name') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
    </div>

    <div class="grid gap-5 sm:grid-cols-2">
        <div>
            <label for="category_id" class="mb-2 block text-sm font-semibold text-slate-700">Category</label>
            <select id="category_id" name="category_id" required class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100">
                <option value="">Choose a category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected((string) old('category_id', $product->category_id ?? '') === (string) $category->id)>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="sku" class="mb-2 block text-sm font-semibold text-slate-700">SKU</label>
            <input id="sku" name="sku" value="{{ old('sku', $product->sku ?? '') }}" required maxlength="255" class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100">
            @error('sku') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
        </div>
    </div>

    <div class="grid gap-5 sm:grid-cols-2">
        <div>
            <label for="price" class="mb-2 block text-sm font-semibold text-slate-700">Price</label>
            <input id="price" name="price" type="number" min="0" step="0.01" value="{{ old('price', $product->price ?? '') }}" required class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100">
            @error('price') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="min_stock" class="mb-2 block text-sm font-semibold text-slate-700">Low stock alert at</label>
            <input id="min_stock" name="min_stock" type="number" min="0" step="1" value="{{ old('min_stock', $product->min_stock ?? 5) }}" required class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100">
            @error('min_stock') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
        </div>
    </div>

    <p class="text-xs leading-5 text-slate-500">New products start at zero units. Record a stock-in movement to add inventory.</p>

    <div class="flex flex-col-reverse gap-3 border-t border-slate-100 pt-5 sm:flex-row sm:justify-between">
        <a href="{{ route('products.index') }}" class="rounded-lg px-4 py-2.5 text-center text-sm font-semibold text-slate-600 hover:bg-slate-100">Cancel</a>
        <button class="rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-blue-700">{{ $isEditing ? 'Save changes' : 'Create product' }}</button>
    </div>
</form>
