<!DOCTYPE html>
<html lang="id" class="min-h-screen bg-[#F8F7F4] scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - SIPEMMA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/sf-pro.css') }}">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"SF Pro"', '"SF Pro Display"', '-apple-system', 'BlinkMacSystemFont', 'sans-serif'],
                        display: ['"SF Pro Display"', '"SF Pro"', '-apple-system', 'BlinkMacSystemFont', 'sans-serif'],
                    },
                    colors: {
                        paper: '#F8F7F4',
                        ink: '#1A1A1A',
                        accent: '#E65C00',
                        accentHover: '#CC5200',
                    }
                }
            }
        }
    </script>
    <style>
        .bg-dots {
            background-image: radial-gradient(#1A1A1A 1px, transparent 1px);
            background-size: 24px 24px;
            opacity: 0.05;
        }
    </style>
</head>
<body class="min-h-screen antialiased text-ink flex items-center justify-center font-sans p-4 relative overflow-x-hidden selection:bg-accent selection:text-white bg-paper">
    
    <!-- Background Dots -->
    <div class="fixed inset-0 bg-dots pointer-events-none z-0"></div>

    <div class="w-full max-w-[340px] mx-auto bg-white rounded-[1.5rem] shadow-xl shadow-ink/5 border border-ink/5 overflow-hidden relative z-10 transition-all hover:shadow-2xl hover:shadow-accent/10">
        
        <div class="p-6 sm:p-8">
            
            <div class="flex justify-center mb-6">
                <a href="{{ route('landing') }}" class="group">
                    <img src="{{ asset('assets/img/LOGO.png') }}" alt="Logo SIPEMMA" class="object-contain h-10 transform transition-transform group-hover:scale-110">
                </a>
            </div>

            <div class="text-center mb-6">
                <h2 class="font-display font-black text-2xl text-ink mb-1">Masuk</h2>
                <p class="text-xs font-medium text-gray-500">Silakan masuk ke akun SIPEMMA Anda</p>
            </div>

            <form action="{{ route('login') }}" method="POST">
                @csrf

                @if (session('status'))
                    <div class="bg-green-50 border border-green-100 rounded-xl text-green-600 font-semibold p-2.5 text-xs mb-4 shadow-sm text-center">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="bg-red-50 border border-red-100 rounded-xl text-red-600 font-semibold p-2.5 text-xs mb-4 shadow-sm text-center">
                        {{ $errors->first() }}
                    </div>
                @endif

                <div class="mb-4">
                    <label for="email" class="block font-bold text-ink text-[10px] mb-1.5 uppercase tracking-wider">Email atau Username</label>
                    <input type="text" name="email" id="email" value="{{ old('email') }}" autofocus required
                        class="w-full bg-paper border border-gray-200 text-ink rounded-xl focus:ring-2 focus:ring-accent focus:border-accent focus:bg-white outline-none transition-all py-2.5 px-3 text-sm font-medium shadow-sm hover:border-gray-300"
                        placeholder="admin@sipemma.com">
                </div>

                <div class="mb-5">
                    <label for="password" class="block font-bold text-ink text-[10px] mb-1.5 uppercase tracking-wider">Kata Sandi</label>
                    <div class="relative flex items-center">
                        <input type="password" name="password" id="password" required
                            class="w-full bg-paper border border-gray-200 text-ink rounded-xl focus:ring-2 focus:ring-accent focus:border-accent focus:bg-white outline-none transition-all py-2.5 pl-3 pr-10 text-sm font-medium shadow-sm hover:border-gray-300"
                            placeholder="••••••••">
                        <button type="button" onclick="togglePasswordVisibility('password', this)" class="absolute right-3 p-1 text-gray-400 hover:text-ink focus:outline-none transition-colors" title="Lihat kata sandi" aria-label="Lihat kata sandi">
                            <svg class="eye-icon w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <svg class="eye-slash-icon w-4 h-4 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox" class="w-3.5 h-3.5 rounded text-accent bg-paper border-gray-300 focus:ring-accent focus:ring-2 cursor-pointer transition">
                        <label for="remember" class="font-semibold text-gray-600 cursor-pointer text-[11px] ml-2 select-none">Ingat saya</label>
                    </div>
                    <a href="{{ route('password.request') }}" class="font-bold text-accent hover:text-accentHover text-[11px] transition">Lupa sandi?</a>
                </div>

                <button type="submit" class="w-full flex justify-center items-center py-3 px-4 border border-transparent rounded-xl font-display font-bold text-white bg-accent hover:bg-accentHover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-accent transition-all transform hover:-translate-y-0.5 shadow-lg shadow-accent/30 cursor-pointer text-sm">
                    Masuk ke Sistem
                </button>
            </form>

            <div class="mt-6 pt-5 border-t border-ink/5 text-center">
                <p class="text-[11px] font-medium text-gray-600">
                    Belum punya akun? 
                    <a href="{{ route('register') }}" class="font-bold text-accent hover:text-accentHover transition">Daftar di sini</a>
                </p>
            </div>

            <div class="text-center text-gray-400 mt-5 text-[10px] font-medium tracking-wider uppercase">
                &copy; {{ date('Y') }} SIPEMMA
            </div>
        </div>
    </div>
    <script>
        function togglePasswordVisibility(inputId, btn) {
            const input = document.getElementById(inputId);
            if (!input) return;
            const isPassword = input.type === 'password';
            input.type = isPassword ? 'text' : 'password';
            
            const eyeIcon = btn.querySelector('.eye-icon');
            const eyeSlashIcon = btn.querySelector('.eye-slash-icon');
            
            if (eyeIcon && eyeSlashIcon) {
                if (isPassword) {
                    eyeIcon.classList.add('hidden');
                    eyeSlashIcon.classList.remove('hidden');
                    btn.setAttribute('title', 'Sembunyikan kata sandi');
                    btn.setAttribute('aria-label', 'Sembunyikan kata sandi');
                } else {
                    eyeIcon.classList.remove('hidden');
                    eyeSlashIcon.classList.add('hidden');
                    btn.setAttribute('title', 'Lihat kata sandi');
                    btn.setAttribute('aria-label', 'Lihat kata sandi');
                }
            }
        }
    </script>
</body>
</html>
