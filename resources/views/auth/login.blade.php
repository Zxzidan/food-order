<!DOCTYPE html>
<html lang="id" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - SIPEMMA</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
</head>
<body class="h-full antialiased text-gray-900 flex items-center justify-center" style="padding: 1rem; font-family: 'Inter', sans-serif;">
    
    <div class="w-full bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden" style="max-width: 340px;">
        
        <div style="padding: 2rem 1.75rem;">
            
            <div class="flex justify-center" style="margin-bottom: 1.25rem;">
                <img src="{{ asset('assets/img/LOGO.png') }}" alt="Logo SIPEMMA" class="object-contain" style="height: 3rem;">
            </div>

            <div class="text-center" style="margin-bottom: 1.5rem;">
                <h2 class="font-semibold text-gray-900" style="font-size: 1.125rem; line-height: 1.5rem;">Masuk ke SIPEMMA</h2>
            </div>

            <form action="{{ route('login') }}" method="POST">
                @csrf

                @if ($errors->any())
                    <div class="bg-red-50 border border-red-100 rounded text-red-600 font-medium" style="padding: 0.5rem; font-size: 0.75rem; margin-bottom: 1rem;">
                        {{ $errors->first() }}
                    </div>
                @endif

                <div style="margin-bottom: 1rem;">
                    <label for="email" class="block font-medium text-gray-700" style="font-size: 0.75rem; margin-bottom: 0.25rem;">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" autofocus
                        class="w-full bg-gray-50 border border-gray-200 text-gray-900 rounded-lg focus:ring-1 focus:ring-blue-600 focus:border-blue-600 outline-none transition"
                        style="padding: 0.4rem 0.6rem; font-size: 0.8125rem;"
                        placeholder="admin@sipemma.com (opsional)">
                </div>

                <div style="margin-bottom: 1rem;">
                    <label for="password" class="block font-medium text-gray-700" style="font-size: 0.75rem; margin-bottom: 0.25rem;">Kata Sandi</label>
                    <input type="password" name="password" id="password"
                        class="w-full bg-gray-50 border border-gray-200 text-gray-900 rounded-lg focus:ring-1 focus:ring-blue-600 focus:border-blue-600 outline-none transition"
                        style="padding: 0.4rem 0.6rem; font-size: 0.8125rem;"
                        placeholder="•••••••• (opsional)">
                </div>

                <div class="flex items-center justify-between" style="margin-bottom: 1.5rem;">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox" style="width: 0.875rem; height: 0.875rem; border-radius: 0.2rem;" class="text-blue-600 bg-gray-50 border-gray-300 focus:ring-blue-500 cursor-pointer">
                        <label for="remember" class="font-medium text-gray-500 cursor-pointer" style="font-size: 0.75rem; margin-left: 0.375rem;">Ingat saya</label>
                    </div>
                    <a href="#" class="font-medium text-blue-600 hover:text-blue-700" style="font-size: 0.75rem;">Lupa sandi?</a>
                </div>

                <button type="submit" class="w-full flex justify-center border border-transparent rounded-lg font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-blue-600 transition cursor-pointer" style="padding: 0.5rem; font-size: 0.8125rem;">
                    Masuk
                </button>
            </form>

            <div class="text-center text-gray-400" style="margin-top: 1.5rem; font-size: 0.7rem;">
                &copy; {{ date('Y') }} SIPEMMA
            </div>
        </div>
    </div>
</body>
</html>
