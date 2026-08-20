<div id="add-menu-modal"
    class="hidden fixed inset-0 z-50 overflow-y-auto bg-black/60 backdrop-blur-xs flex items-center justify-center p-3 sm:p-4 md:p-6">
    <div
        class="relative w-full max-w-lg md:max-w-xl max-h-[92vh] flex flex-col my-auto bg-white dark:bg-gray-800 rounded-2xl shadow-2xl border border-gray-100 dark:border-gray-700 overflow-hidden transform transition-all">

        <!-- Modal Header -->
        <div
            class="flex items-center justify-between px-4 py-3.5 sm:px-6 sm:py-4 border-b border-gray-100 dark:border-gray-700 shrink-0">
            <div class="flex items-center gap-2.5">
                <div class="p-2 bg-green-50 dark:bg-green-900/30 rounded-lg text-green-600 dark:text-green-400 shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-base sm:text-lg font-bold text-gray-900 dark:text-white">Tambah Menu Baru</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Lengkapi formulir untuk menambah menu
                        makanan/minuman</p>
                </div>
            </div>
            <button type="button" id="btn-close-modal"
                class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 rounded-lg p-1.5 hover:bg-gray-100 dark:hover:bg-gray-700 transition cursor-pointer">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Modal Form (Scrollable body for small screens) -->
        <form id="form-tambah-menu" class="p-4 sm:p-6 space-y-4 overflow-y-auto flex-1 max-h-[calc(90vh-8.5rem)]">

            <!-- Nama Produk -->
            <div>
                <label for="input-nama-produk"
                    class="block mb-1.5 text-xs sm:text-sm font-semibold text-gray-900 dark:text-white">
                    Nama Produk <span class="text-red-500">*</span>
                </label>
                <input type="text" id="input-nama-produk" required
                    class="w-full px-3.5 py-2.5 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white text-sm rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition placeholder:text-gray-400"
                    placeholder="Contoh: Ayam Bakar Madu" />
            </div>

            <!-- Kategori & Sisa Produk (Stok) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                <div>
                    <label for="input-kategori-produk"
                        class="block mb-1.5 text-xs sm:text-sm font-semibold text-gray-900 dark:text-white">
                        Kategori Produk <span class="text-red-500">*</span>
                    </label>
                    <select id="input-kategori-produk" required
                        class="w-full px-3.5 py-2.5 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white text-sm rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition cursor-pointer">
                        <option value="Makanan">Makanan</option>
                        <option value="Minuman">Minuman</option>
                        <option value="Snack">Snack</option>
                        <option value="Dessert">Dessert</option>
                    </select>
                </div>

                <!-- Sisa Produk yang Tersedia -->
                <div>
                    <label for="input-stok-produk"
                        class="block mb-1.5 text-xs sm:text-sm font-semibold text-gray-900 dark:text-white">
                        Stok Produk <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="number" id="input-stok-produk" min="0" required
                            class="w-full pl-3.5 pr-3.5 py-2.5 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white text-sm rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition placeholder:text-gray-400"
                            placeholder="Contoh: 30" />
                    </div>
                </div>
            </div>

            <!-- Harga Produk -->
            <div>
                <label for="input-harga-produk"
                    class="block mb-1.5 text-xs sm:text-sm font-semibold text-gray-900 dark:text-white">
                    Harga Produk <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <span
                        class="absolute inset-y-0 left-0 flex items-center pl-3.5 font-semibold text-gray-500 dark:text-gray-400 text-sm pointer-events-none">
                        Rp
                    </span>
                    <input type="number" id="input-harga-produk" min="0" required
                        class="w-full pl-11 pr-3.5 py-2.5 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white text-sm rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition placeholder:text-gray-400"
                        placeholder="Contoh: 28000" />
                </div>
            </div>

            <!-- Gambar Produk (Modern Custom Upload Box) -->
            <div>
                <label class="block mb-1.5 text-xs sm:text-sm font-semibold text-gray-900 dark:text-white">
                    Gambar Produk <span class="text-red-500">*</span>
                </label>
                <div
                    class="flex flex-col sm:flex-row items-center sm:items-start gap-3 sm:gap-4 p-3.5 bg-gray-50/80 dark:bg-gray-700/50 rounded-2xl border border-gray-200/80 dark:border-gray-600/80">

                    <!-- Preview Thumbnail -->
                    <div id="image-preview-container"
                        class="w-full sm:w-28 h-32 sm:h-28 rounded-xl bg-white dark:bg-gray-800 border-2 border-dashed border-gray-300 dark:border-gray-600 flex items-center justify-center overflow-hidden shrink-0 shadow-2xs relative group">
                        <img id="image-preview" src="" alt="Preview" class="hidden w-full h-full object-cover">
                        <div id="image-placeholder-icon" class="flex flex-col items-center text-gray-400">
                            <svg class="w-8 h-8 mb-1 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span class="text-[10px] text-gray-400 font-medium">Pratinjau</span>
                        </div>
                    </div>

                    <!-- Custom Upload Trigger & URL Options -->
                    <div class="w-full flex-1 space-y-2.5">

                        <!-- Custom Styled File Upload Button -->
                        <div>
                            <input type="file" id="input-file-gambar" accept="image/*" class="sr-only" />
                            <label for="input-file-gambar"
                                class="flex items-center justify-center gap-2 w-full px-4 py-2.5 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 hover:border-green-500 dark:hover:border-green-500 rounded-xl text-xs sm:text-sm font-semibold text-gray-700 dark:text-gray-200 hover:text-green-600 dark:hover:text-green-400 hover:bg-green-50/50 dark:hover:bg-green-950/20 transition shadow-2xs cursor-pointer group">
                                <svg class="w-4 h-4 text-green-600 dark:text-green-400 group-hover:scale-110 transition-transform"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                </svg>
                                <span id="add-file-name-text" class="truncate max-w-[200px]">Pilih Foto dari
                                    Perangkat</span>
                            </label>
                            <p class="text-[10px] text-gray-400 dark:text-gray-400 mt-1 text-center sm:text-left">
                                Format: PNG, JPG, JPEG, WEBP (Maks. 5MB)</p>
                        </div>

                        <!-- Divider -->
                        <div class="flex items-center gap-2 text-[10px] font-medium text-gray-400 dark:text-gray-400">
                            <div class="h-px bg-gray-200 dark:border-gray-600 flex-1"></div>
                            <span>ATAU TAUTAN URL</span>
                            <div class="h-px bg-gray-200 dark:border-gray-600 flex-1"></div>
                        </div>

                        <!-- URL Image Input -->
                        <div class="relative">
                            <span
                                class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400 pointer-events-none">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                </svg>
                            </span>
                            <input type="url" id="input-url-gambar"
                                class="w-full pl-8 pr-3 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white text-xs rounded-xl focus:ring-1 focus:ring-green-500 placeholder:text-gray-400 transition"
                                placeholder="https://contoh.com/gambar-makanan.jpg" />
                        </div>
                    </div>
                </div>
            </div>

            <!-- Deskripsi Produk -->
            <div>
                <label for="input-deskripsi-produk"
                    class="block mb-1.5 text-xs sm:text-sm font-semibold text-gray-900 dark:text-white">
                    Deskripsi Singkat (Opsional)
                </label>
                <textarea id="input-deskripsi-produk" rows="2"
                    class="w-full px-3.5 py-2.5 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white text-sm rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition placeholder:text-gray-400"
                    placeholder="Keterangan"></textarea>
            </div>

            <!-- Actions (Responsive: full width on mobile, right-aligned on desktop) -->
            <div
                class="flex flex-col-reverse sm:flex-row items-stretch sm:items-center justify-end gap-2.5 sm:gap-3 pt-3 border-t border-gray-100 dark:border-gray-700 shrink-0">
                <button type="button" id="btn-cancel-modal"
                    class="w-full sm:w-auto px-5 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-xl transition cursor-pointer text-center">
                    Batal
                </button>
                <button type="submit"
                    class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-2.5 text-sm font-semibold text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-300 rounded-xl shadow-md transition cursor-pointer">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Simpan Menu
                </button>
            </div>
        </form>
    </div>
</div>
