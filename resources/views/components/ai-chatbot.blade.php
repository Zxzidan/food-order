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

    // AI Natural Language Understanding & Answer Generation Engine (Sekarang menggunakan Backend)

    async function handleAIChatSubmit(event) {
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

        // 3. Connect to Backend Gemini API
        try {
            const response = await fetch('{{ route("ai.chat") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ message: text })
            });

            const data = await response.json();
            removeBotLoading();

            if (response.ok) {
                appendBotMessage(data.response);
            } else {
                appendBotMessage(`<div class="text-red-500 font-semibold p-2 bg-red-50 dark:bg-red-900/30 rounded">Error: ${data.error || 'Terjadi kesalahan sistem.'}</div>`);
            }
        } catch (error) {
            removeBotLoading();
            appendBotMessage('<div class="text-red-500 font-semibold p-2 bg-red-50 dark:bg-red-900/30 rounded">Gagal terhubung ke server AI. Periksa koneksi internet Anda.</div>');
        }
    }
</script>
