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
                        500
                    </h3>
                </div>

                <!-- Ikon -->
                <div
                    class="p-3 bg-blue-50 dark:bg-blue-900/30 rounded-2xl text-blue-600 dark:text-blue-400 shrink-0"
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
                            1000
                        </h3>
                    </div>

                    <!-- Ikon -->
                    <div
                        class="p-3 bg-blue-50 dark:bg-blue-900/30 rounded-2xl text-blue-600 dark:text-blue-400 shrink-0"
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
                                d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"
                            />
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
                            24
                        </h3>
                    </div>

                    <!-- Ikon -->
                    <div
                        class="p-3 bg-blue-50 dark:bg-blue-900/30 rounded-2xl text-blue-600 dark:text-blue-400 shrink-0"
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
            class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6"
        >
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-bold text-gray-900 dark:text-white">
                    Statistik Penjualan
                </h2>
                <a
                    href="/reports"
                    class="text-sm font-medium text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300"
                >
                    View Report
                </a>
            </div>
            <!-- Simple CSS Chart Representation -->
            <div
                class="h-64 flex items-end justify-between space-x-2 pt-4 mt-20"
            >
                <div class="w-full flex flex-col items-center group">
                    <div
                        class="w-full bg-blue-100 dark:bg-blue-900/40 rounded-t-md h-32 relative group-hover:bg-blue-200 dark:group-hover:bg-blue-800/60 transition"
                    >
                        <div
                            class="absolute top-10 left-1/2 transform -translate-x-1/2 bg-gray-800 dark:bg-gray-700 text-white text-xs py-1 px-2 rounded opacity-0 group-hover:opacity-100 transition pointer-events-none"
                        >
                            Rp1.2M
                        </div>
                    </div>
                    <span class="text-xs text-gray-500 dark:text-gray-400 mt-2"
                        >Sen</span
                    >
                </div>
                <div class="w-full flex flex-col items-center group">
                    <div
                        class="w-full bg-blue-500 dark:bg-blue-600 rounded-t-md h-48 relative group-hover:bg-blue-600 dark:group-hover:bg-blue-500 transition"
                    >
                        <div
                            class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-gray-800 dark:bg-gray-700 text-white text-xs py-1 px-2 rounded opacity-0 group-hover:opacity-100 transition pointer-events-none"
                        >
                            Rp1.8M
                        </div>
                    </div>
                    <span
                        class="text-xs font-bold text-gray-800 dark:text-gray-200 mt-2"
                        >Sel</span
                    >
                </div>
                <div class="w-full flex flex-col items-center group">
                    <div
                        class="w-full bg-blue-100 dark:bg-blue-900/40 rounded-t-md h-24 relative group-hover:bg-blue-200 dark:group-hover:bg-blue-800/60 transition"
                    >
                        <div
                            class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-gray-800 dark:bg-gray-700 text-white text-xs py-1 px-2 rounded opacity-0 group-hover:opacity-100 transition pointer-events-none"
                        >
                            Rp0.9M
                        </div>
                    </div>
                    <span class="text-xs text-gray-500 dark:text-gray-400 mt-2"
                        >Rab</span
                    >
                </div>
                <div class="w-full flex flex-col items-center group">
                    <div
                        class="w-full bg-blue-100 dark:bg-blue-900/40 rounded-t-md h-36 relative group-hover:bg-blue-200 dark:group-hover:bg-blue-800/60 transition"
                    >
                        <div
                            class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-gray-800 dark:bg-gray-700 text-white text-xs py-1 px-2 rounded opacity-0 group-hover:opacity-100 transition pointer-events-none"
                        >
                            Rp1.4M
                        </div>
                    </div>
                    <span class="text-xs text-gray-500 dark:text-gray-400 mt-2"
                        >Kam</span
                    >
                </div>
                <div class="w-full flex flex-col items-center group">
                    <div
                        class="w-full bg-blue-100 dark:bg-blue-900/40 rounded-t-md h-56 relative group-hover:bg-blue-200 dark:group-hover:bg-blue-800/60 transition"
                    >
                        <div
                            class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-gray-800 dark:bg-gray-700 text-white text-xs py-1 px-2 rounded opacity-0 group-hover:opacity-100 transition pointer-events-none"
                        >
                            Rp2.1M
                        </div>
                    </div>
                    <span class="text-xs text-gray-500 dark:text-gray-400 mt-2"
                        >Jum</span
                    >
                </div>
                <div class="w-full flex flex-col items-center group">
                    <div
                        class="w-full bg-blue-100 dark:bg-blue-900/40 rounded-t-md h-64 relative group-hover:bg-blue-200 dark:group-hover:bg-blue-800/60 transition"
                    >
                        <div
                            class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-gray-800 dark:bg-gray-700 text-white text-xs py-1 px-2 rounded opacity-0 group-hover:opacity-100 transition pointer-events-none"
                        >
                            Rp2.5M
                        </div>
                    </div>
                    <span class="text-xs text-gray-500 dark:text-gray-400 mt-2"
                        >Sab</span
                    >
                </div>
                <div class="w-full flex flex-col items-center group">
                    <div
                        class="w-full bg-blue-100 dark:bg-blue-900/40 rounded-t-md h-40 relative group-hover:bg-blue-200 dark:group-hover:bg-blue-800/60 transition"
                    >
                        <div
                            class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-gray-800 dark:bg-gray-700 text-white text-xs py-1 px-2 rounded opacity-0 group-hover:opacity-100 transition pointer-events-none"
                        >
                            Rp1.5M
                        </div>
                    </div>
                    <span class="text-xs text-gray-500 dark:text-gray-400 mt-2"
                        >Min</span
                    >
                </div>
            </div>
        </div>

        <!-- Best Selling Menu -->
        <div
            class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6"
        >
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-bold text-gray-900 dark:text-white">
                    Menu Yang Laris
                </h2>
            </div>

            <div class="space-y-5">
                <!-- Menu Item 1 -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div
                            class="w-16 h-14 rounded-lg bg-orange-100 dark:bg-orange-900/40 flex items-center justify-center text-xl shadow-sm"
                        >
                            <img
                                src="{{
                                    asset('assets/img/MIE AYAM.jpeg')
                                }}"
                                alt="Mie Ayam"
                                class="w-full h-full object-cover rounded-lg"
                            />
                        </div>
                        <div class="ml-4">
                            <h4
                                class="text-sm font-bold text-gray-900 dark:text-white"
                            >
                                Mie Goreng Spesial
                            </h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                124 pesanan
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Menu Item 2 -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div
                            class="w-16 h-14 rounded-lg bg-red-100 dark:bg-red-900/30 flex items-center justify-center text-xl shadow-sm"
                        >
                            <img
                                src="{{
                                    asset('assets/img/NASI GORENG AYAM.jpg')
                                }}"
                                alt="Nasi Goreng"
                                class="w-full h-full object-cover rounded-lg"
                            />
                        </div>
                        <div class="ml-4">
                            <h4
                                class="text-sm font-bold text-gray-900 dark:text-white"
                            >
                                Nasi Goreng Ayam
                            </h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                98 pesanan
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Menu Item 3 -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div
                            class="w-16 h-14 rounded-lg bg-yellow-100 dark:bg-yellow-900/30 flex items-center justify-center text-xl shadow-sm"
                        >
                            <img
                                src="{{
                                    asset('assets/img/ES JERUK.jpg')
                                }}"
                                alt="Es Jeruk Segar"
                                class="w-full h-full object-cover rounded-lg"
                            />
                        </div>
                        <div class="ml-4">
                            <h4
                                class="text-sm font-bold text-gray-900 dark:text-white"
                            >
                                Es Jeruk Segar
                            </h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                85 pesanan
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Menu Item 4 -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div
                            class="w-16 h-14 rounded-lg bg-green-100 dark:bg-green-900/30 flex items-center justify-center text-xl shadow-sm"
                        >
                            <img
                                src="{{
                                    asset('assets/img/GADO GADO.jpg')
                                }}"
                                alt="Gado-Gado"
                                class="w-full h-full object-cover rounded-lg"
                            />
                        </div>
                        <div class="ml-4">
                            <h4
                                class="text-sm font-bold text-gray-900 dark:text-white"
                            >
                                Gado-Gado
                            </h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                64 pesanan
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <button
                class="w-full mt-6 py-2 border border-gray-200 dark:border-gray-700 rounded-lg text-sm font-medium text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition"
            >
                Lihat Semua Menu
            </button>
        </div>
    </div>
</x-layout>
