<!DOCTYPE html>
<html lang="id" class="min-h-screen bg-[#F8F7F4] scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - SIPEMMA</title>
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
    
    <div class="fixed inset-0 bg-dots pointer-events-none z-0"></div>

    <div class="w-full max-w-[360px] mx-auto bg-white rounded-[1.5rem] shadow-xl shadow-ink/5 border border-ink/5 overflow-hidden relative z-10 transition-all hover:shadow-2xl hover:shadow-accent/10">
        
        <div class="p-6 sm:p-8">
            
            <div class="flex justify-center mb-6">
                <a href="{{ route('landing') }}" class="group">
                    <img src="{{ asset('assets/img/LOGO.png') }}" alt="Logo SIPEMMA" class="object-contain h-10 transform transition-transform group-hover:scale-110">
                </a>
            </div>

            <div class="text-center mb-6">
                <h2 class="font-display font-black text-2xl text-ink mb-1">Daftar</h2>
                <p class="text-[11px] font-medium text-gray-500">Buat akun baru untuk mengelola restoran</p>
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
                    <label for="name" class="block font-bold text-ink text-[10px] mb-1 uppercase tracking-wider">Nama Lengkap</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus
                        class="w-full bg-paper border border-gray-200 text-ink rounded-xl focus:ring-2 focus:ring-accent focus:border-accent focus:bg-white outline-none transition-all py-2 px-3 text-[13px] font-medium shadow-sm hover:border-gray-300"
                        placeholder="John Doe">
                </div>

                <div class="mb-3.5">
                    <label for="email" class="block font-bold text-ink text-[10px] mb-1 uppercase tracking-wider">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                        class="w-full bg-paper border border-gray-200 text-ink rounded-xl focus:ring-2 focus:ring-accent focus:border-accent focus:bg-white outline-none transition-all py-2 px-3 text-[13px] font-medium shadow-sm hover:border-gray-300"
                        placeholder="john@example.com">
                </div>

                <div class="mb-3.5">
                    <label for="password" class="block font-bold text-ink text-[10px] mb-1 uppercase tracking-wider">Kata Sandi</label>
                    <input type="password" name="password" id="password" required
                        class="w-full bg-paper border border-gray-200 text-ink rounded-xl focus:ring-2 focus:ring-accent focus:border-accent focus:bg-white outline-none transition-all py-2 px-3 text-[13px] font-medium shadow-sm hover:border-gray-300"
                        placeholder="Min. 8 karakter">
                </div>

                <div class="mb-6">
                    <label for="password_confirmation" class="block font-bold text-ink text-[10px] mb-1 uppercase tracking-wider">Konfirmasi Kata Sandi</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                        class="w-full bg-paper border border-gray-200 text-ink rounded-xl focus:ring-2 focus:ring-accent focus:border-accent focus:bg-white outline-none transition-all py-2 px-3 text-[13px] font-medium shadow-sm hover:border-gray-300"
                        placeholder="Ulangi kata sandi">
                </div>

                <button type="submit" class="w-full flex justify-center items-center py-2.5 px-4 border border-transparent rounded-xl font-display font-bold text-white bg-accent hover:bg-accentHover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-accent transition-all transform hover:-translate-y-0.5 shadow-lg shadow-accent/30 cursor-pointer text-sm">
                    Daftar Sekarang
                </button>
            </form>

            <div class="mt-6 pt-4 border-t border-ink/5 text-center">
                <p class="text-[11px] font-medium text-gray-600">
                    Sudah punya akun? 
                    <a href="{{ route('login') }}" class="font-bold text-accent hover:text-accentHover transition">Masuk di sini</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
