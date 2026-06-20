<?php

namespace App\Http\Controllers;

use App\Models\GlobalSetting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TelegramWebhookController extends Controller
{
    public function __invoke(Request $request, string $token): JsonResponse
    {
        $setting = GlobalSetting::current();

        if (! $setting->confirm_bot_token || $setting->confirm_bot_token !== $token) {
            abort(404);
        }

        $messageText = trim((string) data_get($request->all(), 'message.text'));
        $chatId = data_get($request->all(), 'message.chat.id');

        if (! $chatId) {
            return response()->json(['ok' => true]);
        }

        if (str_starts_with($messageText, '/start')) {
            $this->sendWelcomeMessage($token, (int) $chatId);
        }

        return response()->json(['ok' => true]);
    }

    protected function sendWelcomeMessage(string $token, int $chatId): void
    {
        $webAppUrl = route('bot.dashboard');

        try {
            Http::retry(2, 1000, throw: false)
                ->timeout(20)
                ->post("https://api.telegram.org/bot{$token}/sendMessage", [
                    'chat_id' => $chatId,
                    'text' => "Xush kelibsiz. Lexible web bot tayyor. Pastdagi tugma orqali oching.",
                    'reply_markup' => [
                        'inline_keyboard' => [
                            [
                                [
                                    'text' => 'Web botni ochish',
                                    'web_app' => [
                                        'url' => $webAppUrl,
                                    ],
                                ],
                            ],
                        ],
                    ],
                ]);
        } catch (\Throwable $e) {
            Log::warning('Telegram sendMessage failed', [
                'message' => $e->getMessage(),
            ]);
        }
    }
}
