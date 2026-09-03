<!-- ========================================================= -->
<!-- SIPEMMA AI Restaurant Assistant Chatbot Component -->
<!-- ========================================================= -->

<style>
/* AI Chatbot Markdown Formatting */
.ai-markdown-body {
    font-size: 0.785rem;
    line-height: 1.65;
    color: inherit;
    word-break: break-word;
}
.ai-markdown-body p {
    margin-bottom: 0.65rem;
}
.ai-markdown-body p:last-child {
    margin-bottom: 0;
}
.ai-markdown-body h1,
.ai-markdown-body h2,
.ai-markdown-body h3,
.ai-markdown-body h4 {
    font-weight: 700;
    margin-top: 0.85rem;
    margin-bottom: 0.4rem;
    color: #111827;
}
.dark .ai-markdown-body h1,
.dark .ai-markdown-body h2,
.dark .ai-markdown-body h3,
.dark .ai-markdown-body h4 {
    color: #f9fafb;
}
.ai-markdown-body h1 { font-size: 0.95rem; border-bottom: 1px solid #e5e7eb; padding-bottom: 0.25rem; }
.ai-markdown-body h2 { font-size: 0.875rem; border-bottom: 1px solid #e5e7eb; padding-bottom: 0.2rem; }
.ai-markdown-body h3 { font-size: 0.825rem; }
.ai-markdown-body h4 { font-size: 0.785rem; }

.ai-markdown-body ul {
    list-style-type: disc !important;
    padding-left: 1.25rem !important;
    margin-top: 0.35rem;
    margin-bottom: 0.65rem;
}
.ai-markdown-body ol {
    list-style-type: decimal !important;
    padding-left: 1.25rem !important;
    margin-top: 0.35rem;
    margin-bottom: 0.65rem;
}
.ai-markdown-body li {
    margin-bottom: 0.3rem;
    padding-left: 0.15rem;
}
.ai-markdown-body li::marker {
    color: #f97316;
}
.ai-markdown-body strong {
    font-weight: 600;
    color: #111827;
}
.dark .ai-markdown-body strong {
    color: #f3f4f6;
}
.ai-markdown-body blockquote {
    border-left: 3px solid #f97316;
    padding: 0.4rem 0.65rem;
    margin: 0.5rem 0;
    background-color: rgba(249, 115, 22, 0.06);
    border-radius: 0 0.5rem 0.5rem 0;
    color: #4b5563;
    font-style: normal;
}
.dark .ai-markdown-body blockquote {
    background-color: rgba(249, 115, 22, 0.12);
    color: #9ca3af;
}
.ai-markdown-body table {
    width: 100%;
    border-collapse: collapse;
    margin: 0.65rem 0;
    font-size: 0.72rem;
    border-radius: 0.5rem;
    overflow: hidden;
    border: 1px solid #e5e7eb;
}
.dark .ai-markdown-body table {
    border-color: #374151;
}
.ai-markdown-body th {
    background-color: #f3f4f6;
    color: #374151;
    font-weight: 600;
    padding: 0.45rem 0.55rem;
    text-align: left;
    border-bottom: 1px solid #e5e7eb;
}
.dark .ai-markdown-body th {
    background-color: #1f2937;
    color: #e5e7eb;
    border-color: #374151;
}
.ai-markdown-body td {
    padding: 0.4rem 0.55rem;
    border-bottom: 1px solid #f3f4f6;
}
.dark .ai-markdown-body td {
    border-color: #374151;
}
.ai-markdown-body tr:last-child td {
    border-bottom: none;
}
.ai-markdown-body tr:nth-child(even) {
    background-color: rgba(249, 250, 251, 0.5);
}
.dark .ai-markdown-body tr:nth-child(even) {
    background-color: rgba(31, 41, 55, 0.4);
}
.ai-markdown-body code {
    background: #f1f5f9;
    padding: 0.1rem 0.35rem;
    border-radius: 0.25rem;
    font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
    font-size: 0.72rem;
    color: #ea580c;
}
.dark .ai-markdown-body code {
    background: #1e293b;
    color: #fb923c;
}
.ai-markdown-body hr {
    border: 0;
    height: 1px;
    background: #e5e7eb;
    margin: 0.75rem 0;
}
.dark .ai-markdown-body hr {
    background: #374151;
}
</style>

<!-- 1. Floating AI Assistant Trigger Button (Bottom-Right) -->
<div id="ai-chat-trigger-container" class="fixed bottom-5 right-5 z-45 flex items-center gap-2 group">
    <!-- Tooltip / Callout -->
    <div class="hidden sm:flex items-center gap-1.5 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 text-xs font-semibold px-3 py-1.5 rounded-full shadow-lg border border-gray-100 dark:border-gray-700 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
        <span>Assistant</span>
    </div>

    <!-- Main Floating Button -->
    <button type="button" id="ai-chat-open-btn" onclick="toggleAIChat()"
        class="relative flex items-center justify-center w-14 h-14 rounded-full bg-orange-500 hover:bg-orange-600 text-white shadow-xl hover:shadow-2xl hover:scale-105 active:scale-95 transition-all duration-300 cursor-pointer">
        <!-- Clean Sparkle / Chat Icon -->
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
        </svg>
    </button>
</div>

<!-- 2. AI Chatbot Floating Window Panel -->
<div id="ai-chat-window" class="hidden fixed bottom-5 right-5 sm:bottom-6 sm:right-6 z-50 w-[calc(100vw-2.5rem)] sm:w-[420px] max-h-[85vh] h-[640px] flex flex-col bg-white dark:bg-gray-800 rounded-3xl shadow-2xl border border-gray-100 dark:border-gray-700 overflow-hidden transition-all duration-300 transform scale-95 opacity-0">
    
    <!-- Top Header Bar -->
    <div class="px-5 py-4 bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between shadow-sm">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-2xl bg-orange-50 dark:bg-orange-950/40 flex items-center justify-center text-orange-600 dark:text-orange-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
            </div>
            <div>
                <h3 class="text-sm font-bold text-gray-900 dark:text-white">SIPEMMA Assistant</h3>
                <p class="text-[11px] text-gray-500 dark:text-gray-400">Siap membantu Anda</p>
            </div>
        </div>

        <div class="flex items-center gap-1 text-gray-500 dark:text-gray-400">
            <!-- Clear Chat History -->
            <button type="button" onclick="clearAIChatHistory()" title="Bersihkan Percakapan"
                class="p-1.5 hover:text-gray-900 hover:bg-gray-100 dark:hover:text-white dark:hover:bg-gray-700 rounded-xl transition cursor-pointer">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
            </button>

            <!-- Close Chat Window -->
            <button type="button" onclick="toggleAIChat()" title="Tutup Chat"
                class="p-1.5 hover:text-gray-900 hover:bg-gray-100 dark:hover:text-white dark:hover:bg-gray-700 rounded-xl transition cursor-pointer">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Messages Container (Scrollable) -->
    <div id="ai-chat-messages" class="flex-1 p-4 overflow-y-auto space-y-4 text-xs bg-gray-50 dark:bg-gray-900 font-sans">
        
        <!-- Welcome Initial Message from AI -->
        <div class="flex items-start gap-2.5">
            <div class="w-8 h-8 rounded-full bg-orange-50 dark:bg-gray-800 border border-orange-100 dark:border-gray-700 flex items-center justify-center shrink-0 text-orange-600 dark:text-orange-400 mt-0.5 shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
            </div>
            <div class="flex-1 space-y-2">
                <div class="bg-white dark:bg-gray-800 p-3.5 rounded-2xl rounded-tl-none border border-gray-100 dark:border-gray-700 shadow-sm text-gray-800 dark:text-gray-200 space-y-1.5">
                    <p class="leading-relaxed">Halo! Saya asisten virtual Anda yang siap menyajikan data analisis performa restoran hari ini.</p>
                </div>
            </div>
        </div>

    </div>

    <!-- Quick Suggestion Chips (Horizontal Scrollable) -->
    <div class="px-4 py-3 bg-white dark:bg-gray-800 border-t border-gray-100 dark:border-gray-700 overflow-x-auto no-scrollbar flex items-center gap-2">
        <button type="button" onclick="sendQuickPrompt('Analisis performa penjualan hari ini')"
            class="shrink-0 px-3 py-1.5 bg-gray-50 dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 border border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-200 rounded-full text-[11px] font-medium transition cursor-pointer">
            Omzet Hari Ini
        </button>
        <button type="button" onclick="sendQuickPrompt('Apa menu paling laris?')"
            class="shrink-0 px-3 py-1.5 bg-gray-50 dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 border border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-200 rounded-full text-[11px] font-medium transition cursor-pointer">
            Menu Terlaris
        </button>
        <button type="button" onclick="sendQuickPrompt('Kapan jam paling ramai di resto?')"
            class="shrink-0 px-3 py-1.5 bg-gray-50 dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 border border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-200 rounded-full text-[11px] font-medium transition cursor-pointer">
            Jam Sibuk
        </button>
        <button type="button" onclick="sendQuickPrompt('Beri rekomendasi promo menu')"
            class="shrink-0 px-3 py-1.5 bg-gray-50 dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 border border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-200 rounded-full text-[11px] font-medium transition cursor-pointer">
            Ide Promo
        </button>
    </div>

    <!-- Input Form & Send Button -->
    <div class="p-3 bg-white dark:bg-gray-800 border-t border-gray-100 dark:border-gray-700">
        <form id="ai-chat-form" onsubmit="handleAIChatSubmit(event)" class="flex items-center gap-2">
            <input type="text" id="ai-chat-input"
                placeholder="Ketik pesan Anda..."
                autocomplete="off"
                class="flex-1 px-4 py-2.5 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white text-xs sm:text-sm rounded-full focus:ring-2 focus:ring-orange-500 placeholder:text-gray-400 transition" />
            
            <button type="submit" id="ai-send-btn"
                class="inline-flex items-center justify-center w-10 h-10 bg-orange-500 hover:bg-orange-600 text-white rounded-full shadow-sm transition cursor-pointer shrink-0">
                <svg class="w-4 h-4 transform rotate-90" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"/>
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
                    <div class="w-8 h-8 rounded-full bg-orange-50 dark:bg-gray-800 border border-orange-100 dark:border-gray-700 flex items-center justify-center shrink-0 text-orange-600 dark:text-orange-400 mt-0.5 shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                    </div>
                    <div class="flex-1 space-y-2">
                        <div class="bg-white dark:bg-gray-800 p-3.5 rounded-2xl rounded-tl-none border border-gray-100 dark:border-gray-700 shadow-sm text-gray-800 dark:text-gray-200">
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
            <div class="max-w-[85%] bg-orange-500 text-white p-3.5 rounded-2xl rounded-tr-none shadow-sm text-xs leading-relaxed">
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
            <div class="w-8 h-8 rounded-full bg-orange-50 dark:bg-gray-800 border border-orange-100 dark:border-gray-700 flex items-center justify-center shrink-0 text-orange-600 dark:text-orange-400 mt-0.5 shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
            </div>
            <div class="bg-white dark:bg-gray-800 p-3.5 rounded-2xl rounded-tl-none border border-gray-100 dark:border-gray-700 shadow-sm flex items-center gap-1.5 h-[42px] px-4">
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
            <div class="w-8 h-8 rounded-full bg-orange-50 dark:bg-gray-800 border border-orange-100 dark:border-gray-700 flex items-center justify-center shrink-0 text-orange-600 dark:text-orange-400 mt-0.5 shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
            </div>
            <div class="flex-1 max-w-[90%] bg-white dark:bg-gray-800 p-4 rounded-2xl rounded-tl-none border border-gray-100 dark:border-gray-700 shadow-sm text-gray-800 dark:text-gray-200 text-xs leading-relaxed overflow-x-auto">
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
                appendBotMessage(`<div class="text-red-500 font-medium p-2 bg-red-50 dark:bg-red-900/10 rounded-md border border-red-200 dark:border-red-800">Error: ${data.error || 'Terjadi kesalahan sistem.'}</div>`);
            }
        } catch (error) {
            removeBotLoading();
            appendBotMessage('<div class="text-red-500 font-medium p-2 bg-red-50 dark:bg-red-900/10 rounded-md border border-red-200 dark:border-red-800">Gagal terhubung ke server AI. Periksa koneksi internet Anda.</div>');
        }
    }
</script>
