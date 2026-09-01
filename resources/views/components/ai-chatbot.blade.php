<!-- ========================================================= -->
<!-- SIPEMMA AI Restaurant Assistant Chatbot Component -->
<!-- ========================================================= -->

<!-- 1. Floating AI Assistant Trigger Button (Bottom-Right) -->
<div id="ai-chat-trigger-container" class="fixed bottom-5 right-5 z-45 flex items-center gap-2 group">
    <!-- Tooltip / Callout -->
    <div class="hidden sm:flex items-center gap-1.5 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 text-xs font-medium px-3 py-1.5 rounded-full shadow-sm border border-gray-200 dark:border-gray-700 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
        <span>Tanya Assistant</span>
    </div>

    <!-- Main Floating Button -->
    <button type="button" id="ai-chat-open-btn" onclick="toggleAIChat()"
        class="relative flex items-center justify-center w-12 h-12 rounded-full bg-gray-900 dark:bg-white text-white dark:text-gray-900 shadow-lg hover:shadow-xl hover:scale-105 active:scale-95 transition-all duration-300 cursor-pointer">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
        </svg>
    </button>
</div>

<!-- 2. AI Chatbot Floating Window Panel -->
<div id="ai-chat-window" class="hidden fixed bottom-5 right-5 sm:bottom-6 sm:right-6 z-50 w-[calc(100vw-2.5rem)] sm:w-[400px] max-h-[85vh] h-[600px] flex flex-col bg-white dark:bg-gray-800 rounded-2xl shadow-2xl border border-gray-200 dark:border-gray-700 overflow-hidden transition-all duration-300 transform scale-95 opacity-0">
    
    <!-- Top Header Bar -->
    <div class="px-5 py-4 bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center text-gray-600 dark:text-gray-300">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
            </div>
            <div>
                <h3 class="text-sm font-semibold text-gray-900 dark:text-white">SIPEMMA Assistant</h3>
                <p class="text-[11px] text-gray-500 dark:text-gray-400">Siap membantu Anda</p>
            </div>
        </div>

        <div class="flex items-center gap-1 text-gray-500 dark:text-gray-400">
            <!-- Clear Chat History -->
            <button type="button" onclick="clearAIChatHistory()" title="Bersihkan Percakapan"
                class="p-1.5 hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition cursor-pointer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
            </button>

            <!-- Close Chat Window -->
            <button type="button" onclick="toggleAIChat()" title="Tutup Chat"
                class="p-1.5 hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition cursor-pointer">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Messages Container (Scrollable) -->
    <div id="ai-chat-messages" class="flex-1 p-4 overflow-y-auto space-y-4 text-xs bg-gray-50/50 dark:bg-gray-900/30 font-sans">
        
        <!-- Welcome Initial Message from AI -->
        <div class="flex items-start gap-2.5">
            <div class="w-6 h-6 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center shrink-0 text-gray-600 dark:text-gray-300 mt-0.5">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
            </div>
            <div class="flex-1 space-y-2">
                <div class="bg-white dark:bg-gray-800 p-3.5 rounded-2xl rounded-tl-sm border border-gray-200 dark:border-gray-700 shadow-sm text-gray-800 dark:text-gray-200 space-y-1.5">
                    <p class="leading-relaxed">Halo! Saya siap membantu menyajikan data analisis performa resto Anda hari ini.</p>
                </div>
            </div>
        </div>

    </div>

    <!-- Quick Suggestion Chips (Horizontal Scrollable) -->
    <div class="px-4 py-3 bg-white dark:bg-gray-800 border-t border-gray-100 dark:border-gray-700/80 overflow-x-auto no-scrollbar flex items-center gap-2">
        <button type="button" onclick="sendQuickPrompt('Analisis performa penjualan hari ini')"
            class="shrink-0 px-3 py-1.5 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 border border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-full text-[11px] font-medium transition cursor-pointer shadow-sm">
            Omzet Hari Ini
        </button>
        <button type="button" onclick="sendQuickPrompt('Apa menu paling laris?')"
            class="shrink-0 px-3 py-1.5 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 border border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-full text-[11px] font-medium transition cursor-pointer shadow-sm">
            Menu Terlaris
        </button>
        <button type="button" onclick="sendQuickPrompt('Kapan jam paling ramai di resto?')"
            class="shrink-0 px-3 py-1.5 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 border border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-full text-[11px] font-medium transition cursor-pointer shadow-sm">
            Jam Sibuk
        </button>
        <button type="button" onclick="sendQuickPrompt('Beri rekomendasi promo menu')"
            class="shrink-0 px-3 py-1.5 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 border border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-full text-[11px] font-medium transition cursor-pointer shadow-sm">
            Ide Promo
        </button>
    </div>

    <!-- Input Form & Send Button -->
    <div class="p-3 bg-white dark:bg-gray-800 border-t border-gray-100 dark:border-gray-700">
        <form id="ai-chat-form" onsubmit="handleAIChatSubmit(event)" class="flex items-center gap-2">
            <input type="text" id="ai-chat-input"
                placeholder="Ketik pesan Anda..."
                autocomplete="off"
                class="flex-1 px-4 py-2 bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white text-xs sm:text-sm rounded-full focus:ring-1 focus:ring-gray-900 dark:focus:ring-gray-400 focus:border-gray-900 dark:focus:border-gray-400 placeholder:text-gray-400 transition" />
            
            <button type="submit" id="ai-send-btn"
                class="inline-flex items-center justify-center w-9 h-9 bg-gray-900 hover:bg-gray-800 dark:bg-white dark:hover:bg-gray-100 text-white dark:text-gray-900 rounded-full transition cursor-pointer shrink-0">
                <svg class="w-4 h-4 ml-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                </svg>
            </button>
        </form>
    </div>

