<header class="relative bg-white dark:bg-gray-800 shadow-sm border-b border-gray-100 dark:border-gray-700 z-30">
    <div class="px-4 py-4 sm:px-6 lg:px-8 flex justify-between items-center min-h-[72px]">
        <div class="flex items-center gap-3 sm:gap-4">
            <button id="sidebar-toggle-btn" type="button" class="inline-flex items-center p-2.5 text-sm text-gray-500 rounded-xl hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600 cursor-pointer">
                <span class="sr-only">Buka menu sidebar</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                   <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                </svg>
            </button>
            <h1 class="text-2xl sm:text-3xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $slot }}</h1>
        </div>
        <div class="flex items-center space-x-2 sm:space-x-3">
            <!-- AI Assistant Header Shortcut Button -->
            <button type="button" onclick="toggleAIChat()" title="Buka SIPEMMA Assistant"
                class="inline-flex items-center gap-1.5 px-3 py-2 text-xs font-semibold bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 border border-gray-200 dark:border-gray-600 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-xl transition cursor-pointer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                </svg>
                <span class="hidden sm:inline">Assistant</span>
            </button>

            <button id="theme-toggle" type="button" class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-xl p-2.5 sm:p-3 transition cursor-pointer">
                <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
            </button>
            <div class="relative">
              <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600 cursor-pointer" aria-expanded="false" data-dropdown-toggle="dropdown-user" data-dropdown-placement="bottom-end">
                <span class="sr-only">Buka menu pengguna</span>
                <div class="relative w-10 h-10 sm:w-11 sm:h-11 overflow-hidden bg-gray-200 rounded-full dark:bg-gray-600 ring-2 ring-gray-200 dark:ring-gray-700">
                  <svg class="absolute w-12 h-12 text-gray-400 -left-1 top-0 sm:top-0.5 sm:-left-0.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                </div>
              </button>
            </div>
            <div class="z-50 hidden bg-white dark:bg-gray-800 divide-y divide-gray-100 dark:divide-gray-700 border border-gray-100 dark:border-gray-700 rounded-2xl shadow-xl w-56" id="dropdown-user">
              <div class="px-4 py-3" role="none">
                <p class="text-sm font-semibold text-gray-900 dark:text-white" role="none">
                  Admin Resto
                </p>
                <p class="text-xs text-gray-500 dark:text-gray-400 truncate" role="none">
                  admin@sipemma.com
                </p>
              </div>
              <ul class="p-2 text-sm text-gray-700 dark:text-gray-200 font-medium space-y-0.5" role="none">
                <li>
                  <a href="/" class="inline-flex items-center w-full p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition" role="menuitem">Dashboard</a>
                </li>
                <li>
                  <a href="/menu" class="inline-flex items-center w-full p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition" role="menuitem">Menu</a>
                </li>
                <li>
                  <a href="/order" class="inline-flex items-center w-full p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition" role="menuitem">Order</a>
                </li>
                <li>
                  <a href="#" class="inline-flex items-center w-full p-2 text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-lg transition" role="menuitem">Keluar</a>
                </li>
              </ul>
            </div>
        </div>
    </div>
</header>
