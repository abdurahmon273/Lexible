<?php

namespace Tests\Feature;

use App\Livewire\Admin\BotSettings;
use App\Models\GlobalSetting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Livewire\Livewire;
use Tests\TestCase;

class BotSettingsTest extends TestCase
{
    use RefreshDatabase;

    public function test_super_admin_can_save_bot_token_and_set_webhook(): void
    {
        Http::fake([
            'https://api.telegram.org/*/deleteWebhook' => Http::response(['ok' => true]),
            'https://api.telegram.org/*/setWebhook' => Http::response(['ok' => true]),
        ]);

        $user = User::factory()->create([
            'email' => config('super_admin.email'),
        ]);

        Livewire::actingAs($user)
            ->test(BotSettings::class)
            ->set('confirm_bot_token', '123456:ABC')
            ->call('saveBotToken')
            ->assertHasNoErrors()
            ->assertDispatched('settingsTokenUpdated');

        $this->assertSame('123456:ABC', GlobalSetting::current()->confirm_bot_token);

        Http::assertSent(fn ($request) => str_contains($request->url(), '/deleteWebhook'));
        Http::assertSent(fn ($request) => str_contains($request->url(), '/setWebhook'));
    }
}
