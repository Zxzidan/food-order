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
    <!-- Apple San Francisco Typography -->
    <link rel="stylesheet" href="{{ asset('css/sf-pro.css') }}">
    
    <!-- CSS Custom -->
    <style>
        html {
            overflow-x: hidden;
            scroll-behavior: smooth;
        }
        body {
            font-family: 'SF Pro', 'SF Pro Display', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif !important;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            overflow-x: hidden;
            position: relative;
            width: 100%;
        }

        /* Animated Parallax Water Waves */
        .waves-container {
            position: absolute;
            bottom: -1px;
            left: 0;
            right: 0;
            width: 100%;
            overflow: hidden;
            line-height: 0;
            pointer-events: none;
            z-index: 20;
        }
        .waves {
            position: relative;
            width: 100%;
            display: block;
        }
        .parallax-waves > use {
            animation: move-waves 25s cubic-bezier(.55, .5, .45, .5) infinite;
        }
        .parallax-waves > use:nth-child(1) {
            animation-delay: -2s;
            animation-duration: 7s;
        }
        .parallax-waves > use:nth-child(2) {
            animation-delay: -3s;
            animation-duration: 10s;
        }
        .parallax-waves > use:nth-child(3) {
            animation-delay: -4s;
            animation-duration: 13s;
        }
        .parallax-waves > use:nth-child(4) {
            animation-delay: -5s;
            animation-duration: 20s;
        }
        @keyframes move-waves {
            0% {
                transform: translate3d(-90px, 0, 0);
            }
            100% {
                transform: translate3d(85px, 0, 0);
            }
        }

        /* Continuous Infinite Marquee */
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
            gap: 1.75rem;
            animation: marquee 40s linear infinite;
            width: max-content;
            white-space: normal;
        }
        .marquee-brands {
            display: flex;
            gap: 3rem;
            animation: marquee 30s linear infinite;
            width: max-content;
            align-items: center;
        }
        @keyframes marquee {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }

        /* Architectural Grid Texture */
        .bg-grid-subtle {
            background-size: 32px 32px;
            background-image: 
                linear-gradient(to right, rgba(234, 88, 12, 0.04) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(234, 88, 12, 0.04) 1px, transparent 1px);
        }
        .bg-grid-hero {
            background-size: 40px 40px;
            background-image: 
                linear-gradient(to right, rgba(255, 255, 255, 0.06) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(255, 255, 255, 0.06) 1px, transparent 1px);
        }

        /* Subtle dot matrix background */
        .bg-dots {
            background-image: radial-gradient(#e2e8f0 1.5px, transparent 1.5px);
            background-size: 24px 24px;
        }

        @keyframes floatTablet {
            0%, 100% {
                transform: translateY(0px) rotate(0deg);
            }
            50% {
                transform: translateY(-8px) rotate(0.4deg);
            }
        }
        .float-tablet {
            animation: floatTablet 5s ease-in-out infinite;
        }

        .realistic-shadow {
            filter: drop-shadow(0 25px 35px rgba(0, 0, 0, 0.28)) drop-shadow(0 10px 15px rgba(0, 0, 0, 0.15));
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
            background: #f8fafc;
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
                        'inner-subtle': 'inset 0 1px 1px rgba(255, 255, 255, 0.2)',
                    },
                    fontFamily: {
                        sans: ['"SF Pro"', '"SF Pro Display"', '-apple-system', 'BlinkMacSystemFont', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-white text-gray-800 antialiased overflow-x-hidden">

    <!-- Preloader -->
    <div id="preloader" class="fixed inset-0 bg-white z-[9999] flex flex-col items-center justify-center transition-all duration-700 ease-in-out">
        <img src="{{ asset('assets/img/LOGO.png') }}" alt="Loading SIPEMMA..." class="h-16 md:h-20 object-contain animate-pulse mb-6">
        <div class="w-48 h-1 bg-gray-100 rounded-full overflow-hidden relative">
            <div class="h-full bg-primary-600 rounded-full animate-loader absolute top-0 left-0"></div>
        </div>
    </div>

    <!-- Architectural Floating Navbar (Matching Screenshot Pill) -->
    <header id="navbar" class="fixed top-0 inset-x-0 z-50 transition-all duration-300 py-3 sm:py-5">
        <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">
            <div class="bg-white/95 backdrop-blur-xl border border-white/40 shadow-lg rounded-full px-4 sm:px-8 h-14 sm:h-18 flex items-center justify-between">
                <a href="/" class="flex items-center gap-2 shrink-0">
                    <img src="{{ asset('assets/img/LOGO.png') }}" alt="SIPEMMA Logo" class="h-8 sm:h-10 w-auto object-contain" id="navLogo">
                </a>

                <!-- Desktop Menu -->
                <nav class="hidden lg:flex items-center gap-8 text-[14px] font-semibold text-gray-700" id="navLinks">
                    <a href="#fitur" class="hover:text-primary-600 transition-colors py-1">Fitur</a>
                    <a href="#keunggulan" class="hover:text-primary-600 transition-colors py-1">Keunggulan</a>
                    <a href="#testimoni" class="hover:text-primary-600 transition-colors py-1">Testimoni</a>
                    <a href="#tentang" class="hover:text-primary-600 transition-colors py-1">Tentang Kami</a>
                    <a href="#faq" class="hover:text-primary-600 transition-colors py-1">FAQ</a>
                    <a href="#kontak" class="hover:text-primary-600 transition-colors py-1">Kontak</a>
                </nav>

                <div class="hidden lg:flex items-center gap-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 bg-primary-600 hover:bg-primary-700 text-white text-[14px] font-bold py-2.5 px-6 rounded-full transition-all shadow-sm hover:shadow-md" id="navDashboard">
                            <span>Masuk Dashboard</span>
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-[14px] font-bold text-gray-900 hover:text-primary-600 transition-colors px-3 py-2" id="navLogin">Log in</a>
                        <a href="{{ route('register') }}" class="inline-flex items-center gap-2 bg-primary-600 hover:bg-primary-700 text-white text-[14px] font-bold py-2.5 px-6 rounded-full transition-all shadow-sm hover:shadow-md" id="navRegister">
                            <span>Daftar Sekarang</span>
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    @endauth
                </div>

                <!-- Mobile menu button -->
                <button class="lg:hidden p-2 text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-none transition-colors" id="navMobileBtn" onclick="toggleMobileMenu()">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" id="navMobileIcon"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu Dropdown -->
        <div id="mobileMenu" class="hidden lg:hidden max-w-7xl mx-auto px-3 sm:px-6 pt-2">
            <div class="bg-white/95 backdrop-blur-xl border border-gray-200 rounded-2xl sm:rounded-3xl p-5 sm:p-6 shadow-xl transition-all duration-300">
                <nav class="flex flex-col gap-4 text-base font-medium text-gray-800">
                    <a href="#fitur" onclick="toggleMobileMenu()" class="hover:text-primary-600 py-1 transition-colors">Fitur</a>
                    <a href="#keunggulan" onclick="toggleMobileMenu()" class="hover:text-primary-600 py-1 transition-colors">Keunggulan</a>
                    <a href="#testimoni" onclick="toggleMobileMenu()" class="hover:text-primary-600 py-1 transition-colors">Testimoni</a>
                    <a href="#tentang" onclick="toggleMobileMenu()" class="hover:text-primary-600 py-1 transition-colors">Tentang Kami</a>
                    <a href="#faq" onclick="toggleMobileMenu()" class="hover:text-primary-600 py-1 transition-colors">FAQ</a>
                    <a href="#kontak" onclick="toggleMobileMenu()" class="hover:text-primary-600 py-1 transition-colors">Kontak</a>
                    <div class="pt-4 border-t border-gray-100 flex flex-col gap-3">
                        @auth
                            <a href="{{ route('dashboard') }}" class="text-center font-bold text-white bg-primary-600 hover:bg-primary-700 py-2.5 rounded-full shadow-sm transition-all">Masuk Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-center font-bold text-gray-900 py-2.5 rounded-full border border-gray-200 hover:border-primary-600 hover:text-primary-600 transition-colors">Log in</a>
                            <a href="{{ route('register') }}" class="text-center font-bold text-white bg-primary-600 hover:bg-primary-700 py-2.5 rounded-full shadow-sm transition-all">Daftar Sekarang</a>
                        @endauth
                    </div>
                </nav>
            </div>
        </div>
    </header>

    <!-- Hero Section (Rich Orange Grid + Translucent Frame + Upgraded Curved Bottom Divider) -->
    <section class="relative bg-primary-600 pt-24 sm:pt-36 pb-20 sm:pb-32 lg:pt-40 lg:pb-36 overflow-hidden">
        <!-- Architectural Grid Overlay -->
        <div class="absolute inset-0 bg-grid-hero pointer-events-none opacity-40"></div>
        <div class="absolute inset-y-0 right-0 w-1/2 bg-gradient-to-l from-primary-700/30 to-transparent pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid lg:grid-cols-12 gap-10 lg:gap-12 items-center">
                <!-- Left Content -->
                <div class="lg:col-span-7 text-white pt-4 lg:pt-0">
                    <div class="inline-flex max-w-full items-center gap-1.5 sm:gap-2 px-3 sm:px-4 py-1.5 rounded-lg bg-white/15 border border-white/25 text-white text-[11px] sm:text-sm font-bold uppercase tracking-wider mb-5 sm:mb-6 backdrop-blur-xs">
                        <span class="truncate sm:whitespace-normal">Sistem POS &amp; Manajemen Restoran Terpadu</span>
                    </div>

                    <div class="min-h-[110px] sm:min-h-[160px] lg:min-h-[190px] flex flex-col justify-center">
                        <h1 id="heroTitle" class="text-3xl sm:text-5xl lg:text-[60px] font-extrabold leading-[1.12] sm:leading-[1.08] tracking-tight text-white mb-4 sm:mb-6">
                            Laporan Keuangan<br>Real-Time &amp;<br>Otomatis
                        </h1>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 sm:gap-4 mt-6 sm:mt-8">
                        @auth
                            <a href="{{ route('dashboard') }}" class="group inline-flex items-center justify-center gap-2.5 sm:gap-3 bg-white hover:bg-orange-50 text-primary-600 text-sm sm:text-base font-bold py-3 sm:py-3.5 px-6 sm:px-8 rounded-full shadow-lg hover:shadow-xl transition-all text-center">
                                <span>Masuk Dashboard</span>
                                <svg class="w-4 h-4 text-primary-600 group-hover:translate-x-1 transition-transform shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="group inline-flex items-center justify-center gap-2.5 sm:gap-3 bg-white hover:bg-orange-50 text-primary-600 text-sm sm:text-base font-bold py-3 sm:py-3.5 px-6 sm:px-8 rounded-full shadow-lg hover:shadow-xl transition-all text-center">
                                <span>Jadwalkan Demo</span>
                                <svg class="w-4 h-4 text-primary-600 group-hover:translate-x-1 transition-transform shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </a>
                        @endauth
                        <a href="#fitur" class="inline-flex items-center justify-center bg-white/15 hover:bg-white/25 border border-white/30 text-white text-sm sm:text-base font-bold py-3 sm:py-3.5 px-6 sm:px-8 rounded-full backdrop-blur-xs transition-all text-center">
                            <span>Chat WhatsApp</span>
                        </a>
                    </div>
                </div>

                <!-- Right Visual: Rounded Framed Container matching User Screenshot -->
                <div class="lg:col-span-5 flex justify-center lg:justify-end items-center relative mt-6 lg:mt-0">
                    <div class="relative w-full max-w-sm sm:max-w-lg lg:max-w-none mx-auto">
                        <!-- Structural outer rounded card frame -->
                        <div class="relative rounded-2xl sm:rounded-3xl lg:rounded-[2.5rem] bg-white/10 border border-white/20 backdrop-blur-xs p-4 sm:p-6 lg:p-8 shadow-2xl flex items-center justify-center">
                            <img src="{{ asset('assets/img/tablet-polosan.png') }}" alt="Tablet POS SIPEMMA" class="w-full h-auto object-contain realistic-shadow float-tablet select-none pointer-events-none transition-transform duration-500">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Animated Continuous Water Waves Bottom Divider -->
        <div class="waves-container absolute -bottom-1 left-0 right-0 w-full overflow-hidden leading-none z-20 pointer-events-none">
            <svg class="waves block w-full h-10 sm:h-16 md:h-20 lg:h-24" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
                <defs>
                    <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
                </defs>
                <g class="parallax-waves">
                    <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255, 255, 255, 0.18)" />
                    <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255, 255, 255, 0.35)" />
                    <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(250, 248, 245, 0.6)" />
                    <use xlink:href="#gentle-wave" x="48" y="7" fill="#FAF8F5" />
                </g>
            </svg>
        </div>
    </section>

    <!-- Executive Metrics & Ecosystem Section (Clean, Professional, No Emojis) -->
    <section class="relative bg-[#FAF8F5] border-b border-gray-200/70 py-10 sm:py-12 lg:py-16 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- 4 Column Structured Stat Matrix -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6 mb-10 sm:mb-12">
                <div class="bg-white rounded-xl sm:rounded-2xl p-4 sm:p-6 border border-gray-200/80 shadow-2xs hover:shadow-xs transition-shadow flex flex-col justify-center" data-aos="fade-up" data-aos-delay="0">
                    <div class="text-2xl sm:text-4xl font-extrabold text-primary-600 tracking-tight">10.000+</div>
                    <div class="text-xs sm:text-sm font-bold text-gray-800 mt-1 sm:mt-1.5">Merchant Aktif</div>
                    <div class="text-[11px] sm:text-xs text-gray-500 mt-0.5 leading-snug">Tergabung dalam ekosistem</div>
                </div>
                <div class="bg-white rounded-xl sm:rounded-2xl p-4 sm:p-6 border border-gray-200/80 shadow-2xs hover:shadow-xs transition-shadow flex flex-col justify-center" data-aos="fade-up" data-aos-delay="100">
                    <div class="text-2xl sm:text-4xl font-extrabold text-gray-900 tracking-tight">&lt; 2 Detik</div>
                    <div class="text-xs sm:text-sm font-bold text-gray-800 mt-1 sm:mt-1.5">Kecepatan Kasir</div>
                    <div class="text-[11px] sm:text-xs text-gray-500 mt-0.5 leading-snug">Proses cetak struk &amp; bayar</div>
                </div>
                <div class="bg-white rounded-xl sm:rounded-2xl p-4 sm:p-6 border border-gray-200/80 shadow-2xs hover:shadow-xs transition-shadow flex flex-col justify-center" data-aos="fade-up" data-aos-delay="200">
                    <div class="text-2xl sm:text-4xl font-extrabold text-gray-900 tracking-tight">99.9%</div>
                    <div class="text-xs sm:text-sm font-bold text-gray-800 mt-1 sm:mt-1.5">Uptime Cloud POS</div>
                    <div class="text-[11px] sm:text-xs text-gray-500 mt-0.5 leading-snug">Konektivitas stabil harian</div>
                </div>
                <div class="bg-white rounded-xl sm:rounded-2xl p-4 sm:p-6 border border-gray-200/80 shadow-2xs hover:shadow-xs transition-shadow flex flex-col justify-center" data-aos="fade-up" data-aos-delay="300">
                    <div class="text-2xl sm:text-4xl font-extrabold text-gray-900 tracking-tight">24/7</div>
                    <div class="text-xs sm:text-sm font-bold text-gray-800 mt-1 sm:mt-1.5">Dukungan Teknis</div>
                    <div class="text-[11px] sm:text-xs text-gray-500 mt-0.5 leading-snug">Pendampingan operasional</div>
                </div>
            </div>

            <!-- Sleek Brand Divider Label -->
            <div class="flex items-center justify-center gap-2 sm:gap-4 max-w-3xl mx-auto mb-6 sm:mb-8 px-2" data-aos="fade-up">
                <div class="hidden sm:block h-px bg-gradient-to-r from-transparent via-gray-300 to-gray-300 flex-1"></div>
                <p class="text-[11px] sm:text-[13px] font-bold tracking-wider sm:tracking-widest text-gray-500 uppercase text-center leading-normal">
                    Dipercaya oleh Berbagai Usaha Kuliner &amp; Restoran Mitra
                </p>
                <div class="hidden sm:block h-px bg-gradient-to-l from-transparent via-gray-300 to-gray-300 flex-1"></div>
            </div>
        </div>

        <!-- Continuous Non-Stopping Culinary Partners Marquee -->
        <div class="relative w-full overflow-hidden py-2">
            <!-- Fade edges -->
            <div class="absolute left-0 top-0 bottom-0 w-16 sm:w-32 bg-gradient-to-r from-[#FAF8F5] via-[#FAF8F5]/80 to-transparent z-10 pointer-events-none"></div>
            <div class="absolute right-0 top-0 bottom-0 w-16 sm:w-32 bg-gradient-to-l from-[#FAF8F5] via-[#FAF8F5]/80 to-transparent z-10 pointer-events-none"></div>

            <div class="marquee-wrapper">
                <div class="marquee-brands select-none">
                    <!-- Set 1 (Mitra Usaha Kuliner - Typographic Brandmarks without Emojis) -->
                    <div class="flex items-center gap-1.5 px-4 py-2 hover:opacity-80 transition-opacity shrink-0">
                        <span class="text-base font-black tracking-tight text-gray-800">SAMBAL BAKAR</span>
                        <span class="text-[10px] font-extrabold px-1.5 py-0.5 rounded bg-orange-100 text-primary-600 uppercase tracking-wider">JUARA</span>
                    </div>

                    <div class="flex items-center px-4 py-2 hover:opacity-80 transition-opacity shrink-0">
                        <div class="leading-none text-left">
                            <span class="text-[9px] tracking-widest block font-bold text-gray-400 uppercase">KOPI</span>
                            <span class="text-base font-extrabold tracking-tight text-gray-800">TITIK TEMU</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-1.5 px-4 py-2 hover:opacity-80 transition-opacity shrink-0">
                        <span class="text-base font-black tracking-tight text-gray-800">BAKMI PANGSIT</span>
                        <span class="text-base font-black text-primary-600">88</span>
                    </div>

                    <div class="flex items-center px-4 py-2 hover:opacity-80 transition-opacity shrink-0">
                        <span class="text-base font-serif font-bold text-gray-800 tracking-wide">Saung Selera Sunda</span>
                    </div>

                    <div class="flex items-center gap-2 px-4 py-2 hover:opacity-80 transition-opacity shrink-0">
                        <span class="text-base font-black tracking-tighter text-gray-800 uppercase">URBAN BITES</span>
                        <span class="text-[9px] font-bold text-gray-400 tracking-widest uppercase">CAFE</span>
                    </div>

                    <div class="flex items-center gap-2 px-4 py-2 hover:opacity-80 transition-opacity shrink-0">
                        <span class="text-base font-bold text-gray-800 tracking-tight">Kedai Kopi Senja</span>
                        <span class="text-[9px] font-bold bg-gray-200 text-gray-600 px-1.5 py-0.5 rounded">ROASTERY</span>
                    </div>

                    <div class="flex items-center px-4 py-2 hover:opacity-80 transition-opacity shrink-0">
                        <div class="leading-none text-left">
                            <span class="text-base font-extrabold tracking-tight text-gray-800">DAPUR RASA</span>
                            <span class="text-[9px] tracking-widest block font-bold text-gray-400 uppercase mt-0.5">NUSANTARA</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 px-4 py-2 hover:opacity-80 transition-opacity shrink-0">
                        <span class="text-base font-serif font-bold text-gray-800 tracking-tight">PADANG SAIYO</span>
                        <span class="text-[9px] font-semibold bg-amber-100 text-amber-800 px-1.5 py-0.5 rounded">MINANG</span>
                    </div>

                    <div class="flex items-center gap-2 px-4 py-2 hover:opacity-80 transition-opacity shrink-0">
                        <span class="text-base font-bold italic text-gray-800 tracking-tight">Artisan Bakery</span>
                        <span class="text-[9px] font-bold text-gray-400 uppercase tracking-widest">PASTRY</span>
                    </div>

                    <div class="flex items-center gap-1.5 px-4 py-2 hover:opacity-80 transition-opacity shrink-0">
                        <span class="text-base font-black text-gray-800 tracking-tighter uppercase">Ayam Geprek</span>
                        <span class="text-xs font-black text-primary-600 uppercase">MAS BRO</span>
                    </div>

                    <!-- Set 2 (Duplicated for seamless continuous scroll) -->
                    <div class="flex items-center gap-1.5 px-4 py-2 hover:opacity-80 transition-opacity shrink-0">
                        <span class="text-base font-black tracking-tight text-gray-800">SAMBAL BAKAR</span>
                        <span class="text-[10px] font-extrabold px-1.5 py-0.5 rounded bg-orange-100 text-primary-600 uppercase tracking-wider">JUARA</span>
                    </div>

                    <div class="flex items-center px-4 py-2 hover:opacity-80 transition-opacity shrink-0">
                        <div class="leading-none text-left">
                            <span class="text-[9px] tracking-widest block font-bold text-gray-400 uppercase">KOPI</span>
                            <span class="text-base font-extrabold tracking-tight text-gray-800">TITIK TEMU</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-1.5 px-4 py-2 hover:opacity-80 transition-opacity shrink-0">
                        <span class="text-base font-black tracking-tight text-gray-800">BAKMI PANGSIT</span>
                        <span class="text-base font-black text-primary-600">88</span>
                    </div>

                    <div class="flex items-center px-4 py-2 hover:opacity-80 transition-opacity shrink-0">
                        <span class="text-base font-serif font-bold text-gray-800 tracking-wide">Saung Selera Sunda</span>
                    </div>

                    <div class="flex items-center gap-2 px-4 py-2 hover:opacity-80 transition-opacity shrink-0">
                        <span class="text-base font-black tracking-tighter text-gray-800 uppercase">URBAN BITES</span>
                        <span class="text-[9px] font-bold text-gray-400 tracking-widest uppercase">CAFE</span>
                    </div>

                    <div class="flex items-center gap-2 px-4 py-2 hover:opacity-80 transition-opacity shrink-0">
                        <span class="text-base font-bold text-gray-800 tracking-tight">Kedai Kopi Senja</span>
                        <span class="text-[9px] font-bold bg-gray-200 text-gray-600 px-1.5 py-0.5 rounded">ROASTERY</span>
                    </div>

                    <div class="flex items-center px-4 py-2 hover:opacity-80 transition-opacity shrink-0">
                        <div class="leading-none text-left">
                            <span class="text-base font-extrabold tracking-tight text-gray-800">DAPUR RASA</span>
                            <span class="text-[9px] tracking-widest block font-bold text-gray-400 uppercase mt-0.5">NUSANTARA</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 px-4 py-2 hover:opacity-80 transition-opacity shrink-0">
                        <span class="text-base font-serif font-bold text-gray-800 tracking-tight">PADANG SAIYO</span>
                        <span class="text-[9px] font-semibold bg-amber-100 text-amber-800 px-1.5 py-0.5 rounded">MINANG</span>
                    </div>

                    <div class="flex items-center gap-2 px-4 py-2 hover:opacity-80 transition-opacity shrink-0">
                        <span class="text-base font-bold italic text-gray-800 tracking-tight">Artisan Bakery</span>
                        <span class="text-[9px] font-bold text-gray-400 uppercase tracking-widest">PASTRY</span>
                    </div>

                    <div class="flex items-center gap-1.5 px-4 py-2 hover:opacity-80 transition-opacity shrink-0">
                        <span class="text-base font-black text-gray-800 tracking-tighter uppercase">Ayam Geprek</span>
                        <span class="text-xs font-black text-primary-600 uppercase">MAS BRO</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Feature Chapter 1: Real-time Restaurant Operations -->
    <section id="fitur" class="scroll-mt-24 py-16 sm:py-24 lg:py-32 bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-12 gap-8 lg:gap-16 items-center">
                <!-- Visual Container (Hardware & Dashboard double-bezel) -->
                <div class="lg:col-span-6 order-2 lg:order-1 mt-6 lg:mt-0" data-aos="fade-right">
                    <div class="relative p-2.5 sm:p-3 rounded-2xl sm:rounded-3xl bg-gray-50 border border-gray-200/90 shadow-lg">
                        <div class="rounded-xl sm:rounded-2xl overflow-hidden shadow-inner">
                            <img src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?auto=format&fit=crop&q=80&w=800" alt="Dashboard Backoffice" class="w-full object-cover select-none pointer-events-none hover:scale-102 transition-transform duration-700">
                        </div>
                    </div>
                </div>
                
                <!-- Content Column -->
                <div class="lg:col-span-6 order-1 lg:order-2" data-aos="fade-left">
                    <div class="max-w-xl">
                        <h2 class="text-2xl sm:text-4xl lg:text-5xl font-extrabold text-gray-900 mb-4 sm:mb-6 leading-[1.15] tracking-tight">
                            Pantau Bisnis Lebih Cepat
                        </h2>
                        <p class="text-sm sm:text-base lg:text-lg text-gray-600 mb-6 sm:mb-10 leading-relaxed font-normal">
                            Kelola operasional dan pantau performa finansial usaha Anda secara real-time dari satu sistem.
                        </p>

                        <!-- Structured Feature List (Eliminating repetitive round bubbles) -->
                        <div class="space-y-4 sm:space-y-6">
                            <div class="flex gap-3 sm:gap-4 items-start p-3.5 sm:p-4 rounded-xl sm:rounded-2xl bg-orange-50/40 border border-orange-100/80">
                                <div class="w-1.5 h-8 sm:h-10 rounded-full bg-primary-600 shrink-0 mt-0.5 sm:mt-0"></div>
                                <div>
                                    <h3 class="text-sm sm:text-lg font-bold text-gray-900 leading-snug">
                                        Kelola pesanan dine-in, takeaway, dan online terpadu.
                                    </h3>
                                </div>
                            </div>

                            <div class="flex gap-3 sm:gap-4 items-start p-3.5 sm:p-4 rounded-xl sm:rounded-2xl bg-gray-50 border border-gray-100">
                                <div class="w-1.5 h-8 sm:h-10 rounded-full bg-gray-400 shrink-0 mt-0.5 sm:mt-0"></div>
                                <div>
                                    <h3 class="text-sm sm:text-lg font-bold text-gray-900 leading-snug">
                                        Atur menu, meja, dan operasional toko dengan mudah.
                                    </h3>
                                </div>
                            </div>

                            <div class="flex gap-3 sm:gap-4 items-start p-3.5 sm:p-4 rounded-xl sm:rounded-2xl bg-gray-50 border border-gray-100">
                                <div class="w-1.5 h-8 sm:h-10 rounded-full bg-primary-500 shrink-0 mt-0.5 sm:mt-0"></div>
                                <div>
                                    <h3 class="text-sm sm:text-lg font-bold text-gray-900 leading-snug">
                                        Analisis tren penjualan cerdas berbasis AI Assistant.
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Feature Chapter 2: Point of Sale Experience (Architectural Split with Subtle Grid) -->
    <section class="py-16 sm:py-24 lg:py-32 bg-[#F8F9FA] border-y border-gray-200/70 overflow-hidden bg-grid-subtle">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-12 gap-8 lg:gap-16 items-center">
                <div class="lg:col-span-6" data-aos="fade-right">
                    <div class="max-w-xl">
                        <div class="inline-block text-xs font-extrabold uppercase tracking-wider text-primary-600 bg-orange-100/70 px-3 py-1 rounded-md mb-3 sm:mb-4">
                            SIPEMMA Point of Sale
                        </div>
                        <h2 class="text-2xl sm:text-4xl lg:text-5xl font-extrabold text-gray-900 mb-4 sm:mb-6 leading-[1.15] tracking-tight">
                            Kasir Cepat & Praktis untuk Toko Anda
                        </h2>
                        <p class="text-sm sm:text-base lg:text-lg text-gray-600 mb-6 sm:mb-8 leading-relaxed">
                            Catat transaksi dalam hitungan detik, terima aneka metode pembayaran, dan pantau stok barang otomatis tanpa khawatir selisih.
                        </p>

                        <a href="#fitur" class="group inline-flex items-center gap-2.5 sm:gap-3 text-primary-600 font-extrabold text-sm sm:text-base hover:text-primary-700 transition-colors">
                            <span>Pelajari Fitur</span>
                            <span class="w-7 h-7 rounded-full bg-primary-100 flex items-center justify-center text-primary-600 group-hover:translate-x-1 transition-transform shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            </span>
                        </a>
                    </div>
                </div>

                <div class="lg:col-span-6 mt-6 lg:mt-0" data-aos="fade-left">
                    <div class="p-2.5 sm:p-3 rounded-2xl sm:rounded-3xl bg-white border border-gray-200 shadow-xl">
                        <div class="rounded-xl sm:rounded-2xl overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1556740738-b6a63e27c4df?auto=format&fit=crop&q=80&w=800" alt="Kasir Offline" class="w-full object-cover select-none pointer-events-none hover:scale-102 transition-transform duration-700">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Feature Chapter 3: Integrated Financial Intelligence -->
    <section class="py-16 sm:py-24 lg:py-32 bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-12 gap-8 lg:gap-16 items-center">
                <div class="lg:col-span-6 order-2 lg:order-1 mt-6 lg:mt-0" data-aos="fade-right">
                    <div class="p-2.5 sm:p-3 rounded-2xl sm:rounded-3xl bg-orange-50/60 border border-orange-100 shadow-xl">
                        <div class="rounded-xl sm:rounded-2xl overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1579621970795-87facc2f976d?auto=format&fit=crop&q=80&w=800" alt="Laporan Penjualan" class="w-full object-cover select-none pointer-events-none hover:scale-102 transition-transform duration-700">
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-6 order-1 lg:order-2" data-aos="fade-left">
                    <div class="max-w-xl">
                        <div class="inline-block text-xs font-extrabold uppercase tracking-wider text-primary-600 bg-orange-100/70 px-3 py-1 rounded-md mb-3 sm:mb-4">
                            SIPEMMA Manajemen Terpadu
                        </div>
                        <h2 class="text-2xl sm:text-4xl lg:text-5xl font-extrabold text-gray-900 mb-4 sm:mb-6 leading-[1.15] tracking-tight">
                            Laporan Penjualan & Laba Real-Time
                        </h2>
                        <p class="text-sm sm:text-base lg:text-lg text-gray-600 mb-6 sm:mb-8 leading-relaxed">
                            Tanpa rekap manual yang melelahkan. Pantau laba rugi, omzet harian, dan mutasi barang otomatis dari perangkat apa pun kapan saja.
                        </p>

                        <a href="#fitur" class="group inline-flex items-center gap-2.5 sm:gap-3 text-primary-600 font-extrabold text-sm sm:text-base hover:text-primary-700 transition-colors">
                            <span>Lihat Selengkapnya</span>
                            <span class="w-7 h-7 rounded-full bg-primary-100 flex items-center justify-center text-primary-600 group-hover:translate-x-1 transition-transform shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Comparison Matrix (Clean, Architectural, Highly Legible) -->
    <section id="keunggulan" class="scroll-mt-24 py-16 sm:py-24 lg:py-32 bg-[#F8F9FA] border-t border-gray-200/70 overflow-hidden">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10 sm:mb-16" data-aos="fade-up">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-md bg-white border border-gray-200 text-primary-700 text-xs sm:text-sm font-bold uppercase tracking-wider mb-3 sm:mb-4 shadow-2xs">
                    <svg class="w-4 h-4 text-primary-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    Komparasi Fitur Unggulan
                </div>
                <h2 class="text-2xl sm:text-4xl lg:text-5xl font-extrabold text-gray-900 tracking-tight mb-3 sm:mb-4">
                    Kenapa Memilih SIPEMMA?
                </h2>
                <p class="text-sm sm:text-lg text-gray-600 font-normal max-w-2xl mx-auto">
                    Bandingkan langsung kelengkapan fungsi operasional kasir SIPEMMA dengan sistem kasir konvensional lainnya.
                </p>
            </div>

            <!-- Comparison Table Enclosure -->
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden" data-aos="fade-up" data-aos-delay="100">
                <!-- Table Header -->
                <div class="grid grid-cols-12 items-center px-3.5 sm:px-8 py-3.5 sm:py-5 border-b border-gray-200 bg-gray-50/70">
                    <div class="col-span-6 sm:col-span-8">
                        <span class="text-[11px] sm:text-sm font-extrabold uppercase tracking-wider text-gray-500">Fitur &amp; Kemampuan</span>
                    </div>
                    <div class="col-span-3 sm:col-span-2 text-center text-[11px] sm:text-sm font-bold text-gray-500 leading-tight">
                        Sistem Kasir Lain
                    </div>
                    <div class="col-span-3 sm:col-span-2 text-center flex flex-col items-center justify-center">
                        <span class="hidden sm:inline-block px-2 py-0.5 rounded bg-primary-600 text-white text-[10px] font-extrabold uppercase tracking-wider mb-0.5">
                            Terlengkap
                        </span>
                        <span class="text-xs sm:text-base font-extrabold text-primary-600 tracking-tight">
                            SIPEMMA
                        </span>
                    </div>
                </div>

                <!-- Comparison Rows -->
                <!-- Row 1 -->
                <div class="grid grid-cols-12 items-center px-3.5 sm:px-8 py-3.5 sm:py-5 border-b border-gray-100 hover:bg-orange-50/20 transition-colors">
                    <div class="col-span-6 sm:col-span-8 pr-2 sm:pr-4">
                        <span class="text-xs sm:text-base font-bold text-gray-900 block leading-snug">Kasir Dine In &amp; Take Away dengan Nomor Meja</span>
                        <span class="text-xs text-gray-500 mt-0.5 leading-relaxed hidden sm:block">Pilih tipe pesanan makan di tempat dengan nomor meja atau bungkus, hitung pajak PB1 10% otomatis, dan cetak struk kasir instan.</span>
                    </div>
                    <div class="col-span-3 sm:col-span-2 flex justify-center">
                        <div class="w-6 h-6 sm:w-7 sm:h-7 rounded-full bg-rose-50 text-rose-500 flex items-center justify-center shrink-0">
                            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </div>
                    </div>
                    <div class="col-span-3 sm:col-span-2 flex justify-center">
                        <div class="w-6 h-6 sm:w-7 sm:h-7 rounded-full bg-primary-600 text-white flex items-center justify-center shadow-xs shrink-0">
                            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                    </div>
                </div>

                <!-- Row 2 -->
                <div class="grid grid-cols-12 items-center px-3.5 sm:px-8 py-3.5 sm:py-5 border-b border-gray-100 hover:bg-orange-50/20 transition-colors">
                    <div class="col-span-6 sm:col-span-8 pr-2 sm:pr-4">
                        <span class="text-xs sm:text-base font-bold text-gray-900 block leading-snug">Pembayaran Digital Otomatis (Midtrans Gateway)</span>
                        <span class="text-xs text-gray-500 mt-0.5 leading-relaxed hidden sm:block">Terintegrasi langsung dengan Midtrans untuk pembayaran QRIS dinamis, Virtual Account Bank (BCA, Mandiri, BNI, BRI), dan E-Wallet tanpa cek mutasi manual.</span>
                    </div>
                    <div class="col-span-3 sm:col-span-2 flex justify-center">
                        <div class="w-6 h-6 sm:w-7 sm:h-7 rounded-full bg-rose-50 text-rose-500 flex items-center justify-center shrink-0">
                            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </div>
                    </div>
                    <div class="col-span-3 sm:col-span-2 flex justify-center">
                        <div class="w-6 h-6 sm:w-7 sm:h-7 rounded-full bg-primary-600 text-white flex items-center justify-center shadow-xs shrink-0">
                            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                    </div>
                </div>

                <!-- Row 3 -->
                <div class="grid grid-cols-12 items-center px-3.5 sm:px-8 py-3.5 sm:py-5 border-b border-gray-100 hover:bg-orange-50/20 transition-colors">
                    <div class="col-span-6 sm:col-span-8 pr-2 sm:pr-4">
                        <span class="text-xs sm:text-base font-bold text-gray-900 block leading-snug">Kalkulator Kasir Tunai &amp; Hitung Kembalian Otomatis</span>
                        <span class="text-xs text-gray-500 mt-0.5 leading-relaxed hidden sm:block">Input nominal uang tunai yang diterima dengan kalkulator kembalian otomatis di layar pembayaran untuk mencegah salah hitung saat jam sibuk.</span>
                    </div>
                    <div class="col-span-3 sm:col-span-2 flex justify-center">
                        <div class="w-6 h-6 sm:w-7 sm:h-7 rounded-full bg-rose-50 text-rose-500 flex items-center justify-center shrink-0">
                            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </div>
                    </div>
                    <div class="col-span-3 sm:col-span-2 flex justify-center">
                        <div class="w-6 h-6 sm:w-7 sm:h-7 rounded-full bg-primary-600 text-white flex items-center justify-center shadow-xs shrink-0">
                            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                    </div>
                </div>

                <!-- Row 4 -->
                <div class="grid grid-cols-12 items-center px-3.5 sm:px-8 py-3.5 sm:py-5 border-b border-gray-100 hover:bg-orange-50/20 transition-colors">
                    <div class="col-span-6 sm:col-span-8 pr-2 sm:pr-4">
                        <span class="text-xs sm:text-base font-bold text-gray-900 block leading-snug">Manajemen Menu &amp; Stok Berkurang Otomatis</span>
                        <span class="text-xs text-gray-500 mt-0.5 leading-relaxed hidden sm:block">Stok berkurang otomatis tiap pesanan sukses dibayar, counter menu terjual bertambah, dan otomatis nonaktif (out of stock) jika stok mencapai 0.</span>
                    </div>
                    <div class="col-span-3 sm:col-span-2 flex justify-center">
                        <div class="w-6 h-6 sm:w-7 sm:h-7 rounded-full bg-rose-50 text-rose-500 flex items-center justify-center shrink-0">
                            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </div>
                    </div>
                    <div class="col-span-3 sm:col-span-2 flex justify-center">
                        <div class="w-6 h-6 sm:w-7 sm:h-7 rounded-full bg-primary-600 text-white flex items-center justify-center shadow-xs shrink-0">
                            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                    </div>
                </div>

                <!-- Row 5 -->
                <div class="grid grid-cols-12 items-center px-3.5 sm:px-8 py-3.5 sm:py-5 border-b border-gray-100 hover:bg-orange-50/20 transition-colors">
                    <div class="col-span-6 sm:col-span-8 pr-2 sm:pr-4">
                        <span class="text-xs sm:text-base font-bold text-gray-900 flex flex-wrap items-center gap-1.5 sm:gap-2 leading-snug">
                            <span>SIPEMMA AI Restaurant Assistant (Chatbot Pintar)</span>
                            <span class="px-1.5 py-0.5 rounded bg-purple-100 text-purple-700 text-[10px] sm:text-[11px] font-bold shrink-0">AI Pintar</span>
                        </span>
                        <span class="text-xs text-gray-500 mt-0.5 leading-relaxed hidden sm:block">Asisten AI terintegrasi yang membaca data riil restoran secara live (omzet harian, menu terlaris, ketersediaan stok) dan memberikan saran strategi bisnis.</span>
                    </div>
                    <div class="col-span-3 sm:col-span-2 flex justify-center">
                        <div class="w-6 h-6 sm:w-7 sm:h-7 rounded-full bg-rose-50 text-rose-500 flex items-center justify-center shrink-0">
                            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </div>
                    </div>
                    <div class="col-span-3 sm:col-span-2 flex justify-center">
                        <div class="w-6 h-6 sm:w-7 sm:h-7 rounded-full bg-primary-600 text-white flex items-center justify-center shadow-xs shrink-0">
                            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                    </div>
                </div>

                <!-- Row 6 -->
                <div class="grid grid-cols-12 items-center px-3.5 sm:px-8 py-3.5 sm:py-5 border-b border-gray-100 hover:bg-orange-50/20 transition-colors">
                    <div class="col-span-6 sm:col-span-8 pr-2 sm:pr-4">
                        <span class="text-xs sm:text-base font-bold text-gray-900 block leading-snug">Dashboard KPI &amp; Laporan Omzet Real-Time</span>
                        <span class="text-xs text-gray-500 mt-0.5 leading-relaxed hidden sm:block">Ringkasan Total Pendapatan, Total Transaksi, Total Item Terjual, dan Average Order Value (AOV) otomatis tanpa rekap manual saat tutup toko.</span>
                    </div>
                    <div class="col-span-3 sm:col-span-2 flex justify-center">
                        <div class="w-6 h-6 sm:w-7 sm:h-7 rounded-full bg-rose-50 text-rose-500 flex items-center justify-center shrink-0">
                            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </div>
                    </div>
                    <div class="col-span-3 sm:col-span-2 flex justify-center">
                        <div class="w-6 h-6 sm:w-7 sm:h-7 rounded-full bg-primary-600 text-white flex items-center justify-center shadow-xs shrink-0">
                            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                    </div>
                </div>

                <!-- Row 7 -->
                <div class="grid grid-cols-12 items-center px-3.5 sm:px-8 py-3.5 sm:py-5 border-b border-gray-100 hover:bg-orange-50/20 transition-colors">
                    <div class="col-span-6 sm:col-span-8 pr-2 sm:pr-4">
                        <span class="text-xs sm:text-base font-bold text-gray-900 block leading-snug">Grafik Analisis Jam Sibuk Operasional (Peak Hours)</span>
                        <span class="text-xs text-gray-500 mt-0.5 leading-relaxed hidden sm:block">Visualisasi jam operasional paling ramai (08:00 - 22:00) untuk efisiensi penugasan shift staf dan persiapan stok bahan baku di dapur.</span>
                    </div>
                    <div class="col-span-3 sm:col-span-2 flex justify-center">
                        <div class="w-6 h-6 sm:w-7 sm:h-7 rounded-full bg-rose-50 text-rose-500 flex items-center justify-center shrink-0">
                            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </div>
                    </div>
                    <div class="col-span-3 sm:col-span-2 flex justify-center">
                        <div class="w-6 h-6 sm:w-7 sm:h-7 rounded-full bg-primary-600 text-white flex items-center justify-center shadow-xs shrink-0">
                            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                    </div>
                </div>

                <!-- Row 8 -->
                <div class="grid grid-cols-12 items-center px-3.5 sm:px-8 py-3.5 sm:py-5 border-b border-gray-100 hover:bg-orange-50/20 transition-colors">
                    <div class="col-span-6 sm:col-span-8 pr-2 sm:pr-4">
                        <span class="text-xs sm:text-base font-bold text-gray-900 block leading-snug">Grafik Tren Penjualan &amp; Donut Chart Metode Pembayaran</span>
                        <span class="text-xs text-gray-500 mt-0.5 leading-relaxed hidden sm:block">Area Chart tren omzet 12 hari terakhir serta Donut Chart komposisi transaksi Tunai, QRIS, dan Transfer yang interaktif dan mudah dibaca.</span>
                    </div>
                    <div class="col-span-3 sm:col-span-2 flex justify-center">
                        <div class="w-6 h-6 sm:w-7 sm:h-7 rounded-full bg-rose-50 text-rose-500 flex items-center justify-center shrink-0">
                            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </div>
                    </div>
                    <div class="col-span-3 sm:col-span-2 flex justify-center">
                        <div class="w-6 h-6 sm:w-7 sm:h-7 rounded-full bg-primary-600 text-white flex items-center justify-center shadow-xs shrink-0">
                            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                    </div>
                </div>

                <!-- Row 9 -->
                <div class="grid grid-cols-12 items-center px-3.5 sm:px-8 py-3.5 sm:py-5 border-b border-gray-100 hover:bg-orange-50/20 transition-colors">
                    <div class="col-span-6 sm:col-span-8 pr-2 sm:pr-4">
                        <span class="text-xs sm:text-base font-bold text-gray-900 block leading-snug">Pelacakan Riwayat Pesanan &amp; Auto-Cancel 15 Menit</span>
                        <span class="text-xs text-gray-500 mt-0.5 leading-relaxed hidden sm:block">Pelacakan status transaksi real-time dan proteksi pembatalan otomatis untuk pesanan belum dibayar yang melewati batas 15 menit.</span>
                    </div>
                    <div class="col-span-3 sm:col-span-2 flex justify-center">
                        <div class="w-6 h-6 sm:w-7 sm:h-7 rounded-full bg-rose-50 text-rose-500 flex items-center justify-center shrink-0">
                            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </div>
                    </div>
                    <div class="col-span-3 sm:col-span-2 flex justify-center">
                        <div class="w-6 h-6 sm:w-7 sm:h-7 rounded-full bg-primary-600 text-white flex items-center justify-center shadow-xs shrink-0">
                            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                    </div>
                </div>

                <!-- Row 10 -->
                <div class="grid grid-cols-12 items-center px-3.5 sm:px-8 py-3.5 sm:py-5 border-b border-gray-100 hover:bg-orange-50/20 transition-colors">
                    <div class="col-span-6 sm:col-span-8 pr-2 sm:pr-4">
                        <span class="text-xs sm:text-base font-bold text-gray-900 block leading-snug">Dukungan Dark Mode &amp; Light Mode Bawaan</span>
                        <span class="text-xs text-gray-500 mt-0.5 leading-relaxed hidden sm:block">Beralih mode gelap dan terang secara instan untuk kenyamanan mata staf saat bertugas di kondisi pencahayaan kafe atau resto malam hari.</span>
                    </div>
                    <div class="col-span-3 sm:col-span-2 flex justify-center">
                        <div class="w-6 h-6 sm:w-7 sm:h-7 rounded-full bg-rose-50 text-rose-500 flex items-center justify-center shrink-0">
                            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </div>
                    </div>
                    <div class="col-span-3 sm:col-span-2 flex justify-center">
                        <div class="w-6 h-6 sm:w-7 sm:h-7 rounded-full bg-primary-600 text-white flex items-center justify-center shadow-xs shrink-0">
                            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                    </div>
                </div>

                <!-- Row 11 -->
                <div class="grid grid-cols-12 items-center px-3.5 sm:px-8 py-3.5 sm:py-5 hover:bg-orange-50/20 transition-colors">
                    <div class="col-span-6 sm:col-span-8 pr-2 sm:pr-4">
                        <span class="text-xs sm:text-base font-bold text-gray-900 block leading-snug">Sistem Cloud Multi-Device Bebas Beli Mesin Khusus</span>
                        <span class="text-xs text-gray-500 mt-0.5 leading-relaxed hidden sm:block">Akses fleksibel melalui browser dari smartphone, tablet Android/iPad, laptop, hingga PC kasir tanpa kewajiban membeli hardware mahal.</span>
                    </div>
                    <div class="col-span-3 sm:col-span-2 flex justify-center">
                        <div class="w-6 h-6 sm:w-7 sm:h-7 rounded-full bg-rose-50 text-rose-500 flex items-center justify-center shrink-0">
                            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </div>
                    </div>
                    <div class="col-span-3 sm:col-span-2 flex justify-center">
                        <div class="w-6 h-6 sm:w-7 sm:h-7 rounded-full bg-primary-600 text-white flex items-center justify-center shadow-xs shrink-0">
                            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Impact Stats & Testimonials Section -->
    <section id="testimoni" class="scroll-mt-24 py-16 sm:py-24 lg:py-32 bg-white border-t border-gray-100 relative bg-dots overflow-hidden">
        <!-- Section Header -->
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center mb-10 sm:mb-16" data-aos="fade-up">
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-md bg-white border border-gray-200 text-primary-700 text-xs sm:text-sm font-bold uppercase tracking-wider mb-3 sm:mb-4 shadow-2xs">
                <svg class="w-4 h-4 text-primary-600" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                Ulasan &amp; Dampak Nyata
            </div>
            <h2 class="text-2xl sm:text-4xl lg:text-5xl font-extrabold text-gray-900 tracking-tight mb-3 sm:mb-4 md:whitespace-nowrap">
                Dipercaya oleh Pengusaha <span class="whitespace-nowrap">Restoran &amp; Kafe</span>
            </h2>
            <p class="text-sm sm:text-lg text-gray-600 max-w-2xl mx-auto leading-relaxed">
                Lihat bagaimana SIPEMMA mentransformasi operasional kasir meja, pembayaran otomatis, dan analisis bisnis kuliner harian.
            </p>
        </div>

        <!-- 4 Impact Metric Strips -->
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 mb-12 sm:mb-20">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6">
                <!-- Stat 1 -->
                <div class="bg-white rounded-xl sm:rounded-2xl border border-gray-200/90 p-4 sm:p-6 text-center shadow-xs hover:border-primary-300 transition-all group flex flex-col justify-center" data-aos="fade-up" data-aos-delay="100">
                    <div class="text-2xl sm:text-4xl font-extrabold text-primary-600 mb-1">3x</div>
                    <div class="text-xs sm:text-sm font-bold text-gray-800">Lebih Cepat</div>
                    <div class="text-[10px] sm:text-xs text-gray-500 mt-1 leading-snug">Alur Kasir &amp; Meja Dine-In</div>
                </div>

                <!-- Stat 2 -->
                <div class="bg-white rounded-xl sm:rounded-2xl border border-gray-200/90 p-4 sm:p-6 text-center shadow-xs hover:border-primary-300 transition-all group flex flex-col justify-center" data-aos="fade-up" data-aos-delay="200">
                    <div class="text-2xl sm:text-4xl font-extrabold text-gray-900 mb-1">100%</div>
                    <div class="text-xs sm:text-sm font-bold text-gray-800">Otomatis</div>
                    <div class="text-[10px] sm:text-xs text-gray-500 mt-1 leading-snug">Rekap Laporan &amp; Pajak PB1</div>
                </div>

                <!-- Stat 3 -->
                <div class="bg-white rounded-xl sm:rounded-2xl border border-gray-200/90 p-4 sm:p-6 text-center shadow-xs hover:border-primary-300 transition-all group flex flex-col justify-center" data-aos="fade-up" data-aos-delay="300">
                    <div class="text-2xl sm:text-4xl font-extrabold text-gray-900 mb-1">4.9/5</div>
                    <div class="text-xs sm:text-sm font-bold text-gray-800">Rating Kepuasan</div>
                    <div class="text-[10px] sm:text-xs text-gray-500 mt-1 leading-snug">Berdasarkan Ulasan Kasir &amp; Owner</div>
                </div>

                <!-- Stat 4 -->
                <div class="bg-white rounded-xl sm:rounded-2xl border border-gray-200/90 p-4 sm:p-6 text-center shadow-xs hover:border-primary-300 transition-all group flex flex-col justify-center" data-aos="fade-up" data-aos-delay="400">
                    <div class="text-2xl sm:text-4xl font-extrabold text-gray-900 mb-1">24/7</div>
                    <div class="text-xs sm:text-sm font-bold text-gray-800">AI Assistant Siaga</div>
                    <div class="text-[10px] sm:text-xs text-gray-500 mt-1 leading-snug">Analisis Omzet &amp; Menu Terlaris</div>
                </div>
            </div>
        </div>

        <!-- Testimonials Marquee Header -->
        <div class="mb-8 sm:mb-10 text-center" data-aos="fade-up">
            <h3 class="text-xl sm:text-3xl lg:text-4xl font-extrabold text-gray-900 tracking-tight">
                Pengalaman Nyata Mitra Kuliner SIPEMMA
            </h3>
            <p class="text-xs sm:text-base text-gray-500 mt-1.5 sm:mt-2 font-normal">
                Cerita dari barista, kasir, head chef, dan pemilik restoran yang telah menggunakan SIPEMMA setiap hari.
            </p>
        </div>

        <!-- Testimonial Cards Marquee (Continuous non-stopping scroll) -->
        <div class="relative w-full overflow-hidden py-2 sm:py-4">
            <!-- Fade edges -->
            <div class="absolute left-0 top-0 bottom-0 w-8 sm:w-24 bg-gradient-to-r from-white via-white/80 to-transparent z-10 pointer-events-none"></div>
            <div class="absolute right-0 top-0 bottom-0 w-8 sm:w-24 bg-gradient-to-l from-white via-white/80 to-transparent z-10 pointer-events-none"></div>

            <div class="marquee-wrapper">
                <div class="marquee-testimonials px-2 sm:px-4">
                <!-- Group 1 -->
                <!-- Card 1 -->
                <div class="w-[280px] sm:w-[390px] shrink-0 bg-white rounded-2xl border border-gray-200 p-5 sm:p-7 shadow-xs hover:border-primary-400 transition-all flex flex-col justify-between text-left whitespace-normal min-h-[200px] sm:min-h-[220px]">
                    <div>
                        <div class="flex items-center gap-3.5 mb-3">
                            <div class="w-10 h-10 rounded-xl bg-orange-100 text-primary-700 flex items-center justify-center font-bold text-base shrink-0">
                                M
                            </div>
                            <div>
                                <div class="text-[15px] font-bold text-gray-900 leading-tight">Mayla Fazza</div>
                                <div class="text-xs text-primary-600 font-semibold mt-0.5">Owner, Kopi Senja Space</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-0.5 text-amber-400 text-xs mb-3">
                            <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                        </div>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            "Paling terbantu dengan fitur pesanan meja dine-in dan take away-nya! Antrean kasir jadi tertib, cetak struk kasir cepat, dan pembayaran QRIS pelanggan langsung terkonfirmasi otomatis tanpa kami harus bolak-balik cek mutasi bank."
                        </p>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="w-[280px] sm:w-[390px] shrink-0 bg-white rounded-2xl border border-gray-200 p-5 sm:p-7 shadow-xs hover:border-primary-400 transition-all flex flex-col justify-between text-left whitespace-normal min-h-[200px] sm:min-h-[220px]">
                    <div>
                        <div class="flex items-center gap-3.5 mb-3">
                            <div class="w-10 h-10 rounded-xl bg-orange-100 text-primary-700 flex items-center justify-center font-bold text-base shrink-0">
                                R
                            </div>
                            <div>
                                <div class="text-[15px] font-bold text-gray-900 leading-tight">Rendy Pratama</div>
                                <div class="text-xs text-primary-600 font-semibold mt-0.5">Head Chef & Pengelola, Resto Dapur Melayu</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-0.5 text-amber-400 text-xs mb-3">
                            <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                        </div>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            "Manajemen stok real-time-nya luar biasa. Begitu pesanan dibayar, stok berkurang otomatis dan menu langsung out-of-stock saat habis. Dapur jadi tenang karena pelanggan tidak akan memesan menu yang bahannya sudah kosong."
                        </p>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="w-[280px] sm:w-[390px] shrink-0 bg-white rounded-2xl border border-gray-200 p-5 sm:p-7 shadow-xs hover:border-primary-400 transition-all flex flex-col justify-between text-left whitespace-normal min-h-[200px] sm:min-h-[220px]">
                    <div>
                        <div class="flex items-center gap-3.5 mb-3">
                            <div class="w-10 h-10 rounded-xl bg-orange-100 text-primary-700 flex items-center justify-center font-bold text-base shrink-0">
                                S
                            </div>
                            <div>
                                <div class="text-[15px] font-bold text-gray-900 leading-tight">Sajiwa Baswara</div>
                                <div class="text-xs text-primary-600 font-semibold mt-0.5">Pemilik, Kedai Bakso & Mie Juara</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-0.5 text-amber-400 text-xs mb-3">
                            <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                        </div>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            "Kalkulator kasir tunai dengan hitungan kembalian otomatis benar-benar menyelamatkan kasir kami di jam sibuk makan siang. Kasir tidak perlu lagi hitung kalkulator manual, dan tidak pernah ada lagi selisih uang kas saat tutup toko."
                        </p>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="w-[280px] sm:w-[390px] shrink-0 bg-white rounded-2xl border border-gray-200 p-5 sm:p-7 shadow-xs hover:border-primary-400 transition-all flex flex-col justify-between text-left whitespace-normal min-h-[200px] sm:min-h-[220px]">
                    <div>
                        <div class="flex items-center gap-3.5 mb-3">
                            <div class="w-10 h-10 rounded-xl bg-orange-100 text-primary-700 flex items-center justify-center font-bold text-base shrink-0">
                                D
                            </div>
                            <div>
                                <div class="text-[15px] font-bold text-gray-900 leading-tight">Dewi Sartika</div>
                                <div class="text-xs text-primary-600 font-semibold mt-0.5">Manajer Restoran, Saung Selera Sunda</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-0.5 text-amber-400 text-xs mb-3">
                            <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                        </div>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            "Grafik Peak Hours (Jam Sibuk) di halaman Reports sangat membantu! Kami bisa melihat jam-jam operasional teramai dengan jelas, sehingga penjadwalan shift kerja staf dapur dan kasir jadi jauh lebih efisien dan tepat sasaran."
                        </p>
                    </div>
                </div>

                <!-- Card 5 -->
                <div class="w-[280px] sm:w-[390px] shrink-0 bg-white rounded-2xl border border-gray-200 p-5 sm:p-7 shadow-xs hover:border-primary-400 transition-all flex flex-col justify-between text-left whitespace-normal min-h-[200px] sm:min-h-[220px]">
                    <div>
                        <div class="flex items-center gap-3.5 mb-3">
                            <div class="w-10 h-10 rounded-xl bg-orange-100 text-primary-700 flex items-center justify-center font-bold text-base shrink-0">
                                K
                            </div>
                            <div>
                                <div class="text-[15px] font-bold text-gray-900 leading-tight">Kevin Aditya</div>
                                <div class="text-xs text-primary-600 font-semibold mt-0.5">Founder, Urban Bites Cafe & Dessert</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-0.5 text-amber-400 text-xs mb-3">
                            <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                        </div>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            "Fitur SIPEMMA AI Assistant di dalam aplikasi sangat inovatif! Kami bisa tanya langsung omzet harian, menu paling laku, dan saran promo kuliner. Tampilan Dark Mode-nya juga sangat nyaman untuk mata kasir yang bertugas di shift malam."
                        </p>
                    </div>
                </div>

                <!-- Group 2 (Seamless Duplicate for Continuous Scroll) -->
                <!-- Card 1 -->
                <div class="w-[280px] sm:w-[390px] shrink-0 bg-white rounded-2xl border border-gray-200 p-5 sm:p-7 shadow-xs hover:border-primary-400 transition-all flex flex-col justify-between text-left whitespace-normal min-h-[200px] sm:min-h-[220px]">
                    <div>
                        <div class="flex items-center gap-3.5 mb-3">
                            <div class="w-10 h-10 rounded-xl bg-orange-100 text-primary-700 flex items-center justify-center font-bold text-base shrink-0">
                                M
                            </div>
                            <div>
                                <div class="text-[15px] font-bold text-gray-900 leading-tight">Mayla Fazza</div>
                                <div class="text-xs text-primary-600 font-semibold mt-0.5">Owner, Kopi Senja Space</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-0.5 text-amber-400 text-xs mb-3">
                            <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                        </div>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            "Paling terbantu dengan fitur pesanan meja dine-in dan take away-nya! Antrean kasir jadi tertib, cetak struk kasir cepat, dan pembayaran QRIS pelanggan langsung terkonfirmasi otomatis tanpa kami harus bolak-balik cek mutasi bank."
                        </p>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="w-[280px] sm:w-[390px] shrink-0 bg-white rounded-2xl border border-gray-200 p-5 sm:p-7 shadow-xs hover:border-primary-400 transition-all flex flex-col justify-between text-left whitespace-normal min-h-[200px] sm:min-h-[220px]">
                    <div>
                        <div class="flex items-center gap-3.5 mb-3">
                            <div class="w-10 h-10 rounded-xl bg-orange-100 text-primary-700 flex items-center justify-center font-bold text-base shrink-0">
                                R
                            </div>
                            <div>
                                <div class="text-[15px] font-bold text-gray-900 leading-tight">Rendy Pratama</div>
                                <div class="text-xs text-primary-600 font-semibold mt-0.5">Head Chef & Pengelola, Resto Dapur Melayu</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-0.5 text-amber-400 text-xs mb-3">
                            <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                        </div>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            "Manajemen stok real-time-nya luar biasa. Begitu pesanan dibayar, stok berkurang otomatis dan menu langsung out-of-stock saat habis. Dapur jadi tenang karena pelanggan tidak akan memesan menu yang bahannya sudah kosong."
                        </p>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="w-[280px] sm:w-[390px] shrink-0 bg-white rounded-2xl border border-gray-200 p-5 sm:p-7 shadow-xs hover:border-primary-400 transition-all flex flex-col justify-between text-left whitespace-normal min-h-[200px] sm:min-h-[220px]">
                    <div>
                        <div class="flex items-center gap-3.5 mb-3">
                            <div class="w-10 h-10 rounded-xl bg-orange-100 text-primary-700 flex items-center justify-center font-bold text-base shrink-0">
                                S
                            </div>
                            <div>
                                <div class="text-[15px] font-bold text-gray-900 leading-tight">Sajiwa Baswara</div>
                                <div class="text-xs text-primary-600 font-semibold mt-0.5">Pemilik, Kedai Bakso & Mie Juara</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-0.5 text-amber-400 text-xs mb-3">
                            <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                        </div>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            "Kalkulator kasir tunai dengan hitungan kembalian otomatis benar-benar menyelamatkan kasir kami di jam sibuk makan siang. Kasir tidak perlu lagi hitung kalkulator manual, dan tidak pernah ada lagi selisih uang kas saat tutup toko."
                        </p>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="w-[280px] sm:w-[390px] shrink-0 bg-white rounded-2xl border border-gray-200 p-5 sm:p-7 shadow-xs hover:border-primary-400 transition-all flex flex-col justify-between text-left whitespace-normal min-h-[200px] sm:min-h-[220px]">
                    <div>
                        <div class="flex items-center gap-3.5 mb-3">
                            <div class="w-10 h-10 rounded-xl bg-orange-100 text-primary-700 flex items-center justify-center font-bold text-base shrink-0">
                                D
                            </div>
                            <div>
                                <div class="text-[15px] font-bold text-gray-900 leading-tight">Dewi Sartika</div>
                                <div class="text-xs text-primary-600 font-semibold mt-0.5">Manajer Restoran, Saung Selera Sunda</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-0.5 text-amber-400 text-xs mb-3">
                            <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                        </div>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            "Grafik Peak Hours (Jam Sibuk) di halaman Reports sangat membantu! Kami bisa melihat jam-jam operasional teramai dengan jelas, sehingga penjadwalan shift kerja staf dapur dan kasir jadi jauh lebih efisien dan tepat sasaran."
                        </p>
                    </div>
                </div>

                <!-- Card 5 -->
                <div class="w-[280px] sm:w-[390px] shrink-0 bg-white rounded-2xl border border-gray-200 p-5 sm:p-7 shadow-xs hover:border-primary-400 transition-all flex flex-col justify-between text-left whitespace-normal min-h-[200px] sm:min-h-[220px]">
                    <div>
                        <div class="flex items-center gap-3.5 mb-3">
                            <div class="w-10 h-10 rounded-xl bg-orange-100 text-primary-700 flex items-center justify-center font-bold text-base shrink-0">
                                K
                            </div>
                            <div>
                                <div class="text-[15px] font-bold text-gray-900 leading-tight">Kevin Aditya</div>
                                <div class="text-xs text-primary-600 font-semibold mt-0.5">Founder, Urban Bites Cafe & Dessert</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-0.5 text-amber-400 text-xs mb-3">
                            <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                        </div>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            "Fitur SIPEMMA AI Assistant di dalam aplikasi sangat inovatif! Kami bisa tanya langsung omzet harian, menu paling laku, dan saran promo kuliner. Tampilan Dark Mode-nya juga sangat nyaman untuk mata kasir yang bertugas di shift malam."
                        </p>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Content Section with Refined Editorial Presentation -->
    <section id="tentang" class="scroll-mt-24 py-16 sm:py-20 bg-gray-50/70 border-t border-gray-200/70 overflow-hidden">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8" data-aos="fade-up">
            <div class="bg-white rounded-2xl p-5 sm:p-10 border border-gray-200 shadow-2xs">
                <h3 class="text-lg sm:text-2xl font-extrabold text-gray-900 mb-4 sm:mb-6 text-left tracking-tight">
                    Tentang Aplikasi Kasir SIPEMMA
                </h3>
                
                <div id="aboutContent" class="text-sm sm:text-base text-gray-600 text-left leading-relaxed space-y-4 line-clamp-3 transition-all duration-500">
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
                
                <button id="readMoreBtn" onclick="toggleReadMore()" class="mt-6 text-sm text-primary-600 font-extrabold hover:text-primary-700 focus:outline-none flex items-center justify-start gap-1.5 transition-colors">
                    <span>Baca selengkapnya</span> 
                    <svg id="readMoreIcon" class="w-4 h-4 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
            </div>
        </div>
    </section>

    <!-- FAQ Section (Side-by-Side Editorial Split) -->
    <section id="faq" class="scroll-mt-24 py-16 sm:py-24 lg:py-32 bg-white border-t border-gray-200/70 overflow-hidden">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-12 gap-8 lg:gap-16 items-start">
                <!-- Left Title Column -->
                <div class="lg:col-span-4" data-aos="fade-right">
                    <div class="lg:sticky lg:top-28">
                        <div class="inline-block text-xs font-extrabold uppercase tracking-wider text-primary-600 bg-orange-100/70 px-3 py-1 rounded-md mb-3">
                            Pusat Informasi
                        </div>
                        <h2 class="text-3xl sm:text-5xl font-black text-gray-900 tracking-tight mb-3 sm:mb-4">
                            FAQ
                        </h2>
                        <p class="text-xs sm:text-base text-gray-600 leading-relaxed">
                            Pertanyaan umum seputar fitur kasir, integrasi pembayaran otomatis, dan cara pendaftaran SIPEMMA.
                        </p>
                    </div>
                </div>

                <!-- Right Accordion List -->
                <div class="lg:col-span-8 space-y-3 sm:space-y-4" data-aos="fade-left">
                    <!-- FAQ Item 1 -->
                    <div class="faq-item bg-gray-50/80 border border-gray-200/80 rounded-2xl overflow-hidden transition-all">
                        <button class="faq-button w-full flex items-center justify-between p-4 sm:p-6 text-left text-gray-900 font-bold text-sm sm:text-lg hover:text-primary-600 transition-colors focus:outline-none">
                            <span>Apa itu SIPEMMA?</span>
                            <span class="faq-icon shrink-0 ml-3 sm:ml-4 w-7 h-7 sm:w-8 sm:h-8 rounded-full bg-white border border-gray-200 flex items-center justify-center text-gray-500 transition-transform duration-300">
                                <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                            </span>
                        </button>
                        <div class="faq-content max-h-0 opacity-0 transition-all duration-300 ease-in-out">
                            <p class="px-4 pb-4 sm:px-6 sm:pb-6 leading-relaxed text-gray-600 text-xs sm:text-base">
                                SIPEMMA adalah aplikasi kasir (POS) cloud terpadu untuk bisnis F&B, retail, dan jasa guna mengelola transaksi, stok inventaris, serta laporan keuangan secara otomatis.
                            </p>
                        </div>
                    </div>
                    
                    <!-- FAQ Item 2 -->
                    <div class="faq-item bg-gray-50/80 border border-gray-200/80 rounded-2xl overflow-hidden transition-all">
                        <button class="faq-button w-full flex items-center justify-between p-4 sm:p-6 text-left text-gray-900 font-bold text-sm sm:text-lg hover:text-primary-600 transition-colors focus:outline-none">
                            <span>Bagaimana cara menggunakan aplikasi kasir/POS dari SIPEMMA?</span>
                            <span class="faq-icon shrink-0 ml-3 sm:ml-4 w-7 h-7 sm:w-8 sm:h-8 rounded-full bg-white border border-gray-200 flex items-center justify-center text-gray-500 transition-transform duration-300">
                                <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                            </span>
                        </button>
                        <div class="faq-content max-h-0 opacity-0 transition-all duration-300 ease-in-out">
                            <p class="px-4 pb-4 sm:px-6 sm:pb-6 leading-relaxed text-gray-600 text-xs sm:text-base">
                                Cukup daftar akun, tambahkan daftar menu atau produk, lalu Anda siap memproses transaksi langsung dari tablet, smartphone, maupun komputer.
                            </p>
                        </div>
                    </div>
                    
                    <!-- FAQ Item 3 -->
                    <div class="faq-item bg-gray-50/80 border border-gray-200/80 rounded-2xl overflow-hidden transition-all">
                        <button class="faq-button w-full flex items-center justify-between p-4 sm:p-6 text-left text-gray-900 font-bold text-sm sm:text-lg hover:text-primary-600 transition-colors focus:outline-none">
                            <span>Berapa biaya berlangganan SIPEMMA?</span>
                            <span class="faq-icon shrink-0 ml-3 sm:ml-4 w-7 h-7 sm:w-8 sm:h-8 rounded-full bg-white border border-gray-200 flex items-center justify-center text-gray-500 transition-transform duration-300">
                                <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                            </span>
                        </button>
                        <div class="faq-content max-h-0 opacity-0 transition-all duration-300 ease-in-out">
                            <p class="px-4 pb-4 sm:px-6 sm:pb-6 leading-relaxed text-gray-600 text-xs sm:text-base">
                                Tersedia paket fleksibel sesuai skala bisnis Anda, mulai dari paket pemula hingga enterprise multi-cabang. Hubungi tim kami untuk konsultasi paket terbaik.
                            </p>
                        </div>
                    </div>
                    
                    <!-- FAQ Item 4 -->
                    <div class="faq-item bg-gray-50/80 border border-gray-200/80 rounded-2xl overflow-hidden transition-all">
                        <button class="faq-button w-full flex items-center justify-between p-4 sm:p-6 text-left text-gray-900 font-bold text-sm sm:text-lg hover:text-primary-600 transition-colors focus:outline-none">
                            <span>Bagaimana cara mendaftar SIPEMMA?</span>
                            <span class="faq-icon shrink-0 ml-3 sm:ml-4 w-7 h-7 sm:w-8 sm:h-8 rounded-full bg-white border border-gray-200 flex items-center justify-center text-gray-500 transition-transform duration-300">
                                <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                            </span>
                        </button>
                        <div class="faq-content max-h-0 opacity-0 transition-all duration-300 ease-in-out">
                            <p class="px-4 pb-4 sm:px-6 sm:pb-6 leading-relaxed text-gray-600 text-xs sm:text-base">
                                Klik tombol "Jadwalkan Demo" atau "Coba gratis" di halaman ini, lengkapi formulir pendaftaran singkat, dan tim kami akan segera membantu Anda mengaktifkan akun.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer (Architectural Dark Slate Finish) -->
    <footer id="kontak" class="scroll-mt-24 bg-[#0F172A] pt-14 sm:pt-20 pb-10 sm:pb-12 border-t border-slate-800 text-slate-400 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-8 mb-12 sm:mb-16">
                <div class="col-span-2 sm:col-span-3 md:col-span-4 lg:col-span-2">
                    <img src="{{ asset('assets/img/LOGO.png') }}" alt="SIPEMMA Logo" class="h-10 sm:h-14 mb-4 sm:mb-6 object-contain filter brightness-0 invert">
                    <div class="flex gap-3 mb-2 lg:mb-0">
                        <a href="#" class="w-9 h-9 rounded-xl bg-slate-800/80 flex items-center justify-center text-gray-400 hover:text-white hover:bg-slate-700 transition-all">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"/></svg>
                        </a>
                        <a href="#" class="w-9 h-9 rounded-xl bg-slate-800/80 flex items-center justify-center text-gray-400 hover:text-white hover:bg-slate-700 transition-all">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd"/></svg>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h4 class="font-bold text-white mb-3 sm:mb-4 text-xs sm:text-sm uppercase tracking-wider">Produk</h4>
                    <ul class="space-y-2 sm:space-y-2.5 text-xs sm:text-sm text-slate-400">
                        <li><a href="#" class="hover:text-primary-400 transition-colors">Point of Sale (POS)</a></li>
                        <li><a href="#" class="hover:text-primary-400 transition-colors">Manajemen Stok</a></li>
                        <li><a href="#" class="hover:text-primary-400 transition-colors">Laporan Penjualan</a></li>
                        <li><a href="#" class="hover:text-primary-400 transition-colors">AI Assistant</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-bold text-white mb-3 sm:mb-4 text-xs sm:text-sm uppercase tracking-wider">Perusahaan</h4>
                    <ul class="space-y-2 sm:space-y-2.5 text-xs sm:text-sm text-slate-400">
                        <li><a href="#" class="hover:text-primary-400 transition-colors">Tentang Kami</a></li>
                        <li><a href="#" class="hover:text-primary-400 transition-colors">Karir</a></li>
                        <li><a href="#" class="hover:text-primary-400 transition-colors">Hubungi Kami</a></li>
                        <li><a href="#" class="hover:text-primary-400 transition-colors">Mitra</a></li>
                    </ul>
                </div>
                
                <div class="col-span-2 sm:col-span-1">
                    <h4 class="font-bold text-white mb-3 sm:mb-4 text-xs sm:text-sm uppercase tracking-wider">Bantuan</h4>
                    <ul class="space-y-2 sm:space-y-2.5 text-xs sm:text-sm text-slate-400">
                        <li><a href="#" class="hover:text-primary-400 transition-colors">Pusat Bantuan</a></li>
                        <li><a href="#" class="hover:text-primary-400 transition-colors">Syarat &amp; Ketentuan</a></li>
                        <li><a href="#" class="hover:text-primary-400 transition-colors">Kebijakan Privasi</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-slate-800/80 pt-6 sm:pt-8 flex flex-col sm:flex-row justify-between items-center gap-4 text-center sm:text-left">
                <p class="text-xs sm:text-sm text-slate-500">
                    &copy; {{ date('Y') }} PT SIPEMMA Teknologi Indonesia. Hak Cipta Dilindungi.
                </p>
                <div class="flex items-center gap-4 text-xs sm:text-sm text-slate-500 font-medium">
                    <span class="text-slate-300">ID</span>
                    <span class="w-1 h-1 bg-slate-700 rounded-full"></span>
                    <a href="#" class="hover:text-slate-300 transition-colors">EN</a>
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
            duration: 700,
            easing: 'ease-out-cubic',
        });

        // Hero Typewriter Logic
        const heroContents = [
            'Laporan Keuangan<br>Real-Time &<br>Otomatis',
            'Satu Aplikasi POS<br>untuk Semua<br>Kebutuhan Bisnis',
            'Kelola Inventaris<br>Lebih Mudah<br>& Akurat'
        ];
        let heroIndex = 0;
        const heroTitle = document.getElementById('heroTitle');

        if (heroTitle) {
            setInterval(() => {
                heroTitle.classList.add('opacity-0', 'translate-y-2');
                heroTitle.classList.add('transition-all', 'duration-500');
                
                setTimeout(() => {
                    heroIndex = (heroIndex + 1) % heroContents.length;
                    heroTitle.innerHTML = heroContents[heroIndex];
                    heroTitle.classList.remove('opacity-0', 'translate-y-2');
                }, 500);
            }, 4500);
        }

        // Mobile Menu Toggle
        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            const icon = document.getElementById('navMobileIcon');
            if (menu) {
                const isClosed = menu.classList.contains('hidden');
                menu.classList.toggle('hidden');
                if (icon) {
                    if (isClosed) {
                        icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>';
                    } else {
                        icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>';
                    }
                }
            }
        }

        // Read More Toggle Logic
        function toggleReadMore() {
            const content = document.getElementById('aboutContent');
            const btn = document.getElementById('readMoreBtn');
            const icon = document.getElementById('readMoreIcon');

            if (content.classList.contains('line-clamp-3')) {
                content.classList.remove('line-clamp-3');
                btn.querySelector('span').innerText = 'Tutup sebagian';
                icon.classList.add('rotate-180');
            } else {
                content.classList.add('line-clamp-3');
                btn.querySelector('span').innerText = 'Baca selengkapnya';
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
            if (preloader) {
                setTimeout(() => {
                    preloader.style.opacity = '0';
                    setTimeout(() => {
                        preloader.style.display = 'none';
                    }, 700);
                }, 400);
            }
        });
    </script>
</body>
</html>
