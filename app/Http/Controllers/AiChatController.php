<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class AiChatController extends Controller
{
    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $apiKey = env('OPENROUTER_API_KEY');
        $model = env('OPENROUTER_MODEL', 'openrouter/free');

        if (empty($apiKey)) {
            return response()->json([
                'error' => 'API Key OpenRouter belum dikonfigurasi. Silakan tambahkan OPENROUTER_API_KEY di file .env Anda.',
            ], 500);
        }

        // Ambil data real-time restoran dari database
        $restaurantContext = $this->buildRestaurantContext();

        $systemPrompt = "Anda adalah SIPEMMA AI, asisten virtual cerdas untuk manajemen restoran SIPEMMA.
Tugas Anda adalah membantu pemilik dan staf restoran menganalisis penjualan, performa menu, dan memantau stok berdasarkan data real-time restoran di bawah ini.

=== DATA REAL-TIME RESTORAN SIPEMMA ===
{$restaurantContext}
======================================

ATURAN STRUKTUR & FORMAT TAMPILAN (SANGAT PENTING):
1. Buat jawaban yang SANGAT RAPI, TERSTRUKTUR, dan MUDAH DIBACA:
   - Gunakan judul bagian dengan heading '### Judul' untuk memisahkan topik.
   - Gunakan poin daftar '-' yang rapi untuk rincian data (jangan buat teks menggumpal dalam satu paragraf panjang).
   - Tebalkan (**bold**) angka rupiah (contoh: **Rp 120.000**), jumlah porsi, atau nama menu penting.
   - Pisahkan setiap bab/kategori dengan baris kosong agar tidak berdempetan.
   - Jangan membuat tabel teks ascii (|---|) yang terlalu lebar. Lebih baik sajikan data dalam bentuk daftar poin berurutan yang informatif.
2. Gunakan data angka dan fakta nyata dari ringkasan restoran di atas.
3. Jika transaksi hari ini masih 0, jelaskan dengan ramah bahwa belum ada transaksi baru hari ini, lalu sajikan analisis berdasarkan data penjualan keseluruhan atau transaksi terakhir.
4. Jawab secara ringkas, ramah, profesional, dan dalam bahasa Indonesia.";

        $url = 'https://openrouter.ai/api/v1/chat/completions';

        $payload = [
            'model' => $model,
            'provider' => [
                'ignore' => ['Nvidia'],
            ],
            'messages' => [
                [
                    'role' => 'system',
                    'content' => $systemPrompt,
                ],
                [
                    'role' => 'user',
                    'content' => $request->message,
                ],
            ],
        ];

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.$apiKey,
            ])->post($url, $payload);

            if ($response->successful()) {
                $data = $response->json();

                if (isset($data['choices'][0]['message']['content'])) {
                    $aiText = $data['choices'][0]['message']['content'];

                    // Simple markdown to HTML conversion for basic things since the frontend renders HTML directly
                    // To handle basic bold and list markdown
                    $aiTextHtml = $this->parseSimpleMarkdown($aiText);

                    return response()->json([
                        'response' => $aiTextHtml,
                    ]);
                }
            }

            return response()->json([
                'error' => 'Gagal mendapatkan respons yang valid dari server AI.',
                'details' => $response->body(),
            ], 500);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Terjadi kesalahan sistem saat menghubungi AI.',
            ], 500);
        }
    }

    /**
     * Parse markdown menjadi HTML yang rapi menggunakan engine CommonMark bawaan Laravel
     */
    private function parseSimpleMarkdown(string $text): string
    {
        // Gunakan CommonMark bawaan Laravel untuk parsing markdown lengkap (heading, bold, list, blockquote, table)
        $html = Str::markdown($text, [
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ]);

        return '<div class="ai-markdown-body">'.$html.'</div>';
    }

    /**
     * Membangun ringkasan data restoran real-time dari database
     */
    private function buildRestaurantContext(): string
    {
        try {
            $now = now()->locale('id')->isoFormat('dddd, D MMMM Y - HH:mm').' WIB';
            $today = now()->format('Y-m-d');

            // 1. Data Hari Ini
            $todayOrders = Order::whereDate('created_at', today())->get();
            $todayRevenue = $todayOrders->where('payment_status', 'paid')->sum('total_amount');
            $todayCount = $todayOrders->count();
            $todayCompletedCount = $todayOrders->where('status', 'Selesai')->count();
            $todayPendingCount = $todayOrders->where('status', 'Diproses')->count();

            // 2. Data Keseluruhan / Akumulasi
            $allOrders = Order::all();
            $totalRevenue = $allOrders->where('payment_status', 'paid')->sum('total_amount');
            $totalOrdersCount = $allOrders->count();
            $totalCompleted = $allOrders->where('status', 'Selesai')->count();

            // 3. Menu Terlaris (Top 5 berdasarkan kolom sold)
            $topMenus = Menu::orderByDesc('sold')->take(5)->get(['name', 'price', 'sold', 'stock']);
            $topMenusList = $topMenus->isNotEmpty()
                ? $topMenus->map(function ($m) {
                    return "- {$m->name}: Rp ".number_format($m->price, 0, ',', '.')." | Terjual: {$m->sold} porsi | Sisa Stok: {$m->stock}";
                })->implode("\n")
                : '- Belum ada data menu terlaris.';

            // 4. Menu dengan Stok Menipis (stok <= 10)
            $lowStockMenus = Menu::where('stock', '<=', 10)->get(['name', 'stock']);
            $lowStockList = $lowStockMenus->isNotEmpty()
                ? $lowStockMenus->map(fn ($m) => "- {$m->name}: Sisa {$m->stock} porsi")->implode("\n")
                : '- Semua stok menu dalam kondisi aman.';

            // 5. 5 Transaksi Terakhir
            $recentOrders = Order::with('items')->latest()->take(5)->get();
            $recentOrdersList = $recentOrders->isNotEmpty()
                ? $recentOrders->map(function ($o) {
                    $itemsSummary = $o->items->map(fn ($i) => "{$i->menu_name} ({$i->quantity}x)")->implode(', ');
                    $time = $o->created_at ? $o->created_at->format('d/m H:i') : '-';

                    return "- [{$time}] {$o->order_number} ({$o->customer_name}) - Rp ".number_format($o->total_amount, 0, ',', '.')." [Status: {$o->status}, Bayar: {$o->payment_status}] Menu: {$itemsSummary}";
                })->implode("\n")
                : '- Belum ada transaksi sebelumnya.';

            // 6. Ringkasan Menu Aktif & Harga
            $allAvailableMenus = Menu::where('is_available', true)->get(['name', 'price']);
            $menusList = $allAvailableMenus->map(fn ($m) => "{$m->name} (Rp ".number_format($m->price, 0, ',', '.').')')->implode(', ');

            return "Waktu Sistem: {$now}

[PENJUALAN HARI INI ({$today})]
- Total Pemasukan: Rp ".number_format($todayRevenue, 0, ',', '.')."
- Total Pesanan: {$todayCount} pesanan ({$todayCompletedCount} Selesai, {$todayPendingCount} Diproses)

[PENJUALAN KESELURUHAN (ALL-TIME)]
- Total Akumulasi Omset: Rp ".number_format($totalRevenue, 0, ',', '.')."
- Total Transaksi Masuk: {$totalOrdersCount} pesanan ({$totalCompleted} Selesai)

[TOP 5 MENU TERLARIS]
{$topMenusList}

[STATUS STOK MENIPIS (<= 10 PORSI)]
{$lowStockList}

[5 TRANSAKSI TERBARU]
{$recentOrdersList}

[DAFTAR MENU AKTIF DI RESTORAN]
{$menusList}";
        } catch (\Exception $e) {
            return "Catatan: Tidak dapat mengambil ringkasan database lengkap ({$e->getMessage()}).";
        }
    }
}
