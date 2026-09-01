<?php

namespace App\Http\Controllers;

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

        $apiKey = config('services.gemini.key', env('GEMINI_API_KEY'));
        
        if (empty($apiKey)) {
            return response()->json([
                'error' => 'API Key Gemini belum dikonfigurasi. Silakan tambahkan GEMINI_API_KEY di file .env Anda.'
            ], 500);
        }

        // Menggunakan gemini-3.6-flash karena telah teruji (kuota 3.5 sudah habis)
        $url = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-3.6-flash:generateContent?key=' . $apiKey;

        $payload = [
            'systemInstruction' => [
                'parts' => [
                    [
                        'text' => 'Anda adalah SIPEMMA AI, asisten virtual cerdas untuk restoran. Tugas Anda adalah membantu pemilik restoran menganalisis penjualan, merekomendasikan promo menu, memprediksi jam sibuk, atau menjawab pertanyaan manajemen restoran lainnya. Jawab secara ringkas, ramah, profesional, dan dalam bahasa Indonesia. Anda dapat menggunakan format markdown ringan seperti **bold** atau list jika dibutuhkan.'
                    ]
                ]
            ],
            'contents' => [
                [
                    'role' => 'user',
                    'parts' => [
                        ['text' => $request->message]
                    ]
                ]
            ]
        ];

        try {
            $response = Http::post($url, $payload);
            
            if ($response->successful()) {
                $data = $response->json();
                
                if (isset($data['candidates'][0]['content']['parts'][0]['text'])) {
                    $aiText = $data['candidates'][0]['content']['parts'][0]['text'];
                    
                    // Simple markdown to HTML conversion for basic things since the frontend renders HTML directly
                    // To handle basic bold and list markdown
                    $aiTextHtml = $this->parseSimpleMarkdown($aiText);
                    
                    return response()->json([
                        'response' => $aiTextHtml
                    ]);
                }
            }
            
            return response()->json([
                'error' => 'Gagal mendapatkan respons yang valid dari server AI.',
                'details' => $response->body()
            ], 500);
            
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Terjadi kesalahan sistem saat menghubungi AI.'
            ], 500);
        }
    }

    /**
     * Parse basic markdown for safe HTML rendering in chatbot UI
     */
    private function parseSimpleMarkdown($text)
    {
        // Escape HTML first to prevent XSS
        $html = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
        
        // Bold: **text** -> <strong>text</strong>
        $html = preg_replace('/\*\*(.*?)\*\*/', '<strong class="font-bold text-gray-900 dark:text-white">$1</strong>', $html);
        
        // Italic: *text* -> <em>text</em>
        $html = preg_replace('/\*([^\*]+)\*/', '<em class="italic">$1</em>', $html);
        
        // Line breaks: \n -> <br>
        $html = nl2br($html);
        
        // Wrap in standard space-y-2 container
        return '<div class="space-y-2">' . $html . '</div>';
    }
}
