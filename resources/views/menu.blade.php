<x-layout>
    <x-slot:title>
        {{ $title }}
    </x-slot:title>

    <!-- Header Actions & Search Bar (Responsive Layout) -->
    <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-3 sm:gap-4 max-w-7xl mx-auto mb-6">
        
        <!-- Search & Filter Wrapper -->
        <div class="flex-1 w-full flex shadow-xs rounded-xl overflow-hidden border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800">
            
            <!-- Category Dropdown Filter -->
            <button id="category-filter-btn" data-dropdown-toggle="category-dropdown" type="button"
                class="inline-flex items-center shrink-0 z-10 text-gray-700 dark:text-gray-300 bg-gray-50 dark:bg-gray-700 border-r border-gray-200 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-600 font-medium text-xs sm:text-sm px-3 sm:px-4 py-2.5 focus:outline-none transition cursor-pointer">
                <svg class="w-4 h-4 me-1.5 sm:me-2 text-gray-500 dark:text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                </svg>
                <span id="selected-category-text" class="truncate max-w-[90px] sm:max-w-[140px]">Semua Kategori</span>
                <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 ms-1.5 sm:ms-2 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7" />
                </svg>
            </button>
            
            <div id="category-dropdown"
                class="z-20 hidden bg-white dark:bg-gray-800 divide-y divide-gray-100 dark:divide-gray-700 rounded-xl shadow-xl w-48 border border-gray-100 dark:border-gray-700">
                <ul class="p-2 text-sm text-gray-700 dark:text-gray-200 font-medium space-y-0.5">
                    <li>
                        <button type="button" onclick="filterCategory('all', 'Semua Kategori')"
                            class="w-full text-left p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg cursor-pointer transition">Semua Kategori</button>
                    </li>
                    @foreach($categories as $category)
                    <li>
                        <button type="button" onclick="filterCategory('{{ $category->name }}', '{{ $category->name }}')"
                            class="w-full text-left p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg cursor-pointer transition">{{ $category->name }}</button>
                    </li>
                    @endforeach
                </ul>
            </div>

            <!-- Search Input -->
            <div class="relative w-full">
                <input type="search" id="search-input" onkeyup="filterMenu()"
                    class="p-2.5 w-full text-xs sm:text-sm text-gray-900 dark:text-white bg-transparent border-0 focus:ring-0 focus:outline-none placeholder-gray-400 dark:placeholder-gray-500"
                    placeholder="" />
                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Tambah Menu Button -->
        <button type="button" id="btn-open-modal"
            class="w-full sm:w-auto inline-flex items-center justify-center text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-300 font-medium rounded-xl text-sm px-5 py-2.5 shadow-sm transition hover:shadow cursor-pointer shrink-0">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Menu
        </button>
    </div>

    <!-- Toast Notification Component -->
    <x-toast />

    <!-- Section Daftar Menu -->
    <div class="mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-6">
            <div>
                <h2 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white">Daftar Menu Restoran</h2>
                <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 mt-0.5">Kelola daftar menu, harga, deskripsi, dan sisa stok yang tersedia</p>
            </div>
            <span id="menu-counter" class="self-start sm:self-auto text-xs sm:text-sm font-medium text-gray-600 dark:text-gray-300 bg-white dark:bg-gray-800 px-3 py-1.5 rounded-lg border border-gray-200 dark:border-gray-700 shadow-2xs">
                Total: {{ count($menus) }} Menu
            </span>
        </div>

        <!-- Grid Container Menu Cards (Responsive: 1 col on mobile, 2 on tablet, 3 on laptop, 4 on desktop) -->
        <div id="menu-grid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
            
            @forelse($menus as $menu)
                <x-menu.card
                    :id="'menu-' . $menu->id"
                    :name="$menu->name"
                    :category="$menu->category ? $menu->category->name : 'Makanan'"
                    :price="$menu->price"
                    :stock="$menu->stock"
                    :description="$menu->description ?? ''"
                    :image="$menu->image ? (str_starts_with($menu->image, 'http') ? $menu->image : asset($menu->image)) : 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=400'"
                    :sold="$menu->sold"
                />
            @empty
                <div class="col-span-full text-center py-12 text-gray-500">Belum ada menu di database.</div>
            @endforelse

        </div>

        <!-- Empty State -->
        <div id="no-results" class="hidden text-center py-16 px-4">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <h3 class="mt-2 text-base font-semibold text-gray-900 dark:text-white">Menu Tidak Ditemukan</h3>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Coba kata kunci lain atau periksa filter kategori.</p>
        </div>
    </div>

    <!-- Modals Components -->
    <x-menu.add-modal />
    <x-menu.edit-modal />
    <x-menu.delete-modal />

    <!-- Client-side Interactive Logic -->
    <script>
        // DOM Elements
        const addMenuModal = document.getElementById('add-menu-modal');
        const btnOpenModal = document.getElementById('btn-open-modal');
        const btnCloseModal = document.getElementById('btn-close-modal');
        const btnCancelModal = document.getElementById('btn-cancel-modal');
        const formTambahMenu = document.getElementById('form-tambah-menu');
        
        // Add image preview handlers
        const inputFileGambar = document.getElementById('input-file-gambar');
        const inputUrlGambar = document.getElementById('input-url-gambar');
        const imagePreview = document.getElementById('image-preview');
        const imagePlaceholderIcon = document.getElementById('image-placeholder-icon');
        let currentAddImageSrc = '';

        // Edit Modal DOM
        const editMenuModal = document.getElementById('edit-menu-modal');
        const btnCloseEditModal = document.getElementById('btn-close-edit-modal');
        const btnCancelEditModal = document.getElementById('btn-cancel-edit-modal');
        const formEditMenu = document.getElementById('form-edit-menu');
        const editImagePreview = document.getElementById('edit-image-preview');
        const editFileGambar = document.getElementById('edit-file-gambar');
        const editUrlGambar = document.getElementById('edit-url-gambar');
        let currentEditImageSrc = '';
        let activeEditCard = null;

        // Delete Confirm Modal DOM
        const deleteConfirmModal = document.getElementById('delete-confirm-modal');
        const btnTriggerDelete = document.getElementById('btn-trigger-delete');
        const btnCancelDelete = document.getElementById('btn-cancel-delete');
        const btnConfirmDelete = document.getElementById('btn-confirm-delete');
        const deleteMenuTitle = document.getElementById('delete-menu-title');

        // ==========================
        // Modal Handlers (Tambah Menu)
        // ==========================
        function openModal() {
            addMenuModal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            addMenuModal.classList.add('hidden');
            document.body.style.overflow = 'auto';
            formTambahMenu.reset();
            resetAddImagePreview();
        }

        function resetAddImagePreview() {
            currentAddImageSrc = '';
            imagePreview.src = '';
            imagePreview.classList.add('hidden');
            imagePlaceholderIcon.classList.remove('hidden');
            const fileNameText = document.getElementById('add-file-name-text');
            if (fileNameText) fileNameText.innerText = 'Pilih Foto dari Perangkat';
        }

        btnOpenModal.addEventListener('click', openModal);
        btnCloseModal.addEventListener('click', closeModal);
        btnCancelModal.addEventListener('click', closeModal);
        addMenuModal.addEventListener('click', function(e) {
            if (e.target === addMenuModal) closeModal();
        });

        // File image preview for Add
        inputFileGambar.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const fileNameText = document.getElementById('add-file-name-text');
                if (fileNameText) fileNameText.innerText = file.name;
                const reader = new FileReader();
                reader.onload = function(e) {
                    currentAddImageSrc = e.target.result;
                    imagePreview.src = currentAddImageSrc;
                    imagePreview.classList.remove('hidden');
                    imagePlaceholderIcon.classList.add('hidden');
                    inputUrlGambar.value = '';
                };
                reader.readAsDataURL(file);
            }
        });

        // URL image preview for Add
        inputUrlGambar.addEventListener('input', function() {
            if (this.value.trim()) {
                currentAddImageSrc = this.value.trim();
                imagePreview.src = currentAddImageSrc;
                imagePreview.classList.remove('hidden');
                imagePlaceholderIcon.classList.add('hidden');
                inputFileGambar.value = '';
                const fileNameText = document.getElementById('add-file-name-text');
                if (fileNameText) fileNameText.innerText = 'Pilih Foto dari Perangkat';
            } else if (!inputFileGambar.files[0]) {
                resetAddImagePreview();
            }
        });

        // ==========================
        // Modal Handlers (Edit Menu)
        // ==========================
        function openEditModal(button) {
            const card = button.closest('.menu-card');
            if (!card) return;

            activeEditCard = card;

            const name = card.getAttribute('data-name');
            const category = card.getAttribute('data-category');
            const price = card.getAttribute('data-price');
            const stock = card.getAttribute('data-stock');
            const description = card.getAttribute('data-description');
            const image = card.getAttribute('data-image');

            document.getElementById('edit-nama-produk').value = name;
            document.getElementById('edit-kategori-produk').value = category;
            document.getElementById('edit-harga-produk').value = price;
            document.getElementById('edit-stok-produk').value = stock;
            document.getElementById('edit-deskripsi-produk').value = description;

            currentEditImageSrc = image;
            editImagePreview.src = image;
            editUrlGambar.value = image.startsWith('http') ? image : '';
            editFileGambar.value = '';

            const editFileNameText = document.getElementById('edit-file-name-text');
            if (editFileNameText) editFileNameText.innerText = 'Ganti Foto dari Perangkat';

            document.getElementById('edit-modal-subtitle').innerText = `Mengedit menu: ${name}`;

            editMenuModal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeEditModal() {
            editMenuModal.classList.add('hidden');
            document.body.style.overflow = 'auto';
            activeEditCard = null;
            formEditMenu.reset();
            const editFileNameText = document.getElementById('edit-file-name-text');
            if (editFileNameText) editFileNameText.innerText = 'Ganti Foto dari Perangkat';
        }

        btnCloseEditModal.addEventListener('click', closeEditModal);
        btnCancelEditModal.addEventListener('click', closeEditModal);
        editMenuModal.addEventListener('click', function(e) {
            if (e.target === editMenuModal) closeEditModal();
        });

        // File image preview for Edit
        editFileGambar.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const editFileNameText = document.getElementById('edit-file-name-text');
                if (editFileNameText) editFileNameText.innerText = file.name;
                const reader = new FileReader();
                reader.onload = function(e) {
                    currentEditImageSrc = e.target.result;
                    editImagePreview.src = currentEditImageSrc;
                    editUrlGambar.value = '';
                };
                reader.readAsDataURL(file);
            }
        });

        // URL image preview for Edit
        editUrlGambar.addEventListener('input', function() {
            if (this.value.trim()) {
                currentEditImageSrc = this.value.trim();
                editImagePreview.src = currentEditImageSrc;
                editFileGambar.value = '';
                const editFileNameText = document.getElementById('edit-file-name-text');
                if (editFileNameText) editFileNameText.innerText = 'Ganti Foto dari Perangkat';
            }
        });

        // Handle Edit Form Submit
        formEditMenu.addEventListener('submit', function(e) {
            e.preventDefault();
            if (!activeEditCard) return;

            const name = document.getElementById('edit-nama-produk').value.trim();
            const category = document.getElementById('edit-kategori-produk').value;
            const price = document.getElementById('edit-harga-produk').value.trim();
            const stock = document.getElementById('edit-stok-produk').value.trim();
            const description = document.getElementById('edit-deskripsi-produk').value.trim();
            const image = currentEditImageSrc || activeEditCard.getAttribute('data-image');
            const unit = (category === 'Minuman') ? 'gelas' : 'porsi';

            // Update card data attributes
            activeEditCard.setAttribute('data-name', name);
            activeEditCard.setAttribute('data-category', category);
            activeEditCard.setAttribute('data-price', price);
            activeEditCard.setAttribute('data-stock', stock);
            activeEditCard.setAttribute('data-unit', unit);
            activeEditCard.setAttribute('data-description', description);
            activeEditCard.setAttribute('data-image', image);

            // Update DOM inside the card
            activeEditCard.querySelector('.menu-item-name').innerText = name;
            activeEditCard.querySelector('.menu-item-desc').innerText = description;
            activeEditCard.querySelector('.menu-item-price').innerText = formatRupiah(price);
            activeEditCard.querySelector('.stock-badge').innerText = `Sisa: ${stock} ${unit}`;
            activeEditCard.querySelector('.stock-num').innerText = stock;
            activeEditCard.querySelector('.menu-item-img').src = image;
            activeEditCard.querySelector('.menu-item-img').alt = name;

            // Update category badge
            const categoryBadge = activeEditCard.querySelector('.category-badge');
            categoryBadge.innerText = category;
            if (category === 'Minuman') {
                categoryBadge.className = "category-badge bg-amber-100 text-amber-800 dark:bg-amber-900/40 dark:text-amber-300 text-xs font-semibold px-2.5 py-0.5 rounded-full shrink-0";
            } else {
                categoryBadge.className = "category-badge bg-blue-100 text-blue-800 dark:bg-blue-900/40 dark:text-blue-300 text-xs font-semibold px-2.5 py-0.5 rounded-full shrink-0";
            }

            closeEditModal();
            showToast(`Menu "${name}" berhasil diperbarui!`, 'success');
        });

        // ==========================
        // Delete Product Handlers
        // ==========================
        btnTriggerDelete.addEventListener('click', function() {
            if (!activeEditCard) return;
            const name = activeEditCard.getAttribute('data-name');
            deleteMenuTitle.innerText = `"${name}"`;
            deleteConfirmModal.classList.remove('hidden');
        });

        btnCancelDelete.addEventListener('click', function() {
            deleteConfirmModal.classList.add('hidden');
        });

        deleteConfirmModal.addEventListener('click', function(e) {
            if (e.target === deleteConfirmModal) {
                deleteConfirmModal.classList.add('hidden');
            }
        });

        btnConfirmDelete.addEventListener('click', function() {
            if (!activeEditCard) return;

            const name = activeEditCard.getAttribute('data-name');
            
            // Remove card with animation
            activeEditCard.style.transition = "all 0.3s ease";
            activeEditCard.style.opacity = "0";
            activeEditCard.style.transform = "scale(0.9)";
            
            const cardToDelete = activeEditCard;
            setTimeout(() => {
                cardToDelete.remove();
                updateMenuCounter();
                filterMenu();
            }, 300);

            deleteConfirmModal.classList.add('hidden');
            closeEditModal();
            showToast(`Menu "${name}" berhasil dihapus!`, 'delete');
        });

        // ==========================
        // Add Menu Submission
        // ==========================
        formTambahMenu.addEventListener('submit', function(e) {
            e.preventDefault();

            const nama = document.getElementById('input-nama-produk').value.trim();
            const kategori = document.getElementById('input-kategori-produk').value;
            const stok = document.getElementById('input-stok-produk').value.trim();
            const harga = document.getElementById('input-harga-produk').value.trim();
            const deskripsi = document.getElementById('input-deskripsi-produk').value.trim() || 'Menu pilihan spesial yang disajikan dengan bahan berkualitas terbaik.';
            
            const imageSrc = currentAddImageSrc || 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60';
            const categoryBadgeClass = kategori === 'Minuman' 
                ? 'category-badge bg-amber-100 text-amber-800 dark:bg-amber-900/40 dark:text-amber-300' 
                : 'category-badge bg-blue-100 text-blue-800 dark:bg-blue-900/40 dark:text-blue-300';
            
            const unit = (kategori === 'Minuman') ? 'gelas' : 'porsi';
            const newId = 'menu-' + Date.now();

            // Create new Responsive Card element
            const card = document.createElement('div');
            card.className = "menu-card bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden flex flex-col hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200";
            card.setAttribute('data-id', newId);
            card.setAttribute('data-name', nama);
            card.setAttribute('data-category', kategori);
            card.setAttribute('data-price', harga);
            card.setAttribute('data-stock', stok);
            card.setAttribute('data-unit', unit);
            card.setAttribute('data-description', deskripsi);
            card.setAttribute('data-image', imageSrc);

            card.innerHTML = `
                <div class="relative w-full h-44 sm:h-48 bg-gray-100 dark:bg-gray-700 overflow-hidden group">
                    <img src="${imageSrc}" alt="${nama}"
                        class="menu-item-img w-full h-full object-cover group-hover:scale-105 transition duration-300">
                    <div class="absolute top-2.5 right-2.5 sm:top-3 sm:right-3 bg-white/95 dark:bg-gray-900/95 backdrop-blur-xs px-2.5 py-1 rounded-full text-xs font-semibold text-emerald-600 dark:text-emerald-400 shadow-xs flex items-center gap-1">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        <span class="stock-badge">Sisa: ${stok} ${unit}</span>
                    </div>
                </div>
                <div class="p-4 sm:p-5 flex-1 flex flex-col">
                    <div class="flex justify-between items-start gap-2 mb-2">
                        <h3 class="text-base sm:text-lg font-bold text-gray-900 dark:text-white menu-item-name leading-snug">${nama}</h3>
                        <span class="${categoryBadgeClass} text-xs font-semibold px-2.5 py-0.5 rounded-full shrink-0">${kategori}</span>
                    </div>
                    <p class="menu-item-desc text-xs sm:text-sm text-gray-500 dark:text-gray-400 mb-4 flex-1 line-clamp-2">${deskripsi}</p>
                    
                    <div class="flex items-center justify-between text-xs text-gray-500 dark:text-gray-400 py-2 border-t border-gray-100 dark:border-gray-700/60 mb-3">
                        <div class="flex items-center gap-1.5 text-emerald-600 dark:text-emerald-400 font-medium">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                            <span>Tersedia: <strong class="stock-num">${stok}</strong></span>
                        </div>
                        <span class="text-emerald-600 dark:text-emerald-400 font-medium">Menu Baru</span>
                    </div>

                    <div class="flex items-center justify-between mt-auto pt-1">
                        <span class="menu-item-price text-base sm:text-lg font-bold text-gray-900 dark:text-white">${formatRupiah(harga)}</span>
                        <button type="button" onclick="openEditModal(this)"
                            class="inline-flex items-center gap-1 text-blue-600 hover:text-white bg-blue-50 hover:bg-blue-600 dark:bg-blue-900/30 dark:hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-xs px-3.5 py-1.5 text-center transition cursor-pointer">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                            </svg>
                            Edit
                        </button>
                    </div>
                </div>
            `;

            const menuGrid = document.getElementById('menu-grid');
            menuGrid.prepend(card);

            closeModal();
            updateMenuCounter();
            showToast(`Menu "${nama}" berhasil ditambahkan!`, 'success');
        });

        // ==========================
        // Toast Notification Function
        // ==========================
        function showToast(message, type = 'success') {
            const toast = document.getElementById('toast-success');
            const toastMsg = document.getElementById('toast-message');
            const iconSuccess = document.getElementById('toast-icon-success');
            const iconDelete = document.getElementById('toast-icon-delete');
            const iconContainer = document.getElementById('toast-icon-container');

            toastMsg.innerText = message;

            if (type === 'delete') {
                iconSuccess.classList.add('hidden');
                iconDelete.classList.remove('hidden');
                iconContainer.className = "inline-flex items-center justify-center shrink-0 w-9 h-9 text-red-500 bg-red-100 dark:bg-red-900/50 rounded-xl";
            } else {
                iconDelete.classList.add('hidden');
                iconSuccess.classList.remove('hidden');
                iconContainer.className = "inline-flex items-center justify-center shrink-0 w-9 h-9 text-emerald-500 bg-emerald-100 dark:bg-emerald-900/50 rounded-xl";
            }

            toast.classList.remove('hidden');
            setTimeout(() => {
                toast.classList.remove('translate-y-4', 'opacity-0');
            }, 10);

            setTimeout(() => {
                toast.classList.add('translate-y-4', 'opacity-0');
                setTimeout(() => {
                    toast.classList.add('hidden');
                }, 300);
            }, 3000);
        }

        // ==========================
        // Helper Functions
        // ==========================
        function formatRupiah(number) {
            return 'Rp ' + Number(number).toLocaleString('id-ID');
        }

        function updateMenuCounter() {
            const count = document.querySelectorAll('.menu-card').length;
            document.getElementById('menu-counter').innerText = `Total: ${count} Menu`;
        }

        // Filter and Search Logic
        let activeCategory = 'all';

        function filterCategory(cat, text) {
            activeCategory = cat;
            document.getElementById('selected-category-text').innerText = text;
            const dropdown = document.getElementById('category-dropdown');
            if (dropdown) dropdown.classList.add('hidden');
            filterMenu();
        }

        function filterMenu() {
            const query = document.getElementById('search-input').value.toLowerCase();
            const cards = document.querySelectorAll('.menu-card');
            let visibleCount = 0;

            cards.forEach(card => {
                const name = (card.getAttribute('data-name') || '').toLowerCase();
                const desc = (card.getAttribute('data-description') || '').toLowerCase();
                const cat = card.getAttribute('data-category');

                const matchesQuery = name.includes(query) || desc.includes(query);
                const matchesCategory = (activeCategory === 'all' || cat === activeCategory);

                if (matchesQuery && matchesCategory) {
                    card.classList.remove('hidden');
                    visibleCount++;
                } else {
                    card.classList.add('hidden');
                }
            });

            const noResults = document.getElementById('no-results');
            if (visibleCount === 0) {
                noResults.classList.remove('hidden');
            } else {
                noResults.classList.add('hidden');
            }
        }
    </script>
</x-layout>
