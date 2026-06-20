<?php

namespace Tests\Feature;

use App\Models\GlobalSetting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class TelegramWebhookTest extends TestCase
{
    use RefreshDatabase;

    public function test_start_message_sends_welcome_and_web_app_button(): void
    {
        Http::fake([
            'https://api.telegram.org/*/sendMessage' => Http::response(['ok' => true]),
        ]);

        GlobalSetting::current()->update([
            'confirm_bot_token' => '123456:ABC',
        ]);

        $response = $this->postJson(route('botwebhook.confirm', ['token' => '123456:ABC']), [
            'message' => [
                'text' => '/start',
                'chat' => [
                    'id' => 99,
                ],
            ],
        ]);

        $response->assertOk();

        Http::assertSent(function ($request) {
            return str_contains($request->url(), '/sendMessage')
                && $request['chat_id'] === 99
                && str_contains($request['text'], 'Xush kelibsiz')
                && data_get($request['reply_markup'], 'inline_keyboard.0.0.text') === 'Web botni ochish';
        });
    }
}
