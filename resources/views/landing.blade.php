<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPEMMA - Sistem Manajemen Restoran Modern</title>
    <!-- Gunakan Tailwind CDN agar tampilan dijamin sempurna tanpa perlu npm run dev -->
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
                            50: '#eff6ff',
                            100: '#dbeafe',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            900: '#1e3a8a',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .glass-nav {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        }
        .hero-pattern {
            background-color: #ffffff;
            background-image: radial-gradient(#e5e7eb 1px, transparent 1px);
            background-size: 20px 20px;
        }
        .float-anim {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
    </style>
</head>
<body class="antialiased bg-white text-slate-800 selection:bg-primary-600 selection:text-white font-sans">

    <!-- Navigation -->
    <nav class="fixed w-full z-50 glass-nav transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center gap-3">
                    <div class="bg-white p-1.5 rounded-xl shadow-sm border border-slate-100">
                        <img src="{{ asset('assets/img/LOGO.png') }}" alt="Logo SIPEMMA" class="h-10 w-auto object-contain">
                    </div>
                    <span class="font-extrabold text-2xl tracking-tight text-slate-900">SIPEMMA</span>
                </div>
                <div class="flex items-center gap-6">
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-sm font-semibold text-slate-600 hover:text-primary-600 transition-colors">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="hidden sm:block text-sm font-semibold text-slate-600 hover:text-primary-600 transition-colors">Masuk</a>
                        <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-6 py-2.5 text-sm font-bold text-white bg-primary-600 rounded-full hover:bg-primary-700 hover:shadow-lg hover:shadow-primary-600/30 transition-all duration-300 transform hover:-translate-y-0.5">
                            Mulai Sekarang
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <main class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden hero-pattern">
        
        <!-- Glow Effects -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full max-w-7xl pointer-events-none">
            <div class="absolute top-20 left-10 w-72 h-72 bg-blue-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 float-anim"></div>
            <div class="absolute top-40 right-10 w-72 h-72 bg-purple-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 float-anim" style="animation-delay: 2s;"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-4xl mx-auto">
                
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white shadow-sm border border-slate-200 text-primary-600 text-sm font-bold mb-8 animate-fade-in-up">
                    <span class="flex h-2.5 w-2.5 relative">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-primary-600"></span>
                    </span>
                    Sistem Manajemen Restoran Pintar
                </div>

                <h1 class="text-5xl md:text-6xl lg:text-7xl font-extrabold tracking-tight text-slate-900 mb-8 leading-[1.1]">
                    Tingkatkan Omzet <br class="hidden sm:block" />
                    Dengan <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-600 to-indigo-600">Manajemen Cerdas</span>
                </h1>
                
                <p class="max-w-2xl mx-auto text-lg md:text-xl text-slate-600 mb-10 leading-relaxed font-medium">
                    SIPEMMA dirancang untuk mempercepat alur kasir, melacak pesanan dapur, dan menyajikan laporan keuangan akurat dalam satu dashboard yang elegan.
                </p>
                
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a href="{{ route('login') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 text-base font-bold text-white bg-slate-900 rounded-full hover:bg-slate-800 hover:shadow-xl hover:shadow-slate-900/20 transition-all duration-300 transform hover:-translate-y-1">
                        Masuk ke Dashboard
                        <svg class="w-5 h-5 ml-2 -mr-1 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                    </a>
                </div>

            </div>
        </div>
    </main>

    <!-- Features Section -->
    <section class="py-24 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20">
                <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-4">Fitur Lengkap Untuk Restoran Anda</h2>
                <p class="text-lg text-slate-600 font-medium">Semua yang Anda butuhkan untuk operasional yang lancar.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <!-- Feature 1 -->
                <div class="group p-8 rounded-3xl bg-white border border-slate-100 shadow-sm hover:shadow-2xl hover:shadow-primary-600/10 hover:-translate-y-2 transition-all duration-300">
                    <div class="w-14 h-14 inline-flex items-center justify-center rounded-2xl bg-blue-50 text-primary-600 mb-8 group-hover:scale-110 group-hover:bg-primary-600 group-hover:text-white transition-all duration-300">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" /></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-4">Manajemen Menu Cerdas</h3>
                    <p class="text-slate-600 leading-relaxed font-medium">Atur ketersediaan menu, harga, dan kategori secara real-time tanpa ribet.</p>
                </div>

                <!-- Feature 2 -->
                <div class="group p-8 rounded-3xl bg-white border border-slate-100 shadow-sm hover:shadow-2xl hover:shadow-primary-600/10 hover:-translate-y-2 transition-all duration-300">
                    <div class="w-14 h-14 inline-flex items-center justify-center rounded-2xl bg-blue-50 text-primary-600 mb-8 group-hover:scale-110 group-hover:bg-primary-600 group-hover:text-white transition-all duration-300">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-4">Sistem Kasir (POS) Kilat</h3>
                    <p class="text-slate-600 leading-relaxed font-medium">Proses pesanan dalam hitungan detik, hitung total otomatis, dan hindari antrean panjang.</p>
                </div>

                <!-- Feature 3 -->
                <div class="group p-8 rounded-3xl bg-white border border-slate-100 shadow-sm hover:shadow-2xl hover:shadow-primary-600/10 hover:-translate-y-2 transition-all duration-300">
                    <div class="w-14 h-14 inline-flex items-center justify-center rounded-2xl bg-blue-50 text-primary-600 mb-8 group-hover:scale-110 group-hover:bg-primary-600 group-hover:text-white transition-all duration-300">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-4">Laporan Keuangan Rinci</h3>
                    <p class="text-slate-600 leading-relaxed font-medium">Pantau omzet, pesanan terlaris, dan performa harian lewat visualisasi data yang menawan.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-50 py-12 border-t border-slate-200 mt-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="flex items-center gap-3">
                <img src="{{ asset('assets/img/LOGO.png') }}" alt="Logo SIPEMMA" class="h-8 w-auto">
                <span class="font-extrabold text-lg text-slate-800">SIPEMMA</span>
            </div>
            <p class="text-slate-500 text-sm font-medium">
                &copy; {{ date('Y') }} SIPEMMA Restaurant. Hak Cipta Dilindungi.
            </p>
        </div>
    </footer>

</body>
</html>
