<aside id="top-bar-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
    aria-label="Sidebar">
    <div
        class="h-full px-3 py-4 overflow-y-auto bg-neutral-primary-soft dark:bg-gray-800 border-e border-default dark:border-gray-700">
        <a href="/" class="flex items-center ps-2.5 mb-5">
            <img src="{{ asset('assets/img/LOGO.png') }}" class="h-13 me-3 dark:brightness-0 dark:invert" alt="Logo" />
            <span
                class="self-center text-2xl text-heading dark:text-white font-semibold whitespace-nowrap">SIPEMMA</span>
        </a>
        <ul class="space-y-2 font-medium">
            <li>
                <a href="/dashboard"
                    class="flex items-center px-2 py-1.5 text-body rounded-base hover:bg-neutral-tertiary dark:hover:bg-gray-700 hover:text-fg-brand dark:text-gray-300 dark:hover:text-white group">
                    <svg class="w-5 h-5 transition duration-75 group-hover:text-fg-brand" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 6.025A7.5 7.5 0 1 0 17.975 14H10V6.025Z" />
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13.5 3c-.169 0-.334.014-.5.025V11h7.975c.011-.166.025-.331.025-.5A7.5 7.5 0 0 0 13.5 3Z" />
                    </svg>
                    <span class="ms-3">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="/menu"
                    class="flex items-center px-2 py-1.5 text-body rounded-base hover:bg-neutral-tertiary dark:hover:bg-gray-700 hover:text-fg-brand dark:text-gray-300 dark:hover:text-white group">
                    <svg class="shrink-0 w-5 h-5 transition duration-75 group-hover:text-fg-brand" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 5v14M9 5v14M4 5h16a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1Z" />
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Menu</span>
                </a>
            </li>
            <li>
                <a href="/order"
                    class="flex items-center px-2 py-1.5 text-body rounded-base hover:bg-neutral-tertiary dark:hover:bg-gray-700 hover:text-fg-brand dark:text-gray-300 dark:hover:text-white group">
                    <svg class="shrink-0 w-5 h-5 transition duration-75 group-hover:text-fg-brand" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 13h3.439a.991.991 0 0 1 .908.6 3.978 3.978 0 0 0 7.306 0 .99.99 0 0 1 .908-.6H20M4 13v6a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-6M4 13l2-9h12l2 9M9 7h6m-7 3h8" />
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Orders</span>
                    <span
                        class="inline-flex items-center justify-center w-4.5 h-4.5 ms-2 text-xs font-medium text-fg-danger-strong bg-danger-soft border border-danger-subtle rounded-full">2</span>
                </a>
            </li>
            <li>
                <a href="/reports"
                    class="flex items-center px-2 py-1.5 text-body rounded-base hover:bg-neutral-tertiary dark:hover:bg-gray-700 hover:text-fg-brand dark:text-gray-300 dark:hover:text-white group">
                    <svg class="shrink-0 w-5 h-5 transition duration-75 group-hover:text-fg-brand" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3v18h18M7 16v-3m5 3V9m5 7V5" />
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Reports</span>
                </a>
            </li>
            <li>
                <a href="/history"
                    class="flex items-center px-2 py-1.5 text-body rounded-base hover:bg-neutral-tertiary dark:hover:bg-gray-700 hover:text-fg-brand dark:text-gray-300 dark:hover:text-white group">
                    <svg class="shrink-0 w-5 h-5 transition duration-75 group-hover:text-fg-brand" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 10V6a3 3 0 0 1 3-3v0a3 3 0 0 1 3 3v4m3-2 .917 11.923A1 1 0 0 1 17.92 21H6.08a1 1 0 0 1-.997-1.077L6 8h12Z" />
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">History</span>
                </a>
            </li>
            <li>
                <button type="button" onclick="toggleAIChat()"
                    class="w-full flex items-center px-2 py-1.5 text-body rounded-base hover:bg-neutral-tertiary dark:hover:bg-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-white group cursor-pointer text-left">
                    <svg class="shrink-0 w-5 h-5 text-purple-600 dark:text-purple-400 transition duration-75 group-hover:scale-110"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z" />
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap font-semibold text-indigo-600 dark:text-indigo-400">AI
                        Assistant</span>
                </button>
            </li>

            <li>
                <a href="#"
                    class="flex items-center px-2 py-1.5 text-body rounded-base hover:bg-neutral-tertiary dark:hover:bg-gray-700 hover:text-fg-brand dark:text-gray-300 dark:hover:text-white group">
                    <svg class="shrink-0 w-5 h-5 transition duration-75 group-hover:text-fg-brand" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 12H4m12 0-4 4m4-4-4-4m3-4h2a3 3 0 0 1 3 3v10a3 3 0 0 1-3 3h-2" />
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Logout</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
