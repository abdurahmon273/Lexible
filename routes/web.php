<?php

use App\Http\Controllers\Auth\SuperAdminLoginController;
use App\Http\Controllers\BotController;
use App\Http\Controllers\TelegramWebhookController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return Auth::check()
        ? redirect()->route('admin.settings')
        : redirect()->route('login');
})->name('home');

Route::middleware('guest')->group(function (): void {
    Route::get('/login', [SuperAdminLoginController::class, 'create'])->name('login');
    Route::post('/login', [SuperAdminLoginController::class, 'store'])->name('login.store');
});

Route::middleware(['auth', 'super_admin'])->group(function (): void {
    Route::redirect('/admin', '/admin/settings');

    Route::view('/admin/settings', 'admin.settings')->name('admin.settings');
    Route::post('/logout', [SuperAdminLoginController::class, 'destroy'])->name('logout');
});

Route::prefix('web-bot')->group(function () {
    Route::get('/',        [BotController::class, 'dashboard'])->name('bot.dashboard');
    Route::get('/roadmap', [BotController::class, 'roadmap'])->name('bot.roadmap');
});

Route::post('/bot/webhook/{token}', TelegramWebhookController::class)->name('botwebhook.confirm');
