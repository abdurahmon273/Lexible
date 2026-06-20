<?php

namespace App\Http\Controllers;

use App\Models\GlobalSetting;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TelegramWebhookController extends Controller
{
    public $user;
    public function __invoke(Request $request, string $token): JsonResponse
    {
        $setting = GlobalSetting::current();

        if (! $setting->confirm_bot_token || $setting->confirm_bot_token !== $token) {
            abort(404);
        }

        $messageText = trim((string) data_get($request->all(), 'message.text'));
        $chatId = data_get($request->all(), 'message.chat.id');

        if (!$chatId) {
            return response()->json(['ok' => true]);
        }
        $this->user=$this->CreateOrFindUser($chatId,$request);

        if (str_starts_with($messageText, '/start')) {
            $this->sendWelcomeMessage($token, (int) $chatId);
        }

        return response()->json(['ok' => true]);
    }

    protected function sendWelcomeMessage(string $token, int $chatId): void
    {
        // Encrypted token: chat_id + expiry (1 soat), URL ga qo'shamiz
        $authToken = Crypt::encryptString(json_encode([
            'chat_id' => $chatId,
            'exp'     => now()->addHour()->timestamp,
        ]));

        $webAppUrl = route('bot.dashboard') . '?t=' . urlencode($authToken);

        try {
            $text="Xush kelibsiz,".$this->user->name."\n\n Pastdagi tugma orqali oching.";
            Http::retry(2, 1000, throw: false)
                ->timeout(20)
                ->post("https://api.telegram.org/bot{$token}/sendMessage", [
                    'chat_id' => $chatId,
                    'text' => $text,
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

    protected function CreateOrFindUser($chatId, Request $request)
    {
        $data = $request->all();
        $name     = data_get($data, 'message.from.first_name', '')
                  . ' ' . data_get($data, 'message.from.last_name', '');
        $name     = trim($name) ?: 'Foydalanuvchi';
        $username = data_get($data, 'message.from.username');

        $user = User::where('chat_id', $chatId)->first();

        if ($user) {
            $user->update([
                'name'     => $name,
                'username' => $username,
            ]);
            return $user;
        }

        return User::create([
            'chat_id'  => $chatId,
            'name'     => $name,
            'username' => $username,
            'password' => Hash::make('password'),
        ]);
    }
}
