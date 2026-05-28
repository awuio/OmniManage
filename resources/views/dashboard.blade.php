<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-bold tracking-tight text-zinc-900">
                {{ __('Dashboard') }}
            </h2>
            <div class="flex items-center gap-3">
                <a href="{{ route('products.create') }}"
                    class="inline-flex items-center gap-2 rounded-lg bg-zinc-900 px-4 py-2 text-sm font-semibold text-zinc-50 shadow-sm transition-colors hover:bg-zinc-800">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                        stroke="currentColor" class="h-4 w-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    {{ __('เพิ่มสินค้าใหม่') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="min-h-screen bg-zinc-50/50">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">
            
            {{-- ─── Premium Welcome Banner (shadcn-inspired modern slate card) ─── --}}
            <div class="relative overflow-hidden bg-zinc-900 border border-zinc-800 rounded-xl p-6 sm:p-8 text-white shadow-sm">
                {{-- Subtle glow background elements --}}
                <div class="pointer-events-none absolute -right-24 -top-24 h-96 w-96 rounded-full bg-zinc-800/20 blur-3xl"></div>
                <div class="pointer-events-none absolute -bottom-24 -left-24 h-96 w-96 rounded-full bg-zinc-800/10 blur-3xl"></div>
                
                <div class="relative flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                    <div class="space-y-2">
                        <p class="text-xs font-semibold uppercase tracking-wider text-zinc-400">ยินดีต้อนรับกลับมา</p>
                        <h1 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">
                            {{ auth()->user()->name }}
                        </h1>
                        <p class="text-sm text-zinc-400 font-medium">
                            {{ now()->locale('th')->translatedFormat('l, j F Y') }}
                        </p>
                    </div>

                    {{-- Quick Summary Badges --}}
                    <div class="flex flex-wrap gap-3">
                        <div class="flex items-center gap-3 rounded-lg bg-zinc-800/50 border border-zinc-700/50 px-4 py-2.5 backdrop-blur-sm">
                            <span class="text-2xl font-bold text-white tabular-nums">{{ number_format($productsCount) }}</span>
                            <span class="text-xs text-zinc-400 font-medium leading-none">สินค้า<br>ทั้งหมด</span>
                        </div>
                        <div class="flex items-center gap-3 rounded-lg bg-zinc-800/50 border border-zinc-700/50 px-4 py-2.5 backdrop-blur-sm">
                            <span class="text-2xl font-bold text-white tabular-nums">{{ number_format($categoriesCount) }}</span>
                            <span class="text-xs text-zinc-400 font-medium leading-none">หมวด<br>หมู่</span>
                        </div>
                        <div class="flex items-center gap-3 rounded-lg bg-zinc-800/50 border border-zinc-700/50 px-4 py-2.5 backdrop-blur-sm">
                            <span class="text-2xl font-bold text-white tabular-nums">{{ number_format($postsCount) }}</span>
                            <span class="text-xs text-zinc-400 font-medium leading-none">บทความ<br>ทั้งหมด</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ─── KPI Stat Cards (shadcn/ui style) ─── --}}
            <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                {{-- Products Card --}}
                <div class="group relative rounded-xl bg-white border border-zinc-200 p-6 shadow-sm hover:shadow-md transition-all duration-200">
                    <div class="flex items-center justify-between space-y-0 pb-2">
                        <p class="text-xs font-semibold uppercase tracking-wider text-zinc-500">สินค้าทั้งหมด</p>
                        <div class="h-8 w-8 shrink-0 flex items-center justify-center rounded-md border border-zinc-100 bg-zinc-50 text-zinc-950 group-hover:bg-zinc-900 group-hover:text-white transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-4 w-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007Z" />
                            </svg>
                        </div>
                    </div>
                    <div class="flex items-baseline justify-between mt-2">
                        <div>
                            <span class="text-3xl font-bold tracking-tight text-zinc-900 tabular-nums">{{ number_format($productsCount) }}</span>
                            <span class="text-xs text-zinc-400 font-medium ml-1">รายการ</span>
                        </div>
                        <a href="{{ route('products.index') }}" class="text-xs font-semibold text-zinc-500 hover:text-zinc-900 transition-colors opacity-0 group-hover:opacity-100">
                            ดูทั้งหมด →
                        </a>
                    </div>
                </div>

                {{-- Stock Value Card --}}
                <div class="group relative rounded-xl bg-white border border-zinc-200 p-6 shadow-sm hover:shadow-md transition-all duration-200">
                    <div class="flex items-center justify-between space-y-0 pb-2">
                        <p class="text-xs font-semibold uppercase tracking-wider text-zinc-500">มูลค่าสต็อกรวม</p>
                        <div class="h-8 w-8 shrink-0 flex items-center justify-center rounded-md border border-zinc-100 bg-zinc-50 text-zinc-950">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-4 w-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-2">
                        <span class="text-2xl font-bold tracking-tight text-zinc-900 tabular-nums">฿{{ number_format($totalStockValue, 0) }}</span>
                    </div>
                </div>

                {{-- Stock Alerts Card --}}
                <div class="group relative rounded-xl bg-white border border-zinc-200 p-6 shadow-sm hover:shadow-md transition-all duration-200">
                    <div class="flex items-center justify-between space-y-0 pb-2">
                        <p class="text-xs font-semibold uppercase tracking-wider text-zinc-500">รายการต้องดูแล</p>
                        <div class="h-8 w-8 shrink-0 flex items-center justify-center rounded-md border border-zinc-100 bg-zinc-50 text-zinc-950">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4">
                                <path fill-rule="evenodd" d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003ZM12 8.25a.75.75 0 0 1 .75.75v3.75a.75.75 0 0 1-1.5 0V9a.75.75 0 0 1 .75-.75Zm0 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                    <div class="flex items-baseline justify-between mt-2">
                        <span class="text-3xl font-bold tracking-tight text-zinc-900 tabular-nums">
                            {{ $outOfStockCount + $lowStockCount }}
                        </span>
                        
                        <div class="flex gap-1.5 shrink-0">
                            @if ($outOfStockCount > 0)
                                <span class="inline-flex items-center rounded-md bg-red-50 px-2 py-0.5 text-xs font-bold text-red-700 ring-1 ring-inset ring-red-600/10">
                                    {{ $outOfStockCount }} หมด
                                </span>
                            @endif
                            @if ($lowStockCount > 0)
                                <span class="inline-flex items-center rounded-md bg-amber-50 px-2 py-0.5 text-xs font-bold text-amber-700 ring-1 ring-inset ring-amber-600/10">
                                    {{ $lowStockCount }} ใกล้หมด
                                </span>
                            @endif
                            @if ($outOfStockCount === 0 && $lowStockCount === 0)
                                <span class="inline-flex items-center rounded-md bg-emerald-50 px-2 py-0.5 text-xs font-bold text-emerald-700 ring-1 ring-inset ring-emerald-600/10">
                                    ✓ ปกติดี
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Blog Posts Card --}}
                <div class="group relative rounded-xl bg-white border border-zinc-200 p-6 shadow-sm hover:shadow-md transition-all duration-200">
                    <div class="flex items-center justify-between space-y-0 pb-2">
                        <p class="text-xs font-semibold uppercase tracking-wider text-zinc-500">บทความทั้งหมด</p>
                        <div class="h-8 w-8 shrink-0 flex items-center justify-center rounded-md border border-zinc-100 bg-zinc-50 text-zinc-950 group-hover:bg-zinc-900 group-hover:text-white transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-4 w-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
                            </svg>
                        </div>
                    </div>
                    <div class="flex items-baseline justify-between mt-2">
                        <div>
                            <span class="text-3xl font-bold tracking-tight text-zinc-900 tabular-nums">{{ number_format($postsCount) }}</span>
                            <span class="text-xs text-zinc-400 font-medium ml-1">บทความ</span>
                        </div>
                        <a href="{{ route('posts.create') }}" class="text-xs font-semibold text-zinc-500 hover:text-zinc-900 transition-colors opacity-0 group-hover:opacity-100">
                            + บทความ
                        </a>
                    </div>
                </div>

            </section>

            {{-- ─── Top Products + Category Chart ─── --}}
            <section class="grid grid-cols-1 lg:grid-cols-5 gap-6">

                {{-- Top Products by Views (3/5 width) --}}
                <div class="lg:col-span-3 rounded-xl bg-white border border-zinc-200 shadow-sm overflow-hidden flex flex-col">
                    <div class="flex items-center justify-between px-6 py-5 border-b border-zinc-100">
                        <div class="flex items-center gap-3">
                            <div class="flex h-8 w-8 items-center justify-center rounded-lg border border-zinc-100 bg-zinc-50 text-zinc-950">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-4 w-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-sm font-bold text-zinc-900">สินค้ายอดนิยม</h3>
                                <p class="text-xs text-zinc-400 font-medium">จัดอันดับตามยอดเข้าชม</p>
                            </div>
                        </div>
                        <a href="{{ route('products.index') }}" class="text-xs font-semibold text-zinc-500 hover:text-zinc-900 transition-colors">
                            ดูทั้งหมด →
                        </a>
                    </div>

                    @if ($topProducts->isEmpty())
                        <div class="flex-1 flex flex-col items-center justify-center py-16 gap-3 text-zinc-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-zinc-300">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                            </svg>
                            <p class="text-sm font-semibold">ยังไม่มีสินค้าในระบบ</p>
                        </div>
                    @else
                        @php $maxViews = $topProducts->first()->views ?: 1; @endphp
                        <div class="divide-y divide-zinc-100 flex-1">
                            @foreach ($topProducts as $index => $item)
                                <div class="flex items-center gap-4 px-6 py-4 hover:bg-zinc-50/50 transition-colors group/row">
                                    {{-- Rank (Badge clean style) --}}
                                    <span @class([
                                        'shrink-0 flex h-6 w-6 items-center justify-center rounded-full text-xs font-bold',
                                        'bg-zinc-900 text-white shadow-sm' => $index === 0,
                                        'bg-zinc-200 text-zinc-700' => $index === 1,
                                        'bg-zinc-100 text-zinc-600' => $index === 2,
                                        'text-zinc-400 bg-transparent' => $index > 2,
                                    ])>{{ $index + 1 }}</span>

                                    {{-- Thumbnail --}}
                                    @if ($item->image)
                                        <img src="{{ $item->image_url }}"
                                            alt="{{ $item->name }}"
                                            class="h-10 w-10 shrink-0 rounded-lg border border-zinc-200 object-cover bg-zinc-50">
                                    @else
                                        <div class="h-10 w-10 shrink-0 rounded-lg border border-zinc-200 bg-zinc-50 flex items-center justify-center text-[10px] font-bold text-zinc-400 border-dashed">
                                            N/A
                                        </div>
                                    @endif

                                    {{-- Name + Bar --}}
                                    <div class="flex-1 min-w-0">
                                        <a href="{{ route('products.edit', $item) }}"
                                            class="text-sm font-semibold text-zinc-900 hover:text-zinc-600 transition-colors truncate block tracking-tight">
                                            {{ $item->name }}
                                        </a>
                                        <div class="mt-1.5 flex items-center gap-3">
                                            <div class="flex-1 h-1.5 rounded-full bg-zinc-100 overflow-hidden">
                                                <div class="h-full rounded-full bg-zinc-900 transition-all duration-700"
                                                    style="width: {{ round(($item->views / $maxViews) * 100) }}%">
                                                </div>
                                            </div>
                                            <span class="text-xs text-zinc-400 tabular-nums shrink-0 font-medium">{{ number_format($item->views) }} views</span>
                                        </div>
                                    </div>

                                    {{-- Price + Stock status --}}
                                    <div class="text-right shrink-0">
                                        <p class="text-sm font-bold text-zinc-900">฿{{ number_format($item->price, 0) }}</p>
                                        <p class="text-xs font-semibold mt-1 uppercase tracking-wider
                                            {{ $item->quantity > 5 ? 'text-emerald-600' : ($item->quantity > 0 ? 'text-amber-600' : 'text-rose-600') }}">
                                            {{ $item->quantity > 0 ? $item->quantity . ' ชิ้น' : 'หมดแล้ว' }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- Category Distribution (2/5 width) --}}
                <div class="lg:col-span-2 rounded-xl bg-white border border-zinc-200 shadow-sm overflow-hidden flex flex-col"
                    x-data="{
                        cats: {{ json_encode($productsByCategory->map(fn($c) => ['name' => $c->name, 'count' => $c->products_count])) }},
                        colors: ['#09090b', '#71717a', '#a1a1aa', '#d4d4d8', '#e4e4e7', '#f4f4f5'],
                        get total() { return this.cats.reduce((s, c) => s + c.count, 0) || 1 },
                        pct(n) { return Math.round((n / this.total) * 100) }
                    }">
                    <div class="flex items-center gap-3 px-6 py-5 border-b border-zinc-100">
                        <div class="flex h-8 w-8 items-center justify-center rounded-lg border border-zinc-100 bg-zinc-50 text-zinc-950">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-4 w-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-zinc-900">สัดส่วนตามหมวดหมู่</h3>
                            <p class="text-xs text-zinc-400 font-medium">จำนวนสินค้าในแต่ละหมวด</p>
                        </div>
                    </div>

                    @if ($productsByCategory->isEmpty())
                        <div class="flex-1 flex flex-col items-center justify-center py-16 gap-3 text-zinc-400">
                            <p class="text-sm font-semibold">ยังไม่มีหมวดหมู่</p>
                        </div>
                    @else
                        <div class="p-6 flex-1 flex flex-col justify-between space-y-6">
                            
                            {{-- Minimal Segmented Bar --}}
                            <div class="space-y-2">
                                <div class="flex h-4 w-full overflow-hidden rounded-md gap-0.5 bg-zinc-100">
                                    <template x-for="(c, i) in cats" :key="i">
                                        <div class="h-full transition-all duration-1000 ease-out"
                                            :style="`width:${pct(c.count)}%; background:${colors[i % colors.length]}`"
                                            :title="`${c.name}: ${c.count}`"></div>
                                    </template>
                                </div>
                                <p class="text-xs text-zinc-400 font-medium">แสดงสัดส่วนจากสินค้าทั้งหมดในระบบ</p>
                            </div>

                            {{-- Clean Legend List --}}
                            <ul class="space-y-3 flex-1 overflow-y-auto max-h-56 pr-1">
                                <template x-for="(c, i) in cats" :key="i">
                                    <li class="flex items-center gap-3">
                                        <span class="h-2.5 w-2.5 shrink-0 rounded-full border border-zinc-200"
                                            :style="`background:${colors[i % colors.length]}`"></span>
                                        <span class="flex-1 text-sm font-medium text-zinc-600 truncate" x-text="c.name"></span>
                                        <div class="flex items-center gap-1.5 shrink-0">
                                            <span class="text-xs font-bold text-zinc-900 tabular-nums" x-text="c.count + ' ชิ้น'"></span>
                                            <span class="text-[10px] font-semibold text-zinc-400 tabular-nums" x-text="`(${pct(c.count)}%)`"></span>
                                        </div>
                                    </li>
                                </template>
                            </ul>

                            <div class="pt-4 border-t border-zinc-100 flex items-center justify-between">
                                <span class="text-xs text-zinc-500 font-medium">รวมทั้งสิ้น</span>
                                <span class="text-sm font-bold text-zinc-900" x-text="total + ' รายการ'"></span>
                            </div>
                        </div>
                    @endif
                </div>
            </section>

            {{-- ─── Recent Products + Recent Posts ─── --}}
            <section class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                {{-- Recent Products --}}
                <div class="rounded-xl bg-white border border-zinc-200 shadow-sm overflow-hidden flex flex-col">
                    <div class="flex items-center justify-between px-6 py-5 border-b border-zinc-100">
                        <div class="flex items-center gap-3">
                            <div class="flex h-8 w-8 items-center justify-center rounded-lg border border-zinc-100 bg-zinc-50 text-zinc-950">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-4 w-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                            </div>
                            <h3 class="text-sm font-bold text-zinc-900">สินค้าที่เพิ่มล่าสุด</h3>
                        </div>
                        <a href="{{ route('products.create') }}"
                            class="inline-flex items-center gap-1.5 rounded-lg border border-zinc-200 bg-white px-3 py-1.5 text-xs font-semibold text-zinc-700 hover:bg-zinc-50 hover:text-zinc-950 transition-colors shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3 h-3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            เพิ่มสินค้า
                        </a>
                    </div>

                    @if ($recentProducts->isEmpty())
                        <div class="flex-1 flex flex-col items-center justify-center py-14 text-zinc-400 gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-zinc-300">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007Z" />
                            </svg>
                            <p class="text-sm font-semibold">ยังไม่มีสินค้า</p>
                        </div>
                    @else
                        <ul class="divide-y divide-zinc-100 flex-1">
                            @foreach ($recentProducts as $product)
                                <li class="group/item flex items-center gap-4 px-6 py-4 hover:bg-zinc-50/50 transition-colors">
                                    @if ($product->image)
                                        <img src="{{ $product->image_url }}"
                                            alt="{{ $product->name }}"
                                            class="h-10 w-10 shrink-0 rounded-lg border border-zinc-200 object-cover bg-zinc-50">
                                    @else
                                        <div class="h-10 w-10 shrink-0 rounded-lg border border-zinc-200 bg-zinc-50 flex items-center justify-center text-[10px] font-bold text-zinc-400 border-dashed">
                                            N/A
                                        </div>
                                    @endif
                                    
                                    <div class="flex-1 min-w-0">
                                        <a href="{{ route('products.edit', $product) }}"
                                            class="text-sm font-semibold text-zinc-900 group-hover/item:text-zinc-600 transition-colors truncate block tracking-tight">
                                            {{ $product->name }}
                                        </a>
                                        <p class="text-xs text-zinc-400 mt-1 flex items-center gap-1.5 font-medium">
                                            <span class="inline-flex items-center rounded bg-zinc-100 px-1.5 py-0.5 text-[10px] font-bold text-zinc-800">
                                                {{ $product->category?->name ?? 'ไม่มีหมวดหมู่' }}
                                            </span>
                                            <span>•</span>
                                            <span>{{ $product->created_at->diffForHumans() }}</span>
                                        </p>
                                    </div>
                                    
                                    <div class="text-right shrink-0 space-y-1.5">
                                        <p class="text-sm font-bold text-zinc-900">฿{{ number_format($product->price, 0) }}</p>
                                        <span @class([
                                            'inline-flex items-center rounded-md px-2 py-0.5 text-[10px] font-bold ring-1 ring-inset',
                                            'text-emerald-700 bg-emerald-50 ring-emerald-600/10' => $product->quantity > 5,
                                            'text-amber-700 bg-amber-50 ring-amber-600/10' => $product->quantity > 0 && $product->quantity <= 5,
                                            'text-red-700 bg-red-50 ring-red-600/10' => $product->quantity === 0,
                                        ])>{{ $product->quantity > 0 ? $product->quantity . ' ชิ้น' : 'หมด' }}</span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <div class="px-6 py-4 border-t border-zinc-100">
                            <a href="{{ route('products.index') }}" class="text-xs font-semibold text-zinc-500 hover:text-zinc-900 transition-colors">
                                ดูสินค้าทั้งหมด ({{ $productsCount }}) →
                            </a>
                        </div>
                    @endif
                </div>

                {{-- Recent Posts --}}
                <div class="rounded-xl bg-white border border-zinc-200 shadow-sm overflow-hidden flex flex-col">
                    <div class="flex items-center justify-between px-6 py-5 border-b border-zinc-100">
                        <div class="flex items-center gap-3">
                            <div class="flex h-8 w-8 items-center justify-center rounded-lg border border-zinc-100 bg-zinc-50 text-zinc-950">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-4 w-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                </svg>
                            </div>
                            <h3 class="text-sm font-bold text-zinc-900">บทความที่เพิ่มล่าสุด</h3>
                        </div>
                        <a href="{{ route('posts.create') }}"
                            class="inline-flex items-center gap-1.5 rounded-lg border border-zinc-200 bg-white px-3 py-1.5 text-xs font-semibold text-zinc-700 hover:bg-zinc-50 hover:text-zinc-950 transition-colors shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3 h-3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            เพิ่มบทความ
                        </a>
                    </div>

                    @if ($recentPosts->isEmpty())
                        <div class="flex-1 flex flex-col items-center justify-center py-14 text-zinc-400 gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-zinc-300">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
                            </svg>
                            <p class="text-sm font-semibold">ยังไม่มีบทความ</p>
                        </div>
                    @else
                        <ul class="divide-y divide-zinc-100 flex-1">
                            @foreach ($recentPosts as $post)
                                <li class="group/item flex items-start gap-4 px-6 py-4 hover:bg-zinc-50/50 transition-colors">
                                    <div class="shrink-0 flex h-10 w-10 items-center justify-center rounded-lg border border-zinc-200 bg-zinc-50 font-bold text-zinc-800 text-sm">
                                        {{ mb_strtoupper(mb_substr($post->title, 0, 1)) }}
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <a href="{{ route('posts.edit', $post) }}"
                                            class="text-sm font-semibold text-zinc-900 group-hover/item:text-zinc-600 transition-colors line-clamp-1 block tracking-tight">
                                            {{ $post->title }}
                                        </a>
                                        <p class="text-xs text-zinc-400 mt-1 flex items-center gap-1.5 font-medium">
                                            <span class="inline-flex items-center rounded bg-zinc-100 px-1.5 py-0.5 text-[10px] font-bold text-zinc-800">
                                                {{ $post->category?->name ?? 'ไม่มีหมวดหมู่' }}
                                            </span>
                                            <span>•</span>
                                            <span>{{ $post->created_at->diffForHumans() }}</span>
                                        </p>
                                        @if ($post->text)
                                            <p class="text-xs text-zinc-500 line-clamp-1 mt-1.5 font-medium">
                                                {{ Str::limit($post->text, 100) }}
                                            </p>
                                        @endif
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <div class="px-6 py-4 border-t border-zinc-100">
                            <a href="{{ route('posts.index') }}" class="text-xs font-semibold text-zinc-500 hover:text-zinc-900 transition-colors">
                                ดูบทความทั้งหมด ({{ $postsCount }}) →
                            </a>
                        </div>
                    @endif
                </div>

            </section>

            {{-- ─── Quick Action Shortcuts ─── --}}
            <section>
                <p class="text-xs font-bold uppercase tracking-wider text-zinc-400 mb-4">จัดการระบบ</p>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                    @php
                        // Clean explicit styling details for shadcn design
                        $shortcuts = [
                            [
                                'route' => 'products.index',
                                'label' => 'จัดการสินค้า',
                                'desc' => 'เพิ่ม/แก้ไข/ลบ',
                                'icon' => 'M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007Z',
                            ],
                            [
                                'route' => 'categories.index',
                                'label' => 'จัดการหมวดหมู่',
                                'desc' => 'หมวดสินค้า/โพสต์',
                                'icon' => 'M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z',
                            ],
                            [
                                'route' => 'posts.index',
                                'label' => 'จัดการบทความ',
                                'desc' => 'เนื้อหาและบล็อก',
                                'icon' => 'M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z',
                            ],
                            [
                                'route' => 'shop',
                                'label' => 'ดูหน้าร้านค้า',
                                'desc' => 'มุมมองลูกค้า',
                                'icon' => 'M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z',
                            ],
                        ];
                    @endphp

                    @foreach ($shortcuts as $sc)
                        <a href="{{ route($sc['route']) }}"
                            class="group flex items-center gap-4 rounded-xl border border-zinc-200 bg-white p-5 shadow-sm transition-all duration-200 hover:shadow-md hover:border-zinc-300">
                            <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg border border-zinc-100 bg-zinc-50 text-zinc-950 group-hover:bg-zinc-900 group-hover:text-white transition-colors duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2" stroke="currentColor" class="h-4 w-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $sc['icon'] }}" />
                                </svg>
                            </span>
                            <div class="min-w-0">
                                <p class="text-sm font-semibold text-zinc-900 group-hover:text-zinc-700 transition-colors tracking-tight">
                                    {{ $sc['label'] }}
                                </p>
                                <p class="text-[11px] text-zinc-400 font-medium mt-0.5">{{ $sc['desc'] }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>

        </div>
    </div>
</x-app-layout>
