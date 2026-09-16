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
    <!-- Google Fonts: Plus Jakarta Sans & Inter for crystal-clear typography on all screens & zoom levels -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300..800;1,300..800&family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Global Typography Overrides -->
    <link rel="stylesheet" href="{{ asset('css/sf-pro.css') }}">
    
    <!-- CSS Custom -->
    <style>
        html {
            overflow-x: hidden;
            scroll-behavior: smooth;
        }
        body {
            font-family: 'Plus Jakarta Sans', 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif !important;
            -webkit-font-smoothing: auto;
            -moz-osx-font-smoothing: auto;
            text-rendering: auto;
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
        /* 3D Testimonial Coverflow Carousel */
        .testimonial-3d-card {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 390px;
            max-width: calc(100vw - 44px);
            transition: transform 0.65s cubic-bezier(0.25, 1, 0.5, 1), opacity 0.65s cubic-bezier(0.25, 1, 0.5, 1), box-shadow 0.65s cubic-bezier(0.25, 1, 0.5, 1), filter 0.65s cubic-bezier(0.25, 1, 0.5, 1);
            transform-origin: center center;
            will-change: transform, opacity;
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

        /* 3D Micro-Widget Floating Animations */
        @keyframes floatWidgetA {
            0%, 100% {
                transform: translateY(0px) rotate(2deg);
            }
            50% {
                transform: translateY(-8px) rotate(2deg);
            }
        }
        @keyframes floatWidgetB {
            0%, 100% {
                transform: translateY(0px) rotate(2.5deg);
            }
            50% {
                transform: translateY(7px) rotate(2.5deg);
            }
        }
        @keyframes floatWidgetC {
            0%, 100% {
                transform: translateY(0px) rotate(-1.5deg);
            }
            50% {
                transform: translateY(-7px) rotate(-1.5deg);
            }
        }
        @keyframes floatWidgetD {
            0%, 100% {
                transform: translateY(0px) rotate(1.5deg);
            }
            50% {
                transform: translateY(6px) rotate(1.5deg);
            }
        }
        .float-widget-1 {
            animation: floatWidgetA 5s ease-in-out infinite;
            will-change: transform;
        }
        .float-widget-2 {
            animation: floatWidgetB 5.8s ease-in-out infinite 0.7s;
            will-change: transform;
        }
        .float-widget-3 {
            animation: floatWidgetC 5.2s ease-in-out infinite 1.4s;
            will-change: transform;
        }
        .float-widget-4 {
            animation: floatWidgetD 6s ease-in-out infinite 0.4s;
            will-change: transform;
        }

        /* Looping Progress Slider for Kopi Susu */
        @keyframes progressLoop {
            0% {
                width: 0%;
                opacity: 1;
            }
            65% {
                width: 100%;
                opacity: 1;
            }
            85% {
                width: 100%;
                opacity: 1;
            }
            94% {
                width: 100%;
                opacity: 0;
            }
            96% {
                width: 0%;
                opacity: 0;
            }
            100% {
                width: 0%;
                opacity: 1;
            }
        }
        .animate-progress-loop {
            animation: progressLoop 3s cubic-bezier(0.4, 0, 0.2, 1) infinite;
            will-change: width, opacity;
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
                        sans: ['"Plus Jakarta Sans"', '"Inter"', '-apple-system', 'BlinkMacSystemFont', '"Segoe UI"', 'Roboto', 'Helvetica', 'Arial', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-white text-gray-800 subpixel-antialiased overflow-x-hidden">

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
                <nav class="hidden lg:flex items-center gap-6 xl:gap-8 text-[15px] sm:text-base font-semibold text-gray-700" id="navLinks">
                    <a href="#fitur" class="hover:text-primary-600 transition-colors py-1">Fitur</a>
                    <a href="#keunggulan" class="hover:text-primary-600 transition-colors py-1">Keunggulan</a>
                    <a href="#tentang" class="hover:text-primary-600 transition-colors py-1">Tentang Kami</a>
                    <a href="#testimoni" class="hover:text-primary-600 transition-colors py-1">Testimoni</a>
                    <a href="#faq" class="hover:text-primary-600 transition-colors py-1">FAQ</a>
                    <a href="#kontak" class="hover:text-primary-600 transition-colors py-1">Kontak</a>
                </nav>

                <div class="hidden lg:flex items-center gap-4">
                    <a href="{{ route('login') }}" class="text-[15px] sm:text-base font-bold text-gray-900 hover:text-primary-600 transition-colors px-3 py-2" id="navLogin">Log in</a>
                    <a href="{{ route('register') }}" class="inline-flex items-center gap-2 bg-primary-600 hover:bg-primary-700 text-white text-[15px] sm:text-base font-bold py-2.5 px-6 rounded-full transition-all shadow-sm hover:shadow-md" id="navRegister">
                        <span>Daftar Sekarang</span>
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
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
                <nav class="flex flex-col gap-4 text-base sm:text-lg font-semibold text-gray-800">
                    <a href="#fitur" onclick="toggleMobileMenu()" class="hover:text-primary-600 py-1 transition-colors">Fitur</a>
                    <a href="#keunggulan" onclick="toggleMobileMenu()" class="hover:text-primary-600 py-1 transition-colors">Keunggulan</a>
                    <a href="#tentang" onclick="toggleMobileMenu()" class="hover:text-primary-600 py-1 transition-colors">Tentang Kami</a>
                    <a href="#testimoni" onclick="toggleMobileMenu()" class="hover:text-primary-600 py-1 transition-colors">Testimoni</a>
                    <a href="#faq" onclick="toggleMobileMenu()" class="hover:text-primary-600 py-1 transition-colors">FAQ</a>
                    <a href="#kontak" onclick="toggleMobileMenu()" class="hover:text-primary-600 py-1 transition-colors">Kontak</a>
                    <div class="pt-4 border-t border-gray-100 flex flex-col gap-3">
                        <a href="{{ route('login') }}" class="text-center font-bold text-gray-900 py-2.5 rounded-full border border-gray-200 hover:border-primary-600 hover:text-primary-600 transition-colors text-base">Log in</a>
                        <a href="{{ route('register') }}" class="text-center font-bold text-white bg-primary-600 hover:bg-primary-700 py-2.5 rounded-full shadow-sm transition-all text-base">Daftar Sekarang</a>
                    </div>
                </nav>
            </div>
        </div>
    </header>

    <!-- Hero Section (Rich Orange Grid + Translucent Frame + Upgraded Curved Bottom Divider) -->
    <section class="relative bg-primary-600 pt-24 sm:pt-36 pb-28 sm:pb-40 lg:pt-40 lg:pb-44 overflow-hidden">
        <!-- Architectural Grid Overlay -->
        <div class="absolute inset-0 bg-grid-hero pointer-events-none opacity-40"></div>
        <div class="absolute inset-y-0 right-0 w-1/2 bg-gradient-to-l from-primary-700/30 to-transparent pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                <!-- Left Content (col-span-5 on LG for ample visual room) -->
                <div class="lg:col-span-5 text-white pt-4 lg:pt-0">
                    <div class="inline-flex max-w-full items-center gap-1.5 sm:gap-2 px-3 sm:px-4 py-1.5 rounded-lg bg-white/15 border border-white/25 text-white text-[11px] sm:text-sm font-bold uppercase tracking-wider mb-5 sm:mb-6 backdrop-blur-xs">
                        <span class="whitespace-normal">Sistem POS &amp; Manajemen Restoran Terpadu</span>
                    </div>

                    <div class="min-h-[110px] sm:min-h-[160px] lg:min-h-[190px] flex flex-col justify-center">
                        <h1 id="heroTitle" class="text-3xl sm:text-5xl lg:text-[54px] font-extrabold leading-[1.22] sm:leading-[1.16] tracking-[-0.01em] text-white mb-4 sm:mb-6">
                            Laporan Keuangan<br>Real-Time &amp;<br>Otomatis
                        </h1>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 sm:gap-4 mt-6 sm:mt-8">
                        <a href="{{ route('register') }}" class="group inline-flex items-center justify-center gap-2.5 sm:gap-3 bg-white hover:bg-orange-50 text-primary-600 text-sm sm:text-base font-bold py-3 sm:py-3.5 px-6 sm:px-8 rounded-full shadow-lg hover:shadow-xl transition-all text-center">
                            <span>Jadwalkan Demo</span>
                            <svg class="w-4 h-4 text-primary-600 group-hover:translate-x-1 transition-transform shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                        <a href="#fitur" class="inline-flex items-center justify-center bg-white/15 hover:bg-white/25 border border-white/30 text-white text-sm sm:text-base font-bold py-3 sm:py-3.5 px-6 sm:px-8 rounded-full backdrop-blur-xs transition-all text-center">
                            <span>Chat WhatsApp</span>
                        </a>
                    </div>
                </div>

                <!-- Right Visual: 3-Layered Interactive Showcase (Authentic SIPEMMA Brand & Zero Cutoff) -->
                <div class="lg:col-span-7 flex justify-center lg:justify-end items-center relative mt-8 lg:mt-0">
                    <!-- Spaced Wrapper matching exact reference size -->
                    <div class="relative w-full max-w-[490px] sm:max-w-[560px] lg:max-w-[580px] mx-auto py-8 sm:py-10 px-2 sm:px-4 select-none">
                        
                        <!-- Floating Card 3: Contextual Detail / Top Item (Soft Directional Shadow) -->
                        <div id="heroTopItemCard" class="absolute top-2.5 sm:top-4 -right-4 sm:-right-8 lg:-right-10 z-30 w-[155px] sm:w-[185px] bg-white rounded-2xl sm:rounded-3xl shadow-[0_15px_30px_-6px_rgba(0,0,0,0.22)] border border-gray-100 p-2.5 sm:p-3 transition-all duration-300 transform hover:scale-105">
                            <div class="flex items-center justify-between">
                                <div id="heroTopItemIconBg" class="w-6 h-6 sm:w-7 sm:h-7 rounded-lg bg-orange-50 text-primary-600 flex items-center justify-center font-bold text-xs border border-orange-200/70 shadow-2xs">
                                    <span id="heroTopItemIcon">
                                        <svg class="w-3.5 h-3.5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 8h1a4 4 0 010 8h-1M2 8h16v9a4 4 0 01-4 4H6a4 4 0 01-4-4V8zM6 1v3M10 1v3M14 1v3"/>
                                        </svg>
                                    </span>
                                </div>
                                <span id="heroTopItemBadge" class="px-2 py-0.5 rounded-full bg-orange-50 text-primary-700 text-[9.5px] font-extrabold flex items-center gap-1 border border-primary-200/70">
                                    <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                                    <span id="heroTopItemBadgeText">#1</span>
                                </span>
                            </div>

                            <div class="mt-2 text-left">
                                <span id="heroTopItemSubtitle" class="text-[8.5px] sm:text-[9.5px] font-bold text-gray-400 uppercase tracking-wider block">Menu Terfavorit</span>
                                <h4 id="heroTopItemTitle" class="text-xs sm:text-[13.5px] font-extrabold text-gray-900 tracking-tight leading-tight mt-0.5">Kopi Susu (47)</h4>
                                <div id="heroTopItemPrice" class="text-[9.5px] sm:text-[11px] font-extrabold text-primary-600 mt-0.5">Rp 25.000 / cup</div>
                            </div>

                            <!-- Sparkline Chart (SIPEMMA Orange Gradient & Stroke) -->
                            <div class="mt-1.5 pt-1 border-t border-gray-100">
                                <svg class="w-full h-5 sm:h-6 overflow-visible" viewBox="0 0 100 28" preserveAspectRatio="none">
                                    <defs>
                                        <linearGradient id="heroSparkGrad" x1="0" y1="0" x2="0" y2="1">
                                            <stop offset="0%" stop-color="#ea580c" stop-opacity="0.35"/>
                                            <stop offset="100%" stop-color="#ea580c" stop-opacity="0.0"/>
                                        </linearGradient>
                                    </defs>
                                    <path id="heroSparklineArea" d="M0,24 Q20,22 35,16 T70,10 T100,5 L100,28 L0,28 Z" fill="url(#heroSparkGrad)" />
                                    <path id="heroSparklineLine" d="M0,24 Q20,22 35,16 T70,10 T100,5" fill="none" stroke="#ea580c" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex items-center justify-between text-[7.5px] sm:text-[8.5px] text-gray-400 mt-0.5">
                                    <span id="heroTopItemMeta">47 Terjual Hari Ini</span>
                                    <span id="heroTopItemTrend" class="text-primary-600 font-bold">+24.5%</span>
                                </div>
                            </div>
                        </div>

                        <!-- Card 1: Central Physical Tablet POS Mockup (Soft Directional Elevation Shadow) -->
                        <div class="relative z-20 rounded-3xl sm:rounded-[2.2rem] bg-[#0b0f19] p-2 sm:p-2.5 shadow-[0_24px_48px_-10px_rgba(0,0,0,0.35)] border border-slate-800/80 transition-transform duration-500 hover:scale-[1.01]">
                            <!-- Inner Chassis: bg-[#0f172a] prevents any white artifact from peeking through -->
                            <div class="rounded-2xl sm:rounded-[1.6rem] bg-[#0f172a] overflow-hidden flex flex-col text-gray-800">
                                <!-- Tablet App Topbar (Dark Slate seamless with chassis corners) -->
                                <div class="bg-[#0f172a] px-3 sm:px-4 py-2 sm:py-2.5 flex items-center justify-between text-white border-b border-slate-800">
                                    <div class="flex items-center gap-2 sm:gap-3">
                                        <!-- SIPEMMA POS Brand -->
                                        <div class="flex items-center gap-1.5">
                                            <span class="font-black text-xs sm:text-sm tracking-wide text-white">SIPEMMA</span>
                                            <span class="text-[9px] font-black px-1.5 py-0.5 rounded bg-primary-600 text-white uppercase tracking-wider">POS</span>
                                        </div>

                                        <!-- Nav Icons -->
                                        <div class="flex items-center gap-1 sm:gap-1.5 text-white/70 ml-1">
                                            <div class="w-5.5 h-5.5 rounded-md bg-primary-600 text-white flex items-center justify-center shadow-xs">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                                            </div>
                                            <div class="w-5.5 h-5.5 rounded-md hover:bg-white/10 flex items-center justify-center">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                            </div>
                                            <div class="w-5.5 h-5.5 rounded-md hover:bg-white/10 flex items-center justify-center">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                                            </div>
                                            <div class="w-5.5 h-5.5 rounded-md hover:bg-white/10 flex items-center justify-center">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-right leading-none">
                                        <span class="font-bold text-[9.5px] sm:text-[11px] block text-white">SIPEMMA Resto</span>
                                        <span class="text-[7.5px] sm:text-[8.5px] text-emerald-400 font-semibold">● Kasir 01 • Online</span>
                                    </div>
                                </div>

                                <!-- Category Bar (Authentic SIPEMMA POS) -->
                                <div class="bg-slate-100/90 px-3 py-1.5 flex items-center justify-between border-b border-slate-200/70">
                                    <div class="flex items-center gap-1 sm:gap-1.5 text-[8px] sm:text-[9px] font-bold">
                                        <span class="bg-primary-600 text-white px-2 py-0.5 rounded-md shadow-2xs">Semua</span>
                                        <span class="text-slate-600 px-2 py-0.5 rounded-md">Makanan</span>
                                        <span class="text-slate-600 px-2 py-0.5 rounded-md">Minuman</span>
                                        <span class="text-slate-500 px-2 py-0.5 rounded-md hidden sm:inline">Camilan</span>
                                    </div>
                                    <span class="text-[7.5px] sm:text-[8.5px] text-slate-500 font-medium">6 Menu Tersedia</span>
                                </div>

                                <!-- Tablet App Body (Left Menu Grid + Right Order Cart) -->
                                <div class="p-2 sm:p-2.5 bg-[#f8fafc] grid grid-cols-12 gap-2 text-left rounded-b-2xl sm:rounded-b-[1.6rem]">
                                    <!-- Left: Menu Items Grid (col-span-7) with Profit Placed on Row 1 (Never Cut Off!) -->
                                    <div class="col-span-7 grid grid-cols-3 gap-1.5 sm:gap-2">
                                        <!-- Item 1 (Row 1): Kopi Susu -->
                                        <div class="interactive-tablet-item group cursor-pointer bg-white rounded-xl p-1 sm:p-1.5 border border-gray-200 shadow-2xs hover:shadow-sm hover:border-primary-500 transition-all duration-200 ring-2 ring-primary-500 bg-orange-50/50"
                                             data-id="kopi-susu"
                                             data-title="Kopi Susu (47)"
                                             data-price="Rp 25.000 / cup"
                                             data-subtitle="Menu Terfavorit"
                                             data-badge="#1"
                                             data-icon="coffee"
                                             data-meta="47 Terjual Hari Ini"
                                             data-trend="+24.5%"
                                             data-spark-line="M0,24 Q20,22 35,16 T70,10 T100,5"
                                             data-spark-area="M0,24 Q20,22 35,16 T70,10 T100,5 L100,28 L0,28 Z">
                                            <div class="h-12 sm:h-15 w-full rounded-lg overflow-hidden bg-gray-100 mb-1">
                                                <img src="https://images.unsplash.com/photo-1517701550927-30cf4ba1dba5?auto=format&fit=crop&q=80&w=260" alt="Kopi Susu" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                            </div>
                                            <div class="text-[8.5px] sm:text-[10px] font-bold text-gray-900 truncate leading-tight">Kopi Susu</div>
                                            <div class="text-[7.5px] sm:text-[9px] font-extrabold text-primary-600">Rp 25K</div>
                                        </div>

                                        <!-- Item 2 (Row 1): Beef Bowl -->
                                        <div class="interactive-tablet-item group cursor-pointer bg-white rounded-xl p-1 sm:p-1.5 border border-gray-200 shadow-2xs hover:shadow-sm hover:border-primary-500 transition-all duration-200"
                                             data-id="beef-bowl"
                                             data-title="Beef Bowl (28)"
                                             data-price="Rp 39.000 / porsi"
                                             data-subtitle="Menu Spesial"
                                             data-badge="#2"
                                             data-icon="beef-bowl"
                                             data-meta="Omzet Rp 1.092.000"
                                             data-trend="+16.2%"
                                             data-spark-line="M0,20 Q25,18 45,14 T75,9 T100,6"
                                             data-spark-area="M0,20 Q25,18 45,14 T75,9 T100,6 L100,28 L0,28 Z">
                                            <div class="h-12 sm:h-15 w-full rounded-lg overflow-hidden bg-gray-100 mb-1">
                                                <img src="{{ asset('assets/img/beef-bowl.jpg') }}" alt="Beef Bowl" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                            </div>
                                            <div class="text-[8.5px] sm:text-[10px] font-bold text-gray-900 truncate leading-tight">Beef Bowl</div>
                                            <div class="text-[7.5px] sm:text-[9px] font-extrabold text-primary-600">Rp 39K</div>
                                        </div>

                                        <!-- Item 3 (Row 1): PROFIT / LABA BERSIH - Placed in Row 1 to NEVER be cut off! -->
                                        <div class="interactive-tablet-item group cursor-pointer bg-gradient-to-br from-primary-600 to-orange-700 text-white rounded-xl p-1 sm:p-1.5 border border-orange-400/50 shadow-2xs hover:shadow-sm transition-all duration-200 flex flex-col justify-between"
                                             data-id="profit"
                                             data-title="Laba Bersih (+28.4%)"
                                             data-price="Keuntungan Rp 2.450.000"
                                             data-subtitle="Laporan Finansial"
                                             data-badge="Live"
                                             data-icon="profit"
                                             data-meta="Margin Laba 68.2%"
                                             data-trend="+28.4%"
                                             data-spark-line="M0,26 Q15,24 35,16 T70,8 T100,2"
                                             data-spark-area="M0,26 Q15,24 35,16 T70,8 T100,2 L100,28 L0,28 Z">
                                            <div class="flex items-center justify-between">
                                                <span class="text-[7.5px] sm:text-[8.5px] font-black uppercase tracking-wider text-orange-100">PROFIT</span>
                                                <span class="w-1.5 h-1.5 rounded-full bg-white animate-ping"></span>
                                            </div>
                                            <div class="my-auto py-0.5">
                                                <div class="text-[9.5px] sm:text-[11px] font-black tracking-tight leading-tight">+28.4%</div>
                                                <div class="text-[7px] sm:text-[7.5px] text-orange-100 font-medium">Real-time</div>
                                            </div>
                                            <div class="text-[7px] sm:text-[8px] font-bold bg-white/20 px-1 py-0.5 rounded text-center">Rp 2.45M</div>
                                        </div>

                                        <!-- Item 4 (Row 2): Mie Ayam -->
                                        <div class="interactive-tablet-item group cursor-pointer bg-white rounded-xl p-1 sm:p-1.5 border border-gray-200 shadow-2xs hover:shadow-sm hover:border-primary-500 transition-all duration-200"
                                             data-id="mie-ayam"
                                             data-title="Mie Ayam Spesial (32)"
                                             data-price="Rp 35.000 / porsi"
                                             data-subtitle="Favorit Siang"
                                             data-badge="#3"
                                             data-icon="mie-ayam"
                                             data-meta="Omzet Rp 1.120.000"
                                             data-trend="+19.8%"
                                             data-spark-line="M0,22 Q30,19 50,12 T80,8 T100,4"
                                             data-spark-area="M0,22 Q30,19 50,12 T80,8 T100,4 L100,28 L0,28 Z">
                                            <div class="h-12 sm:h-15 w-full rounded-lg overflow-hidden bg-gray-100 mb-1">
                                                <img src="{{ asset('assets/img/MIE AYAM.jpeg') }}" alt="Mie Ayam" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                            </div>
                                            <div class="text-[8.5px] sm:text-[10px] font-bold text-gray-900 truncate leading-tight">Mie Ayam</div>
                                            <div class="text-[7.5px] sm:text-[9px] font-extrabold text-primary-600">Rp 35K</div>
                                        </div>

                                        <!-- Item 5 (Row 2): Nasi Goreng -->
                                        <div class="interactive-tablet-item group cursor-pointer bg-white rounded-xl p-1 sm:p-1.5 border border-gray-200 shadow-2xs hover:shadow-sm hover:border-primary-500 transition-all duration-200"
                                             data-id="nasi-goreng"
                                             data-title="Nasi Goreng Ayam (38)"
                                             data-price="Rp 28.000 / porsi"
                                             data-subtitle="Terlaris Malam"
                                             data-badge="Promo"
                                             data-icon="nasi-goreng"
                                             data-meta="Omzet Rp 1.064.000"
                                             data-trend="+21.0%"
                                             data-spark-line="M0,25 Q20,20 40,15 T75,9 T100,4"
                                             data-spark-area="M0,25 Q20,20 40,15 T75,9 T100,4 L100,28 L0,28 Z">
                                            <div class="h-12 sm:h-15 w-full rounded-lg overflow-hidden bg-gray-100 mb-1">
                                                <img src="{{ asset('assets/img/NASI GORENG AYAM.jpg') }}" alt="Nasi Goreng" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                            </div>
                                            <div class="text-[8.5px] sm:text-[10px] font-bold text-gray-900 truncate leading-tight">Nasi Goreng</div>
                                            <div class="text-[7.5px] sm:text-[9px] font-extrabold text-primary-600">Rp 28K</div>
                                        </div>

                                        <!-- Item 6 (Row 2): Es Jeruk -->
                                        <div class="interactive-tablet-item group cursor-pointer bg-white rounded-xl p-1 sm:p-1.5 border border-gray-200 shadow-2xs hover:shadow-sm hover:border-primary-500 transition-all duration-200"
                                             data-id="es-jeruk"
                                             data-title="Es Jeruk Segar (41)"
                                             data-price="Rp 15.000 / cup"
                                             data-subtitle="Minuman Segar"
                                             data-badge="Laris"
                                             data-icon="es-jeruk"
                                             data-meta="Omzet Rp 615.000"
                                             data-trend="+14.3%"
                                             data-spark-line="M0,18 Q30,16 55,10 T85,6 T100,3"
                                             data-spark-area="M0,18 Q30,16 55,10 T85,6 T100,3 L100,28 L0,28 Z">
                                            <div class="h-12 sm:h-15 w-full rounded-lg overflow-hidden bg-gray-100 mb-1">
                                                <img src="{{ asset('assets/img/ES JERUK.jpg') }}" alt="Es Jeruk" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                            </div>
                                            <div class="text-[8.5px] sm:text-[10px] font-bold text-gray-900 truncate leading-tight">Es Jeruk</div>
                                            <div class="text-[7.5px] sm:text-[9px] font-extrabold text-primary-600">Rp 15K</div>
                                        </div>
                                    </div>

                                    <!-- Right: Order Panel "Pesanan #101" (col-span-5, Fully Visible & Never Obstructed) -->
                                    <div class="col-span-5 bg-white rounded-xl p-2.5 sm:p-3 border border-gray-200 shadow-2xs flex flex-col justify-between text-left">
                                        <div>
                                            <div class="flex items-center justify-between border-b border-gray-100 pb-1.5 mb-2">
                                                <span class="font-extrabold text-[10px] sm:text-xs text-gray-900">Pesanan #101</span>
                                                <span class="text-[7.5px] font-bold px-1.5 py-0.5 rounded bg-orange-100 text-primary-700">Dine In</span>
                                            </div>

                                            <div class="space-y-1.5 text-[8px] sm:text-[9px]">
                                                <div class="flex items-center justify-between py-0.5 border-b border-gray-50">
                                                    <span class="text-gray-700"><strong class="text-gray-900">2x</strong> Kopi Susu</span>
                                                    <span class="font-bold text-gray-900">50K</span>
                                                </div>
                                                <div class="flex items-center justify-between py-0.5 border-b border-gray-50">
                                                    <span class="text-gray-700 truncate max-w-[90px] sm:max-w-[110px]"><strong class="text-gray-900">1x</strong> Croissant</span>
                                                    <span class="font-bold text-gray-900">20K</span>
                                                </div>
                                                <div class="flex items-center justify-between py-0.5">
                                                    <span class="text-gray-700 truncate max-w-[90px] sm:max-w-[110px]"><strong class="text-gray-900">1x</strong> Beef Bowl</span>
                                                    <span class="font-bold text-gray-900">39K</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="pt-2 border-t border-gray-100 mt-2">
                                             <div class="flex justify-between text-[7.5px] sm:text-[8.5px] text-gray-500 mb-0.5">
                                                 <span>Subtotal</span>
                                                 <span class="font-bold text-gray-800">109K</span>
                                             </div>
                                             <div class="flex justify-between text-[7.5px] sm:text-[8.5px] text-gray-500 mb-2">
                                                 <span>Pajak PB1 10%</span>
                                                 <span class="font-bold text-gray-800">11K</span>
                                             </div>
                                             <!-- SIPEMMA Orange Bayar Button -->
                                             <button type="button" class="w-full py-1.5 sm:py-2 rounded-xl bg-primary-600 hover:bg-primary-700 text-white font-extrabold text-[9px] sm:text-xs text-center shadow-xs transition-colors cursor-pointer">
                                                 Bayar 120K
                                             </button>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>

                        <!-- Floating Card 2: AI Assistant Widget (Soft Directional Shadow - Shifted Slightly Downwards) -->
                        <div class="absolute -bottom-6 sm:-bottom-8 lg:-bottom-9 -left-3 sm:-left-6 lg:-left-8 z-30 w-[190px] sm:w-[225px] h-[175px] sm:h-[190px] bg-white rounded-2xl sm:rounded-3xl shadow-[0_15px_30px_-6px_rgba(0,0,0,0.22)] border border-slate-200/90 overflow-hidden flex flex-col justify-between select-none">
                            <!-- AI Header (Clean Minimalist Vector Icon - No Glowing Shadow on Logo) -->
                            <div class="h-[40px] sm:h-[44px] bg-[#0f172a] px-3 sm:px-3.5 flex items-center justify-between text-white border-b border-slate-800 shrink-0">
                                <div class="flex items-center gap-2">
                                    <!-- Modern Minimalist AI Logo (Clean Translucent Squircle, No Glowing Shadow) -->
                                    <div class="w-6 h-6 sm:w-6.5 sm:h-6.5 rounded-lg bg-white/10 border border-white/20 flex items-center justify-center text-primary-400 shrink-0">
                                        <!-- Minimalist AI Sparkle Glyph (Apple Intelligence / Modern AI) -->
                                        <svg class="w-3.5 h-3.5 text-primary-400" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 2C12 7.52 7.52 12 2 12C7.52 12 12 16.48 12 22C12 16.48 16.48 12 22 12C16.48 12 12 7.52 12 2Z"/>
                                        </svg>
                                    </div>

                                    <div class="leading-none text-left">
                                        <div class="font-black text-[10px] sm:text-[11.5px] text-white tracking-wide flex items-center gap-1">
                                            SIPEMMA <span class="text-[8px] sm:text-[9px] font-black px-1.5 py-0.5 rounded bg-white/15 text-primary-300">AI</span>
                                        </div>
                                        <div class="flex items-center gap-1 mt-0.5 text-[7.5px] text-emerald-400 font-medium">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span> Online
                                        </div>
                                    </div>
                                </div>
                                <span class="text-[7.5px] sm:text-[8px] font-bold px-2 py-0.5 rounded-full bg-white/10 text-primary-300 border border-white/10 backdrop-blur-xs">Live Assist</span>
                            </div>

                            <!-- Chat Messages Area (Fixed Locked Height, No Layout Shifts) -->
                            <div class="flex-1 px-2.5 py-2 bg-slate-50/70 flex flex-col justify-between overflow-hidden text-left">
                                <!-- User Question Bubble (SIPEMMA Orange Gradient & Soft Shadow) -->
                                <div class="flex justify-end shrink-0">
                                    <div id="heroAiUserMsg" class="bg-gradient-to-r from-primary-600 to-orange-600 text-white px-2.5 py-1 rounded-2xl rounded-tr-none text-[8.5px] sm:text-[9.5px] font-semibold shadow-xs shadow-primary-950/20 max-w-[92%] leading-snug">
                                        Berapa omzet hari ini?
                                    </div>
                                </div>

                                <!-- AI Assistant Response Area (Fixed Slot for Typing Indicator & Answer) -->
                                <div class="flex justify-start items-end min-h-[44px] sm:min-h-[50px]">
                                    <!-- Typing Indicator -->
                                    <div id="heroAiTypingIndicator" class="bg-white px-2.5 py-1.5 rounded-2xl rounded-tl-none flex items-center gap-1 shadow-xs border border-slate-200/80 h-[26px]">
                                        <span class="w-1.5 h-1.5 rounded-full bg-primary-600 animate-bounce"></span>
                                        <span class="w-1.5 h-1.5 rounded-full bg-primary-600 animate-bounce [animation-delay:0.18s]"></span>
                                        <span class="w-1.5 h-1.5 rounded-full bg-primary-600 animate-bounce [animation-delay:0.36s]"></span>
                                    </div>

                                    <!-- Actual AI Answer Text (Zero Emojis, Crisp Typography, Subtle Shadow) -->
                                    <div id="heroAiAnswerBubble" class="hidden bg-white text-slate-800 px-2.5 py-1.5 rounded-2xl rounded-tl-none text-[8px] sm:text-[9px] font-medium leading-relaxed shadow-xs border border-slate-200/80">
                                        Omzet live Rp 2.850.000 (+18% vs kemarin) dengan laba bersih Rp 1.420.000.
                                    </div>
                                </div>
                            </div>

                            <!-- Input Bar Dummy (Pixel-Perfect Alignment & Precise Send Button) -->
                            <div class="h-[36px] sm:h-[38px] px-2 py-1 border-t border-gray-100 bg-white flex items-center gap-1.5 shrink-0">
                                <div class="flex-1 h-6 sm:h-7 bg-slate-100/90 border border-slate-200/80 rounded-full px-2.5 flex items-center text-[8px] sm:text-[9px] text-gray-400 text-left truncate shadow-2xs">
                                    Tanya AI...
                                </div>
                                <div class="w-6 h-6 sm:w-7 sm:h-7 rounded-full bg-primary-600 hover:bg-primary-700 text-white flex items-center justify-center shrink-0 shadow-xs transition-colors cursor-pointer">
                                    <svg class="w-3 h-3 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M22 2L11 13"></path>
                                        <path d="M22 2L15 22L11 13L2 9L22 2Z"></path>
                                    </svg>
                                </div>
                            </div>
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

    <!-- Permasalahan Owner F&B Section (Adapted from Reference to SIPEMMA Theme) -->
    <section class="py-16 sm:py-24 lg:py-28 bg-[#FAF8F5] overflow-hidden relative border-b border-gray-200/70">
        <!-- Giant Stylized Question Mark Watermark on Right (Matching Reference) -->
        <div class="absolute -right-4 sm:right-4 lg:right-10 top-1/2 -translate-y-1/2 select-none pointer-events-none text-orange-500/10 text-[200px] sm:text-[320px] lg:text-[420px] font-black leading-none z-0">
            ?
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid lg:grid-cols-12 gap-10 lg:gap-14 items-center">
                <!-- Left Column: Stressed Owner Photo matching Reference -->
                <div class="lg:col-span-5" data-aos="fade-right">
                    <div class="relative max-w-md mx-auto lg:max-w-none">
                        <div class="relative rounded-[2rem] sm:rounded-[2.5rem] overflow-hidden border border-gray-200/90 shadow-[0_20px_50px_rgba(0,0,0,0.08)] bg-white p-2">
                            <img src="{{ asset('assets/img/stressed-owner.jpg') }}" alt="Owner F&B Pusing Laporan Rekap Manual" class="w-full h-auto object-cover rounded-[1.6rem] sm:rounded-[2.1rem] shadow-inner select-none pointer-events-none">
                        </div>
                    </div>
                </div>

                <!-- Right Column: Heading + 2x2 Problem Cards + Bottom Callout Bar -->
                <div class="lg:col-span-7" data-aos="fade-left">
                    <div class="max-w-2xl">
                        <!-- Section Heading matching reference typography with SIPEMMA Orange Pill -->
                        <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-gray-900 tracking-[-0.01em] leading-[1.24] sm:leading-[1.2] mb-8 sm:mb-10 text-left">
                            Masalah yang<br>
                            <span class="inline-block bg-primary-600 text-white px-4 py-1 sm:px-5 sm:py-1.5 rounded-2xl shadow-md -rotate-1 mr-2 align-middle">Diam-Diam</span> Paling<br>
                            Sering Dirasakan<br>
                            Owner F&B
                        </h2>

                        <!-- 2x2 Problem Cards Grid -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-5 mb-6">
                            <!-- Card 01: Stok Habis -->
                            <div class="bg-white rounded-2xl p-5 sm:p-6 border border-gray-200/85 shadow-xs hover:shadow-md hover:border-orange-300 transition-all duration-300 text-left group">
                                <div class="flex items-center justify-between mb-3">
                                    <span class="text-2xl sm:text-3xl font-black text-gray-300 group-hover:text-primary-600 transition-colors">01</span>
                                    <div class="w-10 h-10 rounded-full bg-orange-50 border border-orange-200/70 flex items-center justify-center text-primary-600 group-hover:scale-105 transition-transform shadow-2xs">
                                        <!-- Calculation / Sheet Icon -->
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                </div>
                                <p class="text-sm sm:text-[14.5px] font-semibold text-gray-800 leading-snug">
                                    Tau stok habis pas customer mau order, padahal di catatan masih ada.
                                </p>
                            </div>

                            <!-- Card 02: Uang Laci Selisih -->
                            <div class="bg-white rounded-2xl p-5 sm:p-6 border border-gray-200/85 shadow-xs hover:shadow-md hover:border-orange-300 transition-all duration-300 text-left group">
                                <div class="flex items-center justify-between mb-3">
                                    <span class="text-2xl sm:text-3xl font-black text-gray-300 group-hover:text-primary-600 transition-colors">02</span>
                                    <div class="w-10 h-10 rounded-full bg-orange-50 border border-orange-200/70 flex items-center justify-center text-primary-600 group-hover:scale-105 transition-transform shadow-2xs">
                                        <!-- Cash Drawer / Box Icon -->
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                                        </svg>
                                    </div>
                                </div>
                                <p class="text-sm sm:text-[14.5px] font-semibold text-gray-800 leading-snug">
                                    Uang di laci ada, tapi nggak sinkron sama laporan penjualan.
                                </p>
                            </div>

                            <!-- Card 03: Data Pelanggan Diabaikan -->
                            <div class="bg-white rounded-2xl p-5 sm:p-6 border border-gray-200/85 shadow-xs hover:shadow-md hover:border-orange-300 transition-all duration-300 text-left group">
                                <div class="flex items-center justify-between mb-3">
                                    <span class="text-2xl sm:text-3xl font-black text-gray-300 group-hover:text-primary-600 transition-colors">03</span>
                                    <div class="w-10 h-10 rounded-full bg-orange-50 border border-orange-200/70 flex items-center justify-center text-primary-600 group-hover:scale-105 transition-transform shadow-2xs">
                                        <!-- Wallet / Customer Loyalty Icon -->
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                        </svg>
                                    </div>
                                </div>
                                <p class="text-sm sm:text-[14.5px] font-semibold text-gray-800 leading-snug">
                                    Capek cari pelanggan baru tiap hari, data lama diabaikan.
                                </p>
                            </div>

                            <!-- Card 04: Keputusan Pakai Feeling -->
                            <div class="bg-white rounded-2xl p-5 sm:p-6 border border-gray-200/85 shadow-xs hover:shadow-md hover:border-orange-300 transition-all duration-300 text-left group">
                                <div class="flex items-center justify-between mb-3">
                                    <span class="text-2xl sm:text-3xl font-black text-gray-300 group-hover:text-primary-600 transition-colors">04</span>
                                    <div class="w-10 h-10 rounded-full bg-orange-50 border border-orange-200/70 flex items-center justify-center text-primary-600 group-hover:scale-105 transition-transform shadow-2xs">
                                        <!-- Brain / Idea / Decision Icon -->
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                                        </svg>
                                    </div>
                                </div>
                                <p class="text-sm sm:text-[14.5px] font-semibold text-gray-800 leading-snug">
                                    Data bisnis numpuk, tapi tetap ambil keputusan pakai feeling.
                                </p>
                            </div>
                        </div>

                        <!-- Summary Callout Bar (Clean straight accent line, zero curve artifacts) -->
                        <div class="p-4 sm:p-4.5 rounded-xl bg-white border border-gray-200/80 text-left flex items-center gap-3.5 shadow-2xs">
                            <div class="w-1 h-8 sm:h-7 rounded-full bg-primary-600 shrink-0"></div>
                            <p class="text-xs sm:text-[13.5px] text-gray-600 leading-relaxed font-normal">
                                Masalah-masalah ini sering dianggap wajar, padahal jika dibiarkan terus, membuat bisnis sulit berkembang dan owner cepat lelah.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Feature Chapter 1: Point of Sale Experience (Core Foundation) -->
    <section id="fitur" class="scroll-mt-24 py-16 sm:py-24 lg:py-32 bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-12 gap-8 lg:gap-16 items-center">
                <div class="lg:col-span-6" data-aos="fade-right">
                    <div class="max-w-xl">
                        <div class="inline-block text-xs font-extrabold uppercase tracking-wider text-primary-600 bg-orange-100/70 px-3 py-1 rounded-md mb-3 sm:mb-4">
                            Solusi Kasir & Kas Terpadu
                        </div>
                        <h2 class="text-2xl sm:text-4xl lg:text-5xl font-extrabold text-gray-900 mb-4 sm:mb-6 leading-[1.22] sm:leading-[1.18] tracking-[-0.01em]">
                            Uang Kasir &amp; Laporan Sinkron Real-Time
                        </h2>
                        <p class="text-sm sm:text-base lg:text-lg text-gray-600 mb-6 sm:mb-8 leading-relaxed">
                            Tak ada lagi uang laci selisih atau nota kertas hilang. Catat pesanan dalam 3 detik, terima QRIS & tunai, dan cetak struk otomatis langsung sinkron dengan pembukuan kasir.
                        </p>

                        <button type="button" onclick="openFeatureModal('pos')" class="group inline-flex items-center gap-2.5 sm:gap-3 text-primary-600 font-extrabold text-sm sm:text-base hover:text-primary-700 transition-colors cursor-pointer">
                            <span>Pelajari Fitur Kasir</span>
                            <span class="w-7 h-7 rounded-full bg-primary-100 flex items-center justify-center text-primary-600 group-hover:translate-x-1 transition-transform shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            </span>
                        </button>
                    </div>
                </div>

                <div class="lg:col-span-6 mt-6 lg:mt-0" data-aos="fade-left">
                    <div class="p-2.5 sm:p-3 rounded-2xl sm:rounded-3xl bg-white border border-gray-200 shadow-xl">
                        <div class="rounded-xl sm:rounded-2xl overflow-hidden">
                            <img src="{{ asset('assets/img/pos-cashier.jpg') }}" alt="Sistem Kasir POS Tablet & Struk Kasir Otomatis SIPEMMA" class="w-full object-cover select-none pointer-events-none hover:scale-102 transition-transform duration-700">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Feature Chapter 2: Real-time Restaurant Operations -->
    <section class="py-16 sm:py-24 lg:py-32 bg-[#F8F9FA] border-y border-gray-200/70 overflow-hidden bg-grid-subtle">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-12 gap-8 lg:gap-16 items-center">
                <!-- Visual Container (Hardware & Dashboard double-bezel) -->
                <div class="lg:col-span-6 order-2 lg:order-1 mt-6 lg:mt-0" data-aos="fade-right">
                    <div class="relative p-2.5 sm:p-3 rounded-2xl sm:rounded-3xl bg-gray-50 border border-gray-200/90 shadow-lg">
                        <div class="rounded-xl sm:rounded-2xl overflow-hidden shadow-inner">
                            <img src="{{ asset('assets/img/kitchen-stock.jpg') }}" alt="Manajemen Stok Bahan & Dapur Restoran SIPEMMA" class="w-full object-cover select-none pointer-events-none hover:scale-102 transition-transform duration-700">
                        </div>
                    </div>
                </div>
                
                <!-- Content Column -->
                <div class="lg:col-span-6 order-1 lg:order-2" data-aos="fade-left">
                    <div class="max-w-xl">
                        <div class="inline-block text-xs font-extrabold uppercase tracking-wider text-primary-600 bg-orange-100/70 px-3 py-1 rounded-md mb-3 sm:mb-4">
                            Solusi Stok & Pelanggan
                        </div>
                        <h2 class="text-2xl sm:text-4xl lg:text-5xl font-extrabold text-gray-900 mb-4 sm:mb-6 leading-[1.22] sm:leading-[1.18] tracking-[-0.01em]">
                            Peringatan Bahan &amp; Data Pelanggan
                        </h2>
                        <p class="text-sm sm:text-base lg:text-lg text-gray-600 mb-6 sm:mb-8 leading-relaxed font-normal">
                            Cegah customer kecewa karena stok habis mendadak, serta manfaatkan database pelanggan lama untuk mendorong pesanan berulang.
                        </p>

                        <!-- Structured Feature List -->
                        <div class="space-y-4 sm:space-y-6 mb-8">
                            <div class="flex gap-3 sm:gap-4 items-start p-3.5 sm:p-4 rounded-xl sm:rounded-2xl bg-orange-50/40 border border-orange-100/80">
                                <div class="w-1.5 h-8 sm:h-10 rounded-full bg-primary-600 shrink-0 mt-0.5 sm:mt-0"></div>
                                <div>
                                    <h3 class="text-sm sm:text-lg font-bold text-gray-900 leading-snug">
                                        Peringatan stok menipis otomatis sebelum bahan habis di jam ramai resto.
                                    </h3>
                                </div>
                            </div>

                            <div class="flex gap-3 sm:gap-4 items-start p-3.5 sm:p-4 rounded-xl sm:rounded-2xl bg-gray-50 border border-gray-100">
                                <div class="w-1.5 h-8 sm:h-10 rounded-full bg-gray-400 shrink-0 mt-0.5 sm:mt-0"></div>
                                <div>
                                    <h3 class="text-sm sm:text-lg font-bold text-gray-900 leading-snug">
                                        Database pelanggan & riwayat transaksi tersimpan rapi untuk promo loyalitas.
                                    </h3>
                                </div>
                            </div>

                            <div class="flex gap-3 sm:gap-4 items-start p-3.5 sm:p-4 rounded-xl sm:rounded-2xl bg-gray-50 border border-gray-100">
                                <div class="w-1.5 h-8 sm:h-10 rounded-full bg-primary-500 shrink-0 mt-0.5 sm:mt-0"></div>
                                <div>
                                    <h3 class="text-sm sm:text-lg font-bold text-gray-900 leading-snug">
                                        Pesanan meja dine-in & takeaway terintegrasi langsung ke printer dapur.
                                    </h3>
                                </div>
                            </div>
                        </div>

                        <button type="button" onclick="openFeatureModal('stock')" class="group inline-flex items-center gap-2.5 sm:gap-3 text-primary-600 font-extrabold text-sm sm:text-base hover:text-primary-700 transition-colors cursor-pointer">
                            <span>Pelajari Fitur Stok & Dapur</span>
                            <span class="w-7 h-7 rounded-full bg-primary-100 flex items-center justify-center text-primary-600 group-hover:translate-x-1 transition-transform shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            </span>
                        </button>
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
                            <img src="{{ asset('assets/img/business-analytics.jpg') }}" alt="Laporan Penjualan & Analitik AI SIPEMMA" class="w-full object-cover select-none pointer-events-none hover:scale-102 transition-transform duration-700">
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-6 order-1 lg:order-2" data-aos="fade-left">
                    <div class="max-w-xl">
                        <div class="inline-block text-xs font-extrabold uppercase tracking-wider text-primary-600 bg-orange-100/70 px-3 py-1 rounded-md mb-3 sm:mb-4">
                            Solusi Analitik Bisnis
                        </div>
                        <h2 class="text-2xl sm:text-4xl lg:text-5xl font-extrabold text-gray-900 mb-4 sm:mb-6 leading-[1.22] sm:leading-[1.18] tracking-[-0.01em]">
                            Ambil Keputusan dari Data, Bukan Feeling
                        </h2>
                        <p class="text-sm sm:text-base lg:text-lg text-gray-600 mb-6 sm:mb-8 leading-relaxed">
                            Tinggalkan tebak-tebakan. Laporan omzet harian, margin laba bersih tiap menu, dan analitik cerdas AI Assistant tersaji otomatis kapan pun dibutuhkan dari smartphone Anda.
                        </p>

                        <button type="button" onclick="openFeatureModal('analytics')" class="group inline-flex items-center gap-2.5 sm:gap-3 text-primary-600 font-extrabold text-sm sm:text-base hover:text-primary-700 focus:outline-none transition-colors cursor-pointer">
                            <span>Lihat Selengkapnya</span>
                            <span class="w-7 h-7 rounded-full bg-primary-100 flex items-center justify-center text-primary-600 group-hover:translate-x-1 transition-transform shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Apa Yang Berubah Section (Before vs After / Dulu vs Sekarang - Aligned with SIPEMMA System) -->
    <section class="relative bg-[#FAF8F5] border-y border-gray-200/70 py-16 sm:py-20 lg:py-24 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header: Clean SIPEMMA Typography & Tone -->
            <div class="text-center max-w-3xl mx-auto mb-12 sm:mb-16" data-aos="fade-up">
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-gray-900 tracking-[-0.01em] leading-[1.28] sm:leading-[1.24]">
                    Apa yang<br class="hidden sm:inline">
                    <span class="inline-block bg-primary-600 text-white px-4 py-1 sm:px-5 sm:py-1.5 rounded-2xl shadow-md -rotate-1 mx-2 align-middle">Berubah</span>
                    Setelah<br>
                    Menggunakan SIPEMMA
                </h2>
                <p class="text-sm sm:text-base text-gray-600 mt-3 sm:mt-4 max-w-xl mx-auto">
                    Transformasi nyata operasional restoran Anda dari cara manual yang lambat menjadi serba otomatis dan terkendali.
                </p>
            </div>

            <!-- 2x2 Grid Transformation Cards (Exact Reference Layout + Animated Floating Widgets) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8 max-w-5xl mx-auto">
                <!-- Card 1: Omzet & COGS / Kasir -->
                <div class="bg-white rounded-[2.2rem] sm:rounded-[2.5rem] p-6 sm:p-8 lg:p-10 border border-gray-200/85 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col justify-between group" data-aos="fade-up" data-aos-delay="0">
                    <!-- Floating Micro-Widget with Gentle Continuous Float -->
                    <div class="h-36 sm:h-44 flex items-center justify-center mb-4 sm:mb-6">
                        <div class="float-widget-1 bg-white rounded-2xl p-4 sm:p-4.5 shadow-[0_12px_28px_-6px_rgba(0,0,0,0.12)] border border-gray-100/90 flex items-center gap-3.5 min-w-[210px] sm:min-w-[230px] group-hover:scale-105 transition-transform duration-300">
                            <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-xl bg-orange-50 border border-orange-100 flex items-center justify-center text-primary-600 shrink-0 shadow-xs">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </div>
                            <div class="text-left">
                                <span class="text-[11px] font-bold text-gray-500 uppercase tracking-wider block">Total Transaksi</span>
                                <span class="text-base sm:text-lg font-black text-gray-900 tracking-tight">Rp 3.420.000</span>
                            </div>
                        </div>
                    </div>

                    <!-- Comparison Boxes -->
                    <div class="space-y-3">
                        <!-- Dulu -->
                        <div class="bg-[#FFF5F5] border border-[#FED7D7] rounded-2xl p-4 text-left flex items-start gap-3">
                            <svg class="w-4 h-4 text-rose-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            <div class="text-xs sm:text-[13px] leading-relaxed text-gray-700">
                                <strong class="font-extrabold text-rose-600 mr-1">Dulu:</strong><span>Kasir lambat dan sering antre panjang, nota kertas mudah hilang, dan rawan salah hitung pesanan meja.</span>
                            </div>
                        </div>

                        <!-- Sekarang -->
                        <div class="bg-[#F4F7F5] border border-[#DCE5E0] rounded-2xl p-4 text-left flex items-start gap-3">
                            <svg class="w-4 h-4 text-emerald-700 shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="9"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4"/>
                            </svg>
                            <div class="text-xs sm:text-[13px] leading-relaxed text-gray-700">
                                <strong class="font-extrabold text-emerald-800 mr-1">Sekarang:</strong><span>Input pesanan cuma 3 detik, cetak struk bluetooth otomatis, dan transaksi sinkron real-time ke dapur.</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Top Menu & Cash Flow -->
                <div class="bg-white rounded-[2.2rem] sm:rounded-[2.5rem] p-6 sm:p-8 lg:p-10 border border-gray-200/85 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col justify-between group" data-aos="fade-up" data-aos-delay="100">
                    <!-- Floating Micro-Widget with Gentle Continuous Float -->
                    <div class="h-36 sm:h-44 flex items-center justify-center mb-4 sm:mb-6">
                        <div class="float-widget-2 bg-white rounded-2xl p-4 sm:p-4.5 shadow-[0_12px_28px_-6px_rgba(0,0,0,0.12)] border border-gray-100/90 text-left min-w-[210px] sm:min-w-[240px] group-hover:scale-105 transition-transform duration-300">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-xs font-bold text-gray-900">Top Menu</span>
                                <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                                </svg>
                            </div>
                            <div class="flex items-center justify-between text-xs font-bold mb-2">
                                <span class="text-gray-700">Kopi Susu</span>
                                <span class="text-primary-600 font-extrabold pr-1">45% Margin</span>
                            </div>
                            <div class="w-full h-1.5 bg-gray-100 rounded-full overflow-hidden relative">
                                <div class="h-full bg-gradient-to-r from-primary-600 to-orange-500 rounded-full animate-progress-loop"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Comparison Boxes -->
                    <div class="space-y-3">
                        <!-- Dulu -->
                        <div class="bg-[#FFF5F5] border border-[#FED7D7] rounded-2xl p-4 text-left flex items-start gap-3">
                            <svg class="w-4 h-4 text-rose-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            <div class="text-xs sm:text-[13px] leading-relaxed text-gray-700">
                                <strong class="font-extrabold text-rose-600 mr-1">Dulu:</strong><span>Ribet input pengeluaran manual, nota kertas pesanan meja sering hilang, dan laporan keuangan sering selisih.</span>
                            </div>
                        </div>

                        <!-- Sekarang -->
                        <div class="bg-[#F4F7F5] border border-[#DCE5E0] rounded-2xl p-4 text-left flex items-start gap-3">
                            <svg class="w-4 h-4 text-emerald-700 shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="9"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4"/>
                            </svg>
                            <div class="text-xs sm:text-[13px] leading-relaxed text-gray-700">
                                <strong class="font-extrabold text-emerald-800 mr-1">Sekarang:</strong><span>Menu terlaris, persentase margin laba, dan grafik penjualan harian langsung terkalkulasi otomatis.</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 3: Stock Alert & Recipe Management -->
                <div class="bg-white rounded-[2.2rem] sm:rounded-[2.5rem] p-6 sm:p-8 lg:p-10 border border-gray-200/85 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col justify-between group" data-aos="fade-up" data-aos-delay="200">
                    <!-- Floating Micro-Widget with Gentle Continuous Float -->
                    <div class="h-36 sm:h-44 flex items-center justify-center mb-4 sm:mb-6">
                        <div class="float-widget-3 bg-white rounded-2xl p-3.5 sm:p-4 shadow-[0_12px_28px_-6px_rgba(0,0,0,0.12)] border border-gray-100/90 text-left min-w-[210px] sm:min-w-[230px] group-hover:scale-105 transition-transform duration-300">
                            <div class="flex items-center gap-2.5 mb-2">
                                <span class="w-2.5 h-2.5 rounded-full bg-amber-500 animate-pulse"></span>
                                <span class="text-xs font-bold text-gray-800 pr-1">Peringatan Bahan</span>
                            </div>
                            <div class="bg-amber-50/70 border border-amber-200/70 rounded-xl p-2.5 flex items-center justify-between">
                                <span class="text-xs font-semibold text-gray-700">Sirup Karamel</span>
                                <span class="text-xs font-extrabold text-amber-700 bg-amber-100/80 px-2 py-0.5 rounded-md">Sisa 2 Btl</span>
                            </div>
                        </div>
                    </div>

                    <!-- Comparison Boxes -->
                    <div class="space-y-3">
                        <!-- Dulu -->
                        <div class="bg-[#FFF5F5] border border-[#FED7D7] rounded-2xl p-4 text-left flex items-start gap-3">
                            <svg class="w-4 h-4 text-rose-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            <div class="text-xs sm:text-[13px] leading-relaxed text-gray-700">
                                <strong class="font-extrabold text-rose-600 mr-1">Dulu:</strong><span>Stok bahan habis mendadak saat jam ramai resto, pembeli kecewa pesanan batal, dan stok opname manual makan waktu.</span>
                            </div>
                        </div>

                        <!-- Sekarang -->
                        <div class="bg-[#F4F7F5] border border-[#DCE5E0] rounded-2xl p-4 text-left flex items-start gap-3">
                            <svg class="w-4 h-4 text-emerald-700 shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="9"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4"/>
                            </svg>
                            <div class="text-xs sm:text-[13px] leading-relaxed text-gray-700">
                                <strong class="font-extrabold text-emerald-800 mr-1">Sekarang:</strong><span>Bahan baku berkurang otomatis tiap pesanan terjual, dilengkapi sistem peringatan dini sebelum bahan habis.</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 4: Financial Reports & Multi-Outlet -->
                <div class="bg-white rounded-[2.2rem] sm:rounded-[2.5rem] p-6 sm:p-8 lg:p-10 border border-gray-200/85 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col justify-between group" data-aos="fade-up" data-aos-delay="300">
                    <!-- Floating Micro-Widget with Gentle Continuous Float -->
                    <div class="h-36 sm:h-44 flex items-center justify-center mb-4 sm:mb-6">
                        <div class="float-widget-4 bg-white rounded-2xl p-4 sm:p-4.5 shadow-[0_12px_28px_-6px_rgba(0,0,0,0.12)] border border-gray-100/90 text-left min-w-[210px] sm:min-w-[230px] group-hover:scale-105 transition-transform duration-300">
                            <div class="flex items-center justify-between mb-1.5">
                                <span class="text-xs font-bold text-gray-500 pr-1">Laporan Laba Harian</span>
                                <span class="text-xs font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-100">+28.4%</span>
                            </div>
                            <div class="text-lg sm:text-xl font-black text-gray-900 tracking-tight mb-1.5">Rp 12.850.000</div>
                            <div class="text-[11px] font-semibold text-gray-500">Otomatis sinkron dari semua meja</div>
                        </div>
                    </div>

                    <!-- Comparison Boxes -->
                    <div class="space-y-3">
                        <!-- Dulu -->
                        <div class="bg-[#FFF5F5] border border-[#FED7D7] rounded-2xl p-4 text-left flex items-start gap-3">
                            <svg class="w-4 h-4 text-rose-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            <div class="text-xs sm:text-[13px] leading-relaxed text-gray-700">
                                <strong class="font-extrabold text-rose-600 mr-1">Dulu:</strong><span>Tiap tutup toko pusing rekap nota fisik sampai larut malam, hitung laba bersih manual, dan rentan kecurangan kasir.</span>
                            </div>
                        </div>

                        <!-- Sekarang -->
                        <div class="bg-[#F4F7F5] border border-[#DCE5E0] rounded-2xl p-4 text-left flex items-start gap-3">
                            <svg class="w-4 h-4 text-emerald-700 shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="9"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4"/>
                            </svg>
                            <div class="text-xs sm:text-[13px] leading-relaxed text-gray-700">
                                <strong class="font-extrabold text-emerald-800 mr-1">Sekarang:</strong><span>Laporan omzet, margin laba, dan evaluasi performa penjualan cabang toko tersaji otomatis dan real-time.</span>
                            </div>
                        </div>
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
                <h2 class="text-2xl sm:text-4xl lg:text-5xl font-extrabold text-gray-900 tracking-[-0.01em] mb-3 sm:mb-4">
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

    <!-- Impact Stats & Testimonials Section -->
    <section id="testimoni" class="scroll-mt-24 py-16 sm:py-24 lg:py-32 bg-white border-t border-gray-100 relative bg-dots overflow-hidden">
        <!-- Section Header -->
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center mb-10 sm:mb-16" data-aos="fade-up">
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-md bg-white border border-gray-200 text-primary-700 text-xs sm:text-sm font-bold uppercase tracking-wider mb-3 sm:mb-4 shadow-2xs">
                <svg class="w-4 h-4 text-primary-600" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                Ulasan &amp; Dampak Nyata
            </div>
            <h2 class="text-2xl sm:text-4xl lg:text-5xl font-extrabold text-gray-900 tracking-[-0.01em] mb-3 sm:mb-4">
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

        <!-- Testimonials 3D Carousel Header -->
        <div class="mb-8 sm:mb-12 text-center" data-aos="fade-up">
            <h3 class="text-2xl sm:text-4xl lg:text-5xl font-black text-gray-900 tracking-[-0.01em] leading-tight">
                Dipercaya oleh Ratusan <br class="sm:hidden"><span class="text-primary-600">Pengusaha F&B</span>
            </h3>
            <p class="text-xs sm:text-base text-gray-500 mt-2 font-normal max-w-xl mx-auto">
                Cerita nyata dari barista, manajer operasional, dan pemilik bisnis kuliner yang tumbuh bersama SIPEMMA.
            </p>
        </div>

        <!-- 3D Testimonial Stage -->
        <div class="relative w-full max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div id="testimonial3DContainer" class="relative w-full h-[380px] sm:h-[420px] flex items-center justify-center select-none overflow-hidden sm:overflow-visible py-4" style="perspective: 1200px; transform-style: preserve-3d;">
                
                <!-- Card 0: Fahmul Ihsan -->
                <div class="testimonial-3d-card p-6 sm:p-8 rounded-[28px] sm:rounded-[34px] bg-white border border-gray-100/90 shadow-sm flex flex-col justify-between min-h-[290px] sm:min-h-[310px]" data-index="0">
                    <div>
                        <div class="flex items-center justify-between mb-4 sm:mb-5">
                            <div class="flex items-center gap-1 text-primary-500">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 fill-primary-500" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 fill-primary-500" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 fill-primary-500" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 fill-primary-500" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 fill-primary-500" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            </div>
                            <span class="text-3xl sm:text-4xl font-serif text-primary-200/80 leading-none select-none">”</span>
                        </div>
                        <p class="text-sm sm:text-[15px] font-bold text-gray-800 leading-relaxed mb-6">
                            “Awalnya ragu ganti sistem, tapi SIPEMMA ternyata intuitif banget. Staf saya cepat paham cara pakainya.”
                        </p>
                    </div>
                    <div class="flex items-center gap-3.5 pt-4 border-t border-gray-100">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150&auto=format&fit=crop&q=80" 
                             alt="Fahmul Ihsan" 
                             class="w-11 h-11 sm:w-12 sm:h-12 rounded-full object-cover ring-2 ring-primary-500/20 shadow-xs shrink-0"
                             onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name=Fahmul+Ihsan&background=ea580c&color=fff';">
                        <div class="min-w-0">
                            <div class="text-sm sm:text-[15px] font-bold text-gray-900 truncate">Fahmul Ihsan</div>
                            <div class="text-xs text-primary-600 font-semibold truncate">Kopi Tempat Kerja</div>
                        </div>
                    </div>
                </div>

                <!-- Card 1: Lusiana (Active Center by Default) -->
                <div class="testimonial-3d-card p-6 sm:p-8 rounded-[28px] sm:rounded-[34px] bg-white border border-gray-100/90 shadow-sm flex flex-col justify-between min-h-[290px] sm:min-h-[310px]" data-index="1">
                    <div>
                        <div class="flex items-center justify-between mb-4 sm:mb-5">
                            <div class="flex items-center gap-1 text-primary-500">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 fill-primary-500" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 fill-primary-500" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 fill-primary-500" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 fill-primary-500" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 fill-primary-500" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            </div>
                            <span class="text-3xl sm:text-4xl font-serif text-primary-200/80 leading-none select-none">”</span>
                        </div>
                        <p class="text-sm sm:text-[15px] font-bold text-gray-800 leading-relaxed mb-6">
                            “Fitur follow-up WhatsApp-nya juara! Pelanggan lama yang sudah sebulan nggak datang jadi balik lagi.”
                        </p>
                    </div>
                    <div class="flex items-center gap-3.5 pt-4 border-t border-gray-100">
                        <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=150&auto=format&fit=crop&q=80" 
                             alt="Lusiana" 
                             class="w-11 h-11 sm:w-12 sm:h-12 rounded-full object-cover ring-2 ring-primary-500/20 shadow-xs shrink-0"
                             onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name=Lusiana&background=ea580c&color=fff';">
                        <div class="min-w-0">
                            <div class="text-sm sm:text-[15px] font-bold text-gray-900 truncate">Lusiana</div>
                            <div class="text-xs text-primary-600 font-semibold truncate">Padi Saka Gallery</div>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Meydi -->
                <div class="testimonial-3d-card p-6 sm:p-8 rounded-[28px] sm:rounded-[34px] bg-white border border-gray-100/90 shadow-sm flex flex-col justify-between min-h-[290px] sm:min-h-[310px]" data-index="2">
                    <div>
                        <div class="flex items-center justify-between mb-4 sm:mb-5">
                            <div class="flex items-center gap-1 text-primary-500">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 fill-primary-500" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 fill-primary-500" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 fill-primary-500" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 fill-primary-500" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 fill-primary-500" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            </div>
                            <span class="text-3xl sm:text-4xl font-serif text-primary-200/80 leading-none select-none">”</span>
                        </div>
                        <p class="text-sm sm:text-[15px] font-bold text-gray-800 leading-relaxed mb-6">
                            “Sekarang saya lebih tenang karena tahu kondisi usaha setiap hari, bukan cuma lihat omzet.”
                        </p>
                    </div>
                    <div class="flex items-center gap-3.5 pt-4 border-t border-gray-100">
                        <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=150&auto=format&fit=crop&q=80" 
                             alt="Meydi" 
                             class="w-11 h-11 sm:w-12 sm:h-12 rounded-full object-cover ring-2 ring-primary-500/20 shadow-xs shrink-0"
                             onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name=Meydi&background=ea580c&color=fff';">
                        <div class="min-w-0">
                            <div class="text-sm sm:text-[15px] font-bold text-gray-900 truncate">Meydi</div>
                            <div class="text-xs text-primary-600 font-semibold truncate">Warkorame</div>
                        </div>
                    </div>
                </div>

                <!-- Card 3: Mayla Fazza -->
                <div class="testimonial-3d-card p-6 sm:p-8 rounded-[28px] sm:rounded-[34px] bg-white border border-gray-100/90 shadow-sm flex flex-col justify-between min-h-[290px] sm:min-h-[310px]" data-index="3">
                    <div>
                        <div class="flex items-center justify-between mb-4 sm:mb-5">
                            <div class="flex items-center gap-1 text-primary-500">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 fill-primary-500" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 fill-primary-500" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 fill-primary-500" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 fill-primary-500" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 fill-primary-500" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            </div>
                            <span class="text-3xl sm:text-4xl font-serif text-primary-200/80 leading-none select-none">”</span>
                        </div>
                        <p class="text-sm sm:text-[15px] font-bold text-gray-800 leading-relaxed mb-6">
                            “Paling terbantu dengan fitur pesanan meja QRIS &amp; struk instan. Antrean kasir jadi rapi dan omzet tercatat akurat!”
                        </p>
                    </div>
                    <div class="flex items-center gap-3.5 pt-4 border-t border-gray-100">
                        <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=150&auto=format&fit=crop&q=80" 
                             alt="Mayla Fazza" 
                             class="w-11 h-11 sm:w-12 sm:h-12 rounded-full object-cover ring-2 ring-primary-500/20 shadow-xs shrink-0"
                             onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name=Mayla+Fazza&background=ea580c&color=fff';">
                        <div class="min-w-0">
                            <div class="text-sm sm:text-[15px] font-bold text-gray-900 truncate">Mayla Fazza</div>
                            <div class="text-xs text-primary-600 font-semibold truncate">Kopi Senja Space</div>
                        </div>
                    </div>
                </div>

                <!-- Card 4: Rendy Pratama -->
                <div class="testimonial-3d-card p-6 sm:p-8 rounded-[28px] sm:rounded-[34px] bg-white border border-gray-100/90 shadow-sm flex flex-col justify-between min-h-[290px] sm:min-h-[310px]" data-index="4">
                    <div>
                        <div class="flex items-center justify-between mb-4 sm:mb-5">
                            <div class="flex items-center gap-1 text-primary-500">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 fill-primary-500" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 fill-primary-500" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 fill-primary-500" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 fill-primary-500" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 fill-primary-500" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            </div>
                            <span class="text-3xl sm:text-4xl font-serif text-primary-200/80 leading-none select-none">”</span>
                        </div>
                        <p class="text-sm sm:text-[15px] font-bold text-gray-800 leading-relaxed mb-6">
                            “Manajemen stok real-time-nya luar biasa. Stok berkurang otomatis dan dapur tenang tanpa takut menu habis dipesan.”
                        </p>
                    </div>
                    <div class="flex items-center gap-3.5 pt-4 border-t border-gray-100">
                        <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=150&auto=format&fit=crop&q=80" 
                             alt="Rendy Pratama" 
                             class="w-11 h-11 sm:w-12 sm:h-12 rounded-full object-cover ring-2 ring-primary-500/20 shadow-xs shrink-0"
                             onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name=Rendy+Pratama&background=ea580c&color=fff';">
                        <div class="min-w-0">
                            <div class="text-sm sm:text-[15px] font-bold text-gray-900 truncate">Rendy Pratama</div>
                            <div class="text-xs text-primary-600 font-semibold truncate">Resto Dapur Melayu</div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Controls: Prev, Indicators, Next -->
            <div class="flex items-center justify-center gap-4 sm:gap-6 mt-6 sm:mt-8">
                <!-- Prev Button -->
                <button id="prevTestimonialBtn" type="button" aria-label="Testimoni Sebelumnya" class="w-10 h-10 rounded-full bg-white border border-gray-200 text-gray-700 hover:text-primary-600 hover:border-primary-400 hover:bg-orange-50/50 shadow-xs transition-all flex items-center justify-center cursor-pointer group">
                    <svg class="w-5 h-5 group-hover:-translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>

                <!-- Indicator Dots -->
                <div id="testimonialDots" class="flex items-center gap-2"></div>

                <!-- Next Button -->
                <button id="nextTestimonialBtn" type="button" aria-label="Testimoni Selanjutnya" class="w-10 h-10 rounded-full bg-white border border-gray-200 text-gray-700 hover:text-primary-600 hover:border-primary-400 hover:bg-orange-50/50 shadow-xs transition-all flex items-center justify-center cursor-pointer group">
                    <svg class="w-5 h-5 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M9 5l7 7-7 7" />
                    </svg>
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

    <!-- Feature Detail Modal (Interactive Detail for Pelajari Fitur Kasir, Stok & Dapur, Laporan & AI) -->
    <div id="featureDetailModal" class="fixed inset-0 z-50 bg-gray-900/60 backdrop-blur-sm flex items-center justify-center p-3.5 sm:p-6 opacity-0 pointer-events-none transition-all duration-300" role="dialog" aria-modal="true" aria-labelledby="featureModalTitle">
        <!-- Backdrop Backdrop Click Handler -->
        <div class="fixed inset-0" onclick="closeFeatureModal()" aria-hidden="true"></div>

        <!-- Modal Card Container -->
        <div id="featureModalDialog" class="relative w-full max-w-3xl bg-white rounded-2xl sm:rounded-3xl shadow-2xl border border-gray-200/80 flex flex-col max-h-[92vh] sm:max-h-[88vh] z-10 overflow-hidden transform scale-95 transition-all duration-300">
            <!-- Modal Top Header with Tabs & Close Button -->
            <div class="px-4 py-3.5 sm:px-7 sm:py-4.5 border-b border-gray-100 flex items-center justify-between bg-white shrink-0">
                <!-- Interactive Tab Pill Switcher -->
                <div class="flex items-center gap-1 sm:gap-1.5 p-1 bg-gray-100 rounded-xl overflow-x-auto max-w-[calc(100%-44px)] sm:max-w-none">
                    <button type="button" onclick="switchFeatureTab('pos')" id="tabBtn-pos" class="px-3 sm:px-4 py-1.5 rounded-lg text-xs sm:text-sm font-extrabold transition-all shrink-0 cursor-pointer bg-primary-600 text-white shadow-xs">
                        Kasir POS
                    </button>
                    <button type="button" onclick="switchFeatureTab('stock')" id="tabBtn-stock" class="px-3 sm:px-4 py-1.5 rounded-lg text-xs sm:text-sm font-bold text-gray-600 hover:text-gray-900 hover:bg-white/60 transition-all shrink-0 cursor-pointer">
                        Stok &amp; Dapur
                    </button>
                    <button type="button" onclick="switchFeatureTab('analytics')" id="tabBtn-analytics" class="px-3 sm:px-4 py-1.5 rounded-lg text-xs sm:text-sm font-bold text-gray-600 hover:text-gray-900 hover:bg-white/60 transition-all shrink-0 cursor-pointer">
                        Laporan &amp; AI
                    </button>
                </div>

                <!-- Close "X" Button -->
                <button type="button" onclick="closeFeatureModal()" aria-label="Tutup Detail Fitur" class="w-8 h-8 sm:w-9 sm:h-9 rounded-full bg-gray-100 hover:bg-gray-200 text-gray-500 hover:text-gray-900 flex items-center justify-center transition-colors cursor-pointer shrink-0">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <!-- Modal Body (Scrollable with Smooth Momentum) -->
            <div class="overflow-y-auto px-5 py-5 sm:px-8 sm:py-7 space-y-6">
                <!-- Pane 1: Kasir POS -->
                <div id="featurePane-pos" class="space-y-6 text-left">
                    <div>
                        <div class="inline-flex items-center gap-1.5 text-[11px] sm:text-xs font-extrabold uppercase tracking-wider text-primary-600 bg-orange-50 border border-orange-200/70 px-3 py-1 rounded-md mb-2">
                            Solusi Kasir &amp; Kas Terpadu
                        </div>
                        <h3 id="featureModalTitle" class="text-xl sm:text-2xl lg:text-3xl font-black text-gray-900 tracking-tight leading-tight">
                            Sistem Kasir Pintar (POS) &amp; Pembukuan Otomatis
                        </h3>
                        <p class="text-xs sm:text-[15px] text-gray-600 mt-2 leading-relaxed font-normal">
                            Dirancang khusus untuk ritme cepat bisnis resto dan kafe. Menggabungkan pencatatan pesanan kilat, penerimaan pembayaran digital otomatis, hingga pencetakan nota fisik tanpa risiko uang kas laci selisih.
                        </p>
                    </div>

                    <!-- 4 Capabilities Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5 sm:gap-4">
                        <div class="p-4 rounded-2xl bg-orange-50/40 border border-orange-100/90 text-left">
                            <div class="w-8 h-8 rounded-lg bg-white border border-orange-200/80 text-primary-600 flex items-center justify-center font-bold text-sm mb-2.5 shadow-2xs">01</div>
                            <h4 class="font-bold text-gray-900 text-sm sm:text-base mb-1">Transaksi Kilat 3 Detik</h4>
                            <p class="text-xs text-gray-600 leading-relaxed font-normal">Pilih menu, varian rasa, level pedas, dan nomor meja langsung dalam beberapa sentuhan. Antrean kasir tetap lancar di jam sibuk.</p>
                        </div>
                        <div class="p-4 rounded-2xl bg-orange-50/40 border border-orange-100/90 text-left">
                            <div class="w-8 h-8 rounded-lg bg-white border border-orange-200/80 text-primary-600 flex items-center justify-center font-bold text-sm mb-2.5 shadow-2xs">02</div>
                            <h4 class="font-bold text-gray-900 text-sm sm:text-base mb-1">Multi-Metode Pembayaran</h4>
                            <p class="text-xs text-gray-600 leading-relaxed font-normal">Mendukung uang tunai dengan kalkulator kembalian otomatis, serta QRIS dinamis Midtrans tanpa perlu cek mutasi manual.</p>
                        </div>
                        <div class="p-4 rounded-2xl bg-orange-50/40 border border-orange-100/90 text-left">
                            <div class="w-8 h-8 rounded-lg bg-white border border-orange-200/80 text-primary-600 flex items-center justify-center font-bold text-sm mb-2.5 shadow-2xs">03</div>
                            <h4 class="font-bold text-gray-900 text-sm sm:text-base mb-1">Cetak Struk &amp; Split Bill</h4>
                            <p class="text-xs text-gray-600 leading-relaxed font-normal">Koneksi bluetooth &amp; USB ke printer thermal kasir 58mm/80mm, pisah tagihan antar tamu (split bill), dan kirim struk digital.</p>
                        </div>
                        <div class="p-4 rounded-2xl bg-orange-50/40 border border-orange-100/90 text-left">
                            <div class="w-8 h-8 rounded-lg bg-white border border-orange-200/80 text-primary-600 flex items-center justify-center font-bold text-sm mb-2.5 shadow-2xs">04</div>
                            <h4 class="font-bold text-gray-900 text-sm sm:text-base mb-1">Kontrol Kas Shift &amp; Laci Uang</h4>
                            <p class="text-xs text-gray-600 leading-relaxed font-normal">Catat modal kasir awal shift, buka otomatis laci uang kasir (cash drawer RJ-11), dan rekonsiliasi kas akhir harian bebas selisih.</p>
                        </div>
                    </div>

                    <!-- Hardware & Alur Kerja Step-by-Step -->
                    <div class="bg-gray-50/90 border border-gray-200/80 rounded-2xl p-4 sm:p-5 space-y-4">
                        <div>
                            <div class="text-[11px] font-extrabold uppercase tracking-wider text-gray-500 mb-2">Hardware &amp; Perangkat yang Didukung:</div>
                            <div class="flex flex-wrap gap-2 text-xs font-semibold text-gray-700">
                                <span class="px-2.5 py-1 bg-white border border-gray-200 rounded-lg shadow-2xs">Tablet Android &amp; iPad</span>
                                <span class="px-2.5 py-1 bg-white border border-gray-200 rounded-lg shadow-2xs">PC / Laptop Kasir</span>
                                <span class="px-2.5 py-1 bg-white border border-gray-200 rounded-lg shadow-2xs">Printer Thermal Bluetooth &amp; USB (58mm/80mm)</span>
                                <span class="px-2.5 py-1 bg-white border border-gray-200 rounded-lg shadow-2xs">Laci Uang Kasir (Cash Drawer RJ-11)</span>
                                <span class="px-2.5 py-1 bg-white border border-gray-200 rounded-lg shadow-2xs">Barcode Scanner</span>
                            </div>
                        </div>

                        <div class="pt-3 border-t border-gray-200/70">
                            <div class="text-[11px] font-extrabold uppercase tracking-wider text-gray-500 mb-2.5">Alur Kerja Kasir:</div>
                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 text-xs text-gray-700">
                                <div class="p-2.5 rounded-xl bg-white border border-gray-200/70">
                                    <strong class="text-primary-600 block mb-0.5 font-black">Langkah 1</strong>
                                    Input menu &amp; nomor meja makan
                                </div>
                                <div class="p-2.5 rounded-xl bg-white border border-gray-200/70">
                                    <strong class="text-primary-600 block mb-0.5 font-black">Langkah 2</strong>
                                    Pilih pembayaran (QRIS / Tunai / Transfer)
                                </div>
                                <div class="p-2.5 rounded-xl bg-white border border-gray-200/70">
                                    <strong class="text-primary-600 block mb-0.5 font-black">Langkah 3</strong>
                                    Struk kasir &amp; dapur otomatis tercetak
                                </div>
                                <div class="p-2.5 rounded-xl bg-white border border-gray-200/70">
                                    <strong class="text-primary-600 block mb-0.5 font-black">Langkah 4</strong>
                                    Omzet langsung tercatat di laporan keuangan
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pane 2: Stok & Dapur -->
                <div id="featurePane-stock" class="hidden space-y-6 text-left">
                    <div>
                        <div class="inline-flex items-center gap-1.5 text-[11px] sm:text-xs font-extrabold uppercase tracking-wider text-primary-600 bg-orange-50 border border-orange-200/70 px-3 py-1 rounded-md mb-2">
                            Solusi Stok &amp; Pelanggan
                        </div>
                        <h3 class="text-xl sm:text-2xl lg:text-3xl font-black text-gray-900 tracking-tight leading-tight">
                            Manajemen Stok Otomatis &amp; Kitchen Display System
                        </h3>
                        <p class="text-xs sm:text-[15px] text-gray-600 mt-2 leading-relaxed font-normal">
                            Hentikan kebocoran bahan baku dan hindari tamu kecewa karena stok habis mendadak. Setiap menu terjual otomatis memotong bahan baku per resep, dengan peringatan dini sebelum bahan habis dan tiket pesanan langsung ke layar dapur.
                        </p>
                    </div>

                    <!-- 4 Capabilities Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5 sm:gap-4">
                        <div class="p-4 rounded-2xl bg-orange-50/40 border border-orange-100/90 text-left">
                            <div class="w-8 h-8 rounded-lg bg-white border border-orange-200/80 text-primary-600 flex items-center justify-center font-bold text-sm mb-2.5 shadow-2xs">01</div>
                            <h4 class="font-bold text-gray-900 text-sm sm:text-base mb-1">Potong Bahan per Resep (COGS)</h4>
                            <p class="text-xs text-gray-600 leading-relaxed font-normal">Tiap 1 porsi menu terjual, bahan baku (kopi, susu, beras, daging) otomatis terpangkas real-time sesuai gramasi resep.</p>
                        </div>
                        <div class="p-4 rounded-2xl bg-orange-50/40 border border-orange-100/90 text-left">
                            <div class="w-8 h-8 rounded-lg bg-white border border-orange-200/80 text-primary-600 flex items-center justify-center font-bold text-sm mb-2.5 shadow-2xs">02</div>
                            <h4 class="font-bold text-gray-900 text-sm sm:text-base mb-1">Peringatan Stok Menipis</h4>
                            <p class="text-xs text-gray-600 leading-relaxed font-normal">Sistem memberi peringatan dini visual saat stok mendekati batas minimum, sehingga staf dapur sempat restock sebelum jam ramai.</p>
                        </div>
                        <div class="p-4 rounded-2xl bg-orange-50/40 border border-orange-100/90 text-left">
                            <div class="w-8 h-8 rounded-lg bg-white border border-orange-200/80 text-primary-600 flex items-center justify-center font-bold text-sm mb-2.5 shadow-2xs">03</div>
                            <h4 class="font-bold text-gray-900 text-sm sm:text-base mb-1">Layar Dapur Terintegrasi (KDS)</h4>
                            <p class="text-xs text-gray-600 leading-relaxed font-normal">Pesanan dari kasir atau pemesanan meja langsung muncul di layar tablet dapur chef/barista tanpa risiko nota kertas basah atau hilang.</p>
                        </div>
                        <div class="p-4 rounded-2xl bg-orange-50/40 border border-orange-100/90 text-left">
                            <div class="w-8 h-8 rounded-lg bg-white border border-orange-200/80 text-primary-600 flex items-center justify-center font-bold text-sm mb-2.5 shadow-2xs">04</div>
                            <h4 class="font-bold text-gray-900 text-sm sm:text-base mb-1">Database &amp; Riwayat Pelanggan</h4>
                            <p class="text-xs text-gray-600 leading-relaxed font-normal">Rekam nomor kontak, riwayat belanja, dan menu favorit pelanggan untuk penawaran promo loyalitas dan follow-up WhatsApp.</p>
                        </div>
                    </div>

                    <!-- Alur Kerja Dapur Step-by-Step -->
                    <div class="bg-gray-50/90 border border-gray-200/80 rounded-2xl p-4 sm:p-5 space-y-4">
                        <div>
                            <div class="text-[11px] font-extrabold uppercase tracking-wider text-gray-500 mb-2">Manfaat Nyata untuk Operasional:</div>
                            <div class="flex flex-wrap gap-2 text-xs font-semibold text-gray-700">
                                <span class="px-2.5 py-1 bg-white border border-gray-200 rounded-lg shadow-2xs">Zero Food Waste &amp; Bahan Kedaluwarsa</span>
                                <span class="px-2.5 py-1 bg-white border border-gray-200 rounded-lg shadow-2xs">Waktu Tunggu Masak Turun hingga 40%</span>
                                <span class="px-2.5 py-1 bg-white border border-gray-200 rounded-lg shadow-2xs">Stok Opname Cepat Tanpa Hitung Manual Semalaman</span>
                            </div>
                        </div>

                        <div class="pt-3 border-t border-gray-200/70">
                            <div class="text-[11px] font-extrabold uppercase tracking-wider text-gray-500 mb-2.5">Alur Sinkronisasi Dapur:</div>
                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 text-xs text-gray-700">
                                <div class="p-2.5 rounded-xl bg-white border border-gray-200/70">
                                    <strong class="text-primary-600 block mb-0.5 font-black">Langkah 1</strong>
                                    Pesanan kasir sukses dibayar
                                </div>
                                <div class="p-2.5 rounded-xl bg-white border border-gray-200/70">
                                    <strong class="text-primary-600 block mb-0.5 font-black">Langkah 2</strong>
                                    Tiket tampil di KDS dapur &amp; stok terpotong
                                </div>
                                <div class="p-2.5 rounded-xl bg-white border border-gray-200/70">
                                    <strong class="text-primary-600 block mb-0.5 font-black">Langkah 3</strong>
                                    Chef menyiapkan pesanan sesuai urutan meja
                                </div>
                                <div class="p-2.5 rounded-xl bg-white border border-gray-200/70">
                                    <strong class="text-primary-600 block mb-0.5 font-black">Langkah 4</strong>
                                    Notifikasi restock muncul saat bahan menipis
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pane 3: Laporan & AI -->
                <div id="featurePane-analytics" class="hidden space-y-6 text-left">
                    <div>
                        <div class="inline-flex items-center gap-1.5 text-[11px] sm:text-xs font-extrabold uppercase tracking-wider text-primary-600 bg-orange-50 border border-orange-200/70 px-3 py-1 rounded-md mb-2">
                            Solusi Analitik Bisnis
                        </div>
                        <h3 class="text-xl sm:text-2xl lg:text-3xl font-black text-gray-900 tracking-tight leading-tight">
                            Laporan Keuangan Real-Time &amp; SIPEMMA AI Assistant
                        </h3>
                        <p class="text-xs sm:text-[15px] text-gray-600 mt-2 leading-relaxed font-normal">
                            Tinggalkan tebak-tebakan saat menentukan strategi bisnis. SIPEMMA menghitung omzet kotor, beban HPP, laba bersih tiap menu, grafik jam sibuk, hingga saran analitis cerdas AI Assistant langsung dari smartphone Anda kapan pun dibutuhkan.
                        </p>
                    </div>

                    <!-- 4 Capabilities Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5 sm:gap-4">
                        <div class="p-4 rounded-2xl bg-orange-50/40 border border-orange-100/90 text-left">
                            <div class="w-8 h-8 rounded-lg bg-white border border-orange-200/80 text-primary-600 flex items-center justify-center font-bold text-sm mb-2.5 shadow-2xs">01</div>
                            <h4 class="font-bold text-gray-900 text-sm sm:text-base mb-1">Kalkulasi Margin Laba Bersih</h4>
                            <p class="text-xs text-gray-600 leading-relaxed font-normal">Ketahui laba bersih sesungguhnya harian dan bulanan setelah dikurangi modal bahan (COGS) dan operasional tanpa lembur hitung nota.</p>
                        </div>
                        <div class="p-4 rounded-2xl bg-orange-50/40 border border-orange-100/90 text-left">
                            <div class="w-8 h-8 rounded-lg bg-white border border-orange-200/80 text-primary-600 flex items-center justify-center font-bold text-sm mb-2.5 shadow-2xs">02</div>
                            <h4 class="font-bold text-gray-900 text-sm sm:text-base mb-1">Analisis Menu Paling Untung</h4>
                            <p class="text-xs text-gray-600 leading-relaxed font-normal">Pilah menu dengan margin laba tertinggi vs menu yang kurang diminati untuk mengoptimalkan resep dan promosi penjualan.</p>
                        </div>
                        <div class="p-4 rounded-2xl bg-orange-50/40 border border-orange-100/90 text-left">
                            <div class="w-8 h-8 rounded-lg bg-white border border-orange-200/80 text-primary-600 flex items-center justify-center font-bold text-sm mb-2.5 shadow-2xs">03</div>
                            <h4 class="font-bold text-gray-900 text-sm sm:text-base mb-1">SIPEMMA AI Restaurant Assistant</h4>
                            <p class="text-xs text-gray-600 leading-relaxed font-normal">Asisten AI cerdas yang membaca database live resto Anda, memprediksi jam ramai, dan memberikan saran paket promo terlaris.</p>
                        </div>
                        <div class="p-4 rounded-2xl bg-orange-50/40 border border-orange-100/90 text-left">
                            <div class="w-8 h-8 rounded-lg bg-white border border-orange-200/80 text-primary-600 flex items-center justify-center font-bold text-sm mb-2.5 shadow-2xs">04</div>
                            <h4 class="font-bold text-gray-900 text-sm sm:text-base mb-1">Pantau Toko dari Smartphone</h4>
                            <p class="text-xs text-gray-600 leading-relaxed font-normal">Akses laporan multi-cabang kapan saja secara live di ponsel. Owner bisa bepergian dengan tenang karena bisnis tetap terpantau akurat.</p>
                        </div>
                    </div>

                    <!-- AI & Analitik Flow -->
                    <div class="bg-gray-50/90 border border-gray-200/80 rounded-2xl p-4 sm:p-5 space-y-4">
                        <div>
                            <div class="text-[11px] font-extrabold uppercase tracking-wider text-gray-500 mb-2">Manfaat Nyata bagi Pemilik Usaha:</div>
                            <div class="flex flex-wrap gap-2 text-xs font-semibold text-gray-700">
                                <span class="px-2.5 py-1 bg-white border border-gray-200 rounded-lg shadow-2xs">Tutup Toko 5 Menit (Bukan 2 Jam)</span>
                                <span class="px-2.5 py-1 bg-white border border-gray-200 rounded-lg shadow-2xs">Bebas Manipulasi &amp; Kecurangan Kasir</span>
                                <span class="px-2.5 py-1 bg-white border border-gray-200 rounded-lg shadow-2xs">Keputusan Belanja Bahan Berbasis Data</span>
                            </div>
                        </div>

                        <div class="pt-3 border-t border-gray-200/70">
                            <div class="text-[11px] font-extrabold uppercase tracking-wider text-gray-500 mb-2.5">Alur Analitik Bisnis:</div>
                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 text-xs text-gray-700">
                                <div class="p-2.5 rounded-xl bg-white border border-gray-200/70">
                                    <strong class="text-primary-600 block mb-0.5 font-black">Langkah 1</strong>
                                    Transaksi kasir sinkron real-time ke cloud
                                </div>
                                <div class="p-2.5 rounded-xl bg-white border border-gray-200/70">
                                    <strong class="text-primary-600 block mb-0.5 font-black">Langkah 2</strong>
                                    Dashboard hitung omzet, HPP &amp; margin laba
                                </div>
                                <div class="p-2.5 rounded-xl bg-white border border-gray-200/70">
                                    <strong class="text-primary-600 block mb-0.5 font-black">Langkah 3</strong>
                                    AI Assistant susun rangkuman performa harian
                                </div>
                                <div class="p-2.5 rounded-xl bg-white border border-gray-200/70">
                                    <strong class="text-primary-600 block mb-0.5 font-black">Langkah 4</strong>
                                    Owner terima laporan lengkap di smartphone
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Bottom Action Bar -->
            <div class="px-5 py-3.5 sm:px-8 sm:py-4 border-t border-gray-100 bg-gray-50/90 flex flex-wrap items-center justify-between gap-3 shrink-0">
                <div class="text-xs text-gray-500 font-medium hidden sm:block">
                    Aplikasi kasir cloud lengkap untuk kafe, resto, &amp; UMKM kuliner.
                </div>
                <div class="flex items-center gap-2.5 ml-auto">
                    <button type="button" onclick="closeFeatureModal()" class="px-4 py-2 rounded-xl text-xs sm:text-sm font-bold text-gray-600 hover:text-gray-900 bg-white border border-gray-200 hover:bg-gray-100 transition-colors cursor-pointer">
                        Tutup
                    </button>
                    <a href="#kontak" onclick="closeFeatureModal()" class="px-5 py-2 rounded-xl text-xs sm:text-sm font-extrabold text-white bg-primary-600 hover:bg-primary-700 shadow-xs transition-colors cursor-pointer">
                        Konsultasi Fitur
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // -------------------------------------------------------------
        // Feature Detail Modal Controller Logic
        // -------------------------------------------------------------
        function openFeatureModal(key) {
            const modal = document.getElementById('featureDetailModal');
            const dialog = document.getElementById('featureModalDialog');
            if (!modal || !dialog) return;

            switchFeatureTab(key || 'pos');

            modal.classList.remove('opacity-0', 'pointer-events-none');
            dialog.classList.remove('scale-95');
            dialog.classList.add('scale-100');
            document.body.classList.add('overflow-hidden');
        }

        function closeFeatureModal() {
            const modal = document.getElementById('featureDetailModal');
            const dialog = document.getElementById('featureModalDialog');
            if (!modal || !dialog) return;

            modal.classList.add('opacity-0', 'pointer-events-none');
            dialog.classList.remove('scale-100');
            dialog.classList.add('scale-95');
            document.body.classList.remove('overflow-hidden');
        }

        function switchFeatureTab(key) {
            const tabs = ['pos', 'stock', 'analytics'];
            tabs.forEach(t => {
                const pane = document.getElementById(`featurePane-${t}`);
                const btn = document.getElementById(`tabBtn-${t}`);
                if (pane) {
                    if (t === key) {
                        pane.classList.remove('hidden');
                    } else {
                        pane.classList.add('hidden');
                    }
                }
                if (btn) {
                    if (t === key) {
                        btn.className = 'px-3 sm:px-4 py-1.5 rounded-lg text-xs sm:text-sm font-extrabold transition-all shrink-0 cursor-pointer bg-primary-600 text-white shadow-xs';
                    } else {
                        btn.className = 'px-3 sm:px-4 py-1.5 rounded-lg text-xs sm:text-sm font-bold text-gray-600 hover:text-gray-900 hover:bg-white/60 transition-all shrink-0 cursor-pointer';
                    }
                }
            });
        }

        // Close on ESC key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closeFeatureModal();
            }
        });

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

        // -------------------------------------------------------------
        // Hero 3-Layered Interactive Component Logic
        // -------------------------------------------------------------

        // 1. Tablet Menu Hover Synchronization with Gambar 3 (Top Item Card)
        const tabletItems = document.querySelectorAll('.interactive-tablet-item');
        const heroTopCard = document.getElementById('heroTopItemCard');
        const heroTopTitle = document.getElementById('heroTopItemTitle');
        const heroTopPrice = document.getElementById('heroTopItemPrice');
        const heroTopSubtitle = document.getElementById('heroTopItemSubtitle');
        const heroTopBadgeText = document.getElementById('heroTopItemBadgeText');
        const heroTopIcon = document.getElementById('heroTopItemIcon');
        const heroTopMeta = document.getElementById('heroTopItemMeta');
        const heroTopTrend = document.getElementById('heroTopItemTrend');
        const heroSparkLine = document.getElementById('heroSparklineLine');
        const heroSparkArea = document.getElementById('heroSparklineArea');

        function selectTabletItem(item) {
            if (!item) return;

            tabletItems.forEach(el => {
                el.classList.remove('ring-2', 'ring-primary-500', 'bg-orange-50/40');
            });
            item.classList.add('ring-2', 'ring-primary-500', 'bg-orange-50/40');

            const iconSvgs = {
                'coffee': '<svg class="w-3.5 h-3.5 text-primary-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M18 8h1a4 4 0 0 1 0 8h-1M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8zM6 1v3M10 1v3M14 1v3"/></svg>',
                'beef-bowl': '<svg class="w-3.5 h-3.5 text-primary-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 11a8 8 0 0 0 16 0H4zM7 19h10M5 6l14-3M7 6l12-2"/></svg>',
                'profit': '<svg class="w-3.5 h-3.5 text-primary-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6M3 21h18"/></svg>',
                'mie-ayam': '<svg class="w-3.5 h-3.5 text-primary-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 12a8 8 0 0 0 16 0H4zm4-7c0 1.5-1 2-1 3.5m5-3.5c0 1.5-1 2-1 3.5m5-3.5c0 1.5-1 2-1 3.5M7 19h10"/></svg>',
                'nasi-goreng': '<svg class="w-3.5 h-3.5 text-primary-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v2m-8 9a8 8 0 0 1 16 0H4zm-1 3h18M10 4a2 2 0 1 1 4 0"/></svg>',
                'es-jeruk': '<svg class="w-3.5 h-3.5 text-primary-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 3h6v4M21 3l-6.5 6.5M17 11l1.5 9.5a1 1 0 0 1-1 1.5H6.5a1 1 0 0 1-1-1.5L7 11h10z"/></svg>',
                // Backward-compatible fallbacks
                'dish': '<svg class="w-3.5 h-3.5 text-primary-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v2m-8 9a8 8 0 0 1 16 0H4zm-1 3h18M10 4a2 2 0 1 1 4 0"/></svg>',
                'noodles': '<svg class="w-3.5 h-3.5 text-primary-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 12a8 8 0 0 0 16 0H4zm4-7c0 1.5-1 2-1 3.5m5-3.5c0 1.5-1 2-1 3.5m5-3.5c0 1.5-1 2-1 3.5M7 19h10"/></svg>',
                'citrus': '<svg class="w-3.5 h-3.5 text-primary-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 3h6v4M21 3l-6.5 6.5M17 11l1.5 9.5a1 1 0 0 1-1 1.5H6.5a1 1 0 0 1-1-1.5L7 11h10z"/></svg>'
            };
            if (heroTopTitle && item.dataset.title) heroTopTitle.innerText = item.dataset.title;
            if (heroTopPrice && item.dataset.price) heroTopPrice.innerText = item.dataset.price;
            if (heroTopSubtitle && item.dataset.subtitle) heroTopSubtitle.innerText = item.dataset.subtitle;
            if (heroTopBadgeText && item.dataset.badge) heroTopBadgeText.innerText = item.dataset.badge;
            if (heroTopIcon && item.dataset.icon && iconSvgs[item.dataset.icon]) {
                heroTopIcon.innerHTML = iconSvgs[item.dataset.icon];
            }
            if (heroTopMeta && item.dataset.meta) heroTopMeta.innerText = item.dataset.meta;
            if (heroTopTrend && item.dataset.trend) heroTopTrend.innerText = item.dataset.trend;
            if (heroSparkLine && item.dataset.sparkLine) heroSparkLine.setAttribute('d', item.dataset.sparkLine);
            if (heroSparkArea && item.dataset.sparkArea) heroSparkArea.setAttribute('d', item.dataset.sparkArea);

            if (heroTopCard) {
                heroTopCard.style.transform = 'scale(1.04)';
                setTimeout(() => {
                    heroTopCard.style.transform = 'scale(1)';
                }, 200);
            }
        }

        tabletItems.forEach(item => {
            item.addEventListener('mouseenter', () => selectTabletItem(item));
            item.addEventListener('click', () => selectTabletItem(item));
        });

        // 2. Live AI Assistant Typing and Answering Cycle (Clean & Minimalist, Zero Emojis)
        const aiConversations = [
            {
                q: "Berapa omzet hari ini?",
                a: "Omzet live Rp 2.850.000 (+18% vs kemarin) dengan laba bersih Rp 1.420.000."
            },
            {
                q: "Menu terlaris hari ini?",
                a: "Kopi Susu memimpin dengan 47 pesanan, disusul Nasi Goreng sebanyak 38 porsi."
            },
            {
                q: "Stok apa yang menipis?",
                a: "Sirup Karamel tersisa 2 botol dan Daging Slice 1.2 kg. Disarankan restock."
            },
            {
                q: "Saran promo siang?",
                a: "Paket hemat Mie Ayam dan Es Jeruk jam 12:00-14:00 berpotensi naik 25%."
            }
        ];

        let aiIndex = 0;
        let aiTypingInterval = null;
        const aiUserMsg = document.getElementById('heroAiUserMsg');
        const aiTypingIndicator = document.getElementById('heroAiTypingIndicator');
        const aiAnswerBubble = document.getElementById('heroAiAnswerBubble');

        function runAiLoop() {
            if (!aiUserMsg || !aiTypingIndicator || !aiAnswerBubble) return;

            const current = aiConversations[aiIndex];
            aiUserMsg.innerText = current.q;
            
            // Show typing indicator, hide answer
            aiTypingIndicator.classList.remove('hidden');
            aiAnswerBubble.classList.add('hidden');
            aiAnswerBubble.textContent = '';
            if (aiTypingInterval) clearInterval(aiTypingInterval);

            // After 1.2 seconds typing, reveal answer character by character preserving whitespace
            setTimeout(() => {
                aiTypingIndicator.classList.add('hidden');
                aiAnswerBubble.classList.remove('hidden');
                
                const text = current.a;
                let charIndex = 0;
                aiAnswerBubble.textContent = '';
                aiTypingInterval = setInterval(() => {
                    if (charIndex <= text.length) {
                        aiAnswerBubble.textContent = text.slice(0, charIndex);
                        charIndex++;
                    } else {
                        clearInterval(aiTypingInterval);
                    }
                }, 22);

            }, 1200);

            // Advance to next after 5.5s
            aiIndex = (aiIndex + 1) % aiConversations.length;
        }

        // Run immediately and repeat
        runAiLoop();
        setInterval(runAiLoop, 5500);

        // 3. 3D Testimonial Coverflow Carousel with Autoplay & Orange Accents
        (function initTestimonial3D() {
            const container = document.getElementById('testimonial3DContainer');
            if (!container) return;
            const cards = Array.from(container.querySelectorAll('.testimonial-3d-card'));
            const dotsContainer = document.getElementById('testimonialDots');
            const prevBtn = document.getElementById('prevTestimonialBtn');
            const nextBtn = document.getElementById('nextTestimonialBtn');
            if (!cards.length) return;

            let currentIndex = 1; // Start with Lusiana in center (as in reference image)
            const total = cards.length;
            let autoplayTimer = null;
            const autoplayDelay = 3800;

            // Build indicator dots
            if (dotsContainer) {
                dotsContainer.innerHTML = '';
                cards.forEach((_, idx) => {
                    const dot = document.createElement('button');
                    dot.type = 'button';
                    dot.setAttribute('aria-label', `Pilih testimoni ${idx + 1}`);
                    dot.className = 'transition-all duration-300 rounded-full h-2.5';
                    dot.addEventListener('click', () => {
                        goToSlide(idx);
                        restartAutoplay();
                    });
                    dotsContainer.appendChild(dot);
                });
            }

            function updateCarousel() {
                const isMobile = window.innerWidth < 640;
                const isTablet = window.innerWidth >= 640 && window.innerWidth < 1024;
                
                cards.forEach((card, i) => {
                    let offset = (i - currentIndex) % total;
                    if (offset > total / 2) offset -= total;
                    if (offset < -total / 2) offset += total;

                    card.onclick = null;

                    if (offset === 0) {
                        // Center active card
                        card.style.transform = 'translate(-50%, -50%) scale(1.06) translateZ(0)';
                        card.style.opacity = '1';
                        card.style.zIndex = '30';
                        card.style.filter = 'none';
                        card.style.boxShadow = '0 25px 50px -12px rgba(0, 0, 0, 0.12), 0 12px 25px -8px rgba(234, 88, 12, 0.12)';
                        card.style.pointerEvents = 'auto';
                        card.style.cursor = 'default';
                    } else if (offset === -1) {
                        // Left receding card
                        const shift = isMobile ? '-72%' : (isTablet ? '-270px' : '-350px');
                        card.style.transform = `translate(calc(-50% + ${shift}), -50%) scale(0.88) translateZ(-80px)`;
                        card.style.opacity = isMobile ? '0.28' : '0.45';
                        card.style.zIndex = '20';
                        card.style.filter = 'blur(0.5px)';
                        card.style.boxShadow = '0 12px 30px -10px rgba(0, 0, 0, 0.06)';
                        card.style.pointerEvents = 'auto';
                        card.style.cursor = 'pointer';
                        card.onclick = () => {
                            prevSlide();
                            restartAutoplay();
                        };
                    } else if (offset === 1) {
                        // Right receding card
                        const shift = isMobile ? '72%' : (isTablet ? '270px' : '350px');
                        card.style.transform = `translate(calc(-50% + ${shift}), -50%) scale(0.88) translateZ(-80px)`;
                        card.style.opacity = isMobile ? '0.28' : '0.45';
                        card.style.zIndex = '20';
                        card.style.filter = 'blur(0.5px)';
                        card.style.boxShadow = '0 12px 30px -10px rgba(0, 0, 0, 0.06)';
                        card.style.pointerEvents = 'auto';
                        card.style.cursor = 'pointer';
                        card.onclick = () => {
                            nextSlide();
                            restartAutoplay();
                        };
                    } else {
                        // Hidden cards off-screen
                        const shift = offset < 0 ? '-140%' : '140%';
                        card.style.transform = `translate(calc(-50% + ${shift}), -50%) scale(0.7) translateZ(-160px)`;
                        card.style.opacity = '0';
                        card.style.zIndex = '10';
                        card.style.filter = 'blur(2px)';
                        card.style.pointerEvents = 'none';
                        card.style.cursor = 'default';
                    }
                });

                // Update dots
                if (dotsContainer) {
                    const dots = dotsContainer.querySelectorAll('button');
                    dots.forEach((dot, idx) => {
                        if (idx === currentIndex) {
                            dot.className = 'w-7 h-2.5 rounded-full bg-primary-600 transition-all duration-300 shadow-xs cursor-pointer';
                        } else {
                            dot.className = 'w-2.5 h-2.5 rounded-full bg-gray-300 hover:bg-primary-300 transition-all duration-300 cursor-pointer';
                        }
                    });
                }
            }

            function nextSlide() {
                currentIndex = (currentIndex + 1) % total;
                updateCarousel();
            }

            function prevSlide() {
                currentIndex = (currentIndex - 1 + total) % total;
                updateCarousel();
            }

            function goToSlide(idx) {
                currentIndex = (idx + total) % total;
                updateCarousel();
            }

            function startAutoplay() {
                stopAutoplay();
                autoplayTimer = setInterval(nextSlide, autoplayDelay);
            }

            function stopAutoplay() {
                if (autoplayTimer) {
                    clearInterval(autoplayTimer);
                    autoplayTimer = null;
                }
            }

            function restartAutoplay() {
                stopAutoplay();
                startAutoplay();
            }

            if (prevBtn) {
                prevBtn.addEventListener('click', () => {
                    prevSlide();
                    restartAutoplay();
                });
            }

            if (nextBtn) {
                nextBtn.addEventListener('click', () => {
                    nextSlide();
                    restartAutoplay();
                });
            }

            // Pause on hover
            container.addEventListener('mouseenter', stopAutoplay);
            container.addEventListener('mouseleave', startAutoplay);

            // Touch swipe support
            let touchStartX = 0;
            container.addEventListener('touchstart', (e) => {
                touchStartX = e.changedTouches[0].screenX;
                stopAutoplay();
            }, { passive: true });

            container.addEventListener('touchend', (e) => {
                const touchEndX = e.changedTouches[0].screenX;
                if (touchEndX < touchStartX - 40) {
                    nextSlide();
                } else if (touchEndX > touchStartX + 40) {
                    prevSlide();
                }
                startAutoplay();
            }, { passive: true });

            window.addEventListener('resize', updateCarousel);

            // Initial run
            updateCarousel();
            startAutoplay();
        })();
    </script>
</body>
</html>
