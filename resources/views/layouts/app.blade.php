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

<body class="font-sans antialiased bg-zinc-50 text-zinc-900">
    <div class="min-h-screen bg-zinc-50">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white border-b border-zinc-200">
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            <!-- Global Flash Messages Notification Banner (shadcn/ui premium dismissible alerts) -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
                @if (session('success'))
                    <div x-data="{ show: true }" x-show="show" x-transition.duration.300ms class="flex items-center justify-between p-4 rounded-xl border border-zinc-200 bg-white text-zinc-900 shadow-sm" role="alert">
                        <div class="flex items-center gap-3">
                            <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-emerald-50 text-emerald-600">
                                <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M1 5.917 5.724 10.5 15 1.5"/>
                                </svg>
                            </span>
                            <p class="text-sm font-semibold tracking-tight text-zinc-900">{{ session('success') }}</p>
                        </div>
                        <button type="button" @click="show = false" class="text-zinc-400 hover:text-zinc-900 rounded-lg p-1.5 hover:bg-zinc-100 transition-colors">
                            <span class="sr-only">Close Notification</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                        </button>
                    </div>
                @endif

                @if (session('error'))
                    <div x-data="{ show: true }" x-show="show" x-transition.duration.300ms class="flex items-center justify-between p-4 rounded-xl border border-red-100 bg-red-50 text-red-800 shadow-sm" role="alert">
                        <div class="flex items-center gap-3">
                            <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-red-100 text-red-600">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                            </span>
                            <p class="text-sm font-semibold tracking-tight text-red-900">{{ session('error') }}</p>
                        </div>
                        <button type="button" @click="show = false" class="text-red-400 hover:text-red-800 rounded-lg p-1.5 hover:bg-red-100/50 transition-colors">
                            <span class="sr-only">Close Notification</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                        </button>
                    </div>
                @endif
            </div>

            {{ $slot }}
        </main>
    </div>
</body>

</html>
