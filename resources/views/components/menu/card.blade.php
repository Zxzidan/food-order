@props([
    'id' => 'menu-' . uniqid(),
    'name',
    'category' => 'Makanan',
    'price' => 0,
    'stock' => 0,
    'unit' => null,
    'description' => '',
    'image' => '',
    'sold' => null,
])

@php
    $calculatedUnit = $unit ?? ($category === 'Minuman' ? 'gelas' : 'porsi');
    $categoryBadgeClass = $category === 'Minuman'
        ? 'category-badge bg-amber-100 text-amber-800 dark:bg-amber-900/40 dark:text-amber-300 text-xs font-semibold px-2.5 py-0.5 rounded-full'
        : 'category-badge bg-blue-100 text-blue-800 dark:bg-blue-900/40 dark:text-blue-300 text-xs font-semibold px-2.5 py-0.5 rounded-full';
@endphp

<div class="menu-card bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden flex flex-col hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200"
    data-id="{{ $id }}"
    data-name="{{ $name }}"
    data-category="{{ $category }}"
    data-price="{{ $price }}"
    data-stock="{{ $stock }}"
    data-unit="{{ $calculatedUnit }}"
    data-description="{{ $description }}"
    data-image="{{ $image }}">
    
    <!-- Image & Stock Badge -->
    <div class="relative w-full h-44 sm:h-48 bg-gray-100 dark:bg-gray-700 overflow-hidden group">
        <img src="{{ $image }}" alt="{{ $name }}"
            class="menu-item-img w-full h-full object-cover group-hover:scale-105 transition duration-300">
        <div class="absolute top-2.5 right-2.5 sm:top-3 sm:right-3 bg-white/95 dark:bg-gray-900/95 backdrop-blur-xs px-2.5 py-1 rounded-full text-xs font-semibold text-emerald-600 dark:text-emerald-400 shadow-xs flex items-center gap-1">
            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
            <span class="stock-badge">Sisa: {{ $stock }} {{ $calculatedUnit }}</span>
        </div>
    </div>

    <!-- Content -->
    <div class="p-4 sm:p-5 flex-1 flex flex-col">
        <div class="flex justify-between items-start gap-2 mb-2">
            <h3 class="text-base sm:text-lg font-bold text-gray-900 dark:text-white menu-item-name leading-snug">{{ $name }}</h3>
            <span class="{{ $categoryBadgeClass }} shrink-0">{{ $category }}</span>
        </div>
        <p class="menu-item-desc text-xs sm:text-sm text-gray-500 dark:text-gray-400 mb-4 flex-1 line-clamp-2">{{ $description }}</p>
        
        <!-- Stock Details & Sales -->
        <div class="flex items-center justify-between text-xs text-gray-500 dark:text-gray-400 py-2 border-t border-gray-100 dark:border-gray-700/60 mb-3">
            <div class="flex items-center gap-1.5 text-emerald-600 dark:text-emerald-400 font-medium">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
                <span>Tersedia: <strong class="stock-num">{{ $stock }}</strong></span>
            </div>
            @if($sold)
                <span class="text-gray-400 dark:text-gray-500">Terjual {{ $sold }}</span>
            @else
                <span class="text-emerald-600 dark:text-emerald-400 font-medium">Menu Baru</span>
            @endif
        </div>

        <!-- Price & Action Button -->
        <div class="flex items-center justify-between mt-auto pt-1">
            <span class="menu-item-price text-base sm:text-lg font-bold text-gray-900 dark:text-white">Rp {{ number_format($price, 0, ',', '.') }}</span>
            <button type="button" onclick="openEditModal(this)"
                class="inline-flex items-center gap-1 text-blue-600 hover:text-white bg-blue-50 hover:bg-blue-600 dark:bg-blue-900/30 dark:hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-xs px-3.5 py-1.5 text-center transition cursor-pointer">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                </svg>
                Edit
            </button>
        </div>
    </div>
</div>
