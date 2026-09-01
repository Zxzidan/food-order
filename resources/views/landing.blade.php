<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPEMMA - Aplikasi Kasir & Manajemen Restoran Terbaik</title>
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        primary: {
                            50: '#fff7ed',
                            100: '#ffedd5',
                            200: '#fed7aa',
                            300: '#fdba74',
                            400: '#fb923c',
                            500: '#f97316',
                            600: '#ea580c', // SIPEMMA Orange
                            700: '#c2410c',
                            800: '#9a3412',
                            900: '#7c2d12',
                        },
                        dark: '#1e293b'
                    }
                }
            }
        }
    </script>
</head>
<body class="antialiased bg-white text-gray-800 font-sans selection:bg-primary-500 selection:text-white">

    <!-- Navbar -->
    <header class="fixed top-0 inset-x-0 bg-white/95 backdrop-blur-md z-50 border-b border-gray-100 transition-all shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <!-- Logo -->
            <div class="flex items-center gap-2">
                <a href="/" class="flex items-center gap-2">
                    <img src="{{ asset('assets/img/LOGO.png') }}" alt="SIPEMMA Logo" class="h-8 object-contain">
                </a>
            </div>

            <!-- Desktop Menu -->
            <nav class="hidden md:flex items-center gap-8 text-sm font-semibold text-gray-600">
                <a href="#fitur" class="hover:text-primary-600 transition-colors">Fitur</a>
                <a href="#solusi" class="hover:text-primary-600 transition-colors">Solusi Bisnis</a>
                <a href="#harga" class="hover:text-primary-600 transition-colors">Harga</a>
                <a href="#kontak" class="hover:text-primary-600 transition-colors">Hubungi Kami</a>
            </nav>

            <!-- CTA Buttons -->
            <div class="flex items-center gap-4">
                <a href="{{ route('login') }}" class="hidden sm:inline-block text-sm font-semibold text-gray-700 hover:text-primary-600 transition-colors">Log in</a>
                <a href="{{ route('register') }}" class="bg-primary-600 hover:bg-primary-700 text-white text-sm font-semibold py-2.5 px-5 rounded-lg shadow-md shadow-primary-500/30 transition-all transform hover:-translate-y-0.5">
                    Coba Gratis
                </a>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative pt-32 pb-20 lg:pt-40 lg:pb-28 bg-slate-50 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-8 items-center">
                <!-- Text Content -->
                <div class="max-w-2xl">
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-primary-50 border border-primary-100 text-primary-700 text-xs font-bold uppercase tracking-wider mb-6">
                        <span class="flex h-2 w-2 rounded-full bg-primary-600"></span>
                        Aplikasi POS Restoran #1
                    </div>
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-dark leading-[1.15] mb-6 tracking-tight">
                        Satu Aplikasi POS untuk Semua Kebutuhan Bisnis Anda
                    </h1>
                    <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                        Kelola bisnis lebih cepat dan fleksibel. Ambil keputusan cerdas berbasis laporan real-time, manajemen stok akurat, dan asisten AI langsung dari satu layar.
                    </p>
                    <div class="flex flex-col sm:flex-row items-center gap-4">
                        <a href="{{ route('register') }}" class="w-full sm:w-auto bg-primary-600 hover:bg-primary-700 text-white text-base font-semibold py-3.5 px-8 rounded-xl shadow-lg shadow-primary-500/30 transition-all transform hover:-translate-y-1 text-center flex items-center justify-center gap-2">
                            Coba Gratis Sekarang
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                        <a href="#fitur" class="w-full sm:w-auto bg-white hover:bg-gray-50 text-gray-700 border border-gray-200 text-base font-semibold py-3.5 px-8 rounded-xl transition-colors text-center">
                            Pelajari Lebih Lanjut
                        </a>
                    </div>
                </div>

                <!-- Hero Image/Mockup -->
                <div class="relative mx-auto w-full max-w-lg lg:max-w-none group">
                    <!-- Decorational Blob -->
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[120%] h-[120%] bg-gradient-to-tr from-primary-100 to-orange-50 rounded-full blur-3xl opacity-50 -z-10"></div>
                    
                    <div class="relative bg-white p-2 rounded-2xl shadow-2xl border border-gray-100 transform transition-transform duration-700 group-hover:-translate-y-2 group-hover:shadow-primary-500/20">
                        <img src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?auto=format&fit=crop&q=80&w=1200" alt="SIPEMMA POS System" class="rounded-xl w-full h-auto object-cover object-center aspect-[4/3]">
                        <!-- Floating badge -->
                        <div class="absolute -bottom-6 -left-6 bg-white p-4 rounded-xl shadow-xl border border-gray-100 flex items-center gap-4 animate-bounce" style="animation-duration: 3s;">
                            <div class="bg-green-100 p-2 rounded-lg text-green-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-gray-500">Akurasi Order</p>
                                <p class="text-lg font-bold text-dark">99.9%</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Social Proof Section -->
    <section class="py-10 border-y border-gray-100 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-sm font-semibold text-gray-400 uppercase tracking-widest mb-6">Dipercaya oleh ribuan bisnis kuliner di Indonesia</p>
            <div class="flex flex-wrap justify-center items-center gap-8 md:gap-16 opacity-50 grayscale hover:grayscale-0 transition-all duration-500">
                <svg class="h-8 text-gray-800" viewBox="0 0 100 30" fill="currentColor"><path d="M10,15 L20,15 M15,10 L15,20" stroke="currentColor" stroke-width="2"/><text x="30" y="20" font-family="sans-serif" font-weight="bold" font-size="18">Kopi Kenari</text></svg>
                <svg class="h-8 text-gray-800" viewBox="0 0 100 30" fill="currentColor"><circle cx="15" cy="15" r="8" stroke="currentColor" stroke-width="2" fill="none"/><text x="30" y="20" font-family="sans-serif" font-weight="bold" font-size="18">Warung Kita</text></svg>
                <svg class="h-8 text-gray-800" viewBox="0 0 100 30" fill="currentColor"><rect x="10" y="8" width="14" height="14" stroke="currentColor" stroke-width="2" fill="none"/><text x="35" y="20" font-family="sans-serif" font-weight="bold" font-size="18">Resto Raya</text></svg>
                <svg class="h-8 text-gray-800 hidden md:block" viewBox="0 0 100 30" fill="currentColor"><polygon points="15,5 25,20 5,20" stroke="currentColor" stroke-width="2" fill="none"/><text x="35" y="20" font-family="sans-serif" font-weight="bold" font-size="18">Bistro 99</text></svg>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="fitur" class="py-20 lg:py-28 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-dark mb-4">Pantau Usaha dengan Sat-set!</h2>
                <p class="text-lg text-gray-500">
                    Bisnis yang menggunakan SIPEMMA terbukti lebih sehat secara operasional dan finansial. Kelola pesanan, lacak stok, hingga laporan analitik semua dalam satu genggaman.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-slate-50 rounded-2xl p-8 border border-gray-100 hover:border-primary-200 hover:shadow-lg hover:shadow-primary-100/50 transition-all group">
                    <div class="w-14 h-14 bg-white rounded-xl shadow-sm border border-gray-100 flex items-center justify-center mb-6 group-hover:scale-110 group-hover:bg-primary-50 transition-all text-primary-600">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-dark mb-3">Manajemen Kasir (POS)</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Kelola pesanan Dine-In atau Takeaway dengan antarmuka kasir super cepat. Dukungan kalkulasi PB1, uang tunai, dan struk instan.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-slate-50 rounded-2xl p-8 border border-gray-100 hover:border-primary-200 hover:shadow-lg hover:shadow-primary-100/50 transition-all group">
                    <div class="w-14 h-14 bg-white rounded-xl shadow-sm border border-gray-100 flex items-center justify-center mb-6 group-hover:scale-110 group-hover:bg-primary-50 transition-all text-primary-600">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-dark mb-3">AI Smart Assistant</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Dilengkapi dengan kecerdasan buatan Gemini AI. Dapatkan rekomendasi promo, prediksi jam sibuk, dan analisis data layaknya asisten pribadi.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-slate-50 rounded-2xl p-8 border border-gray-100 hover:border-primary-200 hover:shadow-lg hover:shadow-primary-100/50 transition-all group">
                    <div class="w-14 h-14 bg-white rounded-xl shadow-sm border border-gray-100 flex items-center justify-center mb-6 group-hover:scale-110 group-hover:bg-primary-50 transition-all text-primary-600">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-dark mb-3">Laporan Komprehensif</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Pantau metrik bisnis Anda dari mana saja. Lihat total transaksi, omset, dan ranking produk terlaris secara real-time.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Two-column Info Section -->
    <section class="py-20 bg-slate-50 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1 relative">
                    <div class="absolute -inset-4 bg-primary-100 rounded-[3rem] transform -rotate-3 z-0"></div>
                    <img src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?auto=format&fit=crop&q=80&w=800" alt="Restoran operasional" class="relative z-10 rounded-2xl shadow-xl border-4 border-white object-cover aspect-[4/3] w-full">
                </div>
                <div class="order-1 lg:order-2 lg:pl-10">
                    <h2 class="text-3xl md:text-4xl font-bold text-dark mb-6">Semua fitur dalam satu ekosistem yang terintegrasi.</h2>
                    <ul class="space-y-6">
                        <li class="flex items-start gap-4">
                            <div class="shrink-0 mt-1 w-8 h-8 rounded-full bg-primary-100 flex items-center justify-center text-primary-600 font-bold text-sm">1</div>
                            <div>
                                <h4 class="text-xl font-bold text-gray-900 mb-1">Manajemen Menu Mudah</h4>
                                <p class="text-gray-600">Tambah produk, atur harga, kategori, dan stok secara langsung dari sistem dashboard yang intuitif.</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-4">
                            <div class="shrink-0 mt-1 w-8 h-8 rounded-full bg-primary-100 flex items-center justify-center text-primary-600 font-bold text-sm">2</div>
                            <div>
                                <h4 class="text-xl font-bold text-gray-900 mb-1">Cegah Kehabisan Stok</h4>
                                <p class="text-gray-600">Sistem memantau sisa produk secara otomatis dan memberitahu kasir jika menu sudah habis atau tidak tersedia.</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-4">
                            <div class="shrink-0 mt-1 w-8 h-8 rounded-full bg-primary-100 flex items-center justify-center text-primary-600 font-bold text-sm">3</div>
                            <div>
                                <h4 class="text-xl font-bold text-gray-900 mb-1">Hak Akses Fleksibel</h4>
                                <p class="text-gray-600">Amankan data sensitif restoran Anda dengan pembagian otoritas antara Administrator dan staf Kasir.</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Bottom CTA Banner -->
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-primary-600 rounded-3xl p-10 md:p-16 text-center text-white relative overflow-hidden">
                <!-- Abstract BG patterns -->
                <div class="absolute top-0 right-0 -mr-20 -mt-20 w-72 h-72 rounded-full bg-white opacity-10"></div>
                <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-56 h-56 rounded-full bg-black opacity-10"></div>
                
                <div class="relative z-10 max-w-3xl mx-auto">
                    <h2 class="text-3xl md:text-5xl font-bold mb-6">Siap memajukan bisnis restoran Anda?</h2>
                    <p class="text-lg md:text-xl text-primary-100 mb-10">
                        Bergabung dengan ribuan pengusaha kuliner lainnya. Daftar sekarang dan nikmati kemudahan operasional restoran dengan SIPEMMA.
                    </p>
                    <a href="{{ route('register') }}" class="inline-block bg-white text-primary-700 hover:bg-gray-50 text-lg font-bold py-4 px-10 rounded-xl shadow-xl hover:shadow-2xl transition-all transform hover:-translate-y-1">
                        Daftar SIPEMMA Gratis
                    </a>
                    <p class="mt-6 text-sm text-primary-200">Tidak memerlukan kartu kredit. Setup dalam 2 menit.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Minimalist Footer -->
    <footer class="bg-gray-50 pt-16 pb-8 border-t border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-8 mb-12">
                <div class="col-span-2 lg:col-span-2">
                    <img src="{{ asset('assets/img/LOGO.png') }}" alt="SIPEMMA Logo" class="h-8 mb-6 grayscale hover:grayscale-0 transition-all opacity-80 hover:opacity-100">
                    <p class="text-gray-500 text-sm leading-relaxed max-w-sm mb-6">
                        SIPEMMA adalah solusi perangkat lunak kasir pintar terintegrasi yang didesain untuk mempercepat dan menyederhanakan manajemen bisnis restoran Anda.
                    </p>
                    <div class="flex gap-4">
                        <!-- Social Icons -->
                        <a href="#" class="text-gray-400 hover:text-primary-600 transition-colors">
                            <span class="sr-only">Facebook</span>
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"/></svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-primary-600 transition-colors">
                            <span class="sr-only">Instagram</span>
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd"/></svg>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h4 class="font-bold text-gray-900 mb-4 uppercase text-sm tracking-wider">Produk</h4>
                    <ul class="space-y-3 text-sm text-gray-500">
                        <li><a href="#" class="hover:text-primary-600 transition-colors">Point of Sale (POS)</a></li>
                        <li><a href="#" class="hover:text-primary-600 transition-colors">Manajemen Stok</a></li>
                        <li><a href="#" class="hover:text-primary-600 transition-colors">Laporan Penjualan</a></li>
                        <li><a href="#" class="hover:text-primary-600 transition-colors">AI Assistant</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-bold text-gray-900 mb-4 uppercase text-sm tracking-wider">Perusahaan</h4>
                    <ul class="space-y-3 text-sm text-gray-500">
                        <li><a href="#" class="hover:text-primary-600 transition-colors">Tentang Kami</a></li>
                        <li><a href="#" class="hover:text-primary-600 transition-colors">Karir</a></li>
                        <li><a href="#" class="hover:text-primary-600 transition-colors">Hubungi Kami</a></li>
                        <li><a href="#" class="hover:text-primary-600 transition-colors">Mitra</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-bold text-gray-900 mb-4 uppercase text-sm tracking-wider">Bantuan</h4>
                    <ul class="space-y-3 text-sm text-gray-500">
                        <li><a href="#" class="hover:text-primary-600 transition-colors">Pusat Bantuan</a></li>
                        <li><a href="#" class="hover:text-primary-600 transition-colors">Syarat & Ketentuan</a></li>
                        <li><a href="#" class="hover:text-primary-600 transition-colors">Kebijakan Privasi</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-200 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-sm text-gray-400">
                    &copy; {{ date('Y') }} PT SIPEMMA Teknologi Indonesia. Hak Cipta Dilindungi.
                </p>
                <div class="flex items-center gap-4 text-sm text-gray-400">
                    <span>ID</span>
                    <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                    <a href="#" class="hover:text-gray-600">EN</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
