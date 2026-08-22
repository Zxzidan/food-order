<div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-2xs overflow-hidden">
    
    <!-- Table Header Toolbar -->
    <div class="p-5 border-b border-gray-100 dark:border-gray-700 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-base sm:text-lg font-bold text-gray-900 dark:text-white">Daftar Riwayat Transaksi</h2>
            <p class="text-xs text-gray-500 dark:text-gray-400">Rincian seluruh transaksi kasir yang masuk pada periode terpilih</p>
        </div>

        <!-- Table Filters -->
        <div class="flex flex-wrap items-center gap-2.5">
            <!-- Search Input -->
            <div class="relative min-w-[200px]">
                <input type="search" id="report-search-table" onkeyup="filterReportTable()"
                    placeholder="Cari No. Order / Pelanggan..."
                    class="w-full pl-9 pr-3 py-2 bg-gray-50 dark:bg-gray-700/80 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white text-xs rounded-xl focus:ring-2 focus:ring-blue-500" />
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
            </div>

            <!-- Payment Method Filter -->
            <select id="report-filter-payment" onchange="filterReportTable()"
                class="px-3 py-2 bg-gray-50 dark:bg-gray-700/80 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white text-xs rounded-xl focus:ring-2 focus:ring-blue-500">
                <option value="">Semua Metode</option>
                <option value="QRIS">QRIS</option>
                <option value="Tunai">Tunai</option>
                <option value="Transfer">Transfer / Debit</option>
            </select>

            <!-- Order Type Filter -->
            <select id="report-filter-type" onchange="filterReportTable()"
                class="px-3 py-2 bg-gray-50 dark:bg-gray-700/80 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white text-xs rounded-xl focus:ring-2 focus:ring-blue-500">
                <option value="">Semua Tipe</option>
                <option value="Dine In">Dine In</option>
                <option value="Take Away">Take Away</option>
                <option value="Delivery">Delivery</option>
            </select>
        </div>
    </div>

    <!-- Responsive Table -->
    <div class="overflow-x-auto">
        <table class="w-full text-xs text-left text-gray-600 dark:text-gray-300">
            <thead class="text-xs uppercase tracking-wider bg-gray-50/80 dark:bg-gray-700/50 text-gray-500 dark:text-gray-400 border-b border-gray-100 dark:border-gray-700 font-semibold">
                <tr>
                    <th scope="col" class="px-5 py-3.5">No. Order</th>
                    <th scope="col" class="px-5 py-3.5">Tanggal & Waktu</th>
                    <th scope="col" class="px-5 py-3.5">Pelanggan</th>
                    <th scope="col" class="px-5 py-3.5">Tipe Pesanan</th>
                    <th scope="col" class="px-5 py-3.5">Metode Bayar</th>
                    <th scope="col" class="px-5 py-3.5">Items</th>
                    <th scope="col" class="px-5 py-3.5 text-right">Total Transaksi</th>
                    <th scope="col" class="px-5 py-3.5 text-center">Status</th>
                    <th scope="col" class="px-5 py-3.5 text-center no-print">Aksi</th>
                </tr>
            </thead>
            <tbody id="report-table-body" class="divide-y divide-gray-100 dark:divide-gray-700 font-medium">
                
                <!-- Row 1 -->
                <tr class="hover:bg-gray-50/80 dark:hover:bg-gray-700/40 transition">
                    <td class="px-5 py-4 font-bold text-gray-900 dark:text-white">#ORD-20260822-045</td>
                    <td class="px-5 py-4 text-gray-500 dark:text-gray-400">22 Agu 2026, 13:42</td>
                    <td class="px-5 py-4 font-semibold text-gray-800 dark:text-gray-200">Ahmad Fauzi</td>
                    <td class="px-5 py-4">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400">
                            Dine In (Meja 04)
                        </span>
                    </td>
                    <td class="px-5 py-4 font-medium">QRIS</td>
                    <td class="px-5 py-4 text-gray-500">2x Mie Ayam, 2x Es Jeruk</td>
                    <td class="px-5 py-4 text-right font-bold text-gray-900 dark:text-white">Rp 55.000</td>
                    <td class="px-5 py-4 text-center">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400">
                            Selesai
                        </span>
                    </td>
                    <td class="px-5 py-4 text-center no-print">
                        <button type="button" onclick="showReceiptDetail('#ORD-20260822-045', 'Ahmad Fauzi', 'Dine In (Meja 04)', 'QRIS', '22 Agu 2026, 13:42', 50000, 5000, 55000, [{'name':'Mie Ayam Spesial', 'qty':2, 'price':18000}, {'name':'Es Jeruk Segar', 'qty':2, 'price':7000}])"
                            class="inline-flex items-center gap-1 text-xs text-blue-600 dark:text-blue-400 hover:text-blue-800 font-semibold p-1.5 rounded-lg hover:bg-blue-50 dark:hover:bg-blue-900/30 transition cursor-pointer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            Struk
                        </button>
                    </td>
                </tr>

                <!-- Row 2 -->
                <tr class="hover:bg-gray-50/80 dark:hover:bg-gray-700/40 transition">
                    <td class="px-5 py-4 font-bold text-gray-900 dark:text-white">#ORD-20260822-044</td>
                    <td class="px-5 py-4 text-gray-500 dark:text-gray-400">22 Agu 2026, 13:20</td>
                    <td class="px-5 py-4 font-semibold text-gray-800 dark:text-gray-200">Siti Nurhaliza</td>
                    <td class="px-5 py-4">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-purple-50 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400">
                            Take Away
                        </span>
                    </td>
                    <td class="px-5 py-4 font-medium">Tunai</td>
                    <td class="px-5 py-4 text-gray-500">1x Nasi Goreng, 1x Es Jeruk</td>
                    <td class="px-5 py-4 text-right font-bold text-gray-900 dark:text-white">Rp 29.700</td>
                    <td class="px-5 py-4 text-center">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400">
                            Selesai
                        </span>
                    </td>
                    <td class="px-5 py-4 text-center no-print">
                        <button type="button" onclick="showReceiptDetail('#ORD-20260822-044', 'Siti Nurhaliza', 'Take Away', 'Tunai', '22 Agu 2026, 13:20', 27000, 2700, 29700, [{'name':'Nasi Goreng Ayam', 'qty':1, 'price':20000}, {'name':'Es Jeruk Segar', 'qty':1, 'price':7000}])"
                            class="inline-flex items-center gap-1 text-xs text-blue-600 dark:text-blue-400 hover:text-blue-800 font-semibold p-1.5 rounded-lg hover:bg-blue-50 dark:hover:bg-blue-900/30 transition cursor-pointer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            Struk
                        </button>
                    </td>
                </tr>

                <!-- Row 3 -->
                <tr class="hover:bg-gray-50/80 dark:hover:bg-gray-700/40 transition">
                    <td class="px-5 py-4 font-bold text-gray-900 dark:text-white">#ORD-20260822-043</td>
                    <td class="px-5 py-4 text-gray-500 dark:text-gray-400">22 Agu 2026, 12:55</td>
                    <td class="px-5 py-4 font-semibold text-gray-800 dark:text-gray-200">Budi Santoso</td>
                    <td class="px-5 py-4">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400">
                            Dine In (Meja 08)
                        </span>
                    </td>
                    <td class="px-5 py-4 font-medium">QRIS</td>
                    <td class="px-5 py-4 text-gray-500">3x Gado-Gado, 3x Es Jeruk</td>
                    <td class="px-5 py-4 text-right font-bold text-gray-900 dark:text-white">Rp 75.900</td>
                    <td class="px-5 py-4 text-center">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400">
                            Selesai
                        </span>
                    </td>
                    <td class="px-5 py-4 text-center no-print">
                        <button type="button" onclick="showReceiptDetail('#ORD-20260822-043', 'Budi Santoso', 'Dine In (Meja 08)', 'QRIS', '22 Agu 2026, 12:55', 69000, 6900, 75900, [{'name':'Gado-Gado Spesial', 'qty':3, 'price':16000}, {'name':'Es Jeruk Segar', 'qty':3, 'price':7000}])"
                            class="inline-flex items-center gap-1 text-xs text-blue-600 dark:text-blue-400 hover:text-blue-800 font-semibold p-1.5 rounded-lg hover:bg-blue-50 dark:hover:bg-blue-900/30 transition cursor-pointer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            Struk
                        </button>
                    </td>
                </tr>

                <!-- Row 4 -->
                <tr class="hover:bg-gray-50/80 dark:hover:bg-gray-700/40 transition">
                    <td class="px-5 py-4 font-bold text-gray-900 dark:text-white">#ORD-20260822-042</td>
                    <td class="px-5 py-4 text-gray-500 dark:text-gray-400">22 Agu 2026, 12:15</td>
                    <td class="px-5 py-4 font-semibold text-gray-800 dark:text-gray-200">Dewi Lestari</td>
                    <td class="px-5 py-4">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400">
                            Dine In (Meja 02)
                        </span>
                    </td>
                    <td class="px-5 py-4 font-medium">Transfer</td>
                    <td class="px-5 py-4 text-gray-500">2x Nasi Goreng Ayam</td>
                    <td class="px-5 py-4 text-right font-bold text-gray-900 dark:text-white">Rp 44.000</td>
                    <td class="px-5 py-4 text-center">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400">
                            Selesai
                        </span>
                    </td>
                    <td class="px-5 py-4 text-center no-print">
                        <button type="button" onclick="showReceiptDetail('#ORD-20260822-042', 'Dewi Lestari', 'Dine In (Meja 02)', 'Transfer', '22 Agu 2026, 12:15', 40000, 4000, 44000, [{'name':'Nasi Goreng Ayam', 'qty':2, 'price':20000}])"
                            class="inline-flex items-center gap-1 text-xs text-blue-600 dark:text-blue-400 hover:text-blue-800 font-semibold p-1.5 rounded-lg hover:bg-blue-50 dark:hover:bg-blue-900/30 transition cursor-pointer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            Struk
                        </button>
                    </td>
                </tr>

                <!-- Row 5 -->
                <tr class="hover:bg-gray-50/80 dark:hover:bg-gray-700/40 transition">
                    <td class="px-5 py-4 font-bold text-gray-900 dark:text-white">#ORD-20260822-041</td>
                    <td class="px-5 py-4 text-gray-500 dark:text-gray-400">22 Agu 2026, 11:45</td>
                    <td class="px-5 py-4 font-semibold text-gray-800 dark:text-gray-200">Reza Rahardian</td>
                    <td class="px-5 py-4">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-purple-50 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400">
                            Take Away
                        </span>
                    </td>
                    <td class="px-5 py-4 font-medium">Tunai</td>
                    <td class="px-5 py-4 text-gray-500">4x Mie Ayam Spesial</td>
                    <td class="px-5 py-4 text-right font-bold text-gray-900 dark:text-white">Rp 79.200</td>
                    <td class="px-5 py-4 text-center">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400">
                            Selesai
                        </span>
                    </td>
                    <td class="px-5 py-4 text-center no-print">
                        <button type="button" onclick="showReceiptDetail('#ORD-20260822-041', 'Reza Rahardian', 'Take Away', 'Tunai', '22 Agu 2026, 11:45', 72000, 7200, 79200, [{'name':'Mie Ayam Spesial', 'qty':4, 'price':18000}])"
                            class="inline-flex items-center gap-1 text-xs text-blue-600 dark:text-blue-400 hover:text-blue-800 font-semibold p-1.5 rounded-lg hover:bg-blue-50 dark:hover:bg-blue-900/30 transition cursor-pointer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            Struk
                        </button>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>

    <!-- Table Pagination & Footer Summary -->
    <div class="px-5 py-4 bg-gray-50/80 dark:bg-gray-700/50 border-t border-gray-100 dark:border-gray-700 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-gray-500 dark:text-gray-400 no-print">
        <p>Menampilkan <span class="font-bold text-gray-800 dark:text-gray-200">1 - 5</span> dari <span class="font-bold text-gray-800 dark:text-gray-200">924</span> transaksi</p>
        <div class="flex items-center gap-1.5">
            <button type="button" class="px-3 py-1.5 rounded-lg border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-400 cursor-not-allowed" disabled>Sebelumnya</button>
            <button type="button" class="px-3 py-1.5 rounded-lg border border-blue-600 bg-blue-600 text-white font-semibold">1</button>
            <button type="button" class="px-3 py-1.5 rounded-lg border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-200">2</button>
            <button type="button" class="px-3 py-1.5 rounded-lg border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-200">3</button>
            <button type="button" class="px-3 py-1.5 rounded-lg border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-200">Selanjutnya</button>
        </div>
    </div>

</div>
