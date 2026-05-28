<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>404 Not Found - {{ config('app.name', 'OmniManage') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-zinc-900 bg-zinc-50 flex items-center justify-center min-h-screen">
        <div class="text-center px-6 py-12 max-w-lg mx-auto">
            <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-red-100 mb-8">
                <svg class="w-12 h-12 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>
            
            <h1 class="text-7xl font-black text-zinc-900 tracking-tighter mb-4">404</h1>
            <h2 class="text-2xl font-bold text-zinc-800 tracking-tight mb-3">ไม่พบหน้าที่คุณต้องการ (Not Found)</h2>
            <p class="text-zinc-500 mb-10 leading-relaxed text-sm">
                หน้าที่คุณพยายามเข้าถึงอาจถูกลบไปแล้ว, เปลี่ยนชื่อ, หรือไม่มีอยู่จริงในระบบ กรุณาตรวจสอบ URL อีกครั้ง
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
