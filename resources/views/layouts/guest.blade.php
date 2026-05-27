<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts: Inter (shadcn/ui default) -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-zinc-900 antialiased bg-zinc-50">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-zinc-50">
        <!-- Logo -->
        <div>
            <a href="/">
                <x-application-logo class="w-10 h-10 fill-current text-zinc-800" />
            </a>
        </div>

        <!-- Auth Card -->
        <div class="w-full sm:max-w-md mt-6 px-6 py-6 bg-white border border-zinc-200 rounded-xl shadow-sm overflow-hidden">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
