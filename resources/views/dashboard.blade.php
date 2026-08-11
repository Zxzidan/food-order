<x-layout>
    <x-slot:title>
        {{ $title }}
    </x-slot:title>

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Welcome back, {{ $nama ?? 'Admin' }}! 👋</h1><br>
        <p class="text-gray-600 dark:text-gray-400 mt-1">Here is what's happening with your restaurant today.</p>
    </div>

    <!-- Stats Row -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Customer Stat -->
        <div
            class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-100 dark:border-gray-700 flex items-center justify-between transition hover:shadow-md">
            <div>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Total Customers</p><br>
                <h3 class="text-3xl font-bold text-gray-900 dark:text-white">1,248</h3><br>
                <p class="text-sm font-medium text-green-600 dark:text-green-400 mt-2 flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                    +12% <span class="text-gray-400 dark:text-gray-500 ml-1 font-normal">from last month</span>
                </p>
            </div>
            <div class="p-4 bg-blue-50 dark:bg-blue-900/30 rounded-lg text-blue-600 dark:text-blue-400">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-8 h-8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                </svg>

            </div>
        </div>

        <!-- Orders Stat -->
        <div
            class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-100 dark:border-gray-700 flex items-center justify-between transition hover:shadow-md">
            <div>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Total Orders</p><br>
                <h3 class="text-3xl font-bold text-gray-900 dark:text-white">456</h3><br>
                <p class="text-sm font-medium text-green-600 dark:text-green-400 mt-2 flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                    +8.5% <span class="text-gray-400 dark:text-gray-500 ml-1 font-normal">from last month</span>
                </p>
            </div>
            <div class="p-4 bg-purple-50 dark:bg-purple-900/30 rounded-lg text-purple-600 dark:text-purple-400">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
            </div>
        </div>

        <!-- Sales Stat -->
        <div
            class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-100 dark:border-gray-700 flex items-center justify-between transition hover:shadow-md">
            <div>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Total Sales</p><br>
                <h3 class="text-3xl font-bold text-gray-900 dark:text-white">Rp 12.5M</h3><br>
                <p class="text-sm font-medium text-green-600 dark:text-green-400 mt-2 flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                    +15% <span class="text-gray-400 dark:text-gray-500 ml-1 font-normal">from last month</span>
                </p>
            </div>
            <div class="p-4 bg-green-50 dark:bg-green-900/30 rounded-lg text-green-600 dark:text-green-400">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                    </path>
                </svg>
            </div>
        </div>

        <!-- Pending Stat -->
        <div
            class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-100 dark:border-gray-700 flex items-center justify-between transition hover:shadow-md">
            <div>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Pending Orders</p><br>
                <h3 class="text-3xl font-bold text-gray-900 dark:text-white">24</h3><br>
                <p class="text-sm font-medium text-red-500 dark:text-red-400 mt-2 flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Needs attention
                </p>
            </div>
            <div class="p-4 bg-orange-50 dark:bg-orange-900/30 rounded-lg text-orange-600 dark:text-orange-400">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                    </path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Charts and Tables Row -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Sales Statistics -->
        <div
            class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-bold text-gray-900 dark:text-white">Statistik Penjualan (Minggu Ini)</h2>
                <button
                    class="text-sm font-medium text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300">View
                    Report</button>
            </div>
            <!-- Simple CSS Chart Representation -->
            <div class="h-64 flex items-end justify-between space-x-2 pt-4">
                <div class="w-full flex flex-col items-center group">
                    <div
                        class="w-full bg-blue-100 dark:bg-blue-900/40 rounded-t-md h-32 relative group-hover:bg-blue-200 dark:group-hover:bg-blue-800/60 transition">
                        <div
                            class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-gray-800 dark:bg-gray-700 text-white text-xs py-1 px-2 rounded opacity-0 group-hover:opacity-100 transition pointer-events-none">
                            Rp1.2M</div>
                    </div>
                    <span class="text-xs text-gray-500 dark:text-gray-400 mt-2">Sen</span>
                </div>
                <div class="w-full flex flex-col items-center group">
                    <div
                        class="w-full bg-blue-500 dark:bg-blue-600 rounded-t-md h-48 relative group-hover:bg-blue-600 dark:group-hover:bg-blue-500 transition">
                        <div
                            class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-gray-800 dark:bg-gray-700 text-white text-xs py-1 px-2 rounded opacity-0 group-hover:opacity-100 transition pointer-events-none">
                            Rp1.8M</div>
                    </div>
                    <span class="text-xs font-bold text-gray-800 dark:text-gray-200 mt-2">Sel</span>
                </div>
                <div class="w-full flex flex-col items-center group">
                    <div
                        class="w-full bg-blue-100 dark:bg-blue-900/40 rounded-t-md h-24 relative group-hover:bg-blue-200 dark:group-hover:bg-blue-800/60 transition">
                        <div
                            class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-gray-800 dark:bg-gray-700 text-white text-xs py-1 px-2 rounded opacity-0 group-hover:opacity-100 transition pointer-events-none">
                            Rp0.9M</div>
                    </div>
                    <span class="text-xs text-gray-500 dark:text-gray-400 mt-2">Rab</span>
                </div>
                <div class="w-full flex flex-col items-center group">
                    <div
                        class="w-full bg-blue-100 dark:bg-blue-900/40 rounded-t-md h-36 relative group-hover:bg-blue-200 dark:group-hover:bg-blue-800/60 transition">
                        <div
                            class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-gray-800 dark:bg-gray-700 text-white text-xs py-1 px-2 rounded opacity-0 group-hover:opacity-100 transition pointer-events-none">
                            Rp1.4M</div>
                    </div>
                    <span class="text-xs text-gray-500 dark:text-gray-400 mt-2">Kam</span>
                </div>
                <div class="w-full flex flex-col items-center group">
                    <div
                        class="w-full bg-blue-100 dark:bg-blue-900/40 rounded-t-md h-56 relative group-hover:bg-blue-200 dark:group-hover:bg-blue-800/60 transition">
                        <div
                            class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-gray-800 dark:bg-gray-700 text-white text-xs py-1 px-2 rounded opacity-0 group-hover:opacity-100 transition pointer-events-none">
                            Rp2.1M</div>
                    </div>
                    <span class="text-xs text-gray-500 dark:text-gray-400 mt-2">Jum</span>
                </div>
                <div class="w-full flex flex-col items-center group">
                    <div
                        class="w-full bg-blue-100 dark:bg-blue-900/40 rounded-t-md h-64 relative group-hover:bg-blue-200 dark:group-hover:bg-blue-800/60 transition">
                        <div
                            class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-gray-800 dark:bg-gray-700 text-white text-xs py-1 px-2 rounded opacity-0 group-hover:opacity-100 transition pointer-events-none">
                            Rp2.5M</div>
                    </div>
                    <span class="text-xs text-gray-500 dark:text-gray-400 mt-2">Sab</span>
                </div>
                <div class="w-full flex flex-col items-center group">
                    <div
                        class="w-full bg-blue-100 dark:bg-blue-900/40 rounded-t-md h-40 relative group-hover:bg-blue-200 dark:group-hover:bg-blue-800/60 transition">
                        <div
                            class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-gray-800 dark:bg-gray-700 text-white text-xs py-1 px-2 rounded opacity-0 group-hover:opacity-100 transition pointer-events-none">
                            Rp1.5M</div>
                    </div>
                    <span class="text-xs text-gray-500 dark:text-gray-400 mt-2">Min</span>
                </div>
            </div>
        </div>

        <!-- Best Selling Menu -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-bold text-gray-900 dark:text-white">Menu Yang Laris</h2>
            </div>

            <div class="space-y-5">
                <!-- Menu Item 1 -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div
                            class="w-12 h-12 rounded-lg bg-orange-100 dark:bg-orange-900/30 flex items-center justify-center text-xl shadow-sm">
                            🍜
                        </div>
                        <div class="ml-4">
                            <h4 class="text-sm font-bold text-gray-900 dark:text-white">Mie Goreng Spesial</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400">124 pesanan</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-bold text-gray-900 dark:text-white">Rp 25.000</p>
                        <p class="text-xs text-green-500 dark:text-green-400 flex items-center justify-end"><svg
                                class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                            </svg> 12%</p>
                    </div>
                </div>

                <!-- Menu Item 2 -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div
                            class="w-12 h-12 rounded-lg bg-red-100 dark:bg-red-900/30 flex items-center justify-center text-xl shadow-sm">
                            🍚
                        </div>
                        <div class="ml-4">
                            <h4 class="text-sm font-bold text-gray-900 dark:text-white">Nasi Goreng Ayam</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400">98 pesanan</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-bold text-gray-900 dark:text-white">Rp 22.000</p>
                        <p class="text-xs text-green-500 dark:text-green-400 flex items-center justify-end"><svg
                                class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                            </svg> 8%</p>
                    </div>
                </div>

                <!-- Menu Item 3 -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div
                            class="w-12 h-12 rounded-lg bg-yellow-100 dark:bg-yellow-900/30 flex items-center justify-center text-xl shadow-sm">
                            🍹
                        </div>
                        <div class="ml-4">
                            <h4 class="text-sm font-bold text-gray-900 dark:text-white">Es Jeruk Segar</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400">85 pesanan</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-bold text-gray-900 dark:text-white">Rp 10.000</p>
                        <p class="text-xs text-green-500 dark:text-green-400 flex items-center justify-end"><svg
                                class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                            </svg> 5%</p>
                    </div>
                </div>

                <!-- Menu Item 4 -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div
                            class="w-12 h-12 rounded-lg bg-green-100 dark:bg-green-900/30 flex items-center justify-center text-xl shadow-sm">
                            🥗
                        </div>
                        <div class="ml-4">
                            <h4 class="text-sm font-bold text-gray-900 dark:text-white">Gado-Gado</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400">64 pesanan</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-bold text-gray-900 dark:text-white">Rp 18.000</p>
                        <p class="text-xs text-gray-400 dark:text-gray-500 flex items-center justify-end"><svg
                                class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4">
                                </path>
                            </svg> 0%</p>
                    </div>
                </div>
            </div>

            <button
                class="w-full mt-6 py-2 border border-gray-200 dark:border-gray-700 rounded-lg text-sm font-medium text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition">Lihat
                Semua Menu</button>
        </div>
    </div>
</x-layout>
