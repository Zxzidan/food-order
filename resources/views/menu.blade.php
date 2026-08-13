<x-layout>
    <x-slot:title>
        {{ $title }}
    </x-slot:title>


    <div class="flex items-center justify-between max-w-4xl mx-auto">
        <form class="flex-1 mr-4">
            <div class="flex shadow-xs rounded-base -space-x-0.5">
                <label for="search-dropdown" class="block mb-2.5 text-sm font-medium text-heading sr-only ">Your
                    Email</label>
                <button id="dropdown-button" data-dropdown-toggle="dropdown" type="button"
                    class="inline-flex items-center shrink-0 z-10 text-body bg-neutral-secondary-medium box-border border border-default-medium hover:bg-neutral-tertiary-medium hover:text-heading focus:ring-4 focus:ring-neutral-tertiary font-medium leading-5 rounded-s-base text-sm px-4 py-2.5 focus:outline-none">
                    <svg class="w-4 h-4 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.143 4H4.857A.857.857 0 0 0 4 4.857v4.286c0 .473.384.857.857.857h4.286A.857.857 0 0 0 10 9.143V4.857A.857.857 0 0 0 9.143 4Zm10 0h-4.286a.857.857 0 0 0-.857.857v4.286c0 .473.384.857.857.857h4.286A.857.857 0 0 0 20 9.143V4.857A.857.857 0 0 0 19.143 4Zm-10 10H4.857a.857.857 0 0 0-.857.857v4.286c0 .473.384.857.857.857h4.286a.857.857 0 0 0 .857-.857v-4.286A.857.857 0 0 0 9.143 14Zm10 0h-4.286a.857.857 0 0 0-.857.857v4.286c0 .473.384.857.857.857h4.286a.857.857 0 0 0 .857-.857v-4.286a.857.857 0 0 0-.857-.857Z" />
                    </svg>
                    All categories
                    <svg class="w-4 h-4 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 9-7 7-7-7" />
                    </svg>
                </button>
                <div id="dropdown"
                    class="z-10 hidden bg-neutral-primary-medium border border-default-medium rounded-base shadow-lg w-44">
                    <ul class="p-2 text-sm text-body font-medium" aria-labelledby="dropdown-button">
                        <li>
                            <a href="#"
                                class="block p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded-md">Appetizer</a>
                        </li>
                        <li>
                            <a href="#"
                                class="block p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded-md">Main
                                Course</a>
                        </li>
                        <li>
                            <a href="#"
                                class="block p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded-md">Dessert</a>
                        </li>
                        <li>
                            <a href="#"
                                class="block p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded-md">Drinks</a>
                        </li>
                    </ul>
                </div>
                <input type="search" id="search-dropdown" id="input-group-1"
                    class="px-3 py-2.5 bg-neutral-secondary-medium border border-default-medium text-heading text-sm focus:ring-brand focus:border-brand block w-full placeholder:text-body"
                    placeholder="Search for products" required>
                <button type="button"
                    class="inline-flex items-center  text-white bg-brand hover:bg-brand-strong box-border border border-transparent focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-e-base text-sm px-4 py-2.5 focus:outline-none">
                    <svg class="w-4 h-4 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                            d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                    </svg>
                    Search
                </button>
            </div>
        </form>
        <button type="button"
            class="inline-flex items-center text-white bg-green-600 hover:bg-green-700 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none focus:ring-4 focus:ring-green-300 shadow-sm">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Menu
        </button>
    </div>


    <!-- Makanan & Minuman Grid -->
    <div class="mb-6 py-8">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Daftar Menu Makanan & Minuman</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-4 gap-6 py-6">

            <!-- Item 1: Nasi Goreng -->
            <div
                class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden flex flex-col">
                <img src="{{ asset('build/assets/img/nasi goreng.png') }}" alt="Nasi Goreng"
                    class="w-66 h-50 object-cover">
                <div class="p-5 flex-1 flex flex-col">
                    <div class="flex justify-between items-start mb-5">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">Nasi Goreng Ayam</h3>
                        <span
                            class="bg-blue-100 text-blue-800 text-xs font-semibold px-3.5 py-1.5 rounded dark:bg-blue-200 dark:text-blue-900">Makanan</span>
                    </div>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-5 flex-1">Nasi goreng dengan telur, ayam
                        suwir, udang, dan bumbu spesial.</p>
                    <div class="flex items-center justify-between mt-auto">
                        <span class="text-xl font-bold text-gray-900 dark:text-white">Rp 35.000</span>
                        <button
                            class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Edit
                        </button>
                    </div>
                </div>
            </div>

            <!-- Item 2: Mie Goreng -->
            <div
                class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden flex flex-col">
                <img src="https://images.unsplash.com/photo-1612929633738-8fe01f7c8100?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60"
                    alt="Mie Goreng" class="w-full h-48 object-cover">
                <div class="p-5 flex-1 flex flex-col">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">Mie Goreng Seafood</h3>
                        <span
                            class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-900">Makanan</span>
                    </div>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-4 flex-1">Mie goreng dengan isian seafood
                        segar, sayuran, dan bumbu rahasia.</p>
                    <div class="flex items-center justify-between mt-auto">
                        <span class="text-xl font-bold text-gray-900 dark:text-white">Rp 40.000</span>
                        <button
                            class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Edit
                        </button>
                    </div>
                </div>
            </div>

            <!-- Item 3: Es Teh Manis -->
            <div
                class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden flex flex-col">
                <img src="https://images.unsplash.com/photo-1556679343-c7306c1976bc?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60"
                    alt="Es Teh Manis" class="w-full h-48 object-cover">
                <div class="p-5 flex-1 flex flex-col">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">Es Teh Manis</h3>
                        <span
                            class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-green-200 dark:text-green-900">Minuman</span>
                    </div>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-4 flex-1">Es teh manis segar dengan seduhan
                        teh melati pilihan.</p>
                    <div class="flex items-center justify-between mt-auto">
                        <span class="text-xl font-bold text-gray-900 dark:text-white">Rp 8.000</span>
                        <button
                            class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Edit
                        </button>
                    </div>
                </div>
            </div>

            <!-- Item 4: Kopi Susu -->
            <div
                class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden flex flex-col">
                <img src="https://images.unsplash.com/photo-1550478796-0155b1fcebf7?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60"
                    alt="Kopi Susu Dingin" class="w-full h-48 object-cover">
                <div class="p-5 flex-1 flex flex-col">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">Es Kopi Susu Aren</h3>
                        <span
                            class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-green-200 dark:text-green-900">Minuman</span>
                    </div>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-4 flex-1">Perpaduan espresso, susu segar, dan
                        gula aren asli.</p>
                    <div class="flex items-center justify-between mt-auto">
                        <span class="text-xl font-bold text-gray-900 dark:text-white">Rp 20.000</span>
                        <button
                            class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Edit
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>

</x-layout>
