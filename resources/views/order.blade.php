<x-layout>
    <x-slot:title>
        {{ $title }}
    </x-slot:title>

    <!-- POS Header & Realtime Stats -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
        <div>
            <div class="flex items-center gap-2">
                <h1 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white">Point of Sale (POS)</h1>
            </div>
            <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 mt-0.5 py-3">Pilih menu, atur meja, dan proses pembayaran pesanan pelanggan</p>
        </div>

        <!-- Realtime Clock & Date -->
        <div class="flex items-center gap-3">
            <div class="flex items-center gap-2 bg-white dark:bg-gray-800 px-3.5 py-2 rounded-xl border border-gray-200 dark:border-gray-700 shadow-2xs text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-200">
                <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span id="pos-clock">--:--:--</span>
            </div>
        </div>
    </div>

    <!-- Main Layout: Left Menu Grid + Right Order Cart Panel -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
        
        <!-- ========================================== -->
        <!-- LEFT COLUMN: Product Catalog (7 Cols on LG, 8 on XL) -->
        <!-- ========================================== -->
        <div class="lg:col-span-7 xl:col-span-8 space-y-4">
            
            <!-- Filter & Search Bar -->
            <div class="bg-white dark:bg-gray-800 p-3.5 sm:p-4 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-2xs space-y-3">
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-3">
                    
                    <!-- Search Input -->
                    <div class="relative flex-1">
                        <input type="search" id="order-search-input" onkeyup="filterOrderMenu()"
                            class="w-full pl-10 pr-4 py-2.5 bg-gray-50 dark:bg-gray-700/70 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white text-xs sm:text-sm rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition placeholder:text-gray-400"
                            placeholder="" />
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                    </div>

                    <!-- Reset Filter Button -->
                    <button type="button" onclick="resetOrderFilters()"
                        class="hidden sm:inline-flex items-center gap-1 text-xs text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition cursor-pointer">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        Reset
                    </button>
                </div>

                <!-- Category Chips Tabs (Scrollable on small mobile) -->
                <div class="flex items-center gap-2 overflow-x-auto pb-1 no-scrollbar text-xs font-semibold">
                    <button type="button" onclick="selectOrderCategory('all', this)"
                        class="order-cat-btn px-4 py-2 rounded-xl transition cursor-pointer bg-green-600 text-white shadow-xs shrink-0">
                        Semua
                    </button>
                    @foreach($categories as $cat)
                    <button type="button" onclick="selectOrderCategory('{{ $cat->name }}', this)"
                        class="order-cat-btn px-4 py-2 rounded-xl transition cursor-pointer bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 shrink-0">
                        {{ $cat->name }}
                    </button>
                    @endforeach
                </div>
            </div>

            <!-- Products Grid Container -->
            <div id="order-product-grid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 xl:grid-cols-3 gap-3.5 sm:gap-4 py-4">
                
                @forelse($menus as $menu)
                <x-order.card
                    :id="'menu-' . $menu->id"
                    :name="$menu->name"
                    :category="$menu->category ? $menu->category->name : 'Makanan'"
                    :price="$menu->price"
                    :stock="$menu->stock"
                    :description="$menu->description ?? ''"
                    :image="$menu->image_url"
                />
                @empty
                <div class="col-span-full text-center py-12 text-gray-500">Belum ada menu tersedia.</div>
                @endforelse

            </div>

            <!-- Empty Search State -->
            <div id="order-no-results" class="hidden bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 p-12 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="mt-2 text-sm font-semibold text-gray-900 dark:text-white">Menu Tidak Ditemukan</h3>
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Silakan gunakan kata kunci pencarian lain atau pilih kategori Semua.</p>
            </div>
        </div>

        <!-- ========================================== -->
        <!-- RIGHT COLUMN: Order Cart Panel (5 Cols on LG, 4 on XL) -->
        <!-- ========================================== -->
        <div id="cart-drawer-container"
            class="lg:col-span-5 xl:col-span-4 fixed inset-y-0 right-0 z-50 lg:z-10 w-full max-w-md lg:max-w-none lg:relative bg-white dark:bg-gray-800 lg:rounded-3xl border-l lg:border border-gray-200 dark:border-gray-700 shadow-2xl lg:shadow-sm flex flex-col max-h-screen lg:max-h-none lg:sticky lg:top-4 overflow-hidden transform translate-x-full lg:translate-x-0 transition-transform duration-300">
            
            <!-- Mobile Drawer Backdrop -->
            <div id="cart-backdrop" onclick="toggleCartDrawer(false)"
                class="fixed inset-0 bg-black/50 backdrop-blur-xs lg:hidden -z-10 hidden"></div>

            <!-- Cart Header -->
            <div class="p-4 sm:p-5 border-b border-gray-100 dark:border-gray-700/80 flex items-center justify-between shrink-0 bg-gray-50/50 dark:bg-gray-800">
                <div class="flex items-center gap-2.5">
                    <div class="p-2 bg-green-100 dark:bg-green-900/40 text-green-600 dark:text-green-400 rounded-xl">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-base font-bold text-gray-900 dark:text-white">Pesanan Saat Ini</h2>
                        <span id="cart-total-badge" class="text-xs text-gray-500 dark:text-gray-400 font-medium">0 Item dipilih</span>
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    <button type="button" onclick="clearCart()"
                        class="text-xs font-semibold text-red-500 hover:text-red-700 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/30 px-2.5 py-1.5 rounded-lg transition cursor-pointer">
                        Kosongkan
                    </button>
                    <!-- Close button for mobile -->
                    <button type="button" onclick="toggleCartDrawer(false)"
                        class="lg:hidden p-1.5 text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Customer & Order Type Settings -->
            <div class="p-4 border-b border-gray-100 dark:border-gray-700 space-y-3 shrink-0 bg-white dark:bg-gray-800">
                
                <!-- Dine In vs Take Away Toggle -->
                <div class="grid grid-cols-2 gap-2 p-1 bg-gray-100 dark:bg-gray-700/60 rounded-xl">
                    <button type="button" id="type-dinein-btn" onclick="setOrderType('Dine In')"
                        class="flex items-center justify-center gap-1.5 py-2 text-xs font-bold rounded-lg transition bg-white dark:bg-gray-800 text-green-600 dark:text-green-400 shadow-xs cursor-pointer">
                        Dine In 
                    </button>
                    <button type="button" id="type-takeaway-btn" onclick="setOrderType('Take Away')"
                        class="flex items-center justify-center gap-1.5 py-2 text-xs font-bold rounded-lg transition text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white cursor-pointer">
                        Take Away
                    </button>
                </div>

                <!-- Customer & Member Details Section -->
                <div class="space-y-2.5">
                    <div class="flex items-center justify-between">
                        <label class="block text-[11px] font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Pelanggan & Member</label>
                        <button type="button" onclick="openPOSMemberModal()"
                            class="text-[11px] font-semibold text-green-600 dark:text-green-400 hover:text-green-700 hover:underline inline-flex items-center gap-1 cursor-pointer">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                            Member Baru
                        </button>
                    </div>

                    <!-- Member Search Box -->
                    <div class="relative" id="member-search-wrapper">
                        <div class="relative">
                            <input type="text" id="pos-member-search" oninput="searchPOSMember(this.value)"
                                class="w-full pl-8 pr-3 py-1.5 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-xs rounded-lg text-gray-900 dark:text-white placeholder:text-gray-400 focus:ring-1 focus:ring-green-500"
                                placeholder="Cari member (No. HP atau Nama)..." />
                            <div class="absolute inset-y-0 left-0 flex items-center pl-2.5 pointer-events-none text-gray-400">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            </div>
                        </div>

                        <!-- Dropdown Search Results -->
                        <div id="pos-member-dropdown" class="absolute left-0 right-0 top-full mt-1 bg-white dark:bg-gray-800 rounded-xl shadow-xl border border-gray-100 dark:border-gray-700 z-30 hidden max-h-48 overflow-y-auto divide-y divide-gray-100 dark:divide-gray-700">
                            <!-- Items injected by JS -->
                        </div>
                    </div>

                    <!-- Selected Member Pill / Card (Hidden by default) -->
                    <div id="selected-member-card" class="hidden p-2.5 bg-green-50/80 dark:bg-green-900/30 border border-green-200 dark:border-green-800 rounded-xl flex items-center justify-between">
                        <div class="flex items-center gap-2 min-w-0">
                            <div class="w-7 h-7 rounded-lg bg-green-600 text-white font-bold text-xs flex items-center justify-center shrink-0">
                                👤
                            </div>
                            <div class="min-w-0">
                                <div class="flex items-center gap-1.5">
                                    <span id="card-member-name" class="text-xs font-bold text-gray-900 dark:text-white truncate">Nama Member</span>
                                    <span id="card-member-code" class="text-[10px] font-mono text-gray-500 dark:text-gray-400 bg-white/60 dark:bg-gray-800 px-1 rounded">MBR-001</span>
                                </div>
                                <div class="text-[11px] text-green-700 dark:text-green-300 font-semibold flex items-center gap-1">
                                    <span>Saldo:</span>
                                    <span id="card-member-points" class="font-extrabold">0 Poin</span>
                                    <span id="card-member-val" class="text-gray-500 dark:text-gray-400 font-normal">(Rp 0)</span>
                                </div>
                            </div>
                        </div>
                        <button type="button" onclick="clearSelectedMember()" class="p-1 text-gray-400 hover:text-red-500 rounded-lg transition" title="Lepas Member">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>

                    <!-- Member Points Redeem Control (Hidden if no member / 0 points) -->
                    <div id="redeem-points-wrapper" class="hidden p-2.5 bg-yellow-50/80 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800/60 rounded-xl space-y-2">
                        <div class="flex items-center justify-between text-xs font-bold text-yellow-800 dark:text-yellow-300">
                            <span class="flex items-center gap-1">🪙 Tukar Poin Diskon</span>
                            <button type="button" onclick="useAllMemberPoints()" class="text-[11px] font-semibold text-yellow-700 dark:text-yellow-400 underline hover:text-yellow-900 cursor-pointer">
                                Gunakan Maksimal
                            </button>
                        </div>
                        <div class="flex items-center gap-2">
                            <input type="number" id="input-points-used" min="0" value="0" oninput="onPointsUsedChange(this.value)"
                                class="w-full px-2.5 py-1.5 bg-white dark:bg-gray-800 border border-yellow-300 dark:border-yellow-700 text-xs font-bold rounded-lg text-gray-900 dark:text-white focus:ring-1 focus:ring-yellow-500"
                                placeholder="Jumlah poin..." />
                            <span class="text-xs font-semibold text-gray-500 dark:text-gray-400 shrink-0">Poin</span>
                        </div>
                        <div class="text-[11px] text-yellow-700 dark:text-yellow-300 flex justify-between font-medium">
                            <span>Nilai Potongan Diskon:</span>
                            <span id="redeem-discount-preview" class="font-bold text-green-600 dark:text-green-400">- Rp 0</span>
                        </div>
                    </div>

                    <!-- Customer Name & Table Number Inputs -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                        <div>
                            <label class="block text-[11px] font-semibold text-gray-500 dark:text-gray-400 mb-1">Nama Pembeli</label>
                            <input type="text" id="input-customer-name" value="Umum"
                                class="w-full px-3 py-1.5 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-xs font-medium rounded-lg text-gray-900 dark:text-white focus:ring-1 focus:ring-green-500"
                                placeholder="Nama pembeli..." />
                        </div>
                        <div id="table-number-wrapper">
                            <label class="block text-[11px] font-semibold text-gray-500 dark:text-gray-400 mb-1">Nomor Meja</label>
                            <input type="text" id="input-table-number" value="Meja 01"
                                class="w-full px-3 py-1.5 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-xs font-medium rounded-lg text-gray-900 dark:text-white focus:ring-1 focus:ring-green-500"
                                placeholder="Contoh: Meja 05" />
                        </div>
                    </div>
                </div>
            </div>

            <!-- Scrollable Cart Items List -->
            <div id="cart-items-container" class="flex-1 overflow-y-auto p-4 space-y-3 max-h-[38vh] min-h-[160px] divide-y divide-gray-100 dark:divide-gray-700/60">
                
                <!-- Empty Cart State -->
                <div id="empty-cart-state" class="py-10 text-center space-y-2">
                    <div class="w-12 h-12 bg-gray-100 dark:bg-gray-700 text-gray-400 rounded-full flex items-center justify-center mx-auto">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                    </div>
                    <p class="text-xs font-semibold text-gray-600 dark:text-gray-300">Keranjang Masih Kosong</p>
                    <p class="text-[11px] text-gray-400">Klik tombol (+) pada kartu menu untuk menambahkan pesanan</p>
                </div>

                <!-- Dynamic Cart Items injected by JavaScript -->
            </div>

            <!-- Billing & Checkout Footer -->
            <div class="p-4 sm:p-5 bg-gray-50/80 dark:bg-gray-850 border-t border-gray-100 dark:border-gray-700 space-y-3.5 shrink-0">
                
                <!-- Calculation Breakdown -->
                <div class="space-y-1.5 text-xs">
                    <div class="flex justify-between text-gray-500 dark:text-gray-400">
                        <span>Subtotal:</span>
                        <span id="summary-subtotal" class="font-semibold text-gray-800 dark:text-gray-200">Rp 0</span>
                    </div>
                    <div id="summary-discount-row" class="hidden flex justify-between text-green-600 dark:text-green-400 font-medium">
                        <span>Diskon Poin Member (<span id="summary-points-used-text">0</span> Poin):</span>
                        <span id="summary-discount" class="font-bold">- Rp 0</span>
                    </div>
                    <div class="flex justify-between text-gray-500 dark:text-gray-400">
                        <span>Pajak Restoran (PB1 10%):</span>
                        <span id="summary-tax" class="font-semibold text-gray-800 dark:text-gray-200">Rp 0</span>
                    </div>
                    <div id="summary-earned-row" class="hidden flex justify-between items-center bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 p-2 rounded-xl text-[11px] font-semibold">
                        <span class="flex items-center gap-1">✨ Estimasi Poin Didapat:</span>
                        <span id="summary-points-earned" class="font-extrabold">+0 Poin</span>
                    </div>
                    <div class="flex justify-between items-center pt-2 border-t border-gray-200 dark:border-gray-700 text-sm font-bold">
                        <span class="text-gray-900 dark:text-white">Total Tagihan:</span>
                        <span id="summary-grandtotal" class="text-lg text-green-600 dark:text-green-400 font-extrabold">Rp 0</span>
                    </div>
                </div>

                <!-- Form Checkout Tersembunyi -->
                <form id="checkout-form" action="{{ route('order.checkout') }}" method="POST" class="hidden">
                    @csrf
                    <input type="hidden" name="customer_name" id="hidden-customer-name">
                    <input type="hidden" name="member_id" id="hidden-member-id">
                    <input type="hidden" name="points_used" id="hidden-points-used" value="0">
                    <input type="hidden" name="order_type" id="hidden-order-type">
                    <input type="hidden" name="table_number" id="hidden-table-number">
                    <input type="hidden" name="items" id="hidden-items">
                </form>

                <!-- Process Checkout CTA Button -->
                <button type="button" id="btn-process-order" onclick="processOrderCheckout()"
                    class="w-full inline-flex items-center justify-center gap-2 py-3 px-4 text-sm font-bold text-white bg-green-600 hover:bg-green-700 active:scale-[0.99] rounded-2xl shadow-md hover:shadow-lg transition cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span>Checkout Pesanan</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Floating Cart Trigger (Sticky Bottom on small screens) -->
    <div id="mobile-cart-bar" class="lg:hidden fixed bottom-4 left-4 right-4 z-40 hidden">
        <div class="bg-gray-900/95 dark:bg-gray-800/95 backdrop-blur-md text-white p-3.5 rounded-2xl shadow-2xl flex items-center justify-between border border-gray-700">
            <div class="flex items-center gap-3">
                <div class="relative w-10 h-10 bg-green-600 rounded-xl flex items-center justify-center font-bold">
                    🛒
                    <span id="mobile-cart-count" class="absolute -top-1 -right-1 bg-red-500 text-[10px] w-5 h-5 rounded-full flex items-center justify-center font-bold">
                        0
                    </span>
                </div>
                <div>
                    <span class="text-[11px] text-gray-400 block">Total Tagihan</span>
                    <span id="mobile-cart-price" class="text-sm font-bold text-green-400">Rp 0</span>
                </div>
            </div>
            <button type="button" onclick="toggleCartDrawer(true)"
                class="bg-green-600 hover:bg-green-700 text-white font-bold text-xs px-4 py-2.5 rounded-xl shadow-md transition">
                Lihat Pesanan ➔
            </button>
        </div>
    </div>

    <!-- Receipt Modal Removed (Moved to Payment Flow) -->

    <!-- Toast Notification -->
    <x-toast />

    <!-- POS Interactive Logic -->
    <script>
        // Realtime Clock
        function updateClock() {
            const now = new Date();
            const timeStr = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
            const dateStr = now.toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' });
            const clockEl = document.getElementById('pos-clock');
            if (clockEl) clockEl.innerText = `${dateStr} • ${timeStr}`;
        }
        setInterval(updateClock, 1000);
        updateClock();

        // State variables
        let cart = [];
        let orderType = 'Dine In';
        let currentTaxRate = 0.10; // 10% PB1 Restaurant Tax
        let activeCategory = 'all';
        let selectedMember = null;
        let pointsUsed = 0;

        // Member POS Search & Selection
        let searchTimeout = null;
        function searchPOSMember(keyword) {
            clearTimeout(searchTimeout);
            const dropdown = document.getElementById('pos-member-dropdown');
            keyword = keyword.trim();

            if (keyword.length < 2) {
                dropdown.classList.add('hidden');
                dropdown.innerHTML = '';
                return;
            }

            searchTimeout = setTimeout(() => {
                fetch(`/members/search?q=${encodeURIComponent(keyword)}`, {
                    headers: { 'Accept': 'application/json' }
                })
                .then(res => res.json())
                .then(members => {
                    if (members.length === 0) {
                        dropdown.innerHTML = `
                            <div class="p-3 text-center text-xs text-gray-400">
                                Member tidak ditemukan.
                                <button type="button" onclick="openPOSMemberModal('${keyword}')" class="block w-full mt-1 text-green-600 font-semibold hover:underline">
                                    + Daftarkan "${keyword}"
                                </button>
                            </div>
                        `;
                        dropdown.classList.remove('hidden');
                        return;
                    }

                    let html = '';
                    members.forEach(m => {
                        html += `
                            <button type="button" onclick='selectPOSMember(${JSON.stringify(m)})'
                                class="w-full text-left p-2.5 hover:bg-gray-50 dark:hover:bg-gray-700 flex items-center justify-between transition cursor-pointer">
                                <div>
                                    <div class="text-xs font-bold text-gray-900 dark:text-white">${m.name}</div>
                                    <div class="text-[11px] text-gray-400 font-mono">${m.member_code} • ${m.phone}</div>
                                </div>
                                <div class="text-right">
                                    <span class="inline-block px-1.5 py-0.5 bg-green-100 dark:bg-green-900/40 text-green-700 dark:text-green-300 rounded font-bold text-[10px]">
                                        ${m.formatted_points}
                                    </span>
                                </div>
                            </button>
                        `;
                    });
                    dropdown.innerHTML = html;
                    dropdown.classList.remove('hidden');
                })
                .catch(() => {
                    dropdown.classList.add('hidden');
                });
            }, 250);
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            const wrapper = document.getElementById('member-search-wrapper');
            const dropdown = document.getElementById('pos-member-dropdown');
            if (wrapper && !wrapper.contains(e.target) && dropdown) {
                dropdown.classList.add('hidden');
            }
        });

        function selectPOSMember(member) {
            selectedMember = member;
            pointsUsed = 0;

            // Update UI elements
            document.getElementById('pos-member-search').value = '';
            document.getElementById('pos-member-dropdown').classList.add('hidden');
            document.getElementById('member-search-wrapper').classList.add('hidden');

            const card = document.getElementById('selected-member-card');
            card.classList.remove('hidden');
            document.getElementById('card-member-name').textContent = member.name;
            document.getElementById('card-member-code').textContent = member.member_code;
            document.getElementById('card-member-points').textContent = `${new Intl.NumberFormat('id-ID').format(member.points_balance)} Poin`;
            document.getElementById('card-member-val').textContent = `(Rp ${new Intl.NumberFormat('id-ID').format(member.points_balance * 1000)})`;

            // Auto-fill customer name
            document.getElementById('input-customer-name').value = member.name;

            // Show redeem points control if member has points
            const redeemWrapper = document.getElementById('redeem-points-wrapper');
            const pointsInput = document.getElementById('input-points-used');
            pointsInput.value = 0;

            if (member.points_balance > 0) {
                redeemWrapper.classList.remove('hidden');
            } else {
                redeemWrapper.classList.add('hidden');
            }

            renderCart();
            showToast(`Member "${member.name}" berhasil dihubungkan!`, 'success');
        }

        function clearSelectedMember() {
            selectedMember = null;
            pointsUsed = 0;

            document.getElementById('selected-member-card').classList.add('hidden');
            document.getElementById('redeem-points-wrapper').classList.add('hidden');
            document.getElementById('member-search-wrapper').classList.remove('hidden');
            document.getElementById('input-customer-name').value = 'Umum';
            document.getElementById('input-points-used').value = 0;

            renderCart();
            showToast('Member dilepas dari pesanan.', 'delete');
        }

        function onPointsUsedChange(val) {
            if (!selectedMember) {
                pointsUsed = 0;
                renderCart();
                return;
            }

            let num = parseInt(val, 10) || 0;
            if (num < 0) num = 0;

            // Maximum points member has
            num = Math.min(num, selectedMember.points_balance);

            // Maximum discount cannot exceed subtotal
            let subtotal = 0;
            cart.forEach(i => subtotal += i.price * i.qty);
            const maxPointsForSubtotal = Math.floor(subtotal / 1000);
            num = Math.min(num, maxPointsForSubtotal);

            pointsUsed = num;
            document.getElementById('input-points-used').value = pointsUsed;
            renderCart();
        }

        function useAllMemberPoints() {
            if (!selectedMember || selectedMember.points_balance <= 0) return;

            let subtotal = 0;
            cart.forEach(i => subtotal += i.price * i.qty);
            const maxPointsForSubtotal = Math.floor(subtotal / 1000);
            const maxPoints = Math.min(selectedMember.points_balance, maxPointsForSubtotal);

            pointsUsed = maxPoints;
            document.getElementById('input-points-used').value = pointsUsed;
            renderCart();

            if (pointsUsed > 0) {
                showToast(`${pointsUsed} Poin diterapkan sebagai diskon!`, 'success');
            } else {
                showToast('Tambahkan menu ke keranjang terlebih dahulu!', 'delete');
            }
        }

        // Quick Member Registration Modal on POS
        function openPOSMemberModal(initialPhoneOrName = '') {
            document.getElementById('pos-add-member-modal').classList.remove('hidden');
            const phoneInput = document.getElementById('pos-new-phone');
            const nameInput = document.getElementById('pos-new-name');
            nameInput.value = '';
            phoneInput.value = '';
            document.getElementById('pos-new-email').value = '';

            if (initialPhoneOrName) {
                if (/^\d+$/.test(initialPhoneOrName)) {
                    phoneInput.value = initialPhoneOrName;
                } else {
                    nameInput.value = initialPhoneOrName;
                }
            }
            nameInput.focus();
        }

        function closePOSMemberModal() {
            document.getElementById('pos-add-member-modal').classList.add('hidden');
        }

        function submitPOSAddMember(e) {
            e.preventDefault();
            const btn = document.getElementById('btn-submit-pos-member');
            const name = document.getElementById('pos-new-name').value.trim();
            const phone = document.getElementById('pos-new-phone').value.trim();
            const email = document.getElementById('pos-new-email').value.trim();

            if (!name || !phone) {
                alert('Nama dan Nomor HP wajib diisi.');
                return;
            }

            btn.setAttribute('disabled', 'true');
            btn.innerHTML = `<span class="animate-spin inline-block w-3.5 h-3.5 border-2 border-white border-t-transparent rounded-full mr-1.5"></span> Mendaftarkan...`;

            fetch('{{ route("members.store") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ name, phone, email, status: 'active' })
            })
            .then(async res => {
                const data = await res.json();
                if (!res.ok) {
                    throw new Error(data.message || 'Gagal mendaftarkan member');
                }
                return data;
            })
            .then(data => {
                closePOSMemberModal();
                selectPOSMember(data.member);
                showToast(data.message, 'success');
            })
            .catch(err => {
                alert(err.message);
            })
            .finally(() => {
                btn.removeAttribute('disabled');
                btn.innerHTML = 'Daftarkan & Pilih Member';
            });
        }

        // Add to Cart
        function addToCart(id, name, price, image, stock) {
            const existingIndex = cart.findIndex(item => item.id === id);

            if (existingIndex > -1) {
                if (cart[existingIndex].qty < stock) {
                    cart[existingIndex].qty += 1;
                } else {
                    showToast(`Stok maksimal menu "${name}" (${stock}) telah tercapai!`, 'delete');
                    return;
                }
            } else {
                cart.push({
                    id: id,
                    name: name,
                    price: price,
                    image: image,
                    stock: stock,
                    qty: 1,
                    note: ''
                });
            }

            renderCart();
            showToast(`"${name}" ditambahkan ke keranjang!`, 'success');
        }

        // Change Quantity
        function changeQty(id, delta) {
            const item = cart.find(i => i.id === id);
            if (!item) return;

            const newQty = item.qty + delta;
            if (newQty <= 0) {
                removeFromCart(id);
            } else if (newQty > item.stock) {
                showToast(`Stok ${item.name} hanya tersisa ${item.stock}!`, 'delete');
            } else {
                item.qty = newQty;
                renderCart();
            }
        }

        // Update Item Note
        function updateItemNote(id, noteText) {
            const item = cart.find(i => i.id === id);
            if (item) {
                item.note = noteText;
            }
        }

        // Remove from Cart
        function removeFromCart(id) {
            cart = cart.filter(i => i.id !== id);
            renderCart();
        }

        // Clear Entire Cart
        function clearCart() {
            if (cart.length === 0) return;
            cart = [];
            pointsUsed = 0;
            if (document.getElementById('input-points-used')) {
                document.getElementById('input-points-used').value = 0;
            }
            renderCart();
            showToast('Keranjang pesanan telah dikosongkan.', 'delete');
        }

        // Set Order Type (Dine In / Take Away)
        function setOrderType(type) {
            orderType = type;
            const btnDine = document.getElementById('type-dinein-btn');
            const btnTake = document.getElementById('type-takeaway-btn');
            const tableWrapper = document.getElementById('table-number-wrapper');

            if (type === 'Dine In') {
                btnDine.className = "flex items-center justify-center gap-1.5 py-2 text-xs font-bold rounded-lg transition bg-white dark:bg-gray-800 text-green-600 dark:text-green-400 shadow-xs cursor-pointer";
                btnTake.className = "flex items-center justify-center gap-1.5 py-2 text-xs font-bold rounded-lg transition text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white cursor-pointer";
                if (tableWrapper) tableWrapper.classList.remove('hidden');
            } else {
                btnTake.className = "flex items-center justify-center gap-1.5 py-2 text-xs font-bold rounded-lg transition bg-white dark:bg-gray-800 text-green-600 dark:text-green-400 shadow-xs cursor-pointer";
                btnDine.className = "flex items-center justify-center gap-1.5 py-2 text-xs font-bold rounded-lg transition text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white cursor-pointer";
                if (tableWrapper) tableWrapper.classList.add('hidden');
            }
        }

        // Render Cart DOM
        function renderCart() {
            const container = document.getElementById('cart-items-container');
            const emptyState = document.getElementById('empty-cart-state');
            const badge = document.getElementById('cart-total-badge');
            const processBtn = document.getElementById('btn-process-order');
            const mobileBar = document.getElementById('mobile-cart-bar');
            const mobileCount = document.getElementById('mobile-cart-count');
            const mobilePrice = document.getElementById('mobile-cart-price');

            // Calculate Totals
            let subtotal = 0;
            let totalItems = 0;

            cart.forEach(item => {
                subtotal += item.price * item.qty;
                totalItems += item.qty;
            });

            // Calculate Points Discount
            let discountAmount = pointsUsed * 1000;
            if (discountAmount > subtotal) {
                discountAmount = subtotal;
                pointsUsed = Math.floor(discountAmount / 1000);
            }

            const discountRow = document.getElementById('summary-discount-row');
            const discountPreview = document.getElementById('redeem-discount-preview');

            if (pointsUsed > 0) {
                discountRow.classList.remove('hidden');
                document.getElementById('summary-points-used-text').innerText = pointsUsed;
                document.getElementById('summary-discount').innerText = `- ${formatRupiah(discountAmount)}`;
                if (discountPreview) discountPreview.innerText = `- ${formatRupiah(discountAmount)}`;
            } else {
                discountRow.classList.add('hidden');
                if (discountPreview) discountPreview.innerText = `- Rp 0`;
            }

            const taxableSubtotal = Math.max(0, subtotal - discountAmount);
            const tax = Math.round(taxableSubtotal * currentTaxRate);
            const grandTotal = taxableSubtotal + tax;

            // Estimated Points Earned for Member
            const earnedRow = document.getElementById('summary-earned-row');
            if (selectedMember && grandTotal >= 10000) {
                const earnedPoints = Math.floor(grandTotal / 10000);
                earnedRow.classList.remove('hidden');
                document.getElementById('summary-points-earned').innerText = `+${earnedPoints} Poin`;
            } else {
                earnedRow.classList.add('hidden');
            }

            // Update Summary DOM
            document.getElementById('summary-subtotal').innerText = formatRupiah(subtotal);
            document.getElementById('summary-tax').innerText = formatRupiah(tax);
            document.getElementById('summary-grandtotal').innerText = formatRupiah(grandTotal);
            badge.innerText = `${totalItems} Item (${cart.length} Menu)`;

            // Mobile Floating Bar
            if (totalItems > 0) {
                mobileBar.classList.remove('hidden');
                mobileCount.innerText = totalItems;
                mobilePrice.innerText = formatRupiah(grandTotal);
                processBtn.removeAttribute('disabled');
            } else {
                mobileBar.classList.add('hidden');
                processBtn.setAttribute('disabled', 'true');
            }

            // Render Items
            container.innerHTML = '';
            if (cart.length === 0) {
                container.appendChild(emptyState);
                emptyState.classList.remove('hidden');
            } else {
                cart.forEach(item => {
                    const itemTotal = item.price * item.qty;
                    const itemEl = document.createElement('div');
                    itemEl.className = "pt-3 first:pt-0 space-y-2";
                    itemEl.innerHTML = `
                        <div class="flex items-center justify-between gap-2.5">
                            <img src="${item.image}" alt="${item.name}" class="w-12 h-12 rounded-xl object-cover shrink-0 border border-gray-100 dark:border-gray-700">
                            <div class="flex-1 min-w-0">
                                <h4 class="text-xs font-bold text-gray-900 dark:text-white truncate">${item.name}</h4>
                                <span class="text-[11px] text-gray-500 dark:text-gray-400">${formatRupiah(item.price)}</span>
                            </div>
                            
                            <!-- Quantity Controls -->
                            <div class="flex items-center gap-1.5 bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded-xl shrink-0">
                                <button type="button" onclick="changeQty('${item.id}', -1)"
                                    class="w-5 h-5 flex items-center justify-center text-gray-600 dark:text-gray-300 hover:text-red-500 font-bold text-xs rounded transition">
                                    -
                                </button>
                                <span class="text-xs font-bold text-gray-900 dark:text-white w-4 text-center">${item.qty}</span>
                                <button type="button" onclick="changeQty('${item.id}', 1)"
                                    class="w-5 h-5 flex items-center justify-center text-gray-600 dark:text-gray-300 hover:text-green-500 font-bold text-xs rounded transition">
                                    +
                                </button>
                            </div>

                            <span class="text-xs font-bold text-gray-900 dark:text-white w-18 text-right">${formatRupiah(itemTotal)}</span>
                        </div>

                        <!-- Item Note Input -->
                        <div class="flex items-center gap-1.5 pl-14">
                            <input type="text" value="${item.note}" onchange="updateItemNote('${item.id}', this.value)"
                                placeholder="Tambah catatan (cth: tidak pedas)..."
                                class="w-full text-[10px] bg-transparent border-b border-dashed border-gray-300 dark:border-gray-600 focus:border-green-500 text-gray-600 dark:text-gray-300 py-0.5 focus:outline-none placeholder:text-gray-400" />
                        </div>
                    `;
                    container.appendChild(itemEl);
                });
            }
        }

        // Toggle Mobile Cart Drawer
        function toggleCartDrawer(open) {
            const drawer = document.getElementById('cart-drawer-container');
            const backdrop = document.getElementById('cart-backdrop');
            if (open) {
                drawer.classList.remove('translate-x-full');
                backdrop.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            } else {
                drawer.classList.add('translate-x-full');
                backdrop.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }
        }

        // Filter and Search Catalog
        function selectOrderCategory(cat, btn) {
            activeCategory = cat;
            document.querySelectorAll('.order-cat-btn').forEach(b => {
                b.className = "order-cat-btn px-4 py-2 rounded-xl transition cursor-pointer bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 shrink-0";
            });
            btn.className = "order-cat-btn px-4 py-2 rounded-xl transition cursor-pointer bg-green-600 text-white shadow-xs shrink-0";
            filterOrderMenu();
        }

        function resetOrderFilters() {
            document.getElementById('order-search-input').value = '';
            const allBtn = document.querySelector('.order-cat-btn');
            if (allBtn) selectOrderCategory('all', allBtn);
        }

        function filterOrderMenu() {
            const query = document.getElementById('order-search-input').value.toLowerCase();
            const cards = document.querySelectorAll('.order-item-card');
            let visibleCount = 0;

            cards.forEach(card => {
                const name = (card.getAttribute('data-name') || '').toLowerCase();
                const cat = card.getAttribute('data-category');

                const matchesQuery = name.includes(query);
                const matchesCategory = (activeCategory === 'all' || cat === activeCategory);

                if (matchesQuery && matchesCategory) {
                    card.classList.remove('hidden');
                    visibleCount++;
                } else {
                    card.classList.add('hidden');
                }
            });

            const noResults = document.getElementById('order-no-results');
            if (visibleCount === 0) {
                noResults.classList.remove('hidden');
            } else {
                noResults.classList.add('hidden');
            }
        }

        // Process Checkout - Submit Form
        function processOrderCheckout() {
            if (cart.length === 0) {
                showToast('Pilih setidaknya 1 menu terlebih dahulu!', 'delete');
                return;
            }

            const customerName = document.getElementById('input-customer-name').value.trim();
            const tableNumber = document.getElementById('input-table-number').value.trim();

            document.getElementById('hidden-customer-name').value = customerName;
            document.getElementById('hidden-order-type').value = orderType;
            document.getElementById('hidden-table-number').value = tableNumber;
            document.getElementById('hidden-member-id').value = selectedMember ? selectedMember.id : '';
            document.getElementById('hidden-points-used').value = pointsUsed;
            
            // Format cart to match the structure expected by backend
            const itemsToSubmit = cart.map(item => ({
                id: item.id,
                name: item.name,
                price: item.price,
                quantity: item.qty,
                notes: item.note
            }));

            document.getElementById('hidden-items').value = JSON.stringify(itemsToSubmit);
            
            // Submit the form
            const btn = document.getElementById('btn-process-order');
            btn.setAttribute('disabled', 'true');
            btn.innerHTML = `<span class="animate-spin inline-block w-4 h-4 border-2 border-white border-t-transparent rounded-full mr-2"></span> Memproses...`;

            document.getElementById('checkout-form').submit();
        }

        // Helper Format Rupiah
        function formatRupiah(number) {
            return 'Rp ' + Number(number).toLocaleString('id-ID');
        }

        // Initial Render
        renderCart();
    </script>

    <!-- Quick Register Member Modal (POS Kasir) -->
    <div id="pos-add-member-modal" class="fixed inset-0 z-50 hidden bg-black/50 backdrop-blur-xs flex items-center justify-center p-4">
        <div class="bg-white dark:bg-gray-800 rounded-2xl w-full max-w-sm shadow-2xl border border-gray-100 dark:border-gray-700 overflow-hidden">
            <div class="px-5 py-3.5 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between bg-gray-50/60 dark:bg-gray-800">
                <h3 class="text-sm font-bold text-gray-900 dark:text-white flex items-center gap-2">
                    <span class="text-green-600">👤</span> Daftar Member Cepat
                </h3>
                <button type="button" onclick="closePOSMemberModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <form onsubmit="submitPOSAddMember(event)" class="p-5 space-y-3.5">
                <div>
                    <label class="block text-[11px] font-semibold text-gray-700 dark:text-gray-300 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                    <input type="text" id="pos-new-name" required placeholder="Nama pembeli..."
                        class="w-full px-3 py-1.5 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-xs rounded-xl text-gray-900 dark:text-white focus:ring-1 focus:ring-green-500">
                </div>

                <div>
                    <label class="block text-[11px] font-semibold text-gray-700 dark:text-gray-300 mb-1">Nomor WhatsApp / HP <span class="text-red-500">*</span></label>
                    <input type="text" id="pos-new-phone" required placeholder="08xxxxxxxxxx"
                        class="w-full px-3 py-1.5 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-xs rounded-xl text-gray-900 dark:text-white focus:ring-1 focus:ring-green-500">
                </div>

                <div>
                    <label class="block text-[11px] font-semibold text-gray-700 dark:text-gray-300 mb-1">Email (Opsional)</label>
                    <input type="email" id="pos-new-email" placeholder="email@contoh.com"
                        class="w-full px-3 py-1.5 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-xs rounded-xl text-gray-900 dark:text-white focus:ring-1 focus:ring-green-500">
                </div>

                <div class="pt-2 flex items-center justify-end gap-2 border-t border-gray-100 dark:border-gray-700">
                    <button type="button" onclick="closePOSMemberModal()"
                        class="px-3 py-1.5 text-xs font-semibold text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-xl transition">
                        Batal
                    </button>
                    <button type="submit" id="btn-submit-pos-member"
                        class="px-4 py-1.5 bg-green-600 hover:bg-green-700 text-white text-xs font-semibold rounded-xl shadow-xs transition cursor-pointer">
                        Daftarkan & Hubungkan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            #printable-receipt, #printable-receipt * {
                visibility: visible;
            }
            #printable-receipt {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                background: white !important;
                color: black !important;
            }
        }
    </style>
</x-layout>