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

<body class="h-full dark:bg-gray-900 text-gray-900 dark:text-gray-100">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>

    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>

    <div class="min-h-full">
       <x-sidebar />
       
       <div id="main-content" class="sm:ml-64 transition-all duration-300">
           <x-header>{{ $title }}</x-header>
           <main>
               <div class="w-full px-4 py-6 sm:px-6 lg:px-8">
                   <!-- Your content -->
                   {{ $slot }}
               </div>
           </main>
       </div>
    </div>

    <script>
        var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');
        var themeToggleBtn = document.getElementById('theme-toggle');

        if (themeToggleDarkIcon && themeToggleLightIcon && themeToggleBtn) {
            // Change the icons inside the button based on previous settings
            if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                themeToggleLightIcon.classList.remove('hidden');
            } else {
                themeToggleDarkIcon.classList.remove('hidden');
            }

            themeToggleBtn.addEventListener('click', function() {
                // toggle icons inside button
                themeToggleDarkIcon.classList.toggle('hidden');
                themeToggleLightIcon.classList.toggle('hidden');

                // if set via local storage previously
                if (localStorage.getItem('color-theme')) {
                    if (localStorage.getItem('color-theme') === 'light') {
                        document.documentElement.classList.add('dark');
                        localStorage.setItem('color-theme', 'dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                        localStorage.setItem('color-theme', 'light');
                    }

                // if NOT set via local storage previously
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

        // Sidebar toggle logic
        var sidebarToggleBtn = document.getElementById('sidebar-toggle-btn');
        var sidebar = document.getElementById('top-bar-sidebar');
        var mainContent = document.getElementById('main-content');

        if (sidebarToggleBtn && sidebar && mainContent) {
            sidebarToggleBtn.addEventListener('click', function(e) {
                if (window.innerWidth >= 640) {
                    // Desktop
                    sidebar.classList.toggle('sm:translate-x-0');
                    sidebar.classList.toggle('sm:-translate-x-full');
                    mainContent.classList.toggle('sm:ml-64');
                } else {
                    // Mobile
                    sidebar.classList.toggle('-translate-x-full');
                }
            });
        }
    </script>
</body>

</html>
