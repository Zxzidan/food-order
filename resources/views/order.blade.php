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
                            placeholder="Cari menu" />
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
                    :image="$menu->image ? (str_starts_with($menu->image, 'http') ? $menu->image : asset($menu->image)) : 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=400'"
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

                <!-- Customer Details Inputs -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                    <div>
                        <label class="block text-[11px] font-semibold text-gray-500 dark:text-gray-400 mb-1">Nama Pelanggan</label>
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
                    <div class="flex justify-between text-gray-500 dark:text-gray-400">
                        <span>Pajak Restoran (PB1 10%):</span>
                        <span id="summary-tax" class="font-semibold text-gray-800 dark:text-gray-200">Rp 0</span>
                    </div>
                    <div class="flex justify-between items-center pt-2 border-t border-gray-200 dark:border-gray-700 text-sm font-bold">
                        <span class="text-gray-900 dark:text-white">Total Tagihan:</span>
                        <span id="summary-grandtotal" class="text-lg text-green-600 dark:text-green-400 font-extrabold">Rp 0</span>
                    </div>
                </div>

                <!-- Payment Method Tabs -->
                <div>
                    <label class="block text-[11px] font-semibold text-gray-500 dark:text-gray-400 mb-1.5">Metode Pembayaran</label>
                    <div class="grid grid-cols-3 gap-2 py-3">
                        <button type="button" onclick="selectPaymentMethod('Tunai', this)"
                            class="payment-method-btn flex flex-col items-center justify-center py-2 px-1 rounded-xl border-2 border-green-500 bg-green-50/50 dark:bg-green-950/30 text-green-700 dark:text-green-300 text-xs font-bold transition cursor-pointer">
                            <span>Tunai</span>
                        </button>
                        <button type="button" onclick="selectPaymentMethod('QRIS', this)"
                            class="payment-method-btn flex flex-col items-center justify-center py-2 px-1 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-600 dark:text-gray-300 text-xs font-bold transition hover:border-gray-300 cursor-pointer">
                            <span>QRIS</span>
                        </button>
                        <button type="button" onclick="selectPaymentMethod('Debit', this)"
                            class="payment-method-btn flex flex-col items-center justify-center py-2 px-1 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-600 dark:text-gray-300 text-xs font-bold transition hover:border-gray-300 cursor-pointer">
                            <span>Debit / CC</span>
                        </button>
                    </div>
                </div>

                <!-- Cash Quick Amount / Change Calculator (Shown when Tunai is active) -->
                <div id="cash-calculator-panel" class="space-y-2 pt-1">
                    <div class="flex items-center justify-between gap-2">
                        <span class="text-[11px] font-semibold text-gray-500 dark:text-gray-400">Nominal Diterima:</span>
                        <div class="relative w-36">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-2 text-xs font-semibold text-gray-400">Rp</span>
                            <input type="number" id="input-cash-amount" oninput="calculateChange()"
                                class="w-full pl-8 pr-2 py-1.5 text-xs font-bold text-right bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:ring-1 focus:ring-green-500"
                                placeholder="0" />
                        </div>
                    </div>

                    <!-- Quick Cash Suggestion Chips -->
                    <div class="flex items-center gap-1.5 py-3 overflow-x-auto pb-1 text-[10px] font-bold">
                        <button type="button" onclick="setExactCash()"
                            class="px-3 py-1 rounded-md bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-300 transition cursor-pointer shrink-0">
                            Uang Pas
                        </button>
                        <button type="button" onclick="setCashValue(50000)"
                            class="px-2 py-1 rounded-md bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-300 transition cursor-pointer shrink-0">
                            50.000
                        </button>
                        <button type="button" onclick="setCashValue(100000)"
                            class="px-2 py-1 rounded-md bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-300 transition cursor-pointer shrink-0">
                            100.000
                        </button>
                        <button type="button" onclick="setCashValue(200000)"
                            class="px-2 py-1 rounded-md bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-300 transition cursor-pointer shrink-0">
                            200.000
                        </button>
                    </div>

                    <div class="flex justify-between items-center text-xs font-semibold text-gray-600 dark:text-gray-400 bg-white dark:bg-gray-800 p-2 rounded-lg border border-gray-200 dark:border-gray-700 py-3">
                        <span>Kembalian:</span>
                        <span id="cash-change-amount" class="text-sm font-bold text-emerald-600 dark:text-emerald-400">Rp 0</span>
                    </div>
                </div>

                <!-- Process Payment CTA Button -->
                <button type="button" id="btn-process-order" onclick="processOrderCheckout()"
                    class="w-full inline-flex items-center justify-center gap-2 py-3 px-4 text-sm font-bold text-white bg-green-600 hover:bg-green-700 active:scale-[0.99] rounded-2xl shadow-md hover:shadow-lg transition cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span>Bayar & Proses Pesanan</span>
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

    <!-- Receipt / Struk Modal -->
    <x-order.receipt-modal />

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
        let paymentMethod = 'Tunai';
        let currentTaxRate = 0.10; // 10% PB1 Restaurant Tax
        let activeCategory = 'all';

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

        // Set Payment Method
        function selectPaymentMethod(method, btn) {
            paymentMethod = method;
            const buttons = document.querySelectorAll('.payment-method-btn');
            buttons.forEach(b => {
                b.className = "payment-method-btn flex flex-col items-center justify-center py-2 px-1 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-600 dark:text-gray-300 text-xs font-bold transition hover:border-gray-300 cursor-pointer";
            });

            btn.className = "payment-method-btn flex flex-col items-center justify-center py-2 px-1 rounded-xl border-2 border-green-500 bg-green-50/50 dark:bg-green-950/30 text-green-700 dark:text-green-300 text-xs font-bold transition cursor-pointer";

            const cashCalc = document.getElementById('cash-calculator-panel');
            if (method === 'Tunai') {
                cashCalc.classList.remove('hidden');
                calculateChange();
            } else {
                cashCalc.classList.add('hidden');
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

            const tax = Math.round(subtotal * currentTaxRate);
            const grandTotal = subtotal + tax;

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

            calculateChange();
        }

        // Cash Calculation
        function calculateChange() {
            const grandTotal = getGrandTotal();
            const cashInput = document.getElementById('input-cash-amount');
            const changeDisplay = document.getElementById('cash-change-amount');
            const cashVal = Number(cashInput.value) || 0;

            if (cashVal >= grandTotal && grandTotal > 0) {
                const change = cashVal - grandTotal;
                changeDisplay.innerText = formatRupiah(change);
                changeDisplay.className = "text-sm font-bold text-emerald-600 dark:text-emerald-400";
            } else if (cashVal > 0 && cashVal < grandTotal) {
                const deficit = grandTotal - cashVal;
                changeDisplay.innerText = `Kurang ${formatRupiah(deficit)}`;
                changeDisplay.className = "text-xs font-bold text-red-500";
            } else {
                changeDisplay.innerText = "Rp 0";
                changeDisplay.className = "text-sm font-bold text-gray-400";
            }
        }

        function setExactCash() {
            const grandTotal = getGrandTotal();
            document.getElementById('input-cash-amount').value = grandTotal;
            calculateChange();
        }

        function setCashValue(val) {
            document.getElementById('input-cash-amount').value = val;
            calculateChange();
        }

        function getGrandTotal() {
            let subtotal = 0;
            cart.forEach(i => subtotal += i.price * i.qty);
            return subtotal + Math.round(subtotal * currentTaxRate);
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

        // Process Checkout & Show Receipt
        function processOrderCheckout() {
            if (cart.length === 0) {
                showToast('Pilih setidaknya 1 menu terlebih dahulu!', 'delete');
                return;
            }

            const grandTotal = getGrandTotal();
            const cashInput = Number(document.getElementById('input-cash-amount').value) || 0;

            if (paymentMethod === 'Tunai' && cashInput < grandTotal) {
                showToast('Jumlah uang tunai yang diterima kurang!', 'delete');
                return;
            }

            const customerName = document.getElementById('input-customer-name').value.trim() || 'Umum';
            const tableNumber = document.getElementById('input-table-number').value.trim() || 'Meja 01';
            const orderId = '#ORD-' + new Date().toISOString().slice(0,10).replace(/-/g,'') + '-' + Math.floor(100 + Math.random() * 900);

            // Populate Receipt Modal
            document.getElementById('receipt-order-id').innerText = orderId;
            document.getElementById('receipt-date').innerText = new Date().toLocaleString('id-ID', { dateStyle: 'medium', timeStyle: 'short' });
            document.getElementById('receipt-customer').innerText = customerName;
            document.getElementById('receipt-type').innerText = orderType === 'Dine In' ? `Dine In (${tableNumber})` : 'Take Away (Bungkus)';
            
            let subtotal = 0;
            const itemsListEl = document.getElementById('receipt-items-list');
            itemsListEl.innerHTML = '';

            cart.forEach(item => {
                const itemTotal = item.price * item.qty;
                subtotal += itemTotal;
                const row = document.createElement('div');
                row.className = "flex justify-between items-start";
                row.innerHTML = `
                    <div class="flex-1">
                        <span class="font-medium">${item.name}</span>
                        <div class="text-[10px] text-gray-500">${item.qty} x ${formatRupiah(item.price)} ${item.note ? `(${item.note})` : ''}</div>
                    </div>
                    <span class="font-bold">${formatRupiah(itemTotal)}</span>
                `;
                itemsListEl.appendChild(row);
            });

            const tax = Math.round(subtotal * currentTaxRate);
            const total = subtotal + tax;
            const payAmount = (paymentMethod === 'Tunai') ? cashInput : total;
            const change = (paymentMethod === 'Tunai') ? (cashInput - total) : 0;

            document.getElementById('receipt-subtotal').innerText = formatRupiah(subtotal);
            document.getElementById('receipt-tax').innerText = formatRupiah(tax);
            document.getElementById('receipt-total').innerText = formatRupiah(total);
            document.getElementById('receipt-payment-method').innerText = paymentMethod;
            document.getElementById('receipt-pay-amount').innerText = formatRupiah(payAmount);
            document.getElementById('receipt-change').innerText = formatRupiah(change);

            // Open Modal
            document.getElementById('receipt-modal').classList.remove('hidden');
            toggleCartDrawer(false);
        }

        function closeReceiptModal() {
            document.getElementById('receipt-modal').classList.add('hidden');
            clearCart();
            document.getElementById('input-cash-amount').value = '';
            showToast('Pesanan selesai diproses!', 'success');
        }

        function printReceipt() {
            window.print();
        }

        // Helper Format Rupiah
        function formatRupiah(number) {
            return 'Rp ' + Number(number).toLocaleString('id-ID');
        }

        // Initial Render
        renderCart();
    </script>

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