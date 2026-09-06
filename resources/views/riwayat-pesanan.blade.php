<x-layout>
    <x-slot:title>
        {{ $title }}
    </x-slot:title>



    <div class="space-y-6 pb-12">
        <!-- Filterable Transaction Table Component -->
        <x-reports.transaction-table :orders="$orders ?? []" />
    </div>

    <!-- Receipt Detail Modal Component -->
    <x-reports.receipt-modal />

    <script>
        // Formatting helper
        function formatRupiah(number) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                maximumFractionDigits: 0
            }).format(number);
        }

        // Search & Filter in Table
        function filterReportTable() {
            const query = document.getElementById('report-search-table').value.toLowerCase();
            const paymentFilter = document.getElementById('report-filter-payment').value.toLowerCase();
            const typeFilter = document.getElementById('report-filter-type').value.toLowerCase();

            const rows = document.querySelectorAll('.report-item');
            rows.forEach(row => {
                const text = (row.innerText + ' ' + (row.getAttribute('data-order') || '')).toLowerCase();
                const matchesQuery = text.includes(query);
                const matchesPayment = !paymentFilter || text.includes(paymentFilter);
                const matchesType = !typeFilter || text.includes(typeFilter);

                if (matchesQuery && matchesPayment && matchesType) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        // Receipt Modal Handlers
        function showReceiptDetail(orderId, customer, type, payment, date, subtotal, tax, total, items) {
            document.getElementById('modal-receipt-order-id').innerText = orderId;
            document.getElementById('modal-receipt-customer').innerText = customer;
            document.getElementById('modal-receipt-type').innerText = type;
            document.getElementById('modal-receipt-payment').innerText = payment;
            document.getElementById('modal-receipt-date').innerText = date;
            document.getElementById('modal-receipt-subtotal').innerText = formatRupiah(subtotal);
            document.getElementById('modal-receipt-tax').innerText = formatRupiah(tax);
            document.getElementById('modal-receipt-total').innerText = formatRupiah(total);

            const itemsContainer = document.getElementById('modal-receipt-items');
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

            document.getElementById('report-receipt-modal').classList.remove('hidden');
        }

        function closeReportReceiptModal() {
            document.getElementById('report-receipt-modal').classList.add('hidden');
        }

        function printSingleReceipt() {
            window.print();
        }
    </script>
</x-layout>
