@props(['topSelling' => []])

<div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
    
    <!-- Best Selling Menu Items (7 Cols) -->
    <div class="lg:col-span-7 bg-white dark:bg-gray-800 p-5 sm:p-6 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-2xs">
        <div class="flex items-center justify-between mb-5">
            <div>
                <h2 class="text-base sm:text-lg font-bold text-gray-900 dark:text-white">Top 5 Menu Paling Laris</h2>
                <p class="text-xs text-gray-500 dark:text-gray-400">Kontributor volume penjualan tertinggi periode ini</p>
            </div>
            <span class="text-xs font-semibold px-2.5 py-1 bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 rounded-lg">Bulan Ini</span>
        </div>

        <div class="space-y-4">
            @php
                $maxSold = count($topSelling) > 0 ? max($topSelling->pluck('sold')->toArray()) : 1;
                if ($maxSold <= 0) $maxSold = 1;
                $colors = ['bg-amber-500', 'bg-gray-400', 'bg-amber-700', 'bg-blue-500', 'bg-emerald-500'];
            @endphp
            
            @forelse($topSelling as $index => $item)
            @php
                $percentage = min(100, round(($item->sold / $maxSold) * 100));
                $badgeColor = $colors[$index] ?? 'bg-blue-600';
                $totalEstimated = $item->sold * $item->price;
            @endphp
            <div class="flex items-center gap-3.5 p-2.5 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                <span class="w-6 h-6 flex items-center justify-center rounded-full {{ $badgeColor }} text-white font-bold text-xs shrink-0 shadow-2xs">{{ $index + 1 }}</span>
                <img src="{{ $item->image ? (str_starts_with($item->image, 'http') ? $item->image : asset($item->image)) : 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=100' }}" alt="{{ $item->name }}" class="w-12 h-12 rounded-xl object-cover ring-1 ring-gray-200 dark:ring-gray-700" />
                <div class="flex-1 min-w-0">
                    <div class="flex items-center justify-between gap-2">
                        <h4 class="text-sm font-bold text-gray-900 dark:text-white truncate">{{ $item->name }}</h4>
                        <span class="text-sm font-bold text-blue-600 dark:text-blue-400">Rp {{ number_format($totalEstimated, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex items-center justify-between text-xs text-gray-500 dark:text-gray-400 mt-1">
                        <span>{{ $item->sold }} Porsi Terjual</span>
                        <span class="text-xs font-medium text-emerald-600 dark:text-emerald-400">Kategori: {{ $item->category ? $item->category->name : '-' }}</span>
                    </div>
                    <!-- Progress Bar -->
                    <div class="w-full bg-gray-100 dark:bg-gray-700 h-1.5 rounded-full mt-1.5 overflow-hidden">
                        <div class="bg-blue-600 h-1.5 rounded-full" style="width: {{ $percentage }}%"></div>
                    </div>
                </div>
            </div>
            @empty
            <p class="text-xs text-gray-400 text-center py-4">Belum ada data menu terlaris</p>
            @endforelse

        </div>
    </div>

    <!-- Peak Hours & Operational Analytics (5 Cols) -->
    <div class="lg:col-span-5 bg-white dark:bg-gray-800 p-5 sm:p-6 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-2xs flex flex-col justify-between">
        <div>
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h2 class="text-base sm:text-lg font-bold text-gray-900 dark:text-white">Jam Sibuk Restoran</h2>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Distribusi rata-rata kunjungan & transaksi per jam</p>
                </div>
            </div>
            
            <div id="peak-hours-chart" class="w-full min-h-[200px]"></div>
        </div>

        <div class="mt-4 pt-4 border-t border-gray-100 dark:border-gray-700 space-y-2.5">
            <div class="flex items-center justify-between text-xs">
                <span class="text-gray-500 dark:text-gray-400 flex items-center gap-1.5">
                    <span class="w-2.5 h-2.5 rounded-full bg-red-500"></span> Jam Paling Ramai:
                </span>
                <span class="font-bold text-gray-900 dark:text-white">12:00 - 13:30 (Makan Siang)</span>
            </div>
            <div class="flex items-center justify-between text-xs">
                <span class="text-gray-500 dark:text-gray-400 flex items-center gap-1.5">
                    <span class="w-2.5 h-2.5 rounded-full bg-blue-500"></span> Jam Ramai Malam:
                </span>
                <span class="font-bold text-gray-900 dark:text-white">18:30 - 20:30 (Makan Malam)</span>
            </div>
            <div class="p-2.5 bg-blue-50 dark:bg-blue-900/20 text-blue-700 dark:text-blue-300 rounded-xl text-xs flex items-center gap-2">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Rekomendasi: Tambah 1 kasir & stok bahan pada pk 11:30 & 18:00</span>
            </div>
        </div>
    </div>

</div>
