<x-layout>
    <x-slot:title>Pengaturan Profil</x-slot:title>

    <div class="max-w-4xl mx-auto space-y-6">
        
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Profil Saya</h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Kelola informasi data diri dan keamanan akun Anda.</p>
            </div>
        </div>

        @if(session('success'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-xl bg-green-50 dark:bg-gray-800 dark:text-green-400 border border-green-200 dark:border-green-800 shadow-sm" role="alert">
                <span class="font-medium">Berhasil!</span> {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="p-4 mb-4 text-sm text-red-800 rounded-xl bg-red-50 dark:bg-gray-800 dark:text-red-400 border border-red-200 dark:border-red-800 shadow-sm" role="alert">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white dark:bg-gray-800 shadow-sm border border-gray-100 dark:border-gray-700 rounded-2xl overflow-hidden">
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="p-6 sm:p-8">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Kolom Kiri: Foto Profil -->
                    <div class="md:col-span-1 flex flex-col items-center">
                        <div class="relative w-32 h-32 mb-4 group">
                            <div class="w-full h-full rounded-full overflow-hidden border-4 border-white dark:border-gray-800 shadow-lg bg-gray-100 dark:bg-gray-700 flex items-center justify-center">
                                @if(Auth::user()->avatar)
                                    <img id="avatar-preview" src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Avatar" class="w-full h-full object-cover">
                                @else
                                    <svg id="avatar-placeholder" class="w-16 h-16 text-gray-400 mt-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                                    <img id="avatar-preview" src="#" alt="Avatar Preview" class="w-full h-full object-cover hidden">
                                @endif
                            </div>
                            <!-- Overlay edit (Desktop hover) -->
                            <label for="avatar" class="absolute inset-0 w-full h-full rounded-full bg-black/50 flex flex-col items-center justify-center text-white opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer">
                                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <span class="text-xs font-semibold">Ubah Foto</span>
                            </label>
                            <input type="file" id="avatar" name="avatar" accept="image/*" class="hidden" onchange="previewImage(event)">
                        </div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 text-center">Format: JPG, PNG, GIF.<br>Maks: 2MB.</p>
                        
                        <!-- Tombol mobile (muncul jelas di layar kecil) -->
                        <div class="mt-4 md:hidden">
                            <label for="avatar" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm text-sm font-medium text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 cursor-pointer">
                                Pilih Foto Baru
                            </label>
                        </div>
                    </div>

                    <!-- Kolom Kanan: Data Diri -->
                    <div class="md:col-span-2 space-y-6">
                        
                        <div>
                            <label for="name" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Nama Lengkap</label>
                            <input type="text" name="name" id="name" value="{{ old('name', Auth::user()->name) }}" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500 transition-colors">
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Alamat Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email', Auth::user()->email) }}" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500 transition-colors">
                        </div>

                        <div class="pt-4 border-t border-gray-100 dark:border-gray-700">
                            <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-1">Ganti Kata Sandi</h3>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mb-4">Biarkan kosong jika Anda tidak ingin menggantinya.</p>
                            
                            <div class="space-y-4">
                                <div>
                                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Kata Sandi Baru</label>
                                    <div class="relative flex items-center">
                                        <input type="password" name="password" id="password"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5 pr-10 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500 transition-colors">
                                        <button type="button" onclick="togglePasswordVisibility('password', this)" class="absolute right-3 p-1 text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 focus:outline-none transition-colors" title="Lihat kata sandi" aria-label="Lihat kata sandi">
                                            <svg class="eye-icon w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                            <svg class="eye-slash-icon w-4 h-4 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <div>
                                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Konfirmasi Kata Sandi</label>
                                    <div class="relative flex items-center">
                                        <input type="password" name="password_confirmation" id="password_confirmation"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5 pr-10 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500 transition-colors">
                                        <button type="button" onclick="togglePasswordVisibility('password_confirmation', this)" class="absolute right-3 p-1 text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 focus:outline-none transition-colors" title="Lihat konfirmasi kata sandi" aria-label="Lihat konfirmasi kata sandi">
                                            <svg class="eye-icon w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                            <svg class="eye-slash-icon w-4 h-4 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-gray-100 dark:border-gray-700 flex justify-end">
                    <button type="submit" class="text-white bg-orange-500 hover:bg-orange-600 focus:ring-4 focus:outline-none focus:ring-orange-300 font-semibold rounded-xl text-sm px-6 py-3 text-center dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800 transition-all shadow-md shadow-orange-500/30">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Script for local image preview and password visibility toggle -->
    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('avatar-preview');
                var placeholder = document.getElementById('avatar-placeholder');
                
                output.src = reader.result;
                output.classList.remove('hidden');
                
                if (placeholder) {
                    placeholder.classList.add('hidden');
                }
            }
            if(event.target.files[0]) {
                reader.readAsDataURL(event.target.files[0]);
            }
        }

        function togglePasswordVisibility(inputId, btn) {
            const input = document.getElementById(inputId);
            if (!input) return;
            const isPassword = input.type === 'password';
            input.type = isPassword ? 'text' : 'password';
            
            const eyeIcon = btn.querySelector('.eye-icon');
            const eyeSlashIcon = btn.querySelector('.eye-slash-icon');
            
            if (eyeIcon && eyeSlashIcon) {
                if (isPassword) {
                    eyeIcon.classList.add('hidden');
                    eyeSlashIcon.classList.remove('hidden');
                    btn.setAttribute('title', 'Sembunyikan kata sandi');
                    btn.setAttribute('aria-label', 'Sembunyikan kata sandi');
                } else {
                    eyeIcon.classList.remove('hidden');
                    eyeSlashIcon.classList.add('hidden');
                    btn.setAttribute('title', 'Lihat kata sandi');
                    btn.setAttribute('aria-label', 'Lihat kata sandi');
                }
            }
        }
    </script>
</x-layout>
