<div id="history-table-container" class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-2xs overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-xs text-left text-gray-600 dark:text-gray-300">
            <thead class="text-xs uppercase tracking-wider bg-gray-50/80 dark:bg-gray-700/50 text-gray-500 dark:text-gray-400 border-b border-gray-100 dark:border-gray-700 font-semibold">
                <tr>
                    <th scope="col" class="px-5 py-3.5">No. Order & Waktu</th>
                    <th scope="col" class="px-5 py-3.5">Pelanggan</th>
                    <th scope="col" class="px-5 py-3.5">Tipe & Meja</th>
                    <th scope="col" class="px-5 py-3.5">Detail Pesanan</th>
                    <th scope="col" class="px-5 py-3.5">Metode Bayar</th>
                    <th scope="col" class="px-5 py-3.5 text-right">Total Tagihan</th>
                    <th scope="col" class="px-5 py-3.5 text-center">Status</th>
                    <th scope="col" class="px-5 py-3.5 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody id="history-table-body" class="divide-y divide-gray-100 dark:divide-gray-700 font-medium">
                
                <!-- Row 1: ORD-045 -->
                <tr class="history-item-row hover:bg-gray-50/80 dark:hover:bg-gray-700/40 transition"
                    data-id="#ORD-20260822-045" data-customer="Ahmad Fauzi" data-type="Dine In" data-payment="QRIS" data-status="Selesai">
                    <td class="px-5 py-4">
                        <span class="font-bold text-gray-900 dark:text-white block text-sm">#ORD-20260822-045</span>
                        <span class="text-[11px] text-gray-400 flex items-center gap-1 mt-0.5">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            22 Agu 2026, 13:42
                        </span>
                    </td>
                    <td class="px-5 py-4">
                        <span class="font-semibold text-gray-800 dark:text-gray-200 block">Ahmad Fauzi</span>
                        <span class="text-[11px] text-gray-400">Kasir: Admin</span>
                    </td>
                    <td class="px-5 py-4">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400">
                            Dine In (Meja 04)
                        </span>
                    </td>
                    <td class="px-5 py-4 max-w-xs">
                        <p class="truncate text-gray-700 dark:text-gray-300">2x Mie Ayam Spesial, 2x Es Jeruk Segar</p>
                        <span class="text-[11px] text-gray-400">Total 4 item</span>
                    </td>
                    <td class="px-5 py-4">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 text-xs font-medium">
                            <span class="w-2 h-2 rounded-full bg-blue-500"></span> QRIS
                        </span>
                    </td>
                    <td class="px-5 py-4 text-right">
                        <span class="font-bold text-gray-900 dark:text-white text-sm">Rp 55.000</span>
                        <span class="text-[11px] text-emerald-600 dark:text-emerald-400 block font-medium">Lunas</span>
                    </td>
                    <td class="px-5 py-4 text-center">
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Selesai
                        </span>
                    </td>
                    <td class="px-5 py-4 text-center">
                        <div class="flex items-center justify-center gap-1.5">
                            <button type="button" title="Lihat Struk" onclick="openHistoryReceiptModal('#ORD-20260822-045', 'Ahmad Fauzi', 'Dine In (Meja 04)', 'QRIS', '22 Agu 2026, 13:42', 50000, 5000, 55000, [{'name':'Mie Ayam Spesial', 'qty':2, 'price':18000}, {'name':'Es Jeruk Segar', 'qty':2, 'price':7000}])"
                                class="p-1.5 text-blue-600 dark:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/30 rounded-lg transition cursor-pointer">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                            <button type="button" title="Cetak Ulang" onclick="directPrintOrder('#ORD-20260822-045')"
                                class="p-1.5 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition cursor-pointer">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>

                <!-- Row 2: ORD-044 -->
                <tr class="history-item-row hover:bg-gray-50/80 dark:hover:bg-gray-700/40 transition"
                    data-id="#ORD-20260822-044" data-customer="Siti Nurhaliza" data-type="Take Away" data-payment="Tunai" data-status="Selesai">
                    <td class="px-5 py-4">
                        <span class="font-bold text-gray-900 dark:text-white block text-sm">#ORD-20260822-044</span>
                        <span class="text-[11px] text-gray-400 flex items-center gap-1 mt-0.5">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            22 Agu 2026, 13:20
                        </span>
                    </td>
                    <td class="px-5 py-4">
                        <span class="font-semibold text-gray-800 dark:text-gray-200 block">Siti Nurhaliza</span>
                        <span class="text-[11px] text-gray-400">Kasir: Admin</span>
                    </td>
                    <td class="px-5 py-4">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-purple-50 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400">
                            Take Away
                        </span>
                    </td>
                    <td class="px-5 py-4 max-w-xs">
                        <p class="truncate text-gray-700 dark:text-gray-300">1x Nasi Goreng Ayam, 1x Es Jeruk Segar</p>
                        <span class="text-[11px] text-gray-400">Total 2 item</span>
                    </td>
                    <td class="px-5 py-4">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 text-xs font-medium">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Tunai
                        </span>
                    </td>
                    <td class="px-5 py-4 text-right">
                        <span class="font-bold text-gray-900 dark:text-white text-sm">Rp 29.700</span>
                        <span class="text-[11px] text-emerald-600 dark:text-emerald-400 block font-medium">Lunas</span>
                    </td>
                    <td class="px-5 py-4 text-center">
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Selesai
                        </span>
                    </td>
                    <td class="px-5 py-4 text-center">
                        <div class="flex items-center justify-center gap-1.5">
                            <button type="button" title="Lihat Struk" onclick="openHistoryReceiptModal('#ORD-20260822-044', 'Siti Nurhaliza', 'Take Away', 'Tunai', '22 Agu 2026, 13:20', 27000, 2700, 29700, [{'name':'Nasi Goreng Ayam', 'qty':1, 'price':20000}, {'name':'Es Jeruk Segar', 'qty':1, 'price':7000}])"
                                class="p-1.5 text-blue-600 dark:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/30 rounded-lg transition cursor-pointer">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                            </button>
                            <button type="button" title="Cetak Ulang" onclick="directPrintOrder('#ORD-20260822-044')"
                                class="p-1.5 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition cursor-pointer">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" /></svg>
                            </button>
                        </div>
                    </td>
                </tr>

                <!-- Row 3: ORD-043 -->
                <tr class="history-item-row hover:bg-gray-50/80 dark:hover:bg-gray-700/40 transition"
                    data-id="#ORD-20260822-043" data-customer="Budi Santoso" data-type="Dine In" data-payment="QRIS" data-status="Diproses">
                    <td class="px-5 py-4">
                        <span class="font-bold text-gray-900 dark:text-white block text-sm">#ORD-20260822-043</span>
                        <span class="text-[11px] text-gray-400 flex items-center gap-1 mt-0.5">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            22 Agu 2026, 12:55
                        </span>
                    </td>
                    <td class="px-5 py-4">
                        <span class="font-semibold text-gray-800 dark:text-gray-200 block">Budi Santoso</span>
                        <span class="text-[11px] text-gray-400">Kasir: Admin</span>
                    </td>
                    <td class="px-5 py-4">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400">
                            Dine In (Meja 08)
                        </span>
                    </td>
                    <td class="px-5 py-4 max-w-xs">
                        <p class="truncate text-gray-700 dark:text-gray-300">3x Gado-Gado Spesial, 3x Es Jeruk</p>
                        <span class="text-[11px] text-gray-400">Total 6 item</span>
                    </td>
                    <td class="px-5 py-4">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 text-xs font-medium">
                            <span class="w-2 h-2 rounded-full bg-blue-500"></span> QRIS
                        </span>
                    </td>
                    <td class="px-5 py-4 text-right">
                        <span class="font-bold text-gray-900 dark:text-white text-sm">Rp 75.900</span>
                        <span class="text-[11px] text-blue-600 dark:text-blue-400 block font-medium">Menunggu Masak</span>
                    </td>
                    <td class="px-5 py-4 text-center">
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400">
                            <span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-pulse"></span> Diproses
                        </span>
                    </td>
                    <td class="px-5 py-4 text-center">
                        <div class="flex items-center justify-center gap-1.5">
                            <button type="button" title="Lihat Struk" onclick="openHistoryReceiptModal('#ORD-20260822-043', 'Budi Santoso', 'Dine In (Meja 08)', 'QRIS', '22 Agu 2026, 12:55', 69000, 6900, 75900, [{'name':'Gado-Gado Spesial', 'qty':3, 'price':16000}, {'name':'Es Jeruk Segar', 'qty':3, 'price':7000}])"
                                class="p-1.5 text-blue-600 dark:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/30 rounded-lg transition cursor-pointer">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                            </button>
                            <button type="button" title="Cetak Ulang" onclick="directPrintOrder('#ORD-20260822-043')"
                                class="p-1.5 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition cursor-pointer">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" /></svg>
                            </button>
                        </div>
                    </td>
                </tr>

                <!-- Row 4: ORD-042 -->
                <tr class="history-item-row hover:bg-gray-50/80 dark:hover:bg-gray-700/40 transition"
                    data-id="#ORD-20260822-042" data-customer="Dewi Lestari" data-type="Dine In" data-payment="Transfer" data-status="Selesai">
                    <td class="px-5 py-4">
                        <span class="font-bold text-gray-900 dark:text-white block text-sm">#ORD-20260822-042</span>
                        <span class="text-[11px] text-gray-400 flex items-center gap-1 mt-0.5">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            22 Agu 2026, 12:15
                        </span>
                    </td>
                    <td class="px-5 py-4">
                        <span class="font-semibold text-gray-800 dark:text-gray-200 block">Dewi Lestari</span>
                        <span class="text-[11px] text-gray-400">Kasir: Admin</span>
                    </td>
                    <td class="px-5 py-4">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400">
                            Dine In (Meja 02)
                        </span>
                    </td>
                    <td class="px-5 py-4 max-w-xs">
                        <p class="truncate text-gray-700 dark:text-gray-300">2x Nasi Goreng Ayam Spesial</p>
                        <span class="text-[11px] text-gray-400">Total 2 item</span>
                    </td>
                    <td class="px-5 py-4">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 text-xs font-medium">
                            <span class="w-2 h-2 rounded-full bg-amber-500"></span> Transfer
                        </span>
                    </td>
                    <td class="px-5 py-4 text-right">
                        <span class="font-bold text-gray-900 dark:text-white text-sm">Rp 44.000</span>
                        <span class="text-[11px] text-emerald-600 dark:text-emerald-400 block font-medium">Lunas</span>
                    </td>
                    <td class="px-5 py-4 text-center">
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Selesai
                        </span>
                    </td>
                    <td class="px-5 py-4 text-center">
                        <div class="flex items-center justify-center gap-1.5">
                            <button type="button" title="Lihat Struk" onclick="openHistoryReceiptModal('#ORD-20260822-042', 'Dewi Lestari', 'Dine In (Meja 02)', 'Transfer', '22 Agu 2026, 12:15', 40000, 4000, 44000, [{'name':'Nasi Goreng Ayam', 'qty':2, 'price':20000}])"
                                class="p-1.5 text-blue-600 dark:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/30 rounded-lg transition cursor-pointer">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                            </button>
                            <button type="button" title="Cetak Ulang" onclick="directPrintOrder('#ORD-20260822-042')"
                                class="p-1.5 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition cursor-pointer">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" /></svg>
                            </button>
                        </div>
                    </td>
                </tr>

                <!-- Row 5: ORD-040 (Dibatalkan) -->
                <tr class="history-item-row hover:bg-gray-50/80 dark:hover:bg-gray-700/40 transition"
                    data-id="#ORD-20260822-040" data-customer="Hendra Wijaya" data-type="Dine In" data-payment="Tunai" data-status="Dibatalkan">
                    <td class="px-5 py-4">
                        <span class="font-bold text-gray-900 dark:text-white block text-sm line-through opacity-70">#ORD-20260822-040</span>
                        <span class="text-[11px] text-gray-400 flex items-center gap-1 mt-0.5">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            22 Agu 2026, 11:10
                        </span>
                    </td>
                    <td class="px-5 py-4">
                        <span class="font-semibold text-gray-800 dark:text-gray-200 block">Hendra Wijaya</span>
                        <span class="text-[11px] text-gray-400">Kasir: Admin</span>
                    </td>
                    <td class="px-5 py-4">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300">
                            Dine In (Meja 06)
                        </span>
                    </td>
                    <td class="px-5 py-4 max-w-xs">
                        <p class="truncate text-gray-500 line-through">1x Mie Ayam, 1x Es Jeruk</p>
                        <span class="text-[11px] text-red-500">Alasan: Salah input meja</span>
                    </td>
                    <td class="px-5 py-4">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-500 text-xs font-medium">
                            Tunai
                        </span>
                    </td>
                    <td class="px-5 py-4 text-right">
                        <span class="font-bold text-gray-400 text-sm line-through">Rp 27.500</span>
                        <span class="text-[11px] text-red-500 block font-medium">Dibatalkan</span>
                    </td>
                    <td class="px-5 py-4 text-center">
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-red-50 dark:bg-red-900/30 text-red-600 dark:text-red-400">
                            <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Dibatalkan
                        </span>
                    </td>
                    <td class="px-5 py-4 text-center">
                        <span class="text-xs text-gray-400">-</span>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>

    <!-- Table Pagination -->
    <div class="px-5 py-4 bg-gray-50/80 dark:bg-gray-700/50 border-t border-gray-100 dark:border-gray-700 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-gray-500 dark:text-gray-400">
        <p>Menampilkan <span class="font-bold text-gray-800 dark:text-gray-200">1 - 5</span> dari <span class="font-bold text-gray-800 dark:text-gray-200">45</span> transaksi</p>
        <div class="flex items-center gap-1.5">
            <button type="button" class="px-3 py-1.5 rounded-lg border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-400 cursor-not-allowed" disabled>Sebelumnya</button>
            <button type="button" class="px-3 py-1.5 rounded-lg border border-blue-600 bg-blue-600 text-white font-semibold">1</button>
            <button type="button" class="px-3 py-1.5 rounded-lg border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-200">2</button>
            <button type="button" class="px-3 py-1.5 rounded-lg border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-200">3</button>
            <button type="button" class="px-3 py-1.5 rounded-lg border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-200">Selanjutnya</button>
        </div>
    </div>
</div>
