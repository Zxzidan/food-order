<x-layout>
    <x-slot:title>
        {{ $title }}
    </x-slot:title>

    <div class="space-y-6 pb-12">
        <!-- 1. Header & Actions Component -->
        <x-history.header />

        <!-- 2. Summary Metric Stats Cards Component -->
        <x-history.stats />

        <!-- 3. Filter & Search Toolbar Component -->
        <x-history.filter-bar />

        <!-- 4. Table View Component (Default) -->
        <x-history.table-view />

        <!-- 5. Cards View Component (Toggled on Demand) -->
        <x-history.cards-view />

        <!-- Empty State (Hidden when items found) -->
        <div id="history-empty-state" class="hidden bg-white dark:bg-gray-800 p-12 rounded-2xl border border-gray-100 dark:border-gray-700 text-center space-y-3">
            <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 text-gray-400 rounded-full flex items-center justify-center mx-auto">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h3 class="text-base font-bold text-gray-900 dark:text-white">Tidak Ada Riwayat Transaksi Ditemukan</h3>
            <p class="text-xs text-gray-500 dark:text-gray-400 max-w-sm mx-auto">Coba ubah kata kunci pencarian atau bersihkan filter yang sedang aktif</p>
            <button type="button" onclick="resetHistoryFilters()"
                class="inline-flex items-center gap-1.5 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-xs font-semibold transition cursor-pointer">
                Reset Semua Filter
            </button>
        </div>
    </div>

    <!-- 6. Receipt Modal Component -->
    <x-history.receipt-modal />

    <!-- ========================================================= -->
    <!-- Scripts for History Interactions & Filters -->
    <!-- ========================================================= -->
    <script>
        function formatRupiah(number) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                maximumFractionDigits: 0
            }).format(number);
        }

        let currentStatusFilter = 'all';

        function filterByStatus(status, button) {
            currentStatusFilter = status;
            document.querySelectorAll('.history-status-tab').forEach(btn => {
                btn.className = 'history-status-tab px-3 py-1.5 rounded-lg text-xs font-semibold text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition cursor-pointer';
            });
            button.className = 'history-status-tab px-3 py-1.5 rounded-lg text-xs font-semibold bg-white dark:bg-gray-800 text-blue-600 dark:text-blue-400 shadow-2xs transition cursor-pointer';

            applyHistoryFilters();
        }

        function applyHistoryFilters() {
            const query = document.getElementById('history-search-input').value.toLowerCase();
            const paymentFilter = document.getElementById('history-payment-filter').value.toLowerCase();
            const typeFilter = document.getElementById('history-type-filter').value.toLowerCase();

            const rows = document.querySelectorAll('#history-table-body .history-item-row');
            let visibleCount = 0;

            rows.forEach(row => {
                const text = row.innerText.toLowerCase();
                const statusAttr = row.getAttribute('data-status') || '';
                const paymentAttr = (row.getAttribute('data-payment') || '').toLowerCase();
                const typeAttr = (row.getAttribute('data-type') || '').toLowerCase();

                const matchesQuery = text.includes(query);
                const matchesStatus = currentStatusFilter === 'all' || statusAttr === currentStatusFilter;
                const matchesPayment = !paymentFilter || paymentAttr.includes(paymentFilter);
                const matchesType = !typeFilter || typeAttr.includes(typeFilter);

                if (matchesQuery && matchesStatus && matchesPayment && matchesType) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });

            // Empty state toggle
            const emptyState = document.getElementById('history-empty-state');
            const tableContainer = document.getElementById('history-table-container');
            const cardsContainer = document.getElementById('history-cards-container');

            if (visibleCount === 0) {
                emptyState.classList.remove('hidden');
                tableContainer.classList.add('hidden');
                cardsContainer.classList.add('hidden');
            } else {
                emptyState.classList.add('hidden');
                const isCardsMode = !document.getElementById('btn-view-cards').classList.contains('text-gray-500');
                if (isCardsMode) {
                    cardsContainer.classList.remove('hidden');
                    tableContainer.classList.add('hidden');
                } else {
                    tableContainer.classList.remove('hidden');
                    cardsContainer.classList.add('hidden');
                }
            }
        }

        function resetHistoryFilters() {
            document.getElementById('history-search-input').value = '';
            document.getElementById('history-payment-filter').value = '';
            document.getElementById('history-type-filter').value = '';
            
            const firstTab = document.querySelector('.history-status-tab');
            if (firstTab) filterByStatus('all', firstTab);
        }

        // View Mode Switcher (Table vs Card)
        function setViewMode(mode) {
            const tableContainer = document.getElementById('history-table-container');
            const cardsContainer = document.getElementById('history-cards-container');
            const btnTable = document.getElementById('btn-view-table');
            const btnCards = document.getElementById('btn-view-cards');

            if (mode === 'table') {
                tableContainer.classList.remove('hidden');
                cardsContainer.classList.add('hidden');
                btnTable.className = 'p-1.5 rounded-lg bg-white dark:bg-gray-800 text-blue-600 dark:text-blue-400 shadow-2xs transition cursor-pointer';
                btnCards.className = 'p-1.5 rounded-lg text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition cursor-pointer';
            } else {
                cardsContainer.classList.remove('hidden');
                tableContainer.classList.add('hidden');
                btnCards.className = 'p-1.5 rounded-lg bg-white dark:bg-gray-800 text-blue-600 dark:text-blue-400 shadow-2xs transition cursor-pointer';
                btnTable.className = 'p-1.5 rounded-lg text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition cursor-pointer';
            }
        }

        // Receipt Modal Logic
        function openHistoryReceiptModal(orderId, customer, type, payment, date, subtotal, tax, total, items) {
            document.getElementById('h-receipt-order-id').innerText = orderId;
            document.getElementById('h-receipt-customer').innerText = customer;
            document.getElementById('h-receipt-type').innerText = type;
            document.getElementById('h-receipt-payment').innerText = payment;
            document.getElementById('h-receipt-date').innerText = date;
            document.getElementById('h-receipt-subtotal').innerText = formatRupiah(subtotal);
            document.getElementById('h-receipt-tax').innerText = formatRupiah(tax);
            document.getElementById('h-receipt-total').innerText = formatRupiah(total);

            const itemsContainer = document.getElementById('h-receipt-items');
            itemsContainer.innerHTML = '';
            items.forEach(item => {
                const itemEl = document.createElement('div');
                itemEl.className = 'flex justify-between items-center text-[11px]';
                itemEl.innerHTML = `
                    <div>
                        <p class="font-semibold text-gray-800 dark:text-gray-200">${item.name}</p>
                        <p class="text-[10px] text-gray-500">${item.qty} x ${formatRupiah(item.price)}</p>
                    </div>
                    <span class="font-bold">${formatRupiah(item.qty * item.price)}</span>
                `;
                itemsContainer.appendChild(itemEl);
            });

            document.getElementById('history-receipt-modal').classList.remove('hidden');
        }

        function closeHistoryReceiptModal() {
            document.getElementById('history-receipt-modal').classList.add('hidden');
        }

        function directPrintOrder(orderId) {
            window.print();
        }

        function exportHistoryCSV() {
            const rows = [
                ["No. Order", "Tanggal & Waktu", "Pelanggan", "Tipe Pesanan", "Metode Bayar", "Items", "Total Tagihan", "Status"],
                ["#ORD-20260822-045", "22 Agu 2026 13:42", "Ahmad Fauzi", "Dine In (Meja 04)", "QRIS", "2x Mie Ayam, 2x Es Jeruk", "55000", "Selesai"],
                ["#ORD-20260822-044", "22 Agu 2026 13:20", "Siti Nurhaliza", "Take Away", "Tunai", "1x Nasi Goreng, 1x Es Jeruk", "29700", "Selesai"],
                ["#ORD-20260822-043", "22 Agu 2026 12:55", "Budi Santoso", "Dine In (Meja 08)", "QRIS", "3x Gado-Gado, 3x Es Jeruk", "75900", "Diproses"],
                ["#ORD-20260822-042", "22 Agu 2026 12:15", "Dewi Lestari", "Dine In (Meja 02)", "Transfer", "2x Nasi Goreng Ayam", "44000", "Selesai"],
                ["#ORD-20260822-040", "22 Agu 2026 11:10", "Hendra Wijaya", "Dine In (Meja 06)", "Tunai", "1x Mie Ayam, 1x Es Jeruk", "27500", "Dibatalkan"]
            ];

            let csvContent = "data:text/csv;charset=utf-8," + rows.map(e => e.join(",")).join("\n");
            const encodedUri = encodeURI(csvContent);
            const link = document.createElement("a");
            link.setAttribute("href", encodedUri);
            link.setAttribute("download", "Riwayat_Transaksi_SIPEMMA_" + new Date().toISOString().slice(0, 10) + ".csv");
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
    </script>
</x-layout>