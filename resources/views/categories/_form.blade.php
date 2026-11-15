@php($isEditing = isset($category))

<form action="{{ $isEditing ? route('categories.update', $category) : route('categories.store') }}" method="POST" class="space-y-5">
    @csrf
    @if ($isEditing) @method('PUT') @endif
    <div><label for="name" class="mb-2 block text-sm font-semibold text-slate-700">Category name</label><input id="name" name="name" value="{{ old('name', $category->name ?? '') }}" maxlength="255" required class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100">@error('name')<p class="mt-1 text-sm text-rose-600">{{ $message }}</p>@enderror</div>
    <div><label for="description" class="mb-2 block text-sm font-semibold text-slate-700">Description <span class="font-normal text-slate-400">(optional)</span></label><textarea id="description" name="description" rows="4" maxlength="1000" class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-100">{{ old('description', $category->description ?? '') }}</textarea>@error('description')<p class="mt-1 text-sm text-rose-600">{{ $message }}</p>@enderror</div>
    <div class="flex flex-col-reverse gap-3 border-t border-slate-100 pt-5 sm:flex-row sm:justify-between"><a href="{{ route('categories.index') }}" class="rounded-lg px-4 py-2.5 text-center text-sm font-semibold text-slate-600 hover:bg-slate-100">Cancel</a><button class="rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-blue-700">{{ $isEditing ? 'Save changes' : 'Create category' }}</button></div>
</form>
