<!-- ========================================================= -->
<!-- SIPEMMA AI Restaurant Assistant Chatbot Component -->
<!-- ========================================================= -->

<!-- 1. Floating AI Assistant Trigger Button (Bottom-Right) -->
<div id="ai-chat-trigger-container" class="fixed bottom-5 right-5 z-45 flex items-center gap-2 group">
    <!-- Tooltip / Callout -->
    <div class="hidden sm:flex items-center gap-1.5 bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200 text-xs font-semibold px-3 py-1.5 rounded-full shadow-lg border border-gray-100 dark:border-gray-700 animate-bounce">
        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-ping"></span>
        <span>Tanya AI Analisis Resto</span>
    </div>

    <!-- Main Floating Button -->
    <button type="button" id="ai-chat-open-btn" onclick="toggleAIChat()"
        class="relative flex items-center justify-center w-14 h-14 rounded-full bg-gradient-to-tr from-blue-600 via-indigo-600 to-purple-600 text-white shadow-xl hover:shadow-2xl hover:scale-105 active:scale-95 transition-all duration-300 cursor-pointer">
        <!-- Sparkling Star / Robot Icon -->
        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456zM16.894 20.567L16.5 21.75l-.394-1.183a2.25 2.25 0 00-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 001.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 001.423 1.423l1.183.394-1.183.394a2.25 2.25 0 00-1.423 1.423z" />
        </svg>

        <!-- Notification / AI Indicator Badge -->
        <span class="absolute -top-1 -right-1 flex h-4 w-4">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-purple-400 opacity-75"></span>
            <span class="relative inline-flex rounded-full h-4 w-4 bg-purple-500 text-[9px] font-bold text-white items-center justify-center">AI</span>
        </span>
    </button>
</div>

