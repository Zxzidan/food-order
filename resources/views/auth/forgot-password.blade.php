<!DOCTYPE html>
<html lang="id" class="min-h-screen bg-[#F8F7F4] scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Sandi - SIPEMMA</title>
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
                <h2 class="font-display font-black text-2xl text-ink mb-1">Lupa Sandi</h2>
                <p class="text-xs font-medium text-gray-500">Masukkan email Anda untuk menerima tautan reset kata sandi</p>
            </div>

            <form action="#" method="POST" onsubmit="event.preventDefault(); alert('Tautan reset kata sandi telah dikirim ke email Anda. (Mockup)');">
                @csrf

                <div class="mb-6">
                    <label for="email" class="block font-bold text-ink text-[10px] mb-1.5 uppercase tracking-wider">Email</label>
                    <input type="email" name="email" id="email" required autofocus
                        class="w-full bg-paper border border-gray-200 text-ink rounded-xl focus:ring-2 focus:ring-accent focus:border-accent focus:bg-white outline-none transition-all py-2.5 px-3 text-sm font-medium shadow-sm hover:border-gray-300"
                        placeholder="admin@sipemma.com">
                </div>

                <button type="submit" class="w-full flex justify-center items-center py-3 px-4 border border-transparent rounded-xl font-display font-bold text-white bg-accent hover:bg-accentHover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-accent transition-all transform hover:-translate-y-0.5 shadow-lg shadow-accent/30 cursor-pointer text-sm">
                    Kirim Tautan Reset
                </button>
            </form>

            <div class="mt-6 pt-5 border-t border-ink/5 text-center">
                <p class="text-[11px] font-medium text-gray-600">
                    Sudah ingat kata sandi Anda? 
                    <a href="{{ route('login') }}" class="font-bold text-accent hover:text-accentHover transition">Masuk di sini</a>
                </p>
            </div>

            <div class="text-center text-gray-400 mt-5 text-[10px] font-medium tracking-wider uppercase">
                &copy; {{ date('Y') }} SIPEMMA
            </div>
        </div>
    </div>
</body>
</html>
