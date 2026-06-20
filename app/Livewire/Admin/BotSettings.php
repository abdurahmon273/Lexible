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

        $newToken = trim($this->confirm_bot_token);
        $oldToken = trim((string) $this->globalSetting->confirm_bot_token);

        // 1. Eski bot'ning webhook'ini o'chir (token o'zgargan bo'lsa)
        if ($oldToken && $oldToken !== $newToken) {
            try {
                Http::retry(2, 1000, throw: false)
                    ->timeout(15)
                    ->post("https://api.telegram.org/bot{$oldToken}/deleteWebhook", [
                        'drop_pending_updates' => true,
                    ]);
            } catch (\Throwable $e) {
                Log::warning('Telegram deleteWebhook (old token) failed', [
                    'message' => $e->getMessage(),
                ]);
            }
        }

        // 2. DB ga yangi tokenni saqlash
        $this->globalSetting->update([
            'confirm_bot_token' => $newToken,
        ]);
        $this->confirm_bot_token = $newToken;

        // 3. Yangi token bilan webhook o'rnat
        $webhookUrl = route('botwebhook.confirm', ['token' => $newToken]);

        // Avval yangi bot'ning eski webhook'ini ham tozalab ol
        try {
            Http::retry(2, 1000, throw: false)
                ->timeout(15)
                ->post("https://api.telegram.org/bot{$newToken}/deleteWebhook", [
                    'drop_pending_updates' => true,
                ]);
        } catch (\Throwable $e) {
            Log::warning('Telegram deleteWebhook (new token) failed', [
                'message' => $e->getMessage(),
            ]);
        }

        try {
            $webhookResponse = Http::retry(2, 1000, throw: false)
                ->timeout(20)
                ->post("https://api.telegram.org/bot{$newToken}/setWebhook", [
                    'url'                => $webhookUrl,
                    'drop_pending_updates' => true,
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
            message: 'Token saqlandi, lekin webhook sozlanmadi: ' . ($webhookResponse->json('description') ?? 'unknown error')
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
