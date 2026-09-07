<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPEMMA - Aplikasi Kasir & Manajemen Restoran Terbaik</title>
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- AOS CSS for animations -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- CSS Custom -->
    <style>
        /* Google Sans Font Face Definition */
        @font-face {
            font-family: 'Google Sans';
            font-style: normal;
            font-weight: 400;
            src: url(https://fonts.gstatic.com/s/productsans/v5/HYvgU2fE2nRJvZ5JFAumwegdm0LZdjqr5-oayXSOefg.woff2) format('woff2');
        }
        @font-face {
            font-family: 'Google Sans';
            font-style: normal;
            font-weight: 500;
            src: url(https://fonts.gstatic.com/s/productsans/v5/HYvDP2fE2nRJvZ5JFAumwegdm0LZdjqr5-oayXSOefg.woff2) format('woff2');
        }
        @font-face {
            font-family: 'Google Sans';
            font-style: normal;
            font-weight: 700;
            src: url(https://fonts.gstatic.com/s/productsans/v5/HYvDP2fE2nRJvZ5JFAumwegdm0LZdjqr5-oayXSOefg.woff2) format('woff2'); 
        }

        body {
            font-family: 'Google Sans', sans-serif !important;
            -webkit-font-smoothing: antialiased;
        }

        /* Marquee Animation */
        .marquee-wrapper {
            overflow: hidden;
            white-space: nowrap;
            display: flex;
            align-items: center;
        }
        .marquee-content {
            display: flex;
            animation: marquee 35s linear infinite;
        }
        .marquee-testimonials {
            display: flex;
            gap: 1.5rem;
            animation: marquee 40s linear infinite;
            width: max-content;
            white-space: normal;
        }
        .marquee-testimonials:hover {
            animation-play-state: paused;
        }
        @keyframes marquee {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }

        /* Subtle dot matrix background */
        .bg-dots {
            background-image: radial-gradient(#e2e8f0 1.5px, transparent 1.5px);
            background-size: 24px 24px;
        }

        /* Hero blob & tablet animation */
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0px); }
        }
        .float-anim {
            animation: float 5s ease-in-out infinite;
        }

        @keyframes floatTablet {
            0%, 100% {
                transform: translateY(0px) rotate(0deg);
            }
            50% {
                transform: translateY(-12px) rotate(0.6deg);
            }
        }
        .float-tablet {
            animation: floatTablet 4.5s ease-in-out infinite;
        }

        .realistic-shadow {
            filter: drop-shadow(0 20px 25px rgba(0, 0, 0, 0.35)) drop-shadow(0 10px 10px rgba(0, 0, 0, 0.2));
        }

        /* Preloader Animation */
        @keyframes loader {
            0% { width: 0; }
            50% { width: 100%; }
            100% { width: 0; transform: translateX(100%); }
        }
        .animate-loader {
            animation: loader 1.5s infinite ease-in-out;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
        
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;  
            overflow: hidden;
        }
    </style>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#fff7ed',
                            100: '#ffedd5',
                            200: '#fed7aa',
                            300: '#fdba74',
                            400: '#fb923c',
                            500: '#f97316',
                            600: '#ea580c', /* SIPEMMA Orange */
                            700: '#c2410c',
                            800: '#9a3412',
                            900: '#7c2d12',
                        },
                        dark: '#111827'
                    },
                    boxShadow: {
                        'soft': '0 10px 40px -10px rgba(0,0,0,0.08)',
                    },
                    fontFamily: {
                        sans: ['Google Sans', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-white text-gray-800">

    <!-- Preloader -->
    <div id="preloader" class="fixed inset-0 bg-white z-[9999] flex flex-col items-center justify-center transition-all duration-700 ease-in-out">
        <img src="{{ asset('assets/img/LOGO.png') }}" alt="Loading SIPEMMA..." class="h-16 md:h-20 object-contain animate-pulse mb-6">
        <div class="w-48 h-1 bg-gray-100 rounded-full overflow-hidden relative">
            <div class="h-full bg-primary-600 rounded-full animate-loader absolute top-0 left-0"></div>
        </div>
    </div>

    <!-- Navbar -->
    <header id="navbar" class="fixed top-0 inset-x-0 bg-white/95 backdrop-blur-md border-gray-100 shadow-sm z-50 transition-all duration-300 py-2">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <a href="/" class="flex items-center gap-2">
                <img src="{{ asset('assets/img/LOGO.png') }}" alt="SIPEMMA Logo" class="h-10 sm:h-12 w-auto object-contain transition-all duration-300" id="navLogo">
            </a>

            <!-- Desktop Menu -->
            <nav class="hidden lg:flex items-center gap-8 text-[15px] font-medium text-gray-800 transition-colors duration-300" id="navLinks">
                <a href="#fitur" class="hover:text-primary-600 transition-colors flex items-center gap-1">Layanan</a>
                <a href="#hardware" class="hover:text-primary-600 transition-colors">Hardware</a>
                <a href="#harga" class="hover:text-primary-600 transition-colors">Harga</a>
                <a href="#kontak" class="hover:text-primary-600 transition-colors">Hubungi Kami</a>
                <a href="#solusi" class="hover:text-primary-600 transition-colors flex items-center gap-1">Solusi Bisnis</a>
            </nav>

            <div class="hidden lg:flex items-center gap-4">
                <a href="{{ route('login') }}" class="text-[15px] font-bold text-gray-900 hover:text-primary-600 transition-colors mr-2" id="navLogin">Log in</a>
                <a href="{{ route('register') }}" class="bg-primary-500 text-white hover:bg-primary-600 text-[15px] font-bold py-2.5 px-6 rounded-full transition-all shadow-md" id="navCobaGratis">
                    Coba gratis
                </a>
            </div>

            <!-- Mobile menu button -->
            <button class="lg:hidden p-2 text-gray-800 rounded-md" id="navMobileBtn">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
            </button>
        </div>
    </header>

    <!-- Hero Section (Full width carousel) -->
    <section class="relative bg-primary-600 pt-32 pb-14 lg:pt-36 lg:pb-16 overflow-hidden group">
        <!-- Background Decor -->
        <div class="absolute top-0 right-0 -mr-32 -mt-32 w-[600px] h-[600px] bg-primary-500 rounded-full mix-blend-multiply filter blur-3xl opacity-50"></div>
        <div class="absolute bottom-0 left-0 -ml-32 w-[500px] h-[500px] bg-primary-700 rounded-full mix-blend-multiply filter blur-3xl opacity-50 translate-y-1/2"></div>

        <!-- Hero Content Wrapper -->
        <div class="w-full relative z-10">
            <div class="max-w-7xl mx-auto px-6 sm:px-12 lg:px-16">
                <div class="flex flex-col lg:flex-row items-center justify-between gap-10 lg:gap-8">
                    <!-- Left Text (Dynamic) -->
                    <div class="text-white w-full lg:w-1/2 py-4 lg:py-10 flex flex-col justify-center">
                        <div class="min-h-[180px] flex flex-col justify-center">
                            <h1 id="heroTitle" class="text-4xl sm:text-5xl lg:text-[62px] font-bold leading-[1.1] mb-6 tracking-tight min-h-[140px] lg:min-h-[200px] flex items-center">
                                Satu Aplikasi POS<br>untuk Semua<br>Kebutuhan Bisnis
                            </h1>
                            
                            <div class="flex flex-col sm:flex-row items-center gap-4 mt-4 lg:mt-6">
                                <a href="{{ route('register') }}" class="w-full sm:w-auto bg-white hover:bg-gray-100 text-primary-600 text-lg font-bold py-4 px-8 rounded-full shadow-lg transition-all text-center">
                                    Jadwalkan Demo
                                </a>
                                <a href="#fitur" class="w-full sm:w-auto bg-transparent border-2 border-white hover:bg-white hover:text-primary-600 text-white text-lg font-bold py-4 px-8 rounded-full transition-colors text-center">
                                    Chat WhatsApp
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Right Image -->
                    <div class="w-full lg:w-1/2 flex justify-center lg:justify-end items-center relative py-4">
                        <img src="{{ asset('assets/img/tablet-polosan.png') }}" alt="Tablet POS SIPEMMA" class="w-full max-w-xl lg:max-w-[145%] xl:max-w-[155%] lg:-mr-20 xl:-mr-28 object-contain realistic-shadow float-tablet select-none pointer-events-none transition-transform duration-500">
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- Zig Zag Feature 1 -->
    <section id="fitur" class="py-20 lg:py-28 bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div class="order-2 lg:order-1 relative" data-aos="fade-right">
                    <img src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?auto=format&fit=crop&q=80&w=800" alt="Dashboard Backoffice" class="rounded-3xl shadow-xl w-full object-cover select-none pointer-events-none">
                </div>
                
                <div class="order-1 lg:order-2" data-aos="fade-left">
                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-dark mb-5 leading-tight">
                        Pantau Bisnis Lebih Cepat
                    </h2>
                    <p class="text-base sm:text-lg text-gray-600 mb-8 leading-relaxed">
                        Kelola operasional dan pantau performa finansial usaha Anda secara real-time dari satu sistem.
                    </p>

                    <div class="space-y-6">
                        <!-- Item -->
                        <div class="flex gap-4 items-start border-b border-gray-100 pb-5">
                            <div class="shrink-0 w-11 h-11 rounded-full bg-primary-600 flex items-center justify-center text-white">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">Kelola pesanan dine-in, takeaway, dan online terpadu.</h3>
                            </div>
                        </div>
                        <!-- Item -->
                        <div class="flex gap-4 items-start border-b border-gray-100 pb-5">
                            <div class="shrink-0 w-11 h-11 rounded-full bg-primary-600 flex items-center justify-center text-white">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">Atur menu, meja, dan operasional toko dengan mudah.</h3>
                            </div>
                        </div>
                        <!-- Item -->
                        <div class="flex gap-4 items-start">
                            <div class="shrink-0 w-11 h-11 rounded-full bg-primary-600 flex items-center justify-center text-white">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path></svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">Analisis tren penjualan cerdas berbasis AI Assistant.</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Zig Zag Feature 2 (Point of Sale) -->
    <section class="py-20 lg:py-28 bg-gray-50 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div class="" data-aos="fade-right">
                    <p class="text-base font-bold text-primary-600 mb-2">SIPEMMA Point of Sale</p>
                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-dark mb-5 leading-tight">
                        Kasir Cepat & Praktis untuk Toko Anda
                    </h2>
                    <p class="text-base sm:text-lg text-gray-600 mb-8 leading-relaxed">
                        Catat transaksi dalam hitungan detik, terima aneka metode pembayaran, dan pantau stok barang otomatis tanpa khawatir selisih.
                    </p>

                    <a href="#fitur" class="inline-flex items-center gap-2 text-primary-600 font-bold text-base hover:text-primary-700 transition-colors">
                        Pelajari Fitur <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>

                <div class="relative" data-aos="fade-left">
                    <img src="https://images.unsplash.com/photo-1556740738-b6a63e27c4df?auto=format&fit=crop&q=80&w=800" alt="Kasir Offline" class="rounded-3xl shadow-xl w-full object-cover select-none pointer-events-none">
                </div>
            </div>
        </div>
    </section>

    <!-- Zig Zag Feature 3 (New Variant) -->
    <section class="py-20 lg:py-28 bg-orange-50/60 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div class="order-2 lg:order-1 relative" data-aos="fade-right">
                    <img src="https://images.unsplash.com/photo-1579621970795-87facc2f976d?auto=format&fit=crop&q=80&w=800" alt="Laporan Penjualan" class="rounded-3xl shadow-xl w-full object-cover select-none pointer-events-none">
                </div>

                <div class="order-1 lg:order-2" data-aos="fade-left">
                    <p class="text-base font-bold text-primary-600 mb-2">SIPEMMA Manajemen Terpadu</p>
                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-dark mb-5 leading-tight">
                        Laporan Penjualan & Laba Real-Time
                    </h2>
                    <p class="text-base sm:text-lg text-gray-700 mb-8 leading-relaxed">
                        Tanpa rekap manual yang melelahkan. Pantau laba rugi, omzet harian, dan mutasi barang otomatis dari perangkat apa pun kapan saja.
                    </p>

                    <a href="#fitur" class="inline-flex items-center gap-2 text-primary-600 font-bold text-base hover:text-primary-700 transition-colors">
                        Lihat Selengkapnya <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Comparison Section (Kenapa SIPEMMA?) -->
    <section id="keunggulan" class="py-20 lg:py-28 bg-white border-t border-gray-100">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-gray-900 tracking-tight mb-3">
                    Kenapa SIPEMMA?
                </h2>
                <p class="text-base sm:text-lg text-gray-500 font-medium">
                    Bandingkan dengan sistem kasir lainnya.
                </p>
            </div>

            <!-- Comparison Card -->
            <div class="bg-white rounded-3xl border border-gray-200 shadow-sm overflow-hidden" data-aos="fade-up" data-aos-delay="100">
                <!-- Table Header -->
                <div class="grid grid-cols-12 items-center px-6 sm:px-8 py-5 border-b border-gray-100 bg-gray-50/50">
                    <div class="col-span-7 sm:col-span-8"></div>
                    <div class="col-span-2 sm:col-span-2 text-center text-xs sm:text-sm font-semibold text-gray-500">
                        Sistem lain
                    </div>
                    <div class="col-span-3 sm:col-span-2 text-center text-sm sm:text-base font-extrabold text-gray-900">
                        SIPEMMA
                    </div>
                </div>

                <!-- Comparison Rows -->
                <!-- Row 1 -->
                <div class="grid grid-cols-12 items-center px-6 sm:px-8 py-5 border-b border-gray-100 hover:bg-gray-50/40 transition-colors">
                    <div class="col-span-7 sm:col-span-8 pr-4">
                        <span class="text-sm sm:text-base font-medium text-gray-800">Sinkronisasi Cloud otomatis & akses laporan kapan saja</span>
                    </div>
                    <div class="col-span-2 sm:col-span-2 flex justify-center">
                        <div class="w-7 h-7 rounded-full bg-gray-100 flex items-center justify-center text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </div>
                    </div>
                    <div class="col-span-3 sm:col-span-2 flex justify-center">
                        <div class="w-7 h-7 rounded-full bg-gray-900 text-white flex items-center justify-center shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                    </div>
                </div>

                <!-- Row 2 -->
                <div class="grid grid-cols-12 items-center px-6 sm:px-8 py-5 border-b border-gray-100 hover:bg-gray-50/40 transition-colors">
                    <div class="col-span-7 sm:col-span-8 pr-4">
                        <span class="text-sm sm:text-base font-medium text-gray-800">Manajemen meja, pesanan dine-in & split bill instan</span>
                    </div>
                    <div class="col-span-2 sm:col-span-2 flex justify-center">
                        <div class="w-7 h-7 rounded-full bg-gray-100 flex items-center justify-center text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </div>
                    </div>
                    <div class="col-span-3 sm:col-span-2 flex justify-center">
                        <div class="w-7 h-7 rounded-full bg-gray-900 text-white flex items-center justify-center shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                    </div>
                </div>

                <!-- Row 3 -->
                <div class="grid grid-cols-12 items-center px-6 sm:px-8 py-5 border-b border-gray-100 hover:bg-gray-50/40 transition-colors">
                    <div class="col-span-7 sm:col-span-8 pr-4">
                        <span class="text-sm sm:text-base font-medium text-gray-800">Laporan laba rugi + Analisis AI pintar dalam satu tempat</span>
                    </div>
                    <div class="col-span-2 sm:col-span-2 flex justify-center">
                        <div class="w-7 h-7 rounded-full bg-gray-100 flex items-center justify-center text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </div>
                    </div>
                    <div class="col-span-3 sm:col-span-2 flex justify-center">
                        <div class="w-7 h-7 rounded-full bg-gray-900 text-white flex items-center justify-center shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                    </div>
                </div>

                <!-- Row 4 -->
                <div class="grid grid-cols-12 items-center px-6 sm:px-8 py-5 border-b border-gray-100 hover:bg-gray-50/40 transition-colors">
                    <div class="col-span-7 sm:col-span-8 pr-4">
                        <span class="text-sm sm:text-base font-medium text-gray-800">Harga langganan terjangkau tanpa biaya tersembunyi</span>
                    </div>
                    <div class="col-span-2 sm:col-span-2 flex justify-center">
                        <div class="w-7 h-7 rounded-full bg-gray-100 flex items-center justify-center text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </div>
                    </div>
                    <div class="col-span-3 sm:col-span-2 flex justify-center">
                        <div class="w-7 h-7 rounded-full bg-gray-900 text-white flex items-center justify-center shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                    </div>
                </div>

                <!-- Row 5 -->
                <div class="grid grid-cols-12 items-center px-6 sm:px-8 py-5 border-b border-gray-100 hover:bg-gray-50/40 transition-colors">
                    <div class="col-span-7 sm:col-span-8 pr-4">
                        <span class="text-sm sm:text-base font-medium text-gray-800">Kompatibel printer bluetooth, barcode scanner & cash drawer</span>
                    </div>
                    <div class="col-span-2 sm:col-span-2 flex justify-center">
                        <div class="w-7 h-7 rounded-full bg-gray-100 flex items-center justify-center text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </div>
                    </div>
                    <div class="col-span-3 sm:col-span-2 flex justify-center">
                        <div class="w-7 h-7 rounded-full bg-gray-900 text-white flex items-center justify-center shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                    </div>
                </div>

                <!-- Row 6 -->
                <div class="grid grid-cols-12 items-center px-6 sm:px-8 py-5 hover:bg-gray-50/40 transition-colors">
                    <div class="col-span-7 sm:col-span-8 pr-4">
                        <span class="text-sm sm:text-base font-medium text-gray-800">Peringatan stok menipis & rekomendasi restock otomatis</span>
                    </div>
                    <div class="col-span-2 sm:col-span-2 flex justify-center">
                        <div class="w-7 h-7 rounded-full bg-gray-100 flex items-center justify-center text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </div>
                    </div>
                    <div class="col-span-3 sm:col-span-2 flex justify-center">
                        <div class="w-7 h-7 rounded-full bg-gray-900 text-white flex items-center justify-center shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Impact Stats & Testimonials Section -->
    <section id="testimoni" class="py-20 lg:py-28 bg-white border-t border-gray-100 relative bg-dots overflow-hidden">
        <!-- Section Header -->
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center mb-14" data-aos="fade-up">
            <p class="text-xs sm:text-sm font-bold text-gray-500 uppercase tracking-widest mb-3">
                Telah Dipercaya oleh Ribuan Pebisnis Kuliner & Retail
            </p>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-gray-900 tracking-tight mb-4">
                Dampak Nyata SIPEMMA bagi Bisnis
            </h2>
            <p class="text-base sm:text-lg text-gray-600 max-w-2xl mx-auto leading-relaxed">
                Lebih dari 10.000+ pelaku usaha di seluruh Indonesia telah membuktikan efisiensi operasional dan peningkatan profit bersama kami.
            </p>
        </div>

        <!-- 4 Stat Cards Grid -->
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 mb-20">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
                <!-- Stat 1 -->
                <div class="bg-white rounded-2xl border border-gray-200/90 p-6 sm:p-7 text-center shadow-sm hover:shadow-md transition-all flex flex-col items-center justify-center" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-12 h-12 rounded-xl bg-gray-50 border border-gray-100 flex items-center justify-center text-gray-700 mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                    <div class="text-3xl sm:text-4xl font-extrabold text-gray-900 mb-1">10k+</div>
                    <div class="text-xs sm:text-sm font-medium text-gray-500">Pengguna Aktif</div>
                </div>

                <!-- Stat 2 -->
                <div class="bg-white rounded-2xl border border-gray-200/90 p-6 sm:p-7 text-center shadow-sm hover:shadow-md transition-all flex flex-col items-center justify-center" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-12 h-12 rounded-xl bg-gray-50 border border-gray-100 flex items-center justify-center text-gray-700 mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <div class="text-3xl sm:text-4xl font-extrabold text-gray-900 mb-1">5.2M+</div>
                    <div class="text-xs sm:text-sm font-medium text-gray-500">Transaksi Sukses</div>
                </div>

                <!-- Stat 3 -->
                <div class="bg-white rounded-2xl border border-gray-200/90 p-6 sm:p-7 text-center shadow-sm hover:shadow-md transition-all flex flex-col items-center justify-center" data-aos="fade-up" data-aos-delay="300">
                    <div class="w-12 h-12 rounded-xl bg-gray-50 border border-gray-100 flex items-center justify-center text-gray-700 mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                    </div>
                    <div class="text-3xl sm:text-4xl font-extrabold text-gray-900 mb-1">4.9/5</div>
                    <div class="text-xs sm:text-sm font-medium text-gray-500">Rating Kepuasan</div>
                </div>

                <!-- Stat 4 -->
                <div class="bg-white rounded-2xl border border-gray-200/90 p-6 sm:p-7 text-center shadow-sm hover:shadow-md transition-all flex flex-col items-center justify-center" data-aos="fade-up" data-aos-delay="400">
                    <div class="w-12 h-12 rounded-xl bg-gray-50 border border-gray-100 flex items-center justify-center text-gray-700 mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                    <div class="text-3xl sm:text-4xl font-extrabold text-gray-900 mb-1">2.5k+</div>
                    <div class="text-xs sm:text-sm font-medium text-gray-500">Outlet Terdaftar</div>
                </div>
            </div>
        </div>

        <!-- Testimonials Marquee Header -->
        <div class="mb-8 text-center" data-aos="fade-up">
            <h3 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-gray-900 tracking-tight">
                Apa Kata Mereka?
            </h3>
        </div>

        <!-- Testimonial Cards Marquee (Teks card berjalan) -->
        <div class="marquee-wrapper py-4">
            <div class="marquee-testimonials px-4">
                <!-- Group 1 -->
                <div class="w-[300px] sm:w-[380px] shrink-0 bg-white rounded-3xl border border-gray-200 p-6 sm:p-7 shadow-sm hover:shadow-md transition-all flex flex-col justify-between text-left whitespace-normal min-h-[190px]">
                    <div class="flex items-center gap-3.5 mb-4">
                        <div class="w-11 h-11 rounded-full bg-gray-900 text-white flex items-center justify-center font-bold text-base shrink-0">
                            M
                        </div>
                        <div>
                            <div class="text-[15px] font-bold text-gray-900 leading-tight">Mayla Fazza</div>
                            <div class="flex items-center gap-0.5 text-gray-900 text-xs mt-1">
                                <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                            </div>
                        </div>
                    </div>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        "Semenjak pakai SIPEMMA, antrean kasir jadi super cepat! Rekap penjualan harian otomatis terhitung tanpa pusing rekap manual setiap tutup toko."
                    </p>
                </div>

                <div class="w-[300px] sm:w-[380px] shrink-0 bg-white rounded-3xl border border-gray-200 p-6 sm:p-7 shadow-sm hover:shadow-md transition-all flex flex-col justify-between text-left whitespace-normal min-h-[190px]">
                    <div class="flex items-center gap-3.5 mb-4">
                        <div class="w-11 h-11 rounded-full bg-gray-900 text-white flex items-center justify-center font-bold text-base shrink-0">
                            S
                        </div>
                        <div>
                            <div class="text-[15px] font-bold text-gray-900 leading-tight">Sajiwa Baswara</div>
                            <div class="flex items-center gap-0.5 text-gray-900 text-xs mt-1">
                                <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                            </div>
                        </div>
                    </div>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        "Fitur manajemen stok dan inventarisnya ngebantu banget. Bahan baku yang mau habis langsung ada notifikasi, ga pernah lagi ada menu kosong mendadak."
                    </p>
                </div>

                <div class="w-[300px] sm:w-[380px] shrink-0 bg-white rounded-3xl border border-gray-200 p-6 sm:p-7 shadow-sm hover:shadow-md transition-all flex flex-col justify-between text-left whitespace-normal min-h-[190px]">
                    <div class="flex items-center gap-3.5 mb-4">
                        <div class="w-11 h-11 rounded-full bg-gray-900 text-white flex items-center justify-center font-bold text-base shrink-0">
                            R
                        </div>
                        <div>
                            <div class="text-[15px] font-bold text-gray-900 leading-tight">Rian Pratama</div>
                            <div class="flex items-center gap-0.5 text-gray-900 text-xs mt-1">
                                <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                            </div>
                        </div>
                    </div>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        "Pantau 3 cabang restoran langsung dari smartphone sangat praktis. Laporan laba ruginya real-time dan akurat, sangat membantu saat ambil keputusan ekspansi."
                    </p>
                </div>

                <div class="w-[300px] sm:w-[380px] shrink-0 bg-white rounded-3xl border border-gray-200 p-6 sm:p-7 shadow-sm hover:shadow-md transition-all flex flex-col justify-between text-left whitespace-normal min-h-[190px]">
                    <div class="flex items-center gap-3.5 mb-4">
                        <div class="w-11 h-11 rounded-full bg-gray-900 text-white flex items-center justify-center font-bold text-base shrink-0">
                            D
                        </div>
                        <div>
                            <div class="text-[15px] font-bold text-gray-900 leading-tight">Dewi Sartika</div>
                            <div class="flex items-center gap-0.5 text-gray-900 text-xs mt-1">
                                <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                            </div>
                        </div>
                    </div>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        "Training kasir baru cuma butuh 10 menit karena aplikasinya sangat intuitif. Pelanggan juga senang karena cetak struk dan QRIS lancar tanpa kendala."
                    </p>
                </div>

                <div class="w-[300px] sm:w-[380px] shrink-0 bg-white rounded-3xl border border-gray-200 p-6 sm:p-7 shadow-sm hover:shadow-md transition-all flex flex-col justify-between text-left whitespace-normal min-h-[190px]">
                    <div class="flex items-center gap-3.5 mb-4">
                        <div class="w-11 h-11 rounded-full bg-gray-900 text-white flex items-center justify-center font-bold text-base shrink-0">
                            B
                        </div>
                        <div>
                            <div class="text-[15px] font-bold text-gray-900 leading-tight">Budi Santoso</div>
                            <div class="flex items-center gap-0.5 text-gray-900 text-xs mt-1">
                                <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                            </div>
                        </div>
                    </div>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        "Scan barcode produk cepat tanpa lag, integrasi cash drawer otomatis buka saat bayar cash. Sangat recommended buat usaha kuliner maupun retail!"
                    </p>
                </div>

                <!-- Group 2 (Seamless Duplicate for Infinite Scroll) -->
                <div class="w-[300px] sm:w-[380px] shrink-0 bg-white rounded-3xl border border-gray-200 p-6 sm:p-7 shadow-sm hover:shadow-md transition-all flex flex-col justify-between text-left whitespace-normal min-h-[190px]">
                    <div class="flex items-center gap-3.5 mb-4">
                        <div class="w-11 h-11 rounded-full bg-gray-900 text-white flex items-center justify-center font-bold text-base shrink-0">
                            M
                        </div>
                        <div>
                            <div class="text-[15px] font-bold text-gray-900 leading-tight">Mayla Fazza</div>
                            <div class="flex items-center gap-0.5 text-gray-900 text-xs mt-1">
                                <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                            </div>
                        </div>
                    </div>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        "Semenjak pakai SIPEMMA, antrean kasir jadi super cepat! Rekap penjualan harian otomatis terhitung tanpa pusing rekap manual setiap tutup toko."
                    </p>
                </div>

                <div class="w-[300px] sm:w-[380px] shrink-0 bg-white rounded-3xl border border-gray-200 p-6 sm:p-7 shadow-sm hover:shadow-md transition-all flex flex-col justify-between text-left whitespace-normal min-h-[190px]">
                    <div class="flex items-center gap-3.5 mb-4">
                        <div class="w-11 h-11 rounded-full bg-gray-900 text-white flex items-center justify-center font-bold text-base shrink-0">
                            S
                        </div>
                        <div>
                            <div class="text-[15px] font-bold text-gray-900 leading-tight">Sajiwa Baswara</div>
                            <div class="flex items-center gap-0.5 text-gray-900 text-xs mt-1">
                                <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                            </div>
                        </div>
                    </div>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        "Fitur manajemen stok dan inventarisnya ngebantu banget. Bahan baku yang mau habis langsung ada notifikasi, ga pernah lagi ada menu kosong mendadak."
                    </p>
                </div>

                <div class="w-[300px] sm:w-[380px] shrink-0 bg-white rounded-3xl border border-gray-200 p-6 sm:p-7 shadow-sm hover:shadow-md transition-all flex flex-col justify-between text-left whitespace-normal min-h-[190px]">
                    <div class="flex items-center gap-3.5 mb-4">
                        <div class="w-11 h-11 rounded-full bg-gray-900 text-white flex items-center justify-center font-bold text-base shrink-0">
                            R
                        </div>
                        <div>
                            <div class="text-[15px] font-bold text-gray-900 leading-tight">Rian Pratama</div>
                            <div class="flex items-center gap-0.5 text-gray-900 text-xs mt-1">
                                <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                            </div>
                        </div>
                    </div>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        "Pantau 3 cabang restoran langsung dari smartphone sangat praktis. Laporan laba ruginya real-time dan akurat, sangat membantu saat ambil keputusan ekspansi."
                    </p>
                </div>

                <div class="w-[300px] sm:w-[380px] shrink-0 bg-white rounded-3xl border border-gray-200 p-6 sm:p-7 shadow-sm hover:shadow-md transition-all flex flex-col justify-between text-left whitespace-normal min-h-[190px]">
                    <div class="flex items-center gap-3.5 mb-4">
                        <div class="w-11 h-11 rounded-full bg-gray-900 text-white flex items-center justify-center font-bold text-base shrink-0">
                            D
                        </div>
                        <div>
                            <div class="text-[15px] font-bold text-gray-900 leading-tight">Dewi Sartika</div>
                            <div class="flex items-center gap-0.5 text-gray-900 text-xs mt-1">
                                <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                            </div>
                        </div>
                    </div>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        "Training kasir baru cuma butuh 10 menit karena aplikasinya sangat intuitif. Pelanggan juga senang karena cetak struk dan QRIS lancar tanpa kendala."
                    </p>
                </div>

                <div class="w-[300px] sm:w-[380px] shrink-0 bg-white rounded-3xl border border-gray-200 p-6 sm:p-7 shadow-sm hover:shadow-md transition-all flex flex-col justify-between text-left whitespace-normal min-h-[190px]">
                    <div class="flex items-center gap-3.5 mb-4">
                        <div class="w-11 h-11 rounded-full bg-gray-900 text-white flex items-center justify-center font-bold text-base shrink-0">
                            B
                        </div>
                        <div>
                            <div class="text-[15px] font-bold text-gray-900 leading-tight">Budi Santoso</div>
                            <div class="flex items-center gap-0.5 text-gray-900 text-xs mt-1">
                                <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                            </div>
                        </div>
                    </div>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        "Scan barcode produk cepat tanpa lag, integrasi cash drawer otomatis buka saat bayar cash. Sangat recommended buat usaha kuliner maupun retail!"
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Content Section with Read More / Read Less -->
    <section class="py-16 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8" data-aos="fade-up">
            <h3 class="text-lg font-bold text-gray-800 mb-4 text-left">Tentang Aplikasi Kasir SIPEMMA</h3>
            
            <div id="aboutContent" class="text-sm text-gray-600 text-left leading-relaxed space-y-4 line-clamp-3 transition-all duration-500">
                <p>
                    <strong>SIPEMMA</strong> adalah sistem Point of Sale (POS) cloud modern yang memudahkan pencatatan pesanan, pengelolaan stok, dan pembukuan usaha tanpa perlu rekap manual. Semua data tersimpan aman di cloud dan dapat dipantau dari mana saja.
                </p>
                <p>
                    Aplikasi ini mendukung integrasi hardware kasir lengkap seperti printer bluetooth, pemindai barcode, dan laci kasir (cash drawer) untuk mempercepat alur transaksi pelanggan serta mencegah antrean panjang.
                </p>
                <p>
                    Dirancang untuk bisnis skala UMKM hingga multi-cabang di bidang F&B, retail, maupun jasa, SIPEMMA membantu pengusaha mengambil keputusan bisnis yang lebih cepat dan tepat berbasis data real-time.
                </p>
            </div>
            
            <button id="readMoreBtn" onclick="toggleReadMore()" class="mt-4 text-sm text-primary-600 font-bold hover:text-primary-700 focus:outline-none flex items-center justify-start gap-1">
                <span>Baca selengkapnya</span> 
                <svg id="readMoreIcon" class="w-4 h-4 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </button>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-20 bg-white border-t border-gray-100">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="inline-block text-primary-600 font-black text-4xl tracking-widest mb-2 uppercase">FAQ</h2>
            </div>
            
            <div class="space-y-4" data-aos="fade-up" data-aos-delay="100">
                <!-- FAQ Item 1 -->
                <div class="faq-item border-b border-gray-200 overflow-hidden">
                    <button class="faq-button w-full flex items-center justify-between py-5 text-left text-gray-900 font-bold text-lg hover:text-primary-600 transition-colors focus:outline-none">
                        Apa itu SIPEMMA?
                        <span class="faq-icon shrink-0 transition-transform duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                        </span>
                    </button>
                    <div class="faq-content max-h-0 opacity-0 transition-all duration-300 ease-in-out">
                        <p class="pb-5 leading-relaxed text-gray-600 text-base">
                            SIPEMMA adalah aplikasi kasir (POS) cloud terpadu untuk bisnis F&B, retail, dan jasa guna mengelola transaksi, stok inventaris, serta laporan keuangan secara otomatis.
                        </p>
                    </div>
                </div>
                
                <!-- FAQ Item 2 -->
                <div class="faq-item border-b border-gray-200 overflow-hidden">
                    <button class="faq-button w-full flex items-center justify-between py-5 text-left text-gray-900 font-bold text-lg hover:text-primary-600 transition-colors focus:outline-none">
                        Bagaimana cara menggunakan aplikasi kasir/POS dari SIPEMMA?
                        <span class="faq-icon shrink-0 transition-transform duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                        </span>
                    </button>
                    <div class="faq-content max-h-0 opacity-0 transition-all duration-300 ease-in-out">
                        <p class="pb-5 leading-relaxed text-gray-600 text-base">
                            Cukup daftar akun, tambahkan daftar menu atau produk, lalu Anda siap memproses transaksi langsung dari tablet, smartphone, maupun komputer.
                        </p>
                    </div>
                </div>
                
                <!-- FAQ Item 3 -->
                <div class="faq-item border-b border-gray-200 overflow-hidden">
                    <button class="faq-button w-full flex items-center justify-between py-5 text-left text-gray-900 font-bold text-lg hover:text-primary-600 transition-colors focus:outline-none">
                        Berapa biaya berlangganan SIPEMMA?
                        <span class="faq-icon shrink-0 transition-transform duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                        </span>
                    </button>
                    <div class="faq-content max-h-0 opacity-0 transition-all duration-300 ease-in-out">
                        <p class="pb-5 leading-relaxed text-gray-600 text-base">
                            Tersedia paket fleksibel sesuai skala bisnis Anda, mulai dari paket pemula hingga enterprise multi-cabang. Hubungi tim kami untuk konsultasi paket terbaik.
                        </p>
                    </div>
                </div>
                
                <!-- FAQ Item 4 -->
                <div class="faq-item border-b border-gray-200 overflow-hidden">
                    <button class="faq-button w-full flex items-center justify-between py-5 text-left text-gray-900 font-bold text-lg hover:text-primary-600 transition-colors focus:outline-none">
                        Bagaimana cara mendaftar SIPEMMA?
                        <span class="faq-icon shrink-0 transition-transform duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                        </span>
                    </button>
                    <div class="faq-content max-h-0 opacity-0 transition-all duration-300 ease-in-out">
                        <p class="pb-5 leading-relaxed text-gray-600 text-base">
                            Klik tombol "Jadwalkan Demo" atau "Coba gratis" di halaman ini, lengkapi formulir pendaftaran singkat, dan tim kami akan segera membantu Anda mengaktifkan akun.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bottom CTA Removed -->

    <!-- Footer -->
    <footer class="bg-slate-900 pt-20 pb-10 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-8 mb-16">
                <div class="col-span-2 lg:col-span-2">
                    <img src="{{ asset('assets/img/LOGO.png') }}" alt="SIPEMMA Logo" class="h-16 mb-6 object-contain filter brightness-0 invert">
                    <div class="flex gap-4">
                        <a href="#" class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center text-gray-400 hover:text-white hover:bg-slate-700 transition-all">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"/></svg>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center text-gray-400 hover:text-white hover:bg-slate-700 transition-all">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd"/></svg>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h4 class="font-bold text-white mb-4 text-base">Produk</h4>
                    <ul class="space-y-3 text-[15px] text-gray-400">
                        <li><a href="#" class="hover:text-primary-400 transition-colors">Point of Sale (POS)</a></li>
                        <li><a href="#" class="hover:text-primary-400 transition-colors">Manajemen Stok</a></li>
                        <li><a href="#" class="hover:text-primary-400 transition-colors">Laporan Penjualan</a></li>
                        <li><a href="#" class="hover:text-primary-400 transition-colors">AI Assistant</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-bold text-white mb-4 text-base">Perusahaan</h4>
                    <ul class="space-y-3 text-[15px] text-gray-400">
                        <li><a href="#" class="hover:text-primary-400 transition-colors">Tentang Kami</a></li>
                        <li><a href="#" class="hover:text-primary-400 transition-colors">Karir</a></li>
                        <li><a href="#" class="hover:text-primary-400 transition-colors">Hubungi Kami</a></li>
                        <li><a href="#" class="hover:text-primary-400 transition-colors">Mitra</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-bold text-white mb-4 text-base">Bantuan</h4>
                    <ul class="space-y-3 text-[15px] text-gray-400">
                        <li><a href="#" class="hover:text-primary-400 transition-colors">Pusat Bantuan</a></li>
                        <li><a href="#" class="hover:text-primary-400 transition-colors">Syarat & Ketentuan</a></li>
                        <li><a href="#" class="hover:text-primary-400 transition-colors">Kebijakan Privasi</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-slate-800 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-sm text-gray-500">
                    &copy; {{ date('Y') }} PT SIPEMMA Teknologi Indonesia. Hak Cipta Dilindungi.
                </p>
                <div class="flex items-center gap-4 text-sm text-gray-500 font-medium">
                    <span class="text-gray-400">ID</span>
                    <span class="w-1 h-1 bg-slate-700 rounded-full"></span>
                    <a href="#" class="hover:text-gray-300 transition-colors">EN</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true,
            offset: 50,
            duration: 800,
            easing: 'ease-out-cubic',
        });

        // Navbar Scroll Effect removed


        // Hero Typewriter Logic
        const heroContents = [
            'Satu Aplikasi POS<br>untuk Semua<br>Kebutuhan Bisnis',
            'Kelola Inventaris<br>Lebih Mudah<br>& Akurat',
            'Pantau Laporan<br>Penjualan<br>Dari Mana Saja'
        ];

        let currentContentIndex = 0;
        let charIndex = 0;
        let isDeleting = false;
        const heroTitle = document.getElementById('heroTitle');
        const typingSpeed = 50; // ms per char
        const erasingSpeed = 30; // ms per char
        const delayBetweenText = 2500; // ms delay before erasing

        function typeWriter() {
            const currentText = heroContents[currentContentIndex];
            
            if (isDeleting) {
                // If we are deleting and hit a tag like <br>, delete the whole tag
                if (currentText.substring(charIndex - 4, charIndex) === '<br>') {
                    charIndex -= 4;
                } else {
                    charIndex--;
                }
            } else {
                // If we are typing and hit <, add the whole <br> tag
                if (currentText.charAt(charIndex) === '<') {
                    charIndex += 4;
                } else {
                    charIndex++;
                }
            }
            
            const displayText = currentText.substring(0, charIndex);
            heroTitle.innerHTML = displayText + '<span class="animate-pulse border-r-4 border-white ml-1"></span>';
            
            let typeSpeed = isDeleting ? erasingSpeed : typingSpeed;
            
            if (!isDeleting && charIndex === currentText.length) {
                typeSpeed = delayBetweenText;
                isDeleting = true;
            } else if (isDeleting && charIndex === 0) {
                isDeleting = false;
                currentContentIndex = (currentContentIndex + 1) % heroContents.length;
                typeSpeed = 500; // Pause before typing next word
            }
            
            setTimeout(typeWriter, typeSpeed);
        }

        // Start typewriter
        setTimeout(typeWriter, 1000);

        // Read More Toggle Logic
        let isExpanded = false;
        function toggleReadMore() {
            const content = document.getElementById('aboutContent');
            const btnText = document.querySelector('#readMoreBtn span');
            const icon = document.getElementById('readMoreIcon');
            
            isExpanded = !isExpanded;
            
            if (isExpanded) {
                content.classList.remove('line-clamp-3');
                btnText.textContent = 'Sembunyikan';
                icon.classList.add('rotate-180');
            } else {
                content.classList.add('line-clamp-3');
                btnText.textContent = 'Baca selengkapnya';
                icon.classList.remove('rotate-180');
            }
        }
        // FAQ Accordion Logic
        document.querySelectorAll('.faq-button').forEach(button => {
            button.addEventListener('click', () => {
                const content = button.nextElementSibling;
                const icon = button.querySelector('.faq-icon');
                
                // Close other opened FAQs
                document.querySelectorAll('.faq-content').forEach(otherContent => {
                    if (otherContent !== content && otherContent.style.maxHeight) {
                        otherContent.style.maxHeight = null;
                        otherContent.classList.remove('opacity-100');
                        otherContent.previousElementSibling.querySelector('.faq-icon').classList.remove('-rotate-180');
                    }
                });

                // Toggle current FAQ
                if (content.style.maxHeight) {
                    content.style.maxHeight = null;
                    content.classList.remove('opacity-100');
                    icon.classList.remove('-rotate-180');
                } else {
                    content.style.maxHeight = content.scrollHeight + "px";
                    content.classList.add('opacity-100');
                    icon.classList.add('-rotate-180');
                }
            });
        });

        // Preloader Logic
        window.addEventListener('load', () => {
            const preloader = document.getElementById('preloader');
            // Sedikit delay agar animasinya sempat terlihat
            setTimeout(() => {
                preloader.style.opacity = '0';
                setTimeout(() => {
                    preloader.style.display = 'none';
                }, 700); // Wait for transition-all duration
            }, 600);
        });


    </script>

    <!-- AOS Animation Scripts -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            AOS.init({
                once: true,
                offset: 50,
                duration: 800,
                easing: 'ease-out-cubic',
            });
        });
    </script>
</body>
</html>
