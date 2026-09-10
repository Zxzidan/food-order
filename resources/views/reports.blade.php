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

        const chartsData = @json($chartsData ?? []);

        function initCharts() {
            const dark = isDarkMode();
            const textColor = dark ? '#9ca3af' : '#6b7280';
            const gridColor = dark ? '#374151' : '#f3f4f6';

            // 1. Revenue & Orders Trend Area Chart
            const revenueOptions = {
                series: [{
                    name: 'Pendapatan (Rp)',
                    type: 'area',
                    data: chartsData.trend ? chartsData.trend.revenue : []
                }, {
                    name: 'Jumlah Pesanan',
                    type: 'line',
                    data: chartsData.trend ? chartsData.trend.orders : []
                }],
                chart: {
                    height: 320,
                    type: 'line',
                    toolbar: { show: false },
                    zoom: { enabled: false },
                    fontFamily: '"SF Pro", "SF Pro Display", -apple-system, BlinkMacSystemFont, sans-serif'
                },
                noData: {
                    text: 'Belum ada data pendapatan',
                    align: 'center',
                    verticalAlign: 'middle',
                    style: { color: textColor, fontSize: '12px' }
                },
                colors: ['#ea580c', '#10b981'],
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
                    categories: chartsData.trend ? chartsData.trend.categories : [],
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
                series: (chartsData.payment && chartsData.payment.total > 0) ? chartsData.payment.series : [],
                chart: {
                    type: 'donut',
                    height: 240, // Slightly taller to accommodate legends
                    fontFamily: '"SF Pro", "SF Pro Display", -apple-system, BlinkMacSystemFont, sans-serif'
                },
                noData: {
                    text: 'Belum ada data pembayaran',
                    align: 'center',
                    verticalAlign: 'middle',
                    style: { color: textColor, fontSize: '12px' }
                },
                labels: ['QRIS', 'Tunai', 'Transfer / Debit'],
                colors: ['#ea580c', '#10b981', '#f59e0b'],
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
                                    formatter: function() { return chartsData.payment ? chartsData.payment.total : 0; }
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
                    data: chartsData.peak ? chartsData.peak.data : []
                }],
                chart: {
                    type: 'bar',
                    height: 180,
                    toolbar: { show: false },
                    fontFamily: '"SF Pro", "SF Pro Display", -apple-system, BlinkMacSystemFont, sans-serif'
                },
                noData: {
                    text: 'Belum ada data jam sibuk',
                    align: 'center',
                    verticalAlign: 'middle',
                    style: { color: textColor, fontSize: '12px' }
                },
                colors: ['#ea580c'],
                plotOptions: {
                    bar: {
                        borderRadius: 6,
                        columnWidth: '55%',
                        distributed: false
                    }
                },
                dataLabels: { enabled: false },
                xaxis: {
                    categories: chartsData.peak ? chartsData.peak.categories : [],
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
            button.className = 'period-filter-btn px-3 py-1.5 rounded-lg text-xs font-semibold bg-white dark:bg-gray-800 text-orange-600 dark:text-orange-400 shadow-2xs transition cursor-pointer';

            const today = new Date();
            const formatDate = (d) => {
                const year = d.getFullYear();
                const month = String(d.getMonth() + 1).padStart(2, '0');
                const day = String(d.getDate()).padStart(2, '0');
                return `${year}-${month}-${day}`;
            };
            const dateEndEl = document.getElementById('date-end');
            const dateStartEl = document.getElementById('date-start');

            if (dateEndEl) dateEndEl.value = formatDate(today);

            if (type === 'today' && dateStartEl) {
                dateStartEl.value = formatDate(today);
            } else if (type === '7days' && dateStartEl) {
                const d = new Date();
                d.setDate(today.getDate() - 6);
                dateStartEl.value = formatDate(d);
            } else if (type === 'month' && dateStartEl) {
                const d = new Date(today.getFullYear(), today.getMonth(), 1);
                dateStartEl.value = formatDate(d);
            } else if (type === 'year' && dateStartEl) {
                const d = new Date(today.getFullYear(), 0, 1);
                dateStartEl.value = formatDate(d);
            }
        }

        function applyCustomDates() {
            const start = document.getElementById('date-start')?.value;
            const end = document.getElementById('date-end')?.value;
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

        // Export to CSV Function (Downloads real user orders from server)
        function exportToCSV() {
            const payment = document.getElementById('report-filter-payment')?.value || '';
            const type = document.getElementById('report-filter-type')?.value || '';
            const start = document.getElementById('date-start')?.value || '';
            const end = document.getElementById('date-end')?.value || '';

            const params = new URLSearchParams();
            if (payment) params.append('payment_method', payment);
            if (type) params.append('order_type', type);
            if (start) params.append('start_date', start);
            if (end) params.append('end_date', end);

            const url = "{{ route('reports.export') }}" + (params.toString() ? '?' + params.toString() : '');
            window.location.href = url;
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