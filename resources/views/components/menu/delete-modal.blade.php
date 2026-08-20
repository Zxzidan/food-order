<div id="delete-confirm-modal" class="hidden fixed inset-0 z-60 overflow-y-auto bg-black/70 backdrop-blur-xs flex items-center justify-center p-3 sm:p-4">
    <div class="relative w-full max-w-sm sm:max-w-md bg-white dark:bg-gray-800 rounded-2xl shadow-2xl border border-gray-100 dark:border-gray-700 p-5 sm:p-6 text-center transform transition-all my-auto">
        <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-full bg-red-100 dark:bg-red-900/40 text-red-600 dark:text-red-400 mx-auto flex items-center justify-center mb-3.5">
            <svg class="w-6 h-6 sm:w-7 sm:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
        </div>
        <h3 class="text-base sm:text-lg font-bold text-gray-900 dark:text-white mb-1.5">Hapus Menu Ini?</h3>
        <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 mb-5 leading-relaxed">
            Apakah Anda yakin ingin menghapus <strong id="delete-menu-title" class="text-gray-900 dark:text-white"></strong> dari daftar menu? Tindakan ini tidak dapat dibatalkan.
        </p>
        <div class="flex flex-col-reverse sm:flex-row items-center justify-center gap-2.5 sm:gap-3">
            <button type="button" id="btn-cancel-delete"
                class="w-full sm:w-1/2 px-4 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-xl transition cursor-pointer">
                Batal
            </button>
            <button type="button" id="btn-confirm-delete"
                class="w-full sm:w-1/2 px-4 py-2.5 text-sm font-semibold text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-300 rounded-xl shadow-md transition cursor-pointer">
                Ya, Hapus
            </button>
        </div>
    </div>
</div>
