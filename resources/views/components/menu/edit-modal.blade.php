<div id="edit-menu-modal" class="hidden fixed inset-0 z-50 overflow-y-auto bg-black/60 backdrop-blur-xs flex items-center justify-center p-3 sm:p-4 md:p-6">
    <div class="relative w-full max-w-lg md:max-w-xl max-h-[92vh] flex flex-col my-auto bg-white dark:bg-gray-800 rounded-2xl shadow-2xl border border-gray-100 dark:border-gray-700 overflow-hidden transform transition-all">
        
        <!-- Modal Header -->
        <div class="flex items-center justify-between px-4 py-3.5 sm:px-6 sm:py-4 border-b border-gray-100 dark:border-gray-700 shrink-0">
            <div class="flex items-center gap-2.5">
                <div class="p-2 bg-blue-50 dark:bg-blue-900/30 rounded-lg text-blue-600 dark:text-blue-400 shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-base sm:text-lg font-bold text-gray-900 dark:text-white">Edit Menu</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400" id="edit-modal-subtitle">Perbarui informasi, deskripsi, atau hapus menu</p>
                </div>
            </div>
            <button type="button" id="btn-close-edit-modal" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 rounded-lg p-1.5 hover:bg-gray-100 dark:hover:bg-gray-700 transition cursor-pointer">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- Modal Form (Scrollable body for small screens) -->
        <form id="form-edit-menu" class="p-4 sm:p-6 space-y-4 overflow-y-auto flex-1 max-h-[calc(90vh-8.5rem)]">
            <input type="hidden" id="edit-target-id" />

            <!-- Nama Produk -->
            <div>
                <label for="edit-nama-produk" class="block mb-1.5 text-xs sm:text-sm font-semibold text-gray-900 dark:text-white">
                    Nama Produk <span class="text-red-500">*</span>
                </label>
                <input type="text" id="edit-nama-produk" required
                    class="w-full px-3.5 py-2.5 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white text-sm rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" />
            </div>

            <!-- Kategori & Sisa Produk (Stok) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                <div>
                    <label for="edit-kategori-produk" class="block mb-1.5 text-xs sm:text-sm font-semibold text-gray-900 dark:text-white">
                        Kategori Produk <span class="text-red-500">*</span>
                    </label>
                    <select id="edit-kategori-produk" required
                        class="w-full px-3.5 py-2.5 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white text-sm rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition cursor-pointer">
                        <option value="Makanan">Makanan</option>
                        <option value="Minuman">Minuman</option>
                        <option value="Snack">Snack</option>
                        <option value="Dessert">Dessert</option>
                    </select>
                </div>

                <!-- Sisa Produk yang Tersedia -->
                <div>
                    <label for="edit-stok-produk" class="block mb-1.5 text-xs sm:text-sm font-semibold text-gray-900 dark:text-white">
                        Stok Produk <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="number" id="edit-stok-produk" min="0" required
                            class="w-full pl-3.5 pr-3.5 py-2.5 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white text-sm rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" />
                    </div>
                </div>
            </div>

            <!-- Harga Produk -->
            <div>
                <label for="edit-harga-produk" class="block mb-1.5 text-xs sm:text-sm font-semibold text-gray-900 dark:text-white">
                    Harga Produk <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 font-semibold text-gray-500 dark:text-gray-400 text-sm pointer-events-none">
                        Rp
                    </span>
                    <input type="number" id="edit-harga-produk" min="0" required
                        class="w-full pl-11 pr-3.5 py-2.5 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white text-sm rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" />
                </div>
            </div>

            <!-- Gambar Produk (Modern Custom Upload Box) -->
            <div>
                <label class="block mb-1.5 text-xs sm:text-sm font-semibold text-gray-900 dark:text-white">
                    Gambar Produk
                </label>
                <div class="flex flex-col sm:flex-row items-center sm:items-start gap-3 sm:gap-4 p-3.5 bg-gray-50/80 dark:bg-gray-700/50 rounded-2xl border border-gray-200/80 dark:border-gray-600/80">
                    <!-- Preview Thumbnail -->
                    <div class="w-full sm:w-28 h-32 sm:h-28 rounded-xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 flex items-center justify-center overflow-hidden shrink-0 shadow-2xs relative">
                        <img id="edit-image-preview" src="" alt="Preview" class="w-full h-full object-cover">
                    </div>
                    
                    <!-- Custom Upload Trigger & URL Options -->
                    <div class="w-full flex-1 space-y-2.5">
                        <!-- Custom Styled File Upload Button -->
                        <div>
                            <input type="file" id="edit-file-gambar" accept="image/*" class="sr-only" />
                            <label for="edit-file-gambar"
                                class="flex items-center justify-center gap-2 w-full px-4 py-2.5 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 hover:border-blue-500 dark:hover:border-blue-500 rounded-xl text-xs sm:text-sm font-semibold text-gray-700 dark:text-gray-200 hover:text-blue-600 dark:hover:text-blue-400 hover:bg-blue-50/50 dark:hover:bg-blue-950/20 transition shadow-2xs cursor-pointer group">
                                <svg class="w-4 h-4 text-blue-600 dark:text-blue-400 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                </svg>
                                <span id="edit-file-name-text" class="truncate max-w-[200px]">Ganti Foto dari Perangkat</span>
                            </label>
                            <p class="text-[10px] text-gray-400 dark:text-gray-400 mt-1 text-center sm:text-left">Format: PNG, JPG, JPEG, WEBP</p>
                        </div>

                        <!-- Divider -->
                        <div class="flex items-center gap-2 text-[10px] font-medium text-gray-400 dark:text-gray-400">
                            <div class="h-px bg-gray-200 dark:border-gray-600 flex-1"></div>
                            <span>ATAU TAUTAN URL</span>
                            <div class="h-px bg-gray-200 dark:border-gray-600 flex-1"></div>
                        </div>

                        <!-- URL Image Input -->
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400 pointer-events-none">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                </svg>
                            </span>
                            <input type="url" id="edit-url-gambar"
                                class="w-full pl-8 pr-3 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white text-xs rounded-lg focus:ring-1 focus:ring-blue-500 placeholder:text-gray-400 transition"
                                placeholder="Ubah URL gambar..." />
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Deskripsi Produk -->
            <div>
                <label for="edit-deskripsi-produk" class="block mb-1.5 text-xs sm:text-sm font-semibold text-gray-900 dark:text-white">
                    Deskripsi Produk
                </label>
                <textarea id="edit-deskripsi-produk" rows="3" required
                    class="w-full px-3.5 py-2.5 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white text-sm rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                    placeholder="Deskripsikan menu, bahan makanan, cita rasa..."></textarea>
            </div>

            <!-- Modal Actions (Hapus Produk & Simpan Perubahan - Responsive Stack) -->
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-3 pt-3 border-t border-gray-100 dark:border-gray-700 shrink-0">
                <button type="button" id="btn-trigger-delete"
                    class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2.5 text-sm font-semibold text-red-600 hover:text-white bg-red-50 hover:bg-red-600 dark:bg-red-900/30 dark:hover:bg-red-600 rounded-xl transition cursor-pointer">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Hapus Produk
                </button>

                <div class="flex flex-col-reverse sm:flex-row items-stretch sm:items-center gap-2 sm:gap-2.5">
                    <button type="button" id="btn-cancel-edit-modal"
                        class="w-full sm:w-auto px-5 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-xl transition cursor-pointer text-center">
                        Batal
                    </button>
                    <button type="submit"
                        class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-2.5 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 rounded-xl shadow-md transition cursor-pointer">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