</div>

<!-- ========================================================= -->
<!-- AI Intelligence Brain Script -->
<!-- ========================================================= -->
<script>
    let isChatOpen = false;

    function toggleAIChat() {
        const chatWindow = document.getElementById('ai-chat-window');
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
                    <div class="w-6 h-6 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center shrink-0 text-gray-600 dark:text-gray-300 mt-0.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                    </div>
                    <div class="flex-1 space-y-2">
                        <div class="bg-white dark:bg-gray-800 p-3.5 rounded-2xl rounded-tl-sm border border-gray-200 dark:border-gray-700 shadow-sm text-gray-800 dark:text-gray-200">
                            <p class="text-xs text-gray-500 dark:text-gray-400">Percakapan telah dibersihkan.</p>
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
            <div class="max-w-[85%] bg-gray-900 dark:bg-gray-100 text-white dark:text-gray-900 p-3.5 rounded-2xl rounded-tr-sm shadow-sm text-xs leading-relaxed">
                ${escapeHtml(text)}
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
            <div class="w-6 h-6 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center shrink-0 text-gray-600 dark:text-gray-300 mt-0.5">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
            </div>
            <div class="bg-white dark:bg-gray-800 p-3 rounded-2xl rounded-tl-sm border border-gray-200 dark:border-gray-700 shadow-sm flex items-center gap-1.5 h-[42px] px-4">
                <span class="w-1.5 h-1.5 rounded-full bg-gray-400 dark:bg-gray-500 animate-pulse"></span>
                <span class="w-1.5 h-1.5 rounded-full bg-gray-400 dark:bg-gray-500 animate-pulse" style="animation-delay: 0.15s"></span>
                <span class="w-1.5 h-1.5 rounded-full bg-gray-400 dark:bg-gray-500 animate-pulse" style="animation-delay: 0.3s"></span>
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
            <div class="w-6 h-6 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center shrink-0 text-gray-600 dark:text-gray-300 mt-0.5">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
            </div>
            <div class="flex-1 max-w-[90%] bg-white dark:bg-gray-800 p-3.5 rounded-2xl rounded-tl-sm border border-gray-200 dark:border-gray-700 shadow-sm text-gray-800 dark:text-gray-200 text-xs leading-relaxed space-y-2">
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
                appendBotMessage(`<div class="text-red-500 font-medium p-2 bg-red-50 dark:bg-red-900/10 rounded-md">Error: ${data.error || 'Terjadi kesalahan sistem.'}</div>`);
            }
        } catch (error) {
            removeBotLoading();
            appendBotMessage('<div class="text-red-500 font-medium p-2 bg-red-50 dark:bg-red-900/10 rounded-md">Gagal terhubung ke server AI. Periksa koneksi internet Anda.</div>');
        }
    }
</script>
