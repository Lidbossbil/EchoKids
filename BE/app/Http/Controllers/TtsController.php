<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class TtsController extends Controller
{
    /**
     * Trả về âm thanh đọc tiếng Việt (MP3) để trình duyệt phát khi Web Speech không có giọng vi.
     */
    public function vietnamese(Request $request): Response
    {
        $text = mb_substr(trim((string) $request->query('t', '')), 0, 200);
        if ($text === '') {
            abort(422);
        }

        $response = Http::withHeaders([
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36',
            'Referer' => 'https://translate.google.com/',
        ])
            ->timeout(20)
            ->get('https://translate.google.com/translate_tts', [
                'ie' => 'UTF-8',
                'client' => 'tw-ob',
                'tl' => 'vi',
                'q' => $text,
            ]);

        if (! $response->successful()) {
            abort(502);
        }

        $body = $response->body();
        if ($body === '' || strlen($body) < 32) {
            abort(502);
        }

        if (str_starts_with($body, '<') || str_contains(substr($body, 0, 200), '<!DOCTYPE')) {
            abort(502);
        }

        return response($body, 200, [
            'Content-Type' => 'audio/mpeg',
            'Cache-Control' => 'public, max-age=86400',
        ]);
    }
}