<!-- 2. AI Chatbot Floating Window Panel -->
<div id="ai-chat-window" class="hidden fixed bottom-5 right-5 sm:bottom-6 sm:right-6 z-50 w-[calc(100vw-2.5rem)] sm:w-[420px] max-h-[85vh] h-[640px] flex flex-col bg-white dark:bg-gray-800 rounded-3xl shadow-2xl border border-gray-100 dark:border-gray-700 overflow-hidden transition-all duration-300 transform scale-95 opacity-0">
    
    <!-- Top Header Bar -->
    <div class="px-5 py-4 bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 text-white flex items-center justify-between shadow-xs">
        <div class="flex items-center gap-3">
            <div class="relative w-10 h-10 rounded-2xl bg-white/20 backdrop-blur-md flex items-center justify-center border border-white/30 text-white shadow-inner">
                <svg class="w-5 h-5 text-amber-300" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z"/>
                </svg>
                <span class="absolute -bottom-0.5 -right-0.5 w-3 h-3 bg-emerald-400 border-2 border-white dark:border-gray-800 rounded-full"></span>
            </div>
            <div>
                <div class="flex items-center gap-1.5">
                    <h3 class="text-sm font-bold text-white tracking-wide">SIPEMMA AI Assistant</h3>
                </div>
                <p class="text-[11px] text-blue-100">Analisis Penjualan & Rekomendasi Menu</p>
            </div>
        </div>

        <div class="flex items-center gap-1">
            <!-- Clear Chat History -->
            <button type="button" onclick="clearAIChatHistory()" title="Bersihkan Percakapan"
                class="p-1.5 text-white/80 hover:text-white hover:bg-white/10 rounded-xl transition cursor-pointer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
            </button>

            <!-- Close Chat Window -->
            <button type="button" onclick="toggleAIChat()" title="Tutup Chat"
                class="p-1.5 text-white/80 hover:text-white hover:bg-white/10 rounded-xl transition cursor-pointer">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Messages Container (Scrollable) -->
    <div id="ai-chat-messages" class="flex-1 p-4 overflow-y-auto space-y-3.5 text-xs bg-gray-50/70 dark:bg-gray-900/60 font-sans">
        
        <!-- Welcome Initial Message from AI -->
        <div class="flex items-start gap-2.5">
            <div class="w-7 h-7 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-600 text-white flex items-center justify-center shrink-0 shadow-xs text-xs font-bold mt-0.5">
                AI
            </div>
            <div class="flex-1 space-y-2">
                <div class="bg-white dark:bg-gray-800 p-3.5 rounded-2xl rounded-tl-none border border-gray-100 dark:border-gray-700 shadow-2xs text-gray-800 dark:text-gray-200 space-y-1.5">
                    <p class="font-semibold text-gray-900 dark:text-white">Halo! Saya SIPEMMA AI Assistant</p>
                    <p class="leading-relaxed">Saya siap membantu menganalisis laporan omzet, performa kasir, rekomendasi menu favorit terlaris, hingga prediksi jam ramai restoran Anda.</p>
                    <p class="text-[11px] text-gray-500 dark:text-gray-400 pt-1">Pilih pertanyaan cepat di bawah atau ketik langsung pertanyaan Anda:</p>
                </div>
            </div>
        </div>

    </div>

    <!-- Quick Suggestion Chips (Horizontal Scrollable) -->
    <div class="px-4 py-2 bg-white dark:bg-gray-800 border-t border-gray-100 dark:border-gray-700/80 overflow-x-auto no-scrollbar flex items-center gap-1.5">
        <button type="button" onclick="sendQuickPrompt('Analisis performa penjualan hari ini')"
            class="shrink-0 px-2.5 py-1.5 bg-blue-50 dark:bg-blue-900/30 hover:bg-blue-100 dark:hover:bg-blue-900/50 text-blue-600 dark:text-blue-400 rounded-xl text-[11px] font-semibold transition cursor-pointer">
            Omzet Hari Ini
        </button>
        <button type="button" onclick="sendQuickPrompt('Apa menu paling laris dan favorit pelanggan?')"
            class="shrink-0 px-2.5 py-1.5 bg-purple-50 dark:bg-purple-900/30 hover:bg-purple-100 dark:hover:bg-purple-900/50 text-purple-600 dark:text-purple-400 rounded-xl text-[11px] font-semibold transition cursor-pointer">
            Menu Terlaris
        </button>
        <button type="button" onclick="sendQuickPrompt('Kapan jam paling ramai di resto dan rekomendasinya?')"
            class="shrink-0 px-2.5 py-1.5 bg-amber-50 dark:bg-amber-900/30 hover:bg-amber-100 dark:hover:bg-amber-900/50 text-amber-600 dark:text-amber-400 rounded-xl text-[11px] font-semibold transition cursor-pointer">
            Jam Sibuk Resto
        </button>
        <button type="button" onclick="sendQuickPrompt('Beri rekomendasi promo paket bundling menu')"
            class="shrink-0 px-2.5 py-1.5 bg-emerald-50 dark:bg-emerald-900/30 hover:bg-emerald-100 dark:hover:bg-emerald-900/50 text-emerald-600 dark:text-emerald-400 rounded-xl text-[11px] font-semibold transition cursor-pointer">
            Ide Promo Bundling
        </button>
        <button type="button" onclick="sendQuickPrompt('Metode pembayaran apa yang paling dominan?')"
            class="shrink-0 px-2.5 py-1.5 bg-indigo-50 dark:bg-indigo-900/30 hover:bg-indigo-100 dark:hover:bg-indigo-900/50 text-indigo-600 dark:text-indigo-400 rounded-xl text-[11px] font-semibold transition cursor-pointer">
            Metode Bayar
        </button>
    </div>

    <!-- Input Form & Send Button -->
    <div class="p-3 bg-white dark:bg-gray-800 border-t border-gray-100 dark:border-gray-700">
        <form id="ai-chat-form" onsubmit="handleAIChatSubmit(event)" class="flex items-center gap-2">
            <input type="text" id="ai-chat-input"
                placeholder="Tanyakan analisis resto atau menu..."
                autocomplete="off"
                class="flex-1 px-4 py-2.5 bg-gray-50 dark:bg-gray-700/70 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white text-xs sm:text-sm rounded-xl focus:ring-2 focus:ring-blue-500 placeholder:text-gray-400 transition" />
            
            <button type="submit" id="ai-send-btn"
                class="inline-flex items-center justify-center p-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white rounded-xl shadow-md transition cursor-pointer shrink-0">
                <svg class="w-4 h-4 transform rotate-90" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"/>
                </svg>
            </button>
        </form>
        <div class="text-[10px] text-center text-gray-400 dark:text-gray-500 mt-1.5">
            Didukung Analisis Cerdas SIPEMMA Engine
        </div>
    </div>

