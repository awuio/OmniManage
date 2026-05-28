<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>403 Forbidden - {{ config('app.name', 'OmniManage') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-zinc-900 bg-zinc-50 flex items-center justify-center min-h-screen">
        <div class="text-center px-6 py-12 max-w-lg mx-auto">
            <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-amber-100 mb-8">
                <svg class="w-12 h-12 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>
            
            <h1 class="text-7xl font-black text-zinc-900 tracking-tighter mb-4">403</h1>
            <h2 class="text-2xl font-bold text-zinc-800 tracking-tight mb-3">ไม่มีสิทธิ์เข้าถึง (Forbidden)</h2>
            <p class="text-zinc-500 mb-10 leading-relaxed text-sm">
                ขออภัย คุณไม่มีสิทธิ์ในการเข้าถึงหน้านี้ หรือเนื้อหาส่วนนี้สงวนไว้สำหรับผู้ดูแลระบบเท่านั้น
            </p>
            
            <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
                <button onclick="window.history.back()" class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium h-10 px-5 py-2 border border-zinc-200 bg-white text-zinc-700 shadow-sm hover:bg-zinc-50 focus:outline-none focus:ring-2 focus:ring-zinc-400 focus:ring-offset-2 transition-colors duration-150 w-full sm:w-auto">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                    ย้อนกลับ (Go Back)
                </button>
                <a href="{{ url('/') }}" class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium h-10 px-5 py-2 border border-transparent bg-zinc-900 text-white shadow-sm hover:bg-zinc-800 focus:outline-none focus:ring-2 focus:ring-zinc-900 focus:ring-offset-2 transition-colors w-full sm:w-auto">
                    กลับหน้าหลัก (Home)
                </a>
            </div>
        </div>
    </body>
</html>
