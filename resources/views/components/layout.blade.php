<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100 dark:bg-gray-900">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />

    <script>
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>

    <title>@yield('title', 'Sistem Pemesanan Makanan')</title>
</head>

<body class="h-full dark:bg-gray-900 text-gray-900 dark:text-gray-100 antialiased">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>

    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>

    <div class="min-h-full flex flex-col">
        <!-- Sidebar Backdrop for Mobile -->
        <div id="sidebar-backdrop" class="fixed inset-0 z-35 bg-white/30 dark:bg-gray-900/30 backdrop-blur-md hidden sm:hidden border-r border-white/20" style="opacity: 0; transition: opacity 0.4s ease-in-out;"></div>

        <x-sidebar />
        
        <div id="main-content" class="flex-1 flex flex-col sm:ml-64 transition-all duration-300 min-w-0">
            <x-header>{{ $title }}</x-header>
            <main class="flex-1">
                <div class="px-3 py-4 sm:px-6 lg:px-8 max-w-7xl mx-auto w-full">
                    <!-- Your content -->
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>

    <!-- Global SIPEMMA AI Restaurant Assistant Chatbot -->
    <x-ai-chatbot />

    <script>
        // Theme Toggle Logic
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

        // Sidebar toggle logic (Responsive Mobile & Desktop)
        var sidebarToggleBtn = document.getElementById('sidebar-toggle-btn');
        var sidebar = document.getElementById('top-bar-sidebar');
        var mainContent = document.getElementById('main-content');
        var sidebarBackdrop = document.getElementById('sidebar-backdrop');

        function toggleSidebar() {
            if (!sidebar) return;
            if (window.innerWidth >= 640) {
                // Desktop
                sidebar.classList.toggle('sm:translate-x-0');
                sidebar.classList.toggle('sm:-translate-x-full');
                if (mainContent) mainContent.classList.toggle('sm:ml-64');
            } else {
                // Mobile
                const isClosed = sidebar.classList.contains('-translate-x-full');
                if (isClosed) {
                    sidebar.classList.remove('-translate-x-full');
                    if (sidebarBackdrop) {
                        sidebarBackdrop.classList.remove('hidden');
                        // Pastikan browser me-render display block dulu
                        requestAnimationFrame(() => {
                            requestAnimationFrame(() => {
                                sidebarBackdrop.style.opacity = '1';
                            });
                        });
                    }
                } else {
                    sidebar.classList.add('-translate-x-full');
                    if (sidebarBackdrop) {
                        sidebarBackdrop.style.opacity = '0';
                        setTimeout(() => {
                            sidebarBackdrop.classList.add('hidden');
                        }, 400); 
                    }
                }
            }
        }

        if (sidebarToggleBtn) {
            sidebarToggleBtn.addEventListener('click', toggleSidebar);
        }

        if (sidebarBackdrop) {
            sidebarBackdrop.addEventListener('click', function() {
                if (sidebar) sidebar.classList.add('-translate-x-full');
                sidebarBackdrop.style.opacity = '0';
                setTimeout(() => {
                    sidebarBackdrop.classList.add('hidden');
                }, 400);
            });
        }
    </script>
</body>

</html>
