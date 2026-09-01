<x-layout>
    <x-slot:title>
        {{ $title }}
    </x-slot:title>

    <!-- External Chart Script (ApexCharts) -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <!-- Print Stylesheet -->
    <style>
        @media print {
            aside, #sidebar-backdrop, header, #report-filter-bar, .no-print {
                display: none !important;
            }
            #main-content {
                margin-left: 0 !important;
                padding: 0 !important;
            }
            body {
                background: white !important;
                color: black !important;
            }
            .print-only {
                display: block !important;
            }
            .shadow-sm, .shadow-md, .shadow-lg, .shadow-xl {
                box-shadow: none !important;
                border: 1px solid #e5e7eb !important;
            }
        }
    </style>

    <div class="space-y-6 pb-12">
        <!-- 1. Header & Actions Component -->
        <x-reports.header />

        <!-- 2. Filter Bar Component -->
        <x-reports.filter-bar />

        <!-- 3. KPI Metric Cards Component -->
        <x-reports.kpi-cards :kpi="$kpi ?? []" />

        <!-- 4. Interactive Charts Component -->
        <x-reports.charts />

        <!-- 5. Top Selling Menu & Peak Hours Component -->
        <x-reports.top-items :topSelling="$topSelling ?? []" />

        <!-- 6. Filterable Transaction Table Component -->
        <x-reports.transaction-table :orders="$orders ?? []" />
    </div>

    <!-- 7. Receipt Detail Modal Component -->
    <x-reports.receipt-modal />

    <!-- ========================================================= -->
    <!-- Script Logic for Charts & Filters -->
    <!-- ========================================================= -->
    <script>
        // Formatting helper
        function formatRupiah(number) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                maximumFractionDigits: 0
            }).format(number);
        }

        let revenueChartInstance = null;
        let paymentChartInstance = null;
        let peakHoursChartInstance = null;

        // Initialize Charts on DOMContentLoaded
        document.addEventListener('DOMContentLoaded', function() {
            initCharts();
        });

        function isDarkMode() {
            return document.documentElement.classList.contains('dark');
        }

        function initCharts() {
            const dark = isDarkMode();
            const textColor = dark ? '#9ca3af' : '#6b7280';
            const gridColor = dark ? '#374151' : '#f3f4f6';

            // 1. Revenue & Orders Trend Area Chart
            const revenueOptions = {
                series: [{
                    name: 'Pendapatan (Rp)',
                    type: 'area',
                    data: [1200000, 1850000, 1400000, 2100000, 2600000, 3100000, 2800000, 1950000, 2400000, 2900000, 3450000, 3700000]
                }, {
                    name: 'Jumlah Pesanan',
                    type: 'line',
                    data: [42, 65, 48, 72, 88, 105, 94, 68, 80, 96, 118, 128]
                }],
                chart: {
                    height: 320,
                    type: 'line',
                    toolbar: { show: false },
                    zoom: { enabled: false },
                    fontFamily: 'InterVariable, sans-serif'
                },
                colors: ['#2563eb', '#10b981'],
                dataLabels: { enabled: false },
                stroke: {
                    curve: 'smooth',
                    width: [3, 2.5]
                },
                fill: {
                    type: ['gradient', 'solid'],
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.35,
                        opacityTo: 0.05,
                        stops: [0, 90, 100]
                    }
                },
                xaxis: {
                    categories: ['1 Agu', '3 Agu', '5 Agu', '7 Agu', '9 Agu', '11 Agu', '13 Agu', '15 Agu', '17 Agu', '19 Agu', '21 Agu', '22 Agu'],
                    labels: {
                        style: { colors: textColor, fontSize: '11px' }
                    },
                    axisBorder: { show: false },
                    axisTicks: { show: false }
                },
                yaxis: [{
                    labels: {
                        formatter: function(val) {
                            return 'Rp ' + (val / 1000000).toFixed(1) + 'M';
                        },
                        style: { colors: textColor, fontSize: '11px' }
                    }
                }, {
                    opposite: true,
                    labels: {
                        formatter: function(val) {
                            return val + ' order';
                        },
                        style: { colors: textColor, fontSize: '11px' }
                    }
                }],
                grid: {
                    borderColor: gridColor,
                    strokeDashArray: 4
                },
                legend: { show: false },
                tooltip: {
                    theme: dark ? 'dark' : 'light',
                    y: {
                        formatter: function(val, opts) {
                            if (opts.seriesIndex === 0) {
                                return formatRupiah(val);
                            }
                            return val + ' Pesanan';
                        }
                    }
                }
            };

            const chartEl = document.querySelector('#revenue-trend-chart');
            if (chartEl) {
                chartEl.innerHTML = '';
                revenueChartInstance = new ApexCharts(chartEl, revenueOptions);
                revenueChartInstance.render();
            }

            // 2. Payment Methods Donut Chart
            const paymentOptions = {
                series: [54, 32, 14],
                chart: {
                    type: 'donut',
                    height: 240, // Slightly taller to accommodate legends
                    fontFamily: 'InterVariable, sans-serif'
                },
                labels: ['QRIS', 'Tunai', 'Transfer / Debit'],
                colors: ['#2563eb', '#10b981', '#f59e0b'],
                legend: {
                    position: 'bottom',
                    labels: { colors: textColor },
                    fontSize: '11px',
                    itemMargin: { horizontal: 6, vertical: 4 },
                    formatter: function(seriesName, opts) {
                        return seriesName + " (" + opts.w.globals.seriesTotals[opts.seriesIndex] + "%)";
                    }
                },
                dataLabels: { enabled: false },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '80%',
                            labels: {
                                show: true,
                                name: { 
                                    show: true, 
                                    fontSize: '11px', 
                                    fontWeight: 500,
                                    color: textColor,
                                    offsetY: -5
                                },
                                value: {
                                    show: true,
                                    fontSize: '20px',
                                    fontWeight: 'bold',
                                    color: dark ? '#ffffff' : '#111827',
                                    offsetY: 5,
                                    formatter: function(val) { return val + '%'; }
                                },
                                total: {
                                    show: true,
                                    label: 'Total Transaksi',
                                    fontSize: '10px',
                                    color: textColor,
                                    formatter: function() { return '924'; }
                                }
                            }
                        }
                    }
                },
                stroke: { colors: [dark ? '#1f2937' : '#ffffff'], width: 2 }
            };

            const paymentEl = document.querySelector('#payment-methods-chart');
            if (paymentEl) {
                paymentEl.innerHTML = '';
                paymentChartInstance = new ApexCharts(paymentEl, paymentOptions);
                paymentChartInstance.render();
            }

            // 3. Peak Operational Hours Bar Chart
            const peakHoursOptions = {
                series: [{
                    name: 'Pesanan per Jam',
                    data: [12, 28, 95, 142, 60, 35, 88, 130, 75, 20]
                }],
                chart: {
                    type: 'bar',
                    height: 180,
                    toolbar: { show: false },
                    fontFamily: 'InterVariable, sans-serif'
                },
                colors: ['#3b82f6'],
                plotOptions: {
                    bar: {
                        borderRadius: 6,
                        columnWidth: '55%',
                        distributed: false
                    }
                },
                dataLabels: { enabled: false },
                xaxis: {
                    categories: ['10:00', '11:00', '12:00', '13:00', '14:00', '17:00', '18:00', '19:00', '20:00', '21:00'],
                    labels: {
                        style: { colors: textColor, fontSize: '10px' }
                    },
                    axisBorder: { show: false },
                    axisTicks: { show: false }
                },
                yaxis: {
                    show: false
                },
                grid: {
                    borderColor: gridColor,
                    strokeDashArray: 4,
                    yaxis: { lines: { show: false } }
                },
                tooltip: {
                    theme: dark ? 'dark' : 'light',
                    y: {
                        formatter: function(val) {
                            return val + ' Pesanan';
                        }
                    }
                }
            };

            const peakEl = document.querySelector('#peak-hours-chart');
            if (peakEl) {
                peakEl.innerHTML = '';
                peakHoursChartInstance = new ApexCharts(peakEl, peakHoursOptions);
                peakHoursChartInstance.render();
            }
        }

        // Listen for Theme Toggle changes to update charts
        const themeBtn = document.getElementById('theme-toggle');
        if (themeBtn) {
            themeBtn.addEventListener('click', function() {
                setTimeout(initCharts, 100);
            });
        }

        // Period filter switcher
        function setPeriodFilter(type, button) {
            document.querySelectorAll('.period-filter-btn').forEach(btn => {
                btn.className = 'period-filter-btn px-3 py-1.5 rounded-lg text-xs font-semibold text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition cursor-pointer';
            });
            button.className = 'period-filter-btn px-3 py-1.5 rounded-lg text-xs font-semibold bg-white dark:bg-gray-800 text-blue-600 dark:text-blue-400 shadow-2xs transition cursor-pointer';

            // Simulate updating stats based on filter
            if (type === 'today') {
                document.getElementById('stat-revenue').innerText = 'Rp 2.450.000';
                document.getElementById('stat-transactions').innerText = '78';
                document.getElementById('stat-items').innerText = '154';
                document.getElementById('stat-aov').innerText = 'Rp 31.410';
            } else if (type === '7days') {
                document.getElementById('stat-revenue').innerText = 'Rp 14.820.000';
                document.getElementById('stat-transactions').innerText = '480';
                document.getElementById('stat-items').innerText = '960';
                document.getElementById('stat-aov').innerText = 'Rp 30.875';
            } else if (type === 'month') {
                document.getElementById('stat-revenue').innerText = 'Rp 28.450.000';
                document.getElementById('stat-transactions').innerText = '924';
                document.getElementById('stat-items').innerText = '1.842';
                document.getElementById('stat-aov').innerText = 'Rp 30.790';
            } else if (type === 'year') {
                document.getElementById('stat-revenue').innerText = 'Rp 324.500.000';
                document.getElementById('stat-transactions').innerText = '10.850';
                document.getElementById('stat-items').innerText = '21.400';
                document.getElementById('stat-aov').innerText = 'Rp 29.900';
            }
        }

        function applyCustomDates() {
            const start = document.getElementById('date-start').value;
            const end = document.getElementById('date-end').value;
            console.log('Filtered from', start, 'to', end);
        }

        function refreshReportData() {
            initCharts();
        }

        // Search & Filter in Table
        function filterReportTable() {
            const query = document.getElementById('report-search-table').value.toLowerCase();
            const paymentFilter = document.getElementById('report-filter-payment').value.toLowerCase();
            const typeFilter = document.getElementById('report-filter-type').value.toLowerCase();

            const rows = document.querySelectorAll('#report-table-body tr');
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

        // Export to CSV Function
        function exportToCSV() {
            const rows = [
                ["No. Order", "Tanggal", "Pelanggan", "Tipe Pesanan", "Metode Bayar", "Items", "Total"],
                ["#ORD-20260822-045", "22 Agu 2026 13:42", "Ahmad Fauzi", "Dine In (Meja 04)", "QRIS", "2x Mie Ayam, 2x Es Jeruk", "55000"],
                ["#ORD-20260822-044", "22 Agu 2026 13:20", "Siti Nurhaliza", "Take Away", "Tunai", "1x Nasi Goreng, 1x Es Jeruk", "29700"],
                ["#ORD-20260822-043", "22 Agu 2026 12:55", "Budi Santoso", "Dine In (Meja 08)", "QRIS", "3x Gado-Gado, 3x Es Jeruk", "75900"],
                ["#ORD-20260822-042", "22 Agu 2026 12:15", "Dewi Lestari", "Dine In (Meja 02)", "Transfer", "2x Nasi Goreng Ayam", "44000"],
                ["#ORD-20260822-041", "22 Agu 2026 11:45", "Reza Rahardian", "Take Away", "Tunai", "4x Mie Ayam Spesial", "79200"]
            ];

            let csvContent = "data:text/csv;charset=utf-8," + rows.map(e => e.join(",")).join("\n");
            const encodedUri = encodeURI(csvContent);
            const link = document.createElement("a");
            link.setAttribute("href", encodedUri);
            link.setAttribute("download", "Laporan_Penjualan_SIPEMMA_" + new Date().toISOString().slice(0, 10) + ".csv");
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
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