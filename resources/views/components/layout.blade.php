@props([
    'title' => 'Default Title',
    'fullWidth' => false,
    'showNavbar' => true,
])

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="min-h-screen bg-blue-50 text-zinc-900 antialiased">
    @if ($showNavbar)
        <x-navbar />
    @endif
        <main @class([
            'mx-auto max-w-5xl px-6 py-10' => ! $fullWidth,
            'w-full max-w-none p-0' => $fullWidth,
        ])>
        {{ $slot }}
    </main>
</body>
</html>
