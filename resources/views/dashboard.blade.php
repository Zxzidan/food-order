<x-layout>
    <x-slot:title>
        {{ $title }}
    </x-slot:title>

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
            Welcome back, {{ $nama ?? "Admin" }}! 👋
        </h1>
        <br />
        <p class="text-gray-600 dark:text-gray-400 mt-1">
            Here is what's happening with your restaurant today.
        </p>
    </div>

    <!-- Stats Row -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7 mb-7">
        <!-- Customer Stat -->
        <div
            class="bg-white dark:bg-gray-800 p-5 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm"
        >
            <!-- Baris Atas: Teks + Angka di Kiri, Ikon di Kanan -->
            <div class="flex items-start justify-between">
                <div>
                    <p
                        class="text-sm font-medium text-gray-500 dark:text-gray-400 whitespace-nowrap"
                    >
                        Total Pelanggan
                    </p>
                    <h3
                        class="text-3xl font-bold text-gray-900 dark:text-white mt-2"
                    >
                        {{ number_format($totalCustomers ?? 0) }}
                    </h3>
                </div>

                <!-- Ikon -->
                <div
                    class="p-3 bg-orange-50 dark:bg-orange-950/30 rounded-2xl text-orange-600 dark:text-orange-400 shrink-0"
                >
                    <svg
                        class="w-6 h-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"
                        ></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Orders Stat -->
        <div
            class="bg-white dark:bg-gray-800 p-5 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm"
        >
            <div>
                <div class="flex items-start justify-between">
                    <div>
                        <p
                            class="text-sm font-medium text-gray-500 dark:text-gray-400 whitespace-nowrap"
                        >
                            Total Pesanan
                        </p>
                        <h3
                            class="text-3xl font-bold text-gray-900 dark:text-white mt-2"
                        >
                            {{ number_format($totalOrders ?? 0) }}
                        </h3>
                    </div>

                    <!-- Ikon -->
                    <div
                        class="p-3 bg-orange-50 dark:bg-orange-950/30 rounded-2xl text-orange-600 dark:text-orange-400 shrink-0"
                    >
                        <svg
                            class="w-6 h-6"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"
                            ></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Menu Available -->
        <div
            class="bg-white dark:bg-gray-800 p-5 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm"
        >
            <div>
                <div class="flex items-start justify-between">
                    <div>
                        <p
                            class="text-sm font-medium text-gray-500 dark:text-gray-400 whitespace-nowrap"
                        >
                            Menu Tersedia
                        </p>
                        <h3
                            class="text-3xl font-bold text-gray-900 dark:text-white mt-2"
                        >
                            {{ number_format($menusAvailable ?? 0) }}
                        </h3>
                    </div>

                    <!-- Ikon -->
                    <div
                        class="p-3 bg-orange-50 dark:bg-orange-950/30 rounded-2xl text-orange-600 dark:text-orange-400 shrink-0"
                    >
                        <svg
                            class="w-6 h-6"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                strokeLinecap="round"
                                strokeLinejoin="round"
                                d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25"
                            />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts and Tables Row -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Sales Statistics -->
        <div
            class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 flex flex-col justify-between"
        >
            <div class="flex flex-wrap justify-between items-center gap-2 mb-4">
                <div>
                    <h2 class="text-lg font-bold text-gray-900 dark:text-white">
                        Statistik Penjualan
                    </h2>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">
                        Total Penjualan Minggu Ini: <span class="font-bold text-orange-600 dark:text-orange-400">Rp {{ number_format(array_sum(array_column($weeklySales, 'total')), 0, ',', '.') }}</span>
                    </p>
                </div>
                <a
                    href="/reports"
                    class="text-sm font-semibold text-orange-600 dark:text-orange-400 hover:text-orange-700 dark:hover:text-orange-300 inline-flex items-center gap-1 transition"
                >
                    <span>View Report</span>
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
            <!-- Simple CSS Chart Representation -->
            <div
                class="h-64 flex items-end justify-between space-x-2 pt-8 pb-1"
            >
                @php
                    $maxTotal = count($weeklySales) > 0 ? max(array_column($weeklySales, 'total')) : 0;
                @endphp
                
                @foreach($weeklySales as $sale)
                @php
                    $hasSales = $sale['total'] > 0;
                    // Calculate height percentage relative to max, min 14% if has sales, min 6% if 0
                    $heightPercent = ($maxTotal > 0 && $hasSales) ? max(14, round(($sale['total'] / $maxTotal) * 100)) : 6;
                    $isToday = $sale['day'] === \Illuminate\Support\Carbon::today()->translatedFormat('D');
                @endphp
                <div class="w-full h-full flex flex-col justify-end items-center group relative">
                    <!-- Value Label Above Bar -->
                    @if($hasSales)
                        <span class="text-[10px] font-bold text-gray-700 dark:text-gray-300 mb-1.5 transition-transform group-hover:scale-110 whitespace-nowrap">
                            {{ $sale['formatted'] }}
                        </span>
                    @endif

                    <div
                        class="w-full {{ $isToday ? 'bg-gradient-to-t from-orange-600 to-orange-500 shadow-md shadow-orange-500/20' : ($hasSales ? 'bg-gradient-to-t from-orange-300 to-orange-200 dark:from-orange-900/60 dark:to-orange-800/40 hover:from-orange-400 hover:to-orange-300' : 'bg-gray-100 dark:bg-gray-700/40') }} rounded-t-md relative transition-all duration-300"
                        style="height: {{ $heightPercent }}%; min-height: 10px;"
                    >
                        <div
                            class="absolute -top-9 left-1/2 transform -translate-x-1/2 bg-gray-900 text-white text-xs py-1 px-2 rounded-lg opacity-0 group-hover:opacity-100 transition pointer-events-none whitespace-nowrap z-20 shadow-lg font-medium"
                        >
                            {{ $sale['day'] }}: {{ $sale['raw_formatted'] }}
                        </div>
                    </div>
                    <span class="text-xs {{ $isToday ? 'font-bold text-orange-600 dark:text-orange-400' : 'text-gray-500 dark:text-gray-400' }} mt-2 select-none"
                        >{{ $sale['day'] }}</span
                    >
                </div>
                @endforeach
            </div>
        </div>

        <!-- Best Selling Menu -->
        <div
            class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6"
        >
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-bold text-gray-900 dark:text-white">
                    Top 5 Menu Paling Laris
                </h2>
                <span class="text-xs font-semibold px-2.5 py-1 bg-orange-50 dark:bg-orange-950/40 text-orange-600 dark:text-orange-400 rounded-lg">Terlaris</span>
            </div>

            <div class="space-y-4">
                @forelse($bestSellingMenus as $index => $bestMenu)
                <div class="flex items-center justify-between p-2 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                    <div class="flex items-center min-w-0">
                        <span class="w-5 h-5 flex items-center justify-center rounded-full bg-orange-100 dark:bg-orange-900/50 text-orange-600 dark:text-orange-400 font-bold text-xs shrink-0 mr-2.5">{{ $index + 1 }}</span>
                        <div
                            class="w-12 h-12 rounded-lg bg-orange-100 dark:bg-orange-900/40 flex items-center justify-center text-xl shadow-xs overflow-hidden shrink-0"
                        >
                            <img
                                src="{{ $bestMenu->image_url }}"
                                alt="{{ $bestMenu->name }}"
                                class="w-full h-full object-cover rounded-lg"
                                onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=200';"
                            />
                        </div>
                        <div class="ml-3 min-w-0">
                            <h4
                                class="text-sm font-bold text-gray-900 dark:text-white truncate"
                            >
                                {{ $bestMenu->name }}
                            </h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                {{ $bestMenu->sold }} pesanan terjual
                            </p>
                        </div>
                    </div>
                    <div class="text-right shrink-0 ml-2">
                        <span class="text-xs font-bold text-orange-600 dark:text-orange-400">
                            Rp {{ number_format($bestMenu->price, 0, ',', '.') }}
                        </span>
                    </div>
                </div>
                @empty
                <p class="text-xs text-gray-400 text-center py-4">Belum ada data menu terlaris</p>
                @endforelse
            </div>

            <a
                href="/menu"
                class="block text-center w-full mt-6 py-2 border border-gray-200 dark:border-gray-700 rounded-lg text-sm font-medium text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition"
            >
                Lihat Semua Menu
            </a>
        </div>
    </div>
</x-layout>
