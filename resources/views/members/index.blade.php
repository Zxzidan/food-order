<x-layout>
    <x-slot:title>
        {{ $title }}
    </x-slot:title>

    <!-- Header & Action Row -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white flex items-center gap-2.5">
                <svg class="w-7 h-7 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2M9 10a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm14 10v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75" />
                </svg>
                Manajemen Member & Loyalty Poin
            </h1>
            <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 mt-1">Kelola data pelanggan terdaftar, pantau akumulasi saldo poin, dan riwayat penukaran</p>
        </div>

        <div class="flex items-center gap-3">
            <button type="button" onclick="openAddMemberModal()"
                class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-green-600 hover:bg-green-700 active:scale-95 text-white text-xs sm:text-sm font-semibold rounded-xl shadow-xs hover:shadow-md transition cursor-pointer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                </svg>
                <span>Daftar Member Baru</span>
            </button>
        </div>
    </div>

    <!-- Alert Success & Error -->
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 rounded-2xl flex items-center gap-3 text-green-700 dark:text-green-300 text-sm font-medium">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            <p>{{ session('success') }}</p>
        </div>
    @endif
    @if(session('error'))
        <div class="mb-6 p-4 bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 rounded-2xl flex items-center gap-3 text-red-700 dark:text-red-300 text-sm font-medium">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            <p>{{ session('error') }}</p>
        </div>
    @endif

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <!-- Card 1: Total Member -->
        <div class="p-4 bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-2xs">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400">Total Member</p>
                    <h3 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white mt-1">{{ number_format($stats['total_members'], 0, ',', '.') }}</h3>
                </div>
                <div class="w-11 h-11 bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
            </div>
            <p class="text-[11px] text-gray-400 dark:text-gray-500 mt-2 flex items-center gap-1">
                <span class="text-green-600 dark:text-green-400 font-semibold">{{ $stats['active_members'] }}</span> aktif
            </p>
        </div>

        <!-- Card 2: Total Poin Beredar -->
        <div class="p-4 bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-2xs">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400">Total Poin Member</p>
                    <h3 class="text-xl sm:text-2xl font-bold text-green-600 dark:text-green-400 mt-1">{{ number_format($stats['total_points'], 0, ',', '.') }} <span class="text-xs font-semibold text-gray-400">Poin</span></h3>
                </div>
                <div class="w-11 h-11 bg-green-50 dark:bg-green-900/30 text-green-600 dark:text-green-400 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                    </svg>
                </div>
            </div>
            <p class="text-[11px] text-gray-400 dark:text-gray-500 mt-2">
                Setara diskon <span class="font-medium text-gray-700 dark:text-gray-300">Rp {{ number_format($stats['total_points'] * 1000, 0, ',', '.') }}</span>
            </p>
        </div>

        <!-- Card 3: Total Belanja Member -->
        <div class="p-4 bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-2xs">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400">Akumulasi Belanja</p>
                    <h3 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-white mt-1">Rp {{ number_format($stats['total_spend'], 0, ',', '.') }}</h3>
                </div>
                <div class="w-11 h-11 bg-purple-50 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <p class="text-[11px] text-gray-400 dark:text-gray-500 mt-2">Nilai transaksi pelanggan terdaftar</p>
        </div>

        <!-- Card 4: Skema Loyalitas -->
        <div class="p-4 bg-gradient-to-br from-green-600 to-emerald-700 text-white rounded-2xl shadow-sm">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold uppercase tracking-wider text-green-100">Reward Scheme</span>
                <span class="text-xs px-2 py-0.5 bg-white/20 rounded-full font-bold">1:1000</span>
            </div>
            <p class="text-xs text-green-50 mt-2 leading-relaxed">
                Belanja <b>Rp 10.000</b> = <b>1 Poin</b><br>
                <b>1 Poin</b> = Diskon <b>Rp 1.000</b>
            </p>
        </div>
    </div>

    <!-- Filter & Search Bar -->
    <div class="bg-white dark:bg-gray-800 p-4 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-2xs mb-6">
        <form method="GET" action="{{ route('members.index') }}" class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-3">
            <div class="flex-1 relative">
                <input type="text" name="search" value="{{ $search }}"
                    placeholder="Cari berdasarkan Nama, Nomor HP, atau Kode Member..."
                    class="w-full pl-10 pr-4 py-2 bg-gray-50 dark:bg-gray-700/70 border border-gray-200 dark:border-gray-600 text-xs sm:text-sm rounded-xl text-gray-900 dark:text-white placeholder:text-gray-400 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-gray-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
            </div>

            <div class="flex items-center gap-2.5 shrink-0">
                <select name="status" onchange="this.form.submit()"
                    class="px-3 py-2 bg-gray-50 dark:bg-gray-700/70 border border-gray-200 dark:border-gray-600 text-xs sm:text-sm rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-green-500">
                    <option value="">Semua Status</option>
                    <option value="active" {{ $status === 'active' ? 'selected' : '' }}>Aktif</option>
                    <option value="inactive" {{ $status === 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                </select>

                <button type="submit"
                    class="px-4 py-2 bg-gray-900 hover:bg-black text-white text-xs sm:text-sm font-semibold rounded-xl transition cursor-pointer">
                    Cari
                </button>

                @if($search || $status)
                    <a href="{{ route('members.index') }}"
                        class="p-2 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-xl transition" title="Reset Filter">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Table Members -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-2xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs sm:text-sm text-gray-600 dark:text-gray-300">
                <thead class="bg-gray-50 dark:bg-gray-700/50 text-gray-700 dark:text-gray-300 uppercase text-[11px] font-bold tracking-wider border-b border-gray-200 dark:border-gray-700">
                    <tr>
                        <th scope="col" class="px-5 py-3.5">Member</th>
                        <th scope="col" class="px-5 py-3.5">Kontak</th>
                        <th scope="col" class="px-5 py-3.5">Saldo Poin</th>
                        <th scope="col" class="px-5 py-3.5">Total Belanja</th>
                        <th scope="col" class="px-5 py-3.5">Pesanan</th>
                        <th scope="col" class="px-5 py-3.5">Status</th>
                        <th scope="col" class="px-5 py-3.5 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700/60 font-normal">
                    @forelse($members as $member)
                    <tr class="hover:bg-gray-50/80 dark:hover:bg-gray-700/40 transition">
                        <!-- Member Info -->
                        <td class="px-5 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-green-100 dark:bg-green-900/40 text-green-700 dark:text-green-300 font-bold flex items-center justify-center shrink-0 text-sm">
                                    {{ strtoupper(substr($member->name, 0, 1)) }}
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 dark:text-white">{{ $member->name }}</h4>
                                    <span class="inline-block px-1.5 py-0.5 bg-gray-100 dark:bg-gray-700 text-gray-500 dark:text-gray-400 font-mono text-[10px] rounded mt-0.5">
                                        {{ $member->member_code }}
                                    </span>
                                </div>
                            </div>
                        </td>

                        <!-- Kontak -->
                        <td class="px-5 py-4">
                            <div class="font-medium text-gray-900 dark:text-gray-200">{{ $member->phone }}</div>
                            <div class="text-[11px] text-gray-400">{{ $member->email ?? '-' }}</div>
                        </td>

                        <!-- Saldo Poin -->
                        <td class="px-5 py-4">
                            <div class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-green-50 dark:bg-green-900/30 text-green-700 dark:text-green-400 rounded-lg font-bold text-xs">
                                <span>🪙 {{ number_format($member->points_balance, 0, ',', '.') }}</span>
                                <span class="text-[10px] font-normal text-green-600 dark:text-green-500">Poin</span>
                            </div>
                            <p class="text-[11px] text-gray-400 mt-1">Nilai: Rp {{ number_format($member->points_balance * 1000, 0, ',', '.') }}</p>
                        </td>

                        <!-- Total Belanja -->
                        <td class="px-5 py-4 font-semibold text-gray-900 dark:text-white">
                            {{ $member->formatted_total_spend }}
                        </td>

                        <!-- Pesanan Count -->
                        <td class="px-5 py-4 text-gray-700 dark:text-gray-300">
                            {{ $member->orders_count }}x Transaksi
                        </td>

                        <!-- Status -->
                        <td class="px-5 py-4">
                            @if($member->status === 'active')
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-300">
                                    Aktif
                                </span>
                            @else
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                                    Nonaktif
                                </span>
                            @endif
                        </td>

                        <!-- Actions -->
                        <td class="px-5 py-4 text-center">
                            <div class="inline-flex items-center gap-1">
                                <!-- View History -->
                                <button type="button" onclick="viewMemberHistory({{ $member->id }})"
                                    class="p-1.5 text-blue-600 hover:text-blue-800 dark:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/30 rounded-lg transition" title="Riwayat Poin">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </button>

                                <!-- Edit -->
                                <button type="button" onclick='openEditMemberModal(@json($member))'
                                    class="p-1.5 text-yellow-600 hover:text-yellow-800 dark:text-yellow-400 hover:bg-yellow-50 dark:hover:bg-yellow-900/30 rounded-lg transition" title="Edit Member">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </button>

                                <!-- Delete -->
                                <form method="POST" action="{{ route('members.destroy', $member) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus member {{ $member->name }}?')" class="inline m-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="p-1.5 text-red-500 hover:text-red-700 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-lg transition" title="Hapus Member">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-5 py-12 text-center text-gray-500 dark:text-gray-400">
                            <div class="max-w-sm mx-auto">
                                <svg class="w-12 h-12 mx-auto text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2M9 10a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm14 10v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75" />
                                </svg>
                                <p class="text-sm font-semibold text-gray-700 dark:text-gray-200">Belum ada member ditemukan</p>
                                <p class="text-xs text-gray-400 mt-1">Daftarkan pelanggan pertama Anda ke dalam sistem member atau sesuaikan kata kunci pencarian.</p>
                                <button type="button" onclick="openAddMemberModal()"
                                    class="mt-4 inline-flex items-center gap-1.5 px-4 py-2 bg-green-600 text-white rounded-xl text-xs font-semibold hover:bg-green-700 transition">
                                    + Tambah Member Sekarang
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($members->hasPages())
            <div class="p-4 border-t border-gray-100 dark:border-gray-700">
                {{ $members->links() }}
            </div>
        @endif
    </div>

    <!-- Modal Tambah Member Baru -->
    <div id="add-member-modal" class="fixed inset-0 z-50 hidden bg-black/50 backdrop-blur-xs flex items-center justify-center p-4">
        <div class="bg-white dark:bg-gray-800 rounded-2xl w-full max-w-md shadow-2xl border border-gray-100 dark:border-gray-700 overflow-hidden transform transition-all">
            <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between bg-gray-50/50 dark:bg-gray-800">
                <h3 class="text-base font-bold text-gray-900 dark:text-white flex items-center gap-2">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                    Pendaftaran Member Baru
                </h3>
                <button type="button" onclick="closeAddMemberModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <form method="POST" action="{{ route('members.store') }}" class="p-6 space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Nama Lengkap <span class="text-red-500">*</span></label>
                    <input type="text" name="name" required placeholder="Contoh: Budi Santoso"
                        class="w-full px-3.5 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-xs sm:text-sm rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-green-500">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Nomor Handphone / WhatsApp <span class="text-red-500">*</span></label>
                    <input type="text" name="phone" required placeholder="Contoh: 081234567890"
                        class="w-full px-3.5 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-xs sm:text-sm rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-green-500">
                    <span class="text-[11px] text-gray-400 mt-1 block">Nomor HP digunakan kasir untuk mencari member saat transaksi POS</span>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Email (Opsional)</label>
                    <input type="email" name="email" placeholder="Contoh: budi@gmail.com"
                        class="w-full px-3.5 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-xs sm:text-sm rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-green-500">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Status Keanggotaan</label>
                    <select name="status" class="w-full px-3.5 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-xs sm:text-sm rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-green-500">
                        <option value="active" selected>Aktif</option>
                        <option value="inactive">Nonaktif</option>
                    </select>
                </div>

                <div class="pt-3 flex items-center justify-end gap-2 border-t border-gray-100 dark:border-gray-700">
                    <button type="button" onclick="closeAddMemberModal()"
                        class="px-4 py-2 text-xs font-semibold text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-xl transition">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-5 py-2 bg-green-600 hover:bg-green-700 text-white text-xs font-semibold rounded-xl shadow-xs transition cursor-pointer">
                        Simpan Member
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Member -->
    <div id="edit-member-modal" class="fixed inset-0 z-50 hidden bg-black/50 backdrop-blur-xs flex items-center justify-center p-4">
        <div class="bg-white dark:bg-gray-800 rounded-2xl w-full max-w-md shadow-2xl border border-gray-100 dark:border-gray-700 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between bg-gray-50/50 dark:bg-gray-800">
                <h3 class="text-base font-bold text-gray-900 dark:text-white">Edit Data Member</h3>
                <button type="button" onclick="closeEditMemberModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <form id="edit-member-form" method="POST" action="" class="p-6 space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Kode Member</label>
                    <input type="text" id="edit-member-code" disabled
                        class="w-full px-3.5 py-2 bg-gray-100 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-xs sm:text-sm rounded-xl text-gray-500 font-mono">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Nama Lengkap <span class="text-red-500">*</span></label>
                    <input type="text" id="edit-member-name" name="name" required
                        class="w-full px-3.5 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-xs sm:text-sm rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-green-500">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Nomor HP / WhatsApp <span class="text-red-500">*</span></label>
                    <input type="text" id="edit-member-phone" name="phone" required
                        class="w-full px-3.5 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-xs sm:text-sm rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-green-500">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Email</label>
                    <input type="email" id="edit-member-email" name="email"
                        class="w-full px-3.5 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-xs sm:text-sm rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-green-500">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Status</label>
                    <select id="edit-member-status" name="status" class="w-full px-3.5 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-xs sm:text-sm rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-green-500">
                        <option value="active">Aktif</option>
                        <option value="inactive">Nonaktif</option>
                    </select>
                </div>

                <div class="pt-3 flex items-center justify-end gap-2 border-t border-gray-100 dark:border-gray-700">
                    <button type="button" onclick="closeEditMemberModal()"
                        class="px-4 py-2 text-xs font-semibold text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-xl transition">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-5 py-2 bg-green-600 hover:bg-green-700 text-white text-xs font-semibold rounded-xl shadow-xs transition cursor-pointer">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Riwayat Poin Member -->
    <div id="history-modal" class="fixed inset-0 z-50 hidden bg-black/50 backdrop-blur-xs flex items-center justify-center p-4">
        <div class="bg-white dark:bg-gray-800 rounded-2xl w-full max-w-2xl shadow-2xl border border-gray-100 dark:border-gray-700 overflow-hidden flex flex-col max-h-[85vh]">
            <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between bg-gray-50/50 dark:bg-gray-800 shrink-0">
                <div>
                    <h3 class="text-base font-bold text-gray-900 dark:text-white flex items-center gap-2">
                        <span>🪙</span> Riwayat Mutasi Poin
                    </h3>
                    <p id="history-member-title" class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Memuat data member...</p>
                </div>
                <button type="button" onclick="closeHistoryModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <div class="p-6 overflow-y-auto flex-1">
                <!-- Summary Member Banner inside Modal -->
                <div class="p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-xl mb-4 flex items-center justify-between">
                    <div>
                        <span class="text-[11px] text-green-700 dark:text-green-300 font-semibold uppercase">Saldo Poin Sekarang</span>
                        <div id="history-balance" class="text-xl font-extrabold text-green-800 dark:text-green-200 mt-0.5">0 Poin</div>
                    </div>
                    <div class="text-right">
                        <span class="text-[11px] text-gray-500 dark:text-gray-400">Total Akumulasi Belanja</span>
                        <div id="history-total-spend" class="text-sm font-bold text-gray-800 dark:text-gray-200">Rp 0</div>
                    </div>
                </div>

                <h4 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-3">Catatan Log Mutasi</h4>
                
                <div id="history-logs-container" class="space-y-2.5">
                    <!-- Dynamic logs injected by JS -->
                </div>
            </div>

            <div class="p-4 border-t border-gray-100 dark:border-gray-700 flex justify-end shrink-0 bg-gray-50 dark:bg-gray-800">
                <button type="button" onclick="closeHistoryModal()"
                    class="px-4 py-2 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 text-xs font-semibold rounded-xl transition">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <!-- Script Interaktif Member -->
    <script>
        function openAddMemberModal() {
            document.getElementById('add-member-modal').classList.remove('hidden');
        }
        function closeAddMemberModal() {
            document.getElementById('add-member-modal').classList.add('hidden');
        }

        function openEditMemberModal(member) {
            document.getElementById('edit-member-form').action = `/members/${member.id}`;
            document.getElementById('edit-member-code').value = member.member_code;
            document.getElementById('edit-member-name').value = member.name;
            document.getElementById('edit-member-phone').value = member.phone;
            document.getElementById('edit-member-email').value = member.email || '';
            document.getElementById('edit-member-status').value = member.status;
            document.getElementById('edit-member-modal').classList.remove('hidden');
        }
        function closeEditMemberModal() {
            document.getElementById('edit-member-modal').classList.add('hidden');
        }

        function viewMemberHistory(memberId) {
            const container = document.getElementById('history-logs-container');
            container.innerHTML = '<div class="py-8 text-center text-xs text-gray-400">Memuat riwayat poin...</div>';
            document.getElementById('history-modal').classList.remove('hidden');

            fetch(`/members/${memberId}`, {
                headers: { 'Accept': 'application/json' }
            })
            .then(res => res.json())
            .then(data => {
                const m = data.member;
                const logs = data.logs || [];

                document.getElementById('history-member-title').textContent = `${m.name} (${m.member_code}) - ${m.phone}`;
                document.getElementById('history-balance').textContent = `${new Intl.NumberFormat('id-ID').format(m.points_balance)} Poin`;
                document.getElementById('history-total-spend').textContent = `Rp ${new Intl.NumberFormat('id-ID').format(m.total_spend)}`;

                if (logs.length === 0) {
                    container.innerHTML = '<div class="py-8 text-center text-xs text-gray-400">Belum ada riwayat mutasi poin untuk member ini.</div>';
                    return;
                }

                let html = '';
                logs.forEach(log => {
                    const isEarn = log.type === 'earn';
                    const badgeClass = isEarn ? 'bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-300' : 'bg-red-100 text-red-800 dark:bg-red-900/40 dark:text-red-300';
                    const sign = log.points > 0 ? '+' : '';
                    const date = new Date(log.created_at).toLocaleString('id-ID', { dateStyle: 'medium', timeStyle: 'short' });

                    html += `
                        <div class="p-3 bg-gray-50 dark:bg-gray-700/50 rounded-xl border border-gray-100 dark:border-gray-700 flex items-center justify-between">
                            <div>
                                <div class="flex items-center gap-2">
                                    <span class="text-xs font-semibold px-2 py-0.5 rounded-md ${badgeClass}">
                                        ${isEarn ? 'Perolehan Poin' : 'Penukaran Diskon'}
                                    </span>
                                    <span class="text-[11px] text-gray-400">${date}</span>
                                </div>
                                <p class="text-xs text-gray-600 dark:text-gray-300 mt-1 font-medium">${log.description}</p>
                            </div>
                            <div class="text-right">
                                <div class="text-sm font-bold ${isEarn ? 'text-green-600 dark:text-green-400' : 'text-red-500'}">
                                    ${sign}${new Intl.NumberFormat('id-ID').format(log.points)} Poin
                                </div>
                                <span class="text-[10px] text-gray-400">Saldo: ${new Intl.NumberFormat('id-ID').format(log.balance_after)} Poin</span>
                            </div>
                        </div>
                    `;
                });
                container.innerHTML = html;
            })
            .catch(() => {
                container.innerHTML = '<div class="py-8 text-center text-xs text-red-500">Gagal memuat riwayat poin. Silakan coba lagi.</div>';
            });
        }
        function closeHistoryModal() {
            document.getElementById('history-modal').classList.add('hidden');
        }
    </script>
</x-layout>