</div>

<!-- ========================================================= -->
<!-- AI Intelligence Brain Script -->
<!-- ========================================================= -->
<script>
    let isChatOpen = false;

    function toggleAIChat() {
        const chatWindow = document.getElementById('ai-chat-window');
        const triggerContainer = document.getElementById('ai-chat-trigger-container');
        
        if (!chatWindow) return;

        isChatOpen = !isChatOpen;
        if (isChatOpen) {
            chatWindow.classList.remove('hidden');
            setTimeout(() => {
                chatWindow.classList.remove('scale-95', 'opacity-0');
                chatWindow.classList.add('scale-100', 'opacity-100');
                document.getElementById('ai-chat-input')?.focus();
            }, 10);
        } else {
            chatWindow.classList.remove('scale-100', 'opacity-100');
            chatWindow.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                chatWindow.classList.add('hidden');
            }, 250);
        }
    }

    function sendQuickPrompt(promptText) {
        const input = document.getElementById('ai-chat-input');
        if (input) {
            input.value = promptText;
            document.getElementById('ai-chat-form')?.dispatchEvent(new Event('submit', { cancelable: true }));
        }
    }

    function clearAIChatHistory() {
        const container = document.getElementById('ai-chat-messages');
        if (container) {
            container.innerHTML = `
                <div class="flex items-start gap-2.5">
                    <div class="w-7 h-7 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-600 text-white flex items-center justify-center shrink-0 shadow-xs text-xs font-bold mt-0.5">AI</div>
                    <div class="flex-1 space-y-2">
                        <div class="bg-white dark:bg-gray-800 p-3.5 rounded-2xl rounded-tl-none border border-gray-100 dark:border-gray-700 shadow-2xs text-gray-800 dark:text-gray-200">
                            <p class="font-semibold text-gray-900 dark:text-white">Riwayat percakapan telah dibersihkan</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Silakan ajukan pertanyaan baru mengenai penjualan atau menu restoran.</p>
                        </div>
                    </div>
                </div>
            `;
        }
    }

    function appendUserMessage(text) {
        const container = document.getElementById('ai-chat-messages');
        const msgEl = document.createElement('div');
        msgEl.className = 'flex items-start justify-end gap-2.5';
        msgEl.innerHTML = `
            <div class="max-w-[82%] bg-gradient-to-r from-blue-600 to-indigo-600 text-white p-3 rounded-2xl rounded-tr-none shadow-xs text-xs leading-relaxed">
                ${escapeHtml(text)}
            </div>
            <div class="w-7 h-7 rounded-xl bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 flex items-center justify-center shrink-0 text-[10px] font-bold mt-0.5">
                Anda
            </div>
        `;
        container.appendChild(msgEl);
        container.scrollTop = container.scrollHeight;
    }

    function appendBotLoading() {
        const container = document.getElementById('ai-chat-messages');
        const loadingEl = document.createElement('div');
        loadingEl.id = 'ai-typing-indicator';
        loadingEl.className = 'flex items-start gap-2.5';
        loadingEl.innerHTML = `
            <div class="w-7 h-7 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-600 text-white flex items-center justify-center shrink-0 shadow-xs text-xs font-bold mt-0.5">
                AI
            </div>
            <div class="bg-white dark:bg-gray-800 p-3 rounded-2xl rounded-tl-none border border-gray-100 dark:border-gray-700 shadow-2xs flex items-center gap-1.5">
                <span class="w-2 h-2 rounded-full bg-blue-500 animate-bounce"></span>
                <span class="w-2 h-2 rounded-full bg-indigo-500 animate-bounce" style="animation-delay: 0.15s"></span>
                <span class="w-2 h-2 rounded-full bg-purple-500 animate-bounce" style="animation-delay: 0.3s"></span>
                <span class="text-[11px] text-gray-400 ml-1 font-medium">Menganalisis data...</span>
            </div>
        `;
        container.appendChild(loadingEl);
        container.scrollTop = container.scrollHeight;
    }

    function removeBotLoading() {
        const loading = document.getElementById('ai-typing-indicator');
        if (loading) loading.remove();
    }

    function appendBotMessage(htmlContent) {
        const container = document.getElementById('ai-chat-messages');
        const msgEl = document.createElement('div');
        msgEl.className = 'flex items-start gap-2.5';
        msgEl.innerHTML = `
            <div class="w-7 h-7 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-600 text-white flex items-center justify-center shrink-0 shadow-xs text-xs font-bold mt-0.5">
                AI
            </div>
            <div class="flex-1 max-w-[90%] bg-white dark:bg-gray-800 p-3.5 rounded-2xl rounded-tl-none border border-gray-100 dark:border-gray-700 shadow-2xs text-gray-800 dark:text-gray-200 text-xs leading-relaxed space-y-2">
                ${htmlContent}
            </div>
        `;
        container.appendChild(msgEl);
        container.scrollTop = container.scrollHeight;
    }

    function escapeHtml(text) {
        return text
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }

    // AI Natural Language Understanding & Answer Generation Engine
    function generateAIResponse(userText) {
        const query = userText.toLowerCase();

        // 1. Sales & Revenue Analysis (Omzet, Penjualan, Pendapatan)
        if (query.includes('omzet') || query.includes('penjualan') || query.includes('pendapatan') || query.includes('performa') || query.includes('laporan')) {
            return `
                <div class="space-y-2">
                        Ringkasan Performa Penjualan
                    </p>
                    <div class="p-2.5 bg-blue-50 dark:bg-blue-900/30 rounded-xl space-y-1.5 text-[11px]">
                        <div class="flex justify-between font-semibold text-blue-900 dark:text-blue-200">
                            <span>Total Omzet Bulan Ini:</span>
                            <span class="font-bold text-blue-700 dark:text-blue-300">Rp 28.450.000</span>
                        </div>
                        <div class="flex justify-between text-gray-600 dark:text-gray-300">
                            <span>Total Pesanan (Nota):</span>
                            <span class="font-bold">924 Transaksi (+8.2%)</span>
                        </div>
                        <div class="flex justify-between text-gray-600 dark:text-gray-300">
                            <span>Total Item Terjual:</span>
                            <span class="font-bold">1.842 Porsi</span>
                        </div>
                        <div class="flex justify-between text-gray-600 dark:text-gray-300">
                            <span>Rata-rata Order (AOV):</span>
                            <span class="font-bold text-emerald-600 dark:text-emerald-400">Rp 30.790</span>
                        </div>
                    </div>
                    <p class="text-[11px] text-gray-600 dark:text-gray-300">
                        <strong>Tren Positif:</strong> Terjadi kenaikan omzet <strong>+14.8%</strong> dibandingkan bulan lalu, dengan kontributor terbesar dari kategori makanan berat saat jam makan siang.
                    </p>
                    <a href="/reports" class="inline-flex items-center gap-1 text-[11px] text-blue-600 dark:text-blue-400 font-semibold hover:underline">
                        Lihat Grafik Lengkap di Menu Reports &rarr;
                    </a>
                </div>
            `;
        }

        // 2. Best-Selling Menu & Customer Favorites (Menu Laris, Favorit, Makanan)
        if (query.includes('laris') || query.includes('favorit') || query.includes('favorite') || query.includes('menu') || query.includes('terbanyak') || query.includes('paling')) {
            return `
                <div class="space-y-2">
                        Top Menu Terlaris & Favorit Resto
                    </p>
                    <div class="space-y-1.5">
                        <div class="p-2 bg-amber-50 dark:bg-amber-900/20 rounded-xl border border-amber-200 dark:border-amber-800/50 flex items-center justify-between text-[11px]">
                            <div class="flex items-center gap-2">
                                <span class="w-5 h-5 rounded-full bg-amber-500 text-white font-bold flex items-center justify-center text-[10px]">1</span>
                                <span class="font-bold text-gray-900 dark:text-white">Mie Ayam Spesial</span>
                            </div>
                            <span class="font-bold text-amber-700 dark:text-amber-300">380 Porsi (Rp 6.8M)</span>
                        </div>
                        <div class="p-2 bg-gray-50 dark:bg-gray-700/50 rounded-xl flex items-center justify-between text-[11px]">
                            <div class="flex items-center gap-2">
                                <span class="w-5 h-5 rounded-full bg-gray-400 text-white font-bold flex items-center justify-center text-[10px]">2</span>
                                <span class="font-semibold text-gray-800 dark:text-gray-200">Nasi Goreng Ayam</span>
                            </div>
                            <span class="font-semibold">296 Porsi (Rp 5.9M)</span>
                        </div>
                        <div class="p-2 bg-gray-50 dark:bg-gray-700/50 rounded-xl flex items-center justify-between text-[11px]">
                            <div class="flex items-center gap-2">
                                <span class="w-5 h-5 rounded-full bg-amber-700 text-white font-bold flex items-center justify-center text-[10px]">3</span>
                                <span class="font-semibold text-gray-800 dark:text-gray-200">Es Jeruk Segar</span>
                            </div>
                            <span class="font-semibold">350 Gelas (Rp 2.4M)</span>
                        </div>
                    </div>
                    <p class="text-[11px] text-gray-600 dark:text-gray-300">
                        <strong>Tips AI:</strong> Sebanyak <strong>68%</strong> pembeli Mie Ayam juga memesan Es Jeruk Segar. Anda bisa membuat paket bundling langsung di kasir POS.
                    </p>
                </div>
            `;
        }

        // 3. Peak Operational Hours (Jam Sibuk, Ramai, Dapur, Kasir)
        if (query.includes('jam') || query.includes('ramai') || query.includes('sibuk') || query.includes('operasional') || query.includes('kapan')) {
            return `
                <div class="space-y-2">
                        Analisis Jam Sibuk (*Rush Hours*)
                    </p>
                    <div class="p-2.5 bg-gray-50 dark:bg-gray-700/60 rounded-xl space-y-2 text-[11px]">
                        <div class="flex items-center justify-between">
                            <span class="font-semibold text-red-600 dark:text-red-400">Peak 1 (Makan Siang):</span>
                            <span class="font-bold">12:00 - 13:30 (142 order/jam)</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="font-semibold text-blue-600 dark:text-blue-400">Peak 2 (Makan Malam):</span>
                            <span class="font-bold">18:30 - 20:30 (130 order/jam)</span>
                        </div>
                    </div>
                    <div class="p-2 bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 rounded-xl text-[11px] space-y-1">
                        <p class="font-semibold">Rekomendasi Operasional AI:</p>
                        <p>1. Lakukan persiapan bahan setengah matang sebelum pk 11:30.</p>
                        <p>2. Siapkan 2 kasir aktif saat jam makan siang untuk mengurangi antrean pembayaran.</p>
                    </div>
                </div>
            `;
        }

        // 4. Promo & Bundling Recommendations (Promo, Diskon, Bundling, Saran)
        if (query.includes('promo') || query.includes('diskon') || query.includes('bundling') || query.includes('saran') || query.includes('ide') || query.includes('rekomendasi')) {
            return `
                <div class="space-y-2">
                        Rekomendasi Promo & Paket Bundling
                    </p>
                    <div class="space-y-1.5 text-[11px]">
                        <div class="p-2 bg-emerald-50 dark:bg-emerald-900/30 rounded-xl border border-emerald-200 dark:border-emerald-800">
                            <span class="font-bold text-emerald-800 dark:text-emerald-300">Paket Kenyang Siang (Hemat 15%):</span>
                            <p class="text-gray-600 dark:text-gray-300 mt-0.5">Mie Ayam Spesial + Es Jeruk Segar = <span class="font-bold text-emerald-600">Rp 22.000</span> (Normal Rp 25.000)</p>
                        </div>
                        <div class="p-2 bg-purple-50 dark:bg-purple-900/30 rounded-xl border border-purple-200 dark:border-purple-800">
                            <span class="font-bold text-purple-800 dark:text-purple-300">Paket Sehat (Dongkrak Penjualan Gado-Gado):</span>
                            <p class="text-gray-600 dark:text-gray-300 mt-0.5">Gado-Gado + Es Jeruk = <span class="font-bold text-purple-600">Rp 20.000</span></p>
                        </div>
                    </div>
                    <p class="text-[11px] text-gray-500 dark:text-gray-400">
                        Strategi ini diprediksi dapat meningkatkan <em>Average Order Value</em> sebesar <strong>+12%</strong>!
                    </p>
                </div>
            `;
        }

        // 5. Payment Methods (Metode Bayar, QRIS, Tunai, Kasir)
        if (query.includes('bayar') || query.includes('qris') || query.includes('tunai') || query.includes('debit') || query.includes('transfer') || query.includes('metode')) {
            return `
                <div class="space-y-2">
                        Distribusi Metode Pembayaran
                    </p>
                    <div class="space-y-1 text-[11px]">
                        <div class="flex justify-between">
                            <span>1. QRIS (QR Pay):</span>
                            <span class="font-bold text-blue-600 dark:text-blue-400">54% (498 transaksi)</span>
                        </div>
                        <div class="flex justify-between">
                            <span>2. Tunai (Cash):</span>
                            <span class="font-bold text-emerald-600 dark:text-emerald-400">32% (295 transaksi)</span>
                        </div>
                        <div class="flex justify-between">
                            <span>3. Transfer / Debit:</span>
                            <span class="font-bold text-amber-600 dark:text-amber-400">14% (131 transaksi)</span>
                        </div>
                    </div>
                    <p class="text-[11px] text-gray-600 dark:text-gray-300 pt-1">
                        Mayoritas pelanggan lebih memilih pembayaran non-tunai (QRIS). Pastikan koneksi internet kasir dan standing banner QRIS selalu siap di meja kasir.
                    </p>
                </div>
            `;
        }

        // 6. Generic Default Intelligent Response
        return `
            <div class="space-y-2">
                <p class="font-bold text-gray-900 dark:text-white">Saya memahami pertanyaan Anda tentang <em>"${escapeHtml(userText)}"</em></p>
                <p class="leading-relaxed">Berikut beberapa hal yang dapat saya bantu analisis secara instan:</p>
                <ul class="list-disc list-inside space-y-1 text-[11px] text-gray-700 dark:text-gray-300">
                    <li>Ketik <strong>"omzet hari ini"</strong> untuk melihat pemasukan terkini.</li>
                    <li>Ketik <strong>"menu terlaris"</strong> untuk ranking makanan & minuman.</li>
                    <li>Ketik <strong>"jam sibuk"</strong> untuk prediksi waktu teramai.</li>
                    <li>Ketik <strong>"rekomendasi promo"</strong> untuk ide strategi bundling harga.</li>
                </ul>
                <p class="text-[11px] text-blue-600 dark:text-blue-400 font-medium">Ada hal spesifik lain yang ingin Anda ketahui tentang performa resto?</p>
            </div>
        `;
    }

    function handleAIChatSubmit(event) {
        event.preventDefault();
        const input = document.getElementById('ai-chat-input');
        if (!input) return;

        const text = input.value.trim();
        if (!text) return;

        // 1. Render user message
        appendUserMessage(text);
        input.value = '';

        // 2. Show loading animation
        appendBotLoading();

        // 3. Simulate thinking delay (400 - 800ms)
        setTimeout(() => {
            removeBotLoading();
            const responseHtml = generateAIResponse(text);
            appendBotMessage(responseHtml);
        }, 600);
    }
</script>
