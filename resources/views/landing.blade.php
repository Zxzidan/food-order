<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPEMMA - Solusi Manajemen Restoran Modern</title>
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Outfit"', 'sans-serif'],
                        display: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        paper: '#F8F7F4',
                        ink: '#1A1A1A',
                        accent: '#E65C00',
                        accentHover: '#CC5200',
                        bento: '#FFFFFF',
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'float-delayed': 'float 6s ease-in-out 3s infinite',
                        'glow': 'glow 3s linear infinite',
                        'fade-in-up': 'fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-15px)' },
                        },
                        glow: {
                            '0%': { backgroundPosition: '0% 50%' },
                            '50%': { backgroundPosition: '100% 50%' },
                            '100%': { backgroundPosition: '0% 50%' },
                        },
                        fadeInUp: {
                            '0%': { opacity: '0', transform: 'translateY(30px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body { background-color: theme('colors.paper'); color: theme('colors.ink'); }
        .bg-dots {
            background-image: radial-gradient(theme('colors.ink') 1px, transparent 1px);
            background-size: 24px 24px;
            opacity: 0.05;
        }
        /* Ensure elements start invisible for the fade-in animation */
        .stagger-1 { opacity: 0; animation-delay: 0.1s; }
        .stagger-2 { opacity: 0; animation-delay: 0.2s; }
        .stagger-3 { opacity: 0; animation-delay: 0.3s; }
        .stagger-4 { opacity: 0; animation-delay: 0.4s; }
    </style>
</head>
<body class="antialiased min-h-screen relative font-sans overflow-x-hidden selection:bg-accent selection:text-white">

    <!-- Absolute subtle dot pattern -->
    <div class="absolute inset-0 bg-dots pointer-events-none z-0"></div>

    <!-- Minimalist Header -->
    <nav class="relative z-50 px-6 py-6 lg:px-12 flex items-center justify-between animate-fade-in-up stagger-1">
        <div class="flex items-center gap-2">
            <img src="{{ asset('assets/img/LOGO.png') }}" alt="SIPEMMA Logo" class="h-8 md:h-10 object-contain hover:scale-105 transition-transform">
        </div>
        <div class="flex items-center gap-4">
            <a href="{{ route('login') }}" class="font-display font-bold text-sm text-ink hover:text-accent transition-colors px-2">Masuk</a>
            <a href="{{ route('register') }}" class="font-display font-bold text-sm bg-ink text-white px-5 py-2.5 rounded-full hover:bg-accent hover:text-white transition-all transform hover:-translate-y-0.5 shadow-md">Daftar Gratis</a>
        </div>
    </nav>

    <!-- Main Container -->
    <main class="relative z-10 max-w-7xl mx-auto px-6 lg:px-12 pb-24 pt-6">
        
        <!-- Bento Grid Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 h-auto lg:min-h-[75vh]">
            
            <!-- Bento Box 1: The Hero Typography -->
            <div class="lg:col-span-7 bg-bento rounded-[2.5rem] p-8 lg:p-14 flex flex-col justify-center border border-gray-200/60 shadow-sm relative overflow-hidden group animate-fade-in-up stagger-2 hover:shadow-xl transition-shadow duration-500">
                <div class="absolute -right-16 -top-16 w-72 h-72 bg-accent/5 rounded-full blur-3xl transition-transform duration-700 group-hover:scale-150 animate-float-delayed"></div>
                
                <div class="relative z-10">
                    <span class="inline-block py-1.5 px-4 border border-ink/10 rounded-full text-xs font-display font-bold tracking-widest uppercase mb-6 text-accent bg-accent/5">Sistem Manajemen Cerdas</span>
                    <h1 class="text-5xl lg:text-7xl font-black font-display leading-[1.05] tracking-tight mb-6">
                        Revolusi <br />
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-accent to-orange-400">Dapur Anda.</span>
                    </h1>
                    <p class="text-lg lg:text-xl font-light text-gray-600 mb-10 max-w-lg leading-relaxed">
                        Tinggalkan cara lama. SIPEMMA mengemas kasir, manajemen menu, dan pesanan dalam satu antarmuka yang sangat bersih dan secepat kilat.
                    </p>
                    <div class="flex flex-wrap items-center gap-4">
                        <a href="{{ route('login') }}" class="font-display font-bold text-base bg-accent text-white px-8 py-4 rounded-full shadow-lg shadow-accent/30 hover:shadow-accent/50 hover:bg-accentHover transition-all transform hover:-translate-y-1 inline-flex items-center gap-2">
                            Mulai Sekarang
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Right Column Grid Area -->
            <div class="lg:col-span-5 grid grid-rows-2 gap-6 lg:gap-8">
                
                <!-- Bento Box 2: Speed / AI Feature with GEMINI GLOW -->
                <div class="relative rounded-[2.5rem] p-1 flex flex-col justify-between shadow-xl group hover:-translate-y-2 transition-all duration-500 animate-fade-in-up stagger-3">
                    
                    <!-- Animated Rainbow Glow (Gemini Style) -->
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-400 via-purple-500 via-pink-500 to-orange-400 rounded-[2.5rem] opacity-60 blur-xl animate-glow bg-[length:300%_auto] transition-all duration-500 group-hover:opacity-100 group-hover:blur-2xl"></div>
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-400 via-purple-500 via-pink-500 to-orange-400 rounded-[2.5rem] opacity-100 animate-glow bg-[length:300%_auto]"></div>
                    
                    <!-- Inner Dark Box -->
                    <div class="relative z-10 bg-ink rounded-[2.3rem] w-full h-full p-8 flex flex-col justify-between overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-br from-gray-800/20 to-ink/90"></div>
                        
                        <div class="relative z-20 flex justify-between items-start">
                            <!-- Sparkling AI Icon -->
                            <div class="w-14 h-14 rounded-full bg-white/10 flex items-center justify-center text-white mb-6 backdrop-blur-md border border-white/20 shadow-[0_0_20px_rgba(255,255,255,0.15)] animate-float">
                                <svg class="w-7 h-7 text-pink-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            </div>
                            <span class="text-white/20 font-display font-black text-5xl">AI</span>
                        </div>
                        <div class="relative z-20 mt-auto">
                            <h3 class="text-transparent bg-clip-text bg-gradient-to-r from-blue-200 to-pink-200 font-display font-bold text-2xl mb-2">Asisten AI Cerdas</h3>
                            <p class="text-gray-300 text-sm font-light leading-relaxed">
                                Dilengkapi kecerdasan buatan untuk menganalisis tren pesanan layaknya asisten pribadi.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Bottom Right Split Grid -->
                <div class="grid grid-cols-2 gap-6 lg:gap-8">
                    
                    <!-- Bento Box 3: Minimalist Stat -->
                    <div class="bg-accent rounded-[2rem] p-6 flex flex-col justify-center items-center text-center text-white border border-accentHover shadow-lg shadow-accent/20 relative overflow-hidden group animate-fade-in-up stagger-4 hover:scale-105 transition-transform duration-500 cursor-default">
                        <div class="absolute inset-0 bg-white/0 group-hover:bg-white/10 transition-colors duration-500"></div>
                        <span class="text-4xl lg:text-5xl font-black font-display tracking-tighter mb-1 animate-float">99%</span>
                        <span class="text-[10px] sm:text-xs font-bold uppercase tracking-widest text-white/90">Akurasi Order</span>
                    </div>

                    <!-- Bento Box 4: Visual/Graphic -->
                    <div class="bg-bento rounded-[2rem] p-6 border border-gray-200/60 shadow-sm flex items-center justify-center relative overflow-hidden group animate-fade-in-up stagger-4 hover:-translate-y-1 transition-transform duration-500">
                        <!-- Abstract Animated Geometric pattern -->
                        <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                            <div class="w-full h-full relative p-4 flex flex-col justify-center gap-2">
                                <div class="w-full h-2 bg-gray-100 rounded-full transform transition-transform duration-700 group-hover:translate-x-4"></div>
                                <div class="w-2/3 h-2 bg-gray-200 rounded-full transform transition-transform duration-700 group-hover:-translate-x-3"></div>
                                <div class="w-5/6 h-2 bg-accent/20 rounded-full transform transition-transform duration-700 group-hover:translate-x-2"></div>
                            </div>
                        </div>
                        <span class="absolute bottom-4 right-5 text-[10px] font-bold text-gray-400 uppercase tracking-widest font-display z-10 bg-white/80 px-2 py-1 rounded backdrop-blur-sm">Simpel</span>
                    </div>

                </div>
            </div>
        </div>
        
    </main>

    <!-- Footer Minimal -->
    <footer class="relative z-10 border-t border-ink/5 mt-4 py-8 text-center animate-fade-in-up stagger-4">
        <p class="text-sm font-medium text-gray-400">&copy; {{ date('Y') }} SIPEMMA. Hak Cipta Dilindungi.</p>
    </footer>

</body>
</html>
