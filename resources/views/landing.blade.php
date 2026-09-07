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
        @keyframes marquee {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }

        /* Hero blob animation */
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0px); }
        }
        .float-anim {
            animation: float 5s ease-in-out infinite;
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

    <!-- Navbar (Transparent initially, solid on scroll) -->
    <header id="navbar" class="fixed top-0 inset-x-0 bg-transparent border-transparent z-50 transition-all duration-300 py-2">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <a href="/" class="flex items-center gap-2">
                <img src="{{ asset('assets/img/LOGO.png') }}" alt="SIPEMMA Logo" class="h-10 sm:h-12 w-auto object-contain filter brightness-0 invert transition-all duration-300" id="navLogo">
            </a>

            <!-- Desktop Menu -->
            <nav class="hidden lg:flex items-center gap-8 text-[15px] font-medium text-white transition-colors duration-300" id="navLinks">
                <a href="#fitur" class="hover:text-primary-200 transition-colors flex items-center gap-1">Layanan</a>
                <a href="#hardware" class="hover:text-primary-200 transition-colors">Hardware</a>
                <a href="#harga" class="hover:text-primary-200 transition-colors">Harga</a>
                <a href="#kontak" class="hover:text-primary-200 transition-colors">Hubungi Kami</a>
                <a href="#solusi" class="hover:text-primary-200 transition-colors flex items-center gap-1">Solusi Bisnis</a>
            </nav>

            <div class="hidden lg:flex items-center gap-4">
                <a href="{{ route('login') }}" class="text-[15px] font-bold text-white hover:text-primary-200 transition-colors mr-2" id="navLogin">Log in</a>
                <a href="{{ route('register') }}" class="bg-white text-primary-600 hover:bg-gray-100 text-[15px] font-bold py-2.5 px-6 rounded-full transition-all shadow-md" id="navCobaGratis">
                    Coba gratis
                </a>
            </div>

            <!-- Mobile menu button -->
            <button class="lg:hidden p-2 text-white rounded-md" id="navMobileBtn">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
            </button>
        </div>
    </header>

    <!-- Hero Section (Full width carousel) -->
    <section class="relative bg-primary-600 pt-32 lg:pt-40 overflow-hidden group">
        <!-- Background Decor -->
        <div class="absolute top-0 right-0 -mr-32 -mt-32 w-[600px] h-[600px] bg-primary-500 rounded-full mix-blend-multiply filter blur-3xl opacity-50"></div>
        <div class="absolute bottom-0 left-0 -ml-32 w-[500px] h-[500px] bg-primary-700 rounded-full mix-blend-multiply filter blur-3xl opacity-50 translate-y-1/2"></div>

        <!-- Hero Content Wrapper -->
        <div class="flex w-full h-full relative z-10 items-end">
            <div class="w-full">
                <div class="max-w-7xl mx-auto px-12 sm:px-16 lg:px-20 relative h-full">
                    <div class="flex flex-col lg:flex-row items-center lg:items-end justify-between h-full gap-8 lg:gap-12">
                        <!-- Left Text (Dynamic) -->
                        <div class="text-white w-full pb-8 lg:pb-32 relative h-[350px] lg:h-auto flex flex-col justify-end">
                            <div class="min-h-[200px] flex flex-col justify-end">
                                <h1 id="heroTitle" class="text-4xl sm:text-5xl lg:text-[64px] font-bold leading-[1.1] mb-8 tracking-tight min-h-[150px] lg:min-h-[220px] flex items-end">
                                    Satu Aplikasi POS<br>untuk Semua<br>Kebutuhan Bisnis
                                </h1>
                                
                                <div class="flex flex-col sm:flex-row items-center gap-4 mt-4 lg:mt-10">
                                    <a href="{{ route('register') }}" class="w-full sm:w-auto bg-primary-500 hover:bg-primary-600 text-white text-lg font-bold py-4 px-8 rounded-full shadow-lg transition-all text-center">
                                        Jadwalkan Demo
                                    </a>
                                    <a href="#fitur" class="w-full sm:w-auto bg-transparent border-2 border-white hover:bg-white hover:text-primary-600 text-white text-lg font-bold py-4 px-8 rounded-full transition-colors text-center">
                                        WhatsApp Kami Sekarang!
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Marquee Logos Section -->
    <section class="bg-white border-b border-gray-100 py-12 overflow-hidden mt-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-6 text-center">
            <p class="text-sm font-bold text-gray-400 uppercase tracking-widest">Dipercaya Oleh Berbagai Bisnis</p>
        </div>
        <div class="marquee-wrapper">
            <!-- Content duplicated for infinite scroll effect -->
            <div class="marquee-content gap-16 sm:gap-24 lg:gap-32 px-8 items-center">
                <!-- Group 1 -->
                <div class="flex items-center gap-3 text-gray-300 hover:text-gray-400 transition-all grayscale opacity-70 hover:opacity-100">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M4 19h16v2H4v-2zm16-6c0 3.31-2.69 6-6 6H10c-3.31 0-6-2.69-6-6V5h16v8zM6 7v6c0 2.21 1.79 4 4 4h4c2.21 0 4-1.79 4-4V7H6z"/></svg>
                    <span class="font-extrabold text-2xl tracking-tight">Kopi Kenangan</span>
                </div>
                <div class="flex items-center gap-3 text-gray-300 hover:text-gray-400 transition-all grayscale opacity-70 hover:opacity-100">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/></svg>
                    <span class="font-extrabold text-2xl tracking-tighter uppercase">Unilever</span>
                </div>
                <div class="flex items-center gap-3 text-gray-300 hover:text-gray-400 transition-all grayscale opacity-70 hover:opacity-100">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 14H4V6h16v12zM6 10h2v2H6zm0 4h8v2H6zm10 0h2v2h-2zm-6-4h8v2h-8z"/></svg>
                    <span class="font-black text-2xl uppercase italic">XL Axiata</span>
                </div>
                <div class="flex items-center gap-3 text-gray-300 hover:text-gray-400 transition-all grayscale opacity-70 hover:opacity-100">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M12 3L1 9l4 2.18v6L12 21l7-3.82v-6l2-1.09V17h2V9L12 3zm6.82 6L12 12.72 5.18 9 12 5.28 18.82 9zM17 15.99l-5 2.73-5-2.73v-3.72L12 15l5-2.73v3.72z"/></svg>
                    <span class="font-semibold text-2xl tracking-widest uppercase">Foodhall</span>
                </div>
                <div class="flex items-center gap-3 text-gray-300 hover:text-gray-400 transition-all grayscale opacity-70 hover:opacity-100">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"/></svg>
                    <span class="font-bold text-2xl uppercase tracking-tighter">Janji Jiwa</span>
                </div>
                
                <!-- Group 2 (Duplicate) -->
                <div class="flex items-center gap-3 text-gray-300 hover:text-gray-400 transition-all grayscale opacity-70 hover:opacity-100">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M4 19h16v2H4v-2zm16-6c0 3.31-2.69 6-6 6H10c-3.31 0-6-2.69-6-6V5h16v8zM6 7v6c0 2.21 1.79 4 4 4h4c2.21 0 4-1.79 4-4V7H6z"/></svg>
                    <span class="font-extrabold text-2xl tracking-tight">Kopi Kenangan</span>
                </div>
                <div class="flex items-center gap-3 text-gray-300 hover:text-gray-400 transition-all grayscale opacity-70 hover:opacity-100">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/></svg>
                    <span class="font-extrabold text-2xl tracking-tighter uppercase">Unilever</span>
                </div>
                <div class="flex items-center gap-3 text-gray-300 hover:text-gray-400 transition-all grayscale opacity-70 hover:opacity-100">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 14H4V6h16v12zM6 10h2v2H6zm0 4h8v2H6zm10 0h2v2h-2zm-6-4h8v2h-8z"/></svg>
                    <span class="font-black text-2xl uppercase italic">XL Axiata</span>
                </div>
                <div class="flex items-center gap-3 text-gray-300 hover:text-gray-400 transition-all grayscale opacity-70 hover:opacity-100">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M12 3L1 9l4 2.18v6L12 21l7-3.82v-6l2-1.09V17h2V9L12 3zm6.82 6L12 12.72 5.18 9 12 5.28 18.82 9zM17 15.99l-5 2.73-5-2.73v-3.72L12 15l5-2.73v3.72z"/></svg>
                    <span class="font-semibold text-2xl tracking-widest uppercase">Foodhall</span>
                </div>
                <div class="flex items-center gap-3 text-gray-300 hover:text-gray-400 transition-all grayscale opacity-70 hover:opacity-100">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"/></svg>
                    <span class="font-bold text-2xl uppercase tracking-tighter">Janji Jiwa</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Zig Zag Feature 1 -->
    <section id="fitur" class="py-20 lg:py-32 bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div class="order-2 lg:order-1 relative" data-aos="fade-right">
                    <img src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?auto=format&fit=crop&q=80&w=800" alt="Dashboard Backoffice" class="rounded-3xl shadow-xl w-full object-cover select-none pointer-events-none">
                </div>
                
                <div class="order-1 lg:order-2" data-aos="fade-left">
                    <h2 class="text-4xl sm:text-5xl font-bold text-dark mb-6 leading-tight">
                        Pantau Usaha dengan Sat-set!
                    </h2>
                    <p class="text-lg text-gray-600 mb-10 leading-relaxed">
                        Bisnis yang menggunakan Backoffice SIPEMMA 70% lebih sehat secara operasional dan finansial.
                    </p>

                    <div class="space-y-8">
                        <!-- Item -->
                        <div class="flex gap-4 items-start border-b border-gray-100 pb-6">
                            <div class="shrink-0 w-12 h-12 rounded-full bg-primary-600 flex items-center justify-center text-white">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-gray-800">Kelola pesanan dine-in, takeaway atau online? Semua bisa.</h3>
                            </div>
                        </div>
                        <!-- Item -->
                        <div class="flex gap-4 items-start border-b border-gray-100 pb-6">
                            <div class="shrink-0 w-12 h-12 rounded-full bg-primary-600 flex items-center justify-center text-white">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-gray-800">Mudahnya atur operasional bisnis langsung dari Backoffice.</h3>
                            </div>
                        </div>
                        <!-- Item -->
                        <div class="flex gap-4 items-start">
                            <div class="shrink-0 w-12 h-12 rounded-full bg-primary-600 flex items-center justify-center text-white">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path></svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-gray-800">Dapatkan insight dari data dengan fitur AI Assistant.</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Zig Zag Feature 2 (Point of Sale) -->
    <section class="py-20 lg:py-32 bg-gray-50 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div class="" data-aos="fade-right">
                    <p class="text-lg font-bold text-gray-800 mb-2">SIPEMMA Point of Sale</p>
                    <h2 class="text-4xl sm:text-5xl font-bold text-dark mb-6 leading-tight">
                        Kelola usaha offline Anda dengan Aplikasi Kasir SIPEMMA
                    </h2>
                    <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                        Kami membantu Anda mendapatkan data-data menarik dari transaksi Anda sehingga Anda bisa menjual lebih banyak lagi. Cegah kehabisan stok dengan pemantauan inventaris yang akurat.
                    </p>

                    <a href="#fitur" class="inline-flex items-center gap-2 text-primary-500 font-bold text-lg hover:text-primary-600 transition-colors">
                        Pelajari Fitur Lengkap <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>

                <div class="relative" data-aos="fade-left">
                    <img src="https://images.unsplash.com/photo-1556740738-b6a63e27c4df?auto=format&fit=crop&q=80&w=800" alt="Kasir Offline" class="rounded-3xl shadow-xl w-full object-cover select-none pointer-events-none">
                </div>
            </div>
        </div>
    </section>

    <!-- Zig Zag Feature 3 (New Variant) -->
    <section class="py-20 lg:py-32 bg-orange-50 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div class="order-2 lg:order-1 relative" data-aos="fade-right">
                    <img src="https://images.unsplash.com/photo-1579621970795-87facc2f976d?auto=format&fit=crop&q=80&w=800" alt="Laporan Penjualan" class="rounded-3xl shadow-xl w-full object-cover select-none pointer-events-none">
                </div>

                <div class="order-1 lg:order-2" data-aos="fade-left">
                    <p class="text-lg font-bold text-primary-600 mb-2">SIPEMMA Manajemen Terpadu</p>
                    <h2 class="text-4xl sm:text-5xl font-bold text-dark mb-6 leading-tight">
                        Catat dan Analisis Keuntungan Secara Real-time
                    </h2>
                    <p class="text-lg text-gray-700 mb-8 leading-relaxed">
                        Tidak perlu lagi rekap manual yang melelahkan. Dapatkan laporan penjualan, analisis keuntungan, dan pergerakan stok barang Anda hanya dalam satu sentuhan layar. Keputusan bisnis jadi lebih cepat dan akurat.
                    </p>

                    <a href="#fitur" class="inline-flex items-center gap-2 text-primary-600 font-bold text-lg hover:text-primary-700 transition-colors">
                        Lihat Cara Kerjanya <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- About Content Section with Read More / Read Less -->
    <section class="py-16 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8" data-aos="fade-up">
            <h3 class="text-lg font-bold text-gray-800 mb-4 text-left">Mengenal Lebih Dalam Tentang Aplikasi Kasir SIPEMMA</h3>
            
            <div id="aboutContent" class="text-sm text-gray-600 text-left leading-relaxed space-y-4 line-clamp-3 transition-all duration-500">
                <p>
                    Aplikasi Kasir SIPEMMA adalah sistem POS (point of sale) berbasis online yang dibangun untuk membantu sistem kasir yang ada di dalam sebuah usaha. Aplikasi kasir biasanya lebih canggih dibandingkan mesin kasir pada umumnya karena menawarkan beberapa kelebihan. Memungkinkan transaksi tercatat di sistem cloud atau secara online. Sistem POS yang tersedia dalam aplikasi kasir yang Anda pilih juga memungkinkan pemilik usaha mencatat pesanan yang masuk, membantu menghitung keuntungan penjualan, perhitungan stok, dan semua transaksi lainnya lalu menyimpannya di cloud.
                </p>
                <p>
                    <strong>Aplikasi Kasir Berbasis Cloud, Permudah Transaksi Tingkatkan Efisiensi</strong><br>
                    Saat ini perkembangan teknologi menawarkan berbagai kemudahan bagi para pengusaha. Berbagai inovasi dan teknologi bermunculan, salah satunya adalah dengan kehadiran aplikasi cloud SIPEMMA. Aplikasi ini hadir melihat berbagai permasalahan pengusaha yang mengalami kesulitan melakukan pencatatan transaksi, yang kebanyakan dilakukan secara manual. Terutama saat usaha yang ditekuni sudah mulai berkembang dan jumlah transaksi mulai meningkat, pencatatan manual tidak hanya membuang waktu dan tenaga, namun juga memiliki risiko untuk tersebar ataupun hilang.
                </p>
                <p>
                    Tentunya hal ini tidak diinginkan terjadi karena keberadaan catatan transaksi dapat menjadi kunci ketika pemilik usaha membuat strategi bisnis. Oleh karena itu, banyak pemilik usaha kini membuat investasi dengan memiliki aplikasi kasir untuk usaha mereka. Fungsi aplikasi kasir dalam membantu pemilik usaha melakukan pencatatan transaksi bisnis yang lebih cepat, mudah, dan efisien dibandingkan dengan menggunakan cara pencatatan manual.
                </p>
                <p>
                    <strong>Mengenai Aplikasi Kasir dan Mesin Kasir</strong><br>
                    Banyak yang mungkin mempertanyakan apakah mesin kasir masih diperlukan ketika Anda memiliki aplikasi kasir. Mesin kasir sebenarnya adalah suatu komponen penunjang untuk usaha Anda. Oleh karena itu, hardware yang mumpuni juga adalah salah satu hal yang perlu diperhatikan pemilik usaha ketika melakukan pencatatan pengeluaran yang Anda perlukan ketika memulai bisnis Anda. Tidak hanya perangkat mesin kasir sendiri, ada beberapa hardware lainnya yang perlu Anda perhatikan, misalnya alat untuk mencetak struk transaksi pelanggan.
                </p>
                <p>
                    Struk menjadi hal penting terutama untuk transparansi transaksi yang terjadi antara konsumen dan usaha Anda. Aplikasi POS dalam aplikasi kasir biasanya memungkinkan Anda untuk mencetak struk, namun pemilik usaha perlu memiliki mesin pencetak struk sendiri, seperti bluetooth printer. Perangkat keras ini dapat dihubungkan dengan aplikasi kasir dengan sekali klik dan tentunya harga perangkat ini juga cukup terjangkau. Beberapa hal lain yang penting untuk menunjang kemudahan transaksi bisnis Anda seperti pemindai barcode, laci uang, printer label, dan mesin EDC juga penting dimiliki.
                </p>
                <p>
                    <strong>Mengatur Toko Offline & Online</strong><br>
                    Dengan berkembangnya zaman, pemilik UMKM atau usaha offline banyak yang memulai digitalisasi usaha. Membuat toko online terintegrasi adalah salah satu hal yang perlu dilakukan pertama kali ketika Anda memutuskan untuk memasuki ranah usaha online. Memiliki toko online akan membantu Anda menyasar pasar dan audiens yang baru. Dengan begitu, Anda mungkin akan mencatat peningkatan transaksi dan keuntungan melalui kanal yang baru. Yuk daftar di SIPEMMA untuk menggunakan layanan aplikasi kasir terbaik!
                </p>
            </div>
            
            <button id="readMoreBtn" onclick="toggleReadMore()" class="mt-4 text-sm text-primary-600 font-bold hover:text-primary-700 focus:outline-none flex items-center justify-start gap-1">
                <span>Baca banyak</span> 
                <svg id="readMoreIcon" class="w-4 h-4 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </button>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-24 bg-white border-t border-gray-100">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="inline-block text-primary-600 font-black text-4xl tracking-widest mb-4 uppercase">FAQ</h2>
            </div>
            
            <div class="space-y-4" data-aos="fade-up" data-aos-delay="100">
                <!-- FAQ Item 1 -->
                <div class="faq-item border-b border-gray-200 overflow-hidden">
                    <button class="faq-button w-full flex items-center justify-between py-6 text-left text-gray-900 font-bold text-lg hover:text-primary-600 transition-colors focus:outline-none">
                        Apa itu SIPEMMA?
                        <span class="faq-icon shrink-0 transition-transform duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                        </span>
                    </button>
                    <div class="faq-content max-h-0 opacity-0 transition-all duration-300 ease-in-out">
                        <p class="pb-6 leading-relaxed text-gray-600 text-base">
                            SIPEMMA adalah aplikasi Point of Sale (POS) berbasis cloud yang dirancang untuk membantu berbagai jenis bisnis, mulai dari F&B, retail, hingga layanan jasa, dalam mengelola transaksi, inventaris, dan pelanggan dengan lebih efisien.
                        </p>
                    </div>
                </div>
                
                <!-- FAQ Item 2 -->
                <div class="faq-item border-b border-gray-200 overflow-hidden">
                    <button class="faq-button w-full flex items-center justify-between py-6 text-left text-gray-900 font-bold text-lg hover:text-primary-600 transition-colors focus:outline-none">
                        Bagaimana cara menggunakan aplikasi kasir/POS dari SIPEMMA?
                        <span class="faq-icon shrink-0 transition-transform duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                        </span>
                    </button>
                    <div class="faq-content max-h-0 opacity-0 transition-all duration-300 ease-in-out">
                        <p class="pb-6 leading-relaxed text-gray-600 text-base">
                            Anda dapat mendaftar melalui situs web kami, lalu mengunduh aplikasi SIPEMMA di perangkat Anda. Setelah masuk, Anda bisa mulai menambahkan produk, mengatur harga, dan langsung menerima pembayaran dari pelanggan Anda.
                        </p>
                    </div>
                </div>
                
                <!-- FAQ Item 3 -->
                <div class="faq-item border-b border-gray-200 overflow-hidden">
                    <button class="faq-button w-full flex items-center justify-between py-6 text-left text-gray-900 font-bold text-lg hover:text-primary-600 transition-colors focus:outline-none">
                        Berapa biaya berlangganan SIPEMMA?
                        <span class="faq-icon shrink-0 transition-transform duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                        </span>
                    </button>
                    <div class="faq-content max-h-0 opacity-0 transition-all duration-300 ease-in-out">
                        <p class="pb-6 leading-relaxed text-gray-600 text-base">
                            SIPEMMA menawarkan berbagai paket berlangganan yang disesuaikan dengan ukuran bisnis Anda, mulai dari paket pemula hingga enterprise. Kunjungi halaman <a href="#harga" class="text-primary-500 hover:underline">Harga</a> untuk detail selengkapnya.
                        </p>
                    </div>
                </div>
                
                <!-- FAQ Item 4 -->
                <div class="faq-item border-b border-gray-200 overflow-hidden">
                    <button class="faq-button w-full flex items-center justify-between py-6 text-left text-gray-900 font-bold text-lg hover:text-primary-600 transition-colors focus:outline-none">
                        Bagaimana cara mendaftar SIPEMMA?
                        <span class="faq-icon shrink-0 transition-transform duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                        </span>
                    </button>
                    <div class="faq-content max-h-0 opacity-0 transition-all duration-300 ease-in-out">
                        <p class="pb-6 leading-relaxed text-gray-600 text-base">
                            Sangat mudah! Klik tombol "Coba Gratis" atau "Jadwalkan Demo" di halaman ini, isi formulir pendaftaran singkat, dan tim kami akan segera menghubungi Anda untuk proses selanjutnya.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bottom CTA -->
    <section class="py-24 bg-white text-center">
        <div class="max-w-4xl mx-auto px-4" data-aos="fade-up">
            <h2 class="text-4xl md:text-5xl font-bold text-dark mb-6">Siap untuk kembangkan bisnismu?</h2>
            <p class="text-xl text-gray-500 mb-10">Lebih dari 40.000 pebisnis telah membuktikannya. Kini giliran Anda.</p>
            <a href="{{ route('register') }}" class="bg-primary-500 hover:bg-primary-600 text-white text-xl font-bold py-4 px-10 rounded-full shadow-lg transition-all transform hover:-translate-y-1 inline-block">
                Coba Gratis 14 Hari
            </a>
        </div>
    </section>

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

        // Navbar Scroll Effect
        const navbar = document.getElementById('navbar');
        const navLogo = document.getElementById('navLogo');
        const navLinks = document.getElementById('navLinks');
        const navLogin = document.getElementById('navLogin');
        const navCobaGratis = document.getElementById('navCobaGratis');
        const navMobileBtn = document.getElementById('navMobileBtn');

        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                // Scrolled state (White background, Dark text)
                navbar.classList.remove('bg-transparent', 'border-transparent', 'py-2');
                navbar.classList.add('bg-white/95', 'backdrop-blur-md', 'border-gray-100', 'shadow-sm');
                
                navLogo.classList.remove('brightness-0', 'invert'); // Restore original colored logo
                
                navLinks.classList.remove('text-white');
                navLinks.classList.add('text-gray-800');
                
                navLogin.classList.remove('text-white');
                navLogin.classList.add('text-gray-900');
                
                navCobaGratis.classList.remove('bg-white', 'text-primary-600', 'hover:bg-gray-100');
                navCobaGratis.classList.add('bg-primary-500', 'text-white', 'hover:bg-primary-600');
                
                navMobileBtn.classList.remove('text-white');
                navMobileBtn.classList.add('text-gray-800');
            } else {
                // Top state (Transparent background, White text)
                navbar.classList.add('bg-transparent', 'border-transparent', 'py-2');
                navbar.classList.remove('bg-white/95', 'backdrop-blur-md', 'border-gray-100', 'shadow-sm');
                
                navLogo.classList.add('brightness-0', 'invert'); // Make logo white
                
                navLinks.classList.add('text-white');
                navLinks.classList.remove('text-gray-800');
                
                navLogin.classList.add('text-white');
                navLogin.classList.remove('text-gray-900');
                
                navCobaGratis.classList.add('bg-white', 'text-primary-600', 'hover:bg-gray-100');
                navCobaGratis.classList.remove('bg-primary-500', 'text-white', 'hover:bg-primary-600');
                
                navMobileBtn.classList.add('text-white');
                navMobileBtn.classList.remove('text-gray-800');
            }
        });

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
                btnText.textContent = 'Baca sedikit';
                icon.classList.add('rotate-180');
            } else {
                content.classList.add('line-clamp-3');
                btnText.textContent = 'Baca banyak';
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
