<?php

namespace App\Livewire\Admin;

use App\Models\GlobalSetting;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Validate;
use Livewire\Component;

class BotSettings extends Component
{
    public GlobalSetting $globalSetting;

    #[Validate('required|string')]
    public string $confirm_bot_token = '';

    public function mount(): void
    {
        $this->globalSetting = GlobalSetting::current();
        $this->confirm_bot_token = (string) $this->globalSetting->confirm_bot_token;
    }

    public function saveBotToken(): void
    {
        $this->validate([
            'confirm_bot_token' => 'required|string',
        ]);

        $token = trim($this->confirm_bot_token);

        $this->globalSetting->update([
            'confirm_bot_token' => $token,
        ]);

        $this->confirm_bot_token = $token;
        $webhookUrl = route('botwebhook.confirm', ['token' => $token]);

        try {
            Http::retry(2, 1000, throw: false)
                ->timeout(15)
                ->post("https://api.telegram.org/bot{$token}/deleteWebhook");
        } catch (\Throwable $e) {
            Log::warning('Telegram deleteWebhook failed', [
                'message' => $e->getMessage(),
            ]);
        }

        try {
            $webhookResponse = Http::retry(2, 1000, throw: false)
                ->timeout(20)
                ->post("https://api.telegram.org/bot{$token}/setWebhook", [
                    'url' => $webhookUrl,
                ]);
        } catch (\Throwable $e) {
            $this->dispatch(
                'settingsTokenUpdated',
                type: 'error',
                message: "Telegram bilan ulanishda xatolik yuz berdi: {$e->getMessage()}"
            );

            return;
        }

        if ($webhookResponse->successful() && $webhookResponse->json('ok')) {
            $this->dispatch(
                'settingsTokenUpdated',
                type: 'success',
                message: 'Telegram Bot Token saqlandi va webhook sozlandi.'
            );

            return;
        }

        $this->dispatch(
            'settingsTokenUpdated',
            type: 'error',
            message: 'Telegram Bot Token saqlandi, lekin webhookni sozlashda xatolik yuz berdi: '.($webhookResponse->json('description') ?? 'unknown error')
        );
    }

    public function render()
    {
        return view('admin.livewire.bot-settings', [
            'webhookUrl' => $this->confirm_bot_token
                ? route('botwebhook.confirm', ['token' => trim($this->confirm_bot_token)])
                : null,
            'webAppUrl' => route('bot.dashboard'),
        ]);
    }
}
