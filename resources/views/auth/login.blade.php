<!DOCTYPE html>
<html lang="id" class="h-full bg-gray-50 dark:bg-gray-900">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - SIPEMMA</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    <script>
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
</head>
<body class="h-full antialiased text-gray-900 dark:text-gray-100 flex items-center justify-center" style="padding: 1rem;">
    
    <div class="w-full bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-700 overflow-hidden relative" style="max-width: 400px;">
        
        <!-- Theme Toggle Button -->
        <button id="theme-toggle" type="button" class="absolute top-3 right-3 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none rounded-lg p-2 transition cursor-pointer">
            <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
            <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
        </button>

        <div style="padding: 2.5rem 2rem;">
            
            <div class="flex justify-center" style="margin-bottom: 1.5rem;">
                <!-- Simple Logo Area -->
                <div class="bg-blue-600 rounded-xl flex items-center justify-center shadow-md" style="width: 3rem; height: 3rem;">
                    <svg class="text-white" style="width: 1.5rem; height: 1.5rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
            </div>

            <div class="text-center" style="margin-bottom: 1.5rem;">
                <h2 class="font-bold text-gray-900 dark:text-white" style="font-size: 1.25rem; line-height: 1.75rem;">Selamat Datang</h2>
                <p class="text-gray-500 dark:text-gray-400" style="font-size: 0.875rem; margin-top: 0.25rem;">Masuk ke akun SIPEMMA Anda</p>
            </div>

            <form action="{{ route('login') }}" method="POST">
                @csrf

                @if ($errors->any())
                    <div class="bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 rounded-lg text-red-600 dark:text-red-400 font-medium" style="padding: 0.75rem; font-size: 0.875rem; margin-bottom: 1.25rem;">
                        {{ $errors->first() }}
                    </div>
                @endif

                <div style="margin-bottom: 1.25rem;">
                    <label for="email" class="block font-medium text-gray-700 dark:text-gray-300" style="font-size: 0.875rem; margin-bottom: 0.375rem;">Alamat Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                        class="w-full bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none transition"
                        style="padding: 0.5rem 0.75rem; font-size: 0.875rem;"
                        placeholder="admin@sipemma.com (opsional)">
                </div>

                <div style="margin-bottom: 1.25rem;">
                    <label for="password" class="block font-medium text-gray-700 dark:text-gray-300" style="font-size: 0.875rem; margin-bottom: 0.375rem;">Kata Sandi</label>
                    <input type="password" name="password" id="password"
                        class="w-full bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none transition"
                        style="padding: 0.5rem 0.75rem; font-size: 0.875rem;"
                        placeholder="•••••••• (opsional)">
                </div>

                <div class="flex items-center justify-between" style="margin-bottom: 1.5rem;">
                    <div class="flex items-center">
                        <!-- Custom checkbox mapping to avoid tailwind circle bug if custom forms plugin is missing -->
                        <input id="remember" name="remember" type="checkbox" style="width: 1rem; height: 1rem; border-radius: 0.25rem;" class="text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 cursor-pointer">
                        <label for="remember" class="font-medium text-gray-600 dark:text-gray-400 cursor-pointer" style="font-size: 0.875rem; margin-left: 0.5rem;">Ingat saya</label>
                    </div>
                    <a href="#" class="font-medium text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300" style="font-size: 0.875rem;">Lupa sandi?</a>
                </div>

                <button type="submit" class="w-full flex justify-center border border-transparent rounded-lg font-semibold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-600 transition cursor-pointer" style="padding: 0.5rem 1rem; font-size: 0.875rem;">
                    Masuk
                </button>
            </form>

            <div class="text-center text-gray-500 dark:text-gray-400" style="margin-top: 2rem; font-size: 0.75rem;">
                &copy; {{ date('Y') }} SIPEMMA Restaurant. All rights reserved.
            </div>
        </div>
    </div>

    <script>
        var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');
        var themeToggleBtn = document.getElementById('theme-toggle');

        if (themeToggleDarkIcon && themeToggleLightIcon && themeToggleBtn) {
            if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                themeToggleLightIcon.classList.remove('hidden');
            } else {
                themeToggleDarkIcon.classList.remove('hidden');
            }

            themeToggleBtn.addEventListener('click', function() {
                themeToggleDarkIcon.classList.toggle('hidden');
                themeToggleLightIcon.classList.toggle('hidden');

                if (localStorage.getItem('color-theme')) {
                    if (localStorage.getItem('color-theme') === 'light') {
                        document.documentElement.classList.add('dark');
                        localStorage.setItem('color-theme', 'dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                        localStorage.setItem('color-theme', 'light');
                    }
                } else {
                    if (document.documentElement.classList.contains('dark')) {
                        document.documentElement.classList.remove('dark');
                        localStorage.setItem('color-theme', 'light');
                    } else {
                        document.documentElement.classList.add('dark');
                        localStorage.setItem('color-theme', 'dark');
                    }
                }
            });
        }
    </script>
</body>
</html>
