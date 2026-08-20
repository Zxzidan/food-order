@props([
    'id' => 'item-' . uniqid(),
    'name',
    'category' => 'Makanan',
    'price' => 0,
    'stock' => 0,
    'image' => '',
    'description' => '',
])

@php
    $isOutOfStock = $stock <= 0;
    $categoryBadgeClass = $category === 'Minuman'
        ? 'bg-amber-100 text-amber-800 dark:bg-amber-900/40 dark:text-amber-300'
        : 'bg-blue-100 text-blue-800 dark:bg-blue-900/40 dark:text-blue-300';
    $unit = ($category === 'Minuman') ? 'gelas' : 'porsi';
@endphp

<div class="order-item-card group bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-2xs hover:shadow-lg transition-all duration-200 flex flex-col overflow-hidden {{ $isOutOfStock ? 'opacity-60 pointer-events-none' : '' }}"
    data-id="{{ $id }}"
    data-name="{{ $name }}"
    data-category="{{ $category }}"
    data-price="{{ $price }}"
    data-stock="{{ $stock }}"
    data-image="{{ $image }}"
    data-unit="{{ $unit }}">
    
    <!-- Image & Badges -->
    <div class="relative w-full h-36 sm:h-40 bg-gray-100 dark:bg-gray-700 overflow-hidden">
        <img src="{{ $image }}" alt="{{ $name }}"
            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
        
        <!-- Category Badge -->
        <span class="absolute top-2.5 left-2.5 {{ $categoryBadgeClass }} text-[11px] font-bold px-2.5 py-0.5 rounded-full shadow-xs">
            {{ $category }}
        </span>

        <!-- Stock Badge -->
        <div class="absolute top-2.5 right-2.5 bg-white/95 dark:bg-gray-900/95 backdrop-blur-xs px-2 py-0.5 rounded-full text-[11px] font-semibold {{ $stock <= 5 ? 'text-amber-600 dark:text-amber-400' : 'text-emerald-600 dark:text-emerald-400' }} shadow-xs flex items-center gap-1">
            <span class="w-1.5 h-1.5 rounded-full {{ $stock <= 5 ? 'bg-amber-500' : 'bg-emerald-500' }}"></span>
            <span>Stok: {{ $stock }}</span>
        </div>

        @if($isOutOfStock)
            <div class="absolute inset-0 bg-black/60 backdrop-blur-xs flex items-center justify-center">
                <span class="bg-red-600 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">Habis</span>
            </div>
        @endif
    </div>

    <!-- Content -->
    <div class="p-3.5 sm:p-4 flex-1 flex flex-col justify-between">
        <div>
            <h3 class="text-sm sm:text-base font-bold text-gray-900 dark:text-white line-clamp-1 group-hover:text-green-600 dark:group-hover:text-green-400 transition-colors">
                {{ $name }}
            </h3>
            @if($description)
                <p class="text-xs text-gray-500 dark:text-gray-400 line-clamp-1 mt-0.5">{{ $description }}</p>
            @endif
        </div>

        <div class="flex items-center justify-between mt-3 pt-2.5 border-t border-gray-100 dark:border-gray-700/60">
            <div>
                <span class="text-[10px] text-gray-400 font-medium block">Harga</span>
                <span class="text-sm sm:text-base font-bold text-gray-900 dark:text-white">
                    Rp {{ number_format($price, 0, ',', '.') }}
                </span>
            </div>

            <!-- Quick Add Button -->
            <button type="button" onclick="addToCart('{{ $id }}', '{{ addslashes($name) }}', {{ $price }}, '{{ addslashes($image) }}', {{ $stock }})"
                class="inline-flex items-center justify-center w-8 h-8 sm:w-9 sm:h-9 bg-green-600 hover:bg-green-700 active:scale-95 text-white rounded-xl shadow-xs hover:shadow-md transition-all cursor-pointer"
                title="Tambah ke Pesanan">
                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
            </button>
        </div>
    </div>
</div>
