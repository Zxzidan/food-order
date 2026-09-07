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
                <h2 class="font-display font-black text-2xl text-ink mb-1">Reset Sandi</h2>
                <p class="text-xs font-medium text-gray-500">Silakan buat kata sandi baru Anda</p>
            </div>

            <form action="{{ route('password.update') }}" method="POST">
                @csrf

                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                @if ($errors->any())
                    <div class="bg-red-50 border border-red-100 rounded-xl text-red-600 font-semibold p-2.5 text-xs mb-4 shadow-sm text-center">
                        {{ $errors->first() }}
                    </div>
                @endif

                <div class="mb-4">
                    <label for="email" class="block font-bold text-ink text-[10px] mb-1.5 uppercase tracking-wider">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $request->email) }}" autofocus readonly
                        class="w-full bg-gray-100 border border-gray-200 text-gray-500 rounded-xl outline-none py-2.5 px-3 text-sm font-medium shadow-sm">
                </div>

                <div class="mb-4">
                    <label for="password" class="block font-bold text-ink text-[10px] mb-1.5 uppercase tracking-wider">Kata Sandi Baru</label>
                    <input type="password" name="password" id="password" required
                        class="w-full bg-paper border border-gray-200 text-ink rounded-xl focus:ring-2 focus:ring-accent focus:border-accent focus:bg-white outline-none transition-all py-2.5 px-3 text-sm font-medium shadow-sm hover:border-gray-300"
                        placeholder="Min. 8 karakter">
                </div>

                <div class="mb-6">
                    <label for="password_confirmation" class="block font-bold text-ink text-[10px] mb-1.5 uppercase tracking-wider">Konfirmasi Kata Sandi Baru</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                        class="w-full bg-paper border border-gray-200 text-ink rounded-xl focus:ring-2 focus:ring-accent focus:border-accent focus:bg-white outline-none transition-all py-2.5 px-3 text-sm font-medium shadow-sm hover:border-gray-300"
                        placeholder="Ulangi kata sandi baru">
                </div>

                <button type="submit" class="w-full flex justify-center items-center py-3 px-4 border border-transparent rounded-xl font-display font-bold text-white bg-accent hover:bg-accentHover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-accent transition-all transform hover:-translate-y-0.5 shadow-lg shadow-accent/30 cursor-pointer text-sm">
                    Simpan Kata Sandi Baru
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
</body>
</html>
