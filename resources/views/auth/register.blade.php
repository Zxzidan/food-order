<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-50 scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - SIPEMMA</title>
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
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .hero-pattern {
            background-color: #f8fafc;
            background-image: radial-gradient(#e2e8f0 1px, transparent 1px);
            background-size: 20px 20px;
        }
    </style>
</head>
<body class="min-h-screen antialiased text-slate-900 flex items-center justify-center font-sans hero-pattern p-4 relative overflow-x-hidden">
    
    <div class="fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full max-w-2xl pointer-events-none z-0">
        <div class="absolute top-10 left-10 w-72 h-72 bg-blue-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30"></div>
        <div class="absolute bottom-10 right-10 w-72 h-72 bg-indigo-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30"></div>
    </div>

    <div class="w-full max-w-[360px] mx-auto bg-white/80 backdrop-blur-xl rounded-2xl shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden relative z-10 transition-all hover:shadow-2xl hover:shadow-primary-600/10">
        
        <div class="p-6 sm:p-7">
            
            <div class="flex justify-center mb-5">
                <a href="{{ route('landing') }}" class="group">
                    <img src="{{ asset('assets/img/LOGO.png') }}" alt="Logo SIPEMMA" class="object-contain h-10 transform transition-transform group-hover:scale-110">
                </a>
            </div>

            <div class="text-center mb-6">
                <h2 class="font-extrabold text-xl text-slate-900 mb-1">Daftar SIPEMMA</h2>
                <p class="text-[11px] font-medium text-slate-500">Buat akun baru untuk mengelola restoran</p>
            </div>

            <form action="{{ route('register') }}" method="POST">
                @csrf

                @if ($errors->any())
                    <div class="bg-red-50 border border-red-100 rounded-xl text-red-600 font-semibold p-2.5 text-[11px] mb-4 shadow-sm text-left">
                        <ul class="list-disc pl-4 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="mb-3.5">
                    <label for="name" class="block font-bold text-slate-700 text-[10px] mb-1 uppercase tracking-wider">Nama Lengkap</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus
                        class="w-full bg-slate-50 border border-slate-200 text-slate-900 rounded-xl focus:ring-2 focus:ring-primary-600 focus:border-primary-600 focus:bg-white outline-none transition-all py-2 px-3 text-[13px] font-medium shadow-sm hover:border-slate-300"
                        placeholder="John Doe">
                </div>

                <div class="mb-3.5">
                    <label for="email" class="block font-bold text-slate-700 text-[10px] mb-1 uppercase tracking-wider">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                        class="w-full bg-slate-50 border border-slate-200 text-slate-900 rounded-xl focus:ring-2 focus:ring-primary-600 focus:border-primary-600 focus:bg-white outline-none transition-all py-2 px-3 text-[13px] font-medium shadow-sm hover:border-slate-300"
                        placeholder="john@example.com">
                </div>

                <div class="mb-3.5">
                    <label for="password" class="block font-bold text-slate-700 text-[10px] mb-1 uppercase tracking-wider">Kata Sandi</label>
                    <input type="password" name="password" id="password" required
                        class="w-full bg-slate-50 border border-slate-200 text-slate-900 rounded-xl focus:ring-2 focus:ring-primary-600 focus:border-primary-600 focus:bg-white outline-none transition-all py-2 px-3 text-[13px] font-medium shadow-sm hover:border-slate-300"
                        placeholder="Min. 8 karakter">
                </div>

                <div class="mb-6">
                    <label for="password_confirmation" class="block font-bold text-slate-700 text-[10px] mb-1 uppercase tracking-wider">Konfirmasi Kata Sandi</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                        class="w-full bg-slate-50 border border-slate-200 text-slate-900 rounded-xl focus:ring-2 focus:ring-primary-600 focus:border-primary-600 focus:bg-white outline-none transition-all py-2 px-3 text-[13px] font-medium shadow-sm hover:border-slate-300"
                        placeholder="Ulangi kata sandi">
                </div>

                <button type="submit" class="w-full flex justify-center items-center py-2.5 px-4 border border-transparent rounded-xl font-bold text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-600 transition-all transform hover:-translate-y-0.5 shadow-lg shadow-primary-600/30 cursor-pointer text-sm">
                    Daftar Sekarang
                </button>
            </form>

            <div class="mt-6 pt-4 border-t border-slate-100 text-center">
                <p class="text-[11px] font-medium text-slate-600">
                    Sudah punya akun? 
                    <a href="{{ route('login') }}" class="font-bold text-primary-600 hover:text-primary-700 transition">Masuk di sini</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
