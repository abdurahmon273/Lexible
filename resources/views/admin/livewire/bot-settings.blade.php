<div
    x-data="{ toast: null, toastType: 'success' }"
    x-on:settingsTokenUpdated.window="
        toast = $event.detail.message;
        toastType = $event.detail.type;
        setTimeout(() => toast = null, 5000);
    "
>
    <style>
        .bs-wrap {
            max-width: 560px;
            margin: 32px auto 0;
        }

        .bs-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            padding: 36px 32px 28px;
            box-shadow: 0 4px 24px rgba(15, 23, 42, 0.06);
        }

        .bs-card-title {
            font-size: 1.15rem;
            font-weight: 900;
            color: #0f172a;
            margin: 0 0 24px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .bs-card-title svg {
            flex-shrink: 0;
        }

        .bs-label {
            display: block;
            font-size: 0.88rem;
            font-weight: 700;
            color: #475569;
            margin-bottom: 8px;
            letter-spacing: 0.03em;
            text-transform: uppercase;
        }

        .bs-input-wrap {
            position: relative;
        }

        .bs-input {
            width: 100%;
            border: 1.5px solid #cbd5e1;
            border-radius: 14px;
            padding: 15px 18px;
            font: inherit;
            font-size: 1rem;
            color: #0f172a;
            background: #f8fafc;
            transition: border-color .15s, box-shadow .15s;
            box-sizing: border-box;
            letter-spacing: 0.02em;
        }

        .bs-input:focus {
            outline: none;
            border-color: #2563eb;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.12);
        }

        .bs-input::placeholder {
            color: #94a3b8;
        }

        .bs-input-error {
            border-color: #ef4444 !important;
            box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.10) !important;
        }

        .bs-error-msg {
            margin-top: 7px;
            color: #dc2626;
            font-size: 0.87rem;
            font-weight: 600;
        }

        .bs-btn {
            margin-top: 22px;
            width: 100%;
            border: 0;
            border-radius: 14px;
            padding: 17px 24px;
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            color: #fff;
            font: inherit;
            font-size: 1rem;
            font-weight: 800;
            cursor: pointer;
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.28);
            transition: opacity .15s, transform .1s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .bs-btn:hover:not(:disabled) {
            opacity: .92;
            transform: translateY(-1px);
        }

        .bs-btn:active:not(:disabled) {
            transform: translateY(0);
        }

        .bs-btn:disabled {
            cursor: wait;
            opacity: .7;
        }

        /* Toast */
        .bs-toast {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 16px 18px;
            border-radius: 14px;
            font-weight: 700;
            font-size: 0.97rem;
            margin-bottom: 20px;
            animation: bs-fadein .25s ease;
        }

        .bs-toast.success {
            background: #f0fdf4;
            border: 1.5px solid #86efac;
            color: #15803d;
        }

        .bs-toast.error {
            background: #fef2f2;
            border: 1.5px solid #fca5a5;
            color: #b91c1c;
        }

        .bs-toast-icon {
            flex-shrink: 0;
            margin-top: 1px;
        }

        @keyframes bs-fadein {
            from { opacity: 0; transform: translateY(-6px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 600px) {
            .bs-card {
                padding: 24px 18px 20px;
            }
        }
    </style>

    <div class="bs-wrap">
        <template x-if="toast">
            <div class="bs-toast" :class="toastType">
                <span class="bs-toast-icon">
                    <template x-if="toastType === 'success'">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <circle cx="10" cy="10" r="10" fill="#22c55e"/>
                            <path d="M6 10.5l3 3 5-5.5" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </template>
                    <template x-if="toastType === 'error'">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <circle cx="10" cy="10" r="10" fill="#ef4444"/>
                            <path d="M7 7l6 6M13 7l-6 6" stroke="#fff" stroke-width="1.8" stroke-linecap="round"/>
                        </svg>
                    </template>
                </span>
                <span x-text="toast"></span>
            </div>
        </template>

        <div class="bs-card">
            <p class="bs-card-title">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z" fill="#eff6ff"/>
                    <path d="M15.5 9a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0zM12 14c-3.86 0-7 1.79-7 4v1h14v-1c0-2.21-3.14-4-7-4z" fill="#2563eb"/>
                </svg>
                Bot Token
            </p>

            <label class="bs-label" for="bot_token">BotFather Token</label>

            <div class="bs-input-wrap">
                <input
                    id="bot_token"
                    type="text"
                    class="bs-input @error('confirm_bot_token') bs-input-error @enderror"
                    wire:model="confirm_bot_token"
                    placeholder="123456789:AAxxxxxxxxxxxxxxxxxxxxxx"
                    autocomplete="off"
                    spellcheck="false"
                />
            </div>

            @error('confirm_bot_token')
                <div class="bs-error-msg">{{ $message }}</div>
            @enderror

            <button
                class="bs-btn"
                type="button"
                wire:click="saveBotToken"
                wire:loading.attr="disabled"
            >
                <svg wire:loading.remove width="20" height="20" viewBox="0 0 24 24" fill="none">
                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <polyline points="17 21 17 13 7 13 7 21" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <polyline points="7 3 7 8 15 8" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span wire:loading.remove>Tokenni saqlash va webhook ulash</span>
                <span wire:loading>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" style="animation:spin 1s linear infinite">
                        <circle cx="12" cy="12" r="10" stroke="rgba(255,255,255,0.3)" stroke-width="3"/>
                        <path d="M12 2a10 10 0 0 1 10 10" stroke="#fff" stroke-width="3" stroke-linecap="round"/>
                    </svg>
                    Ulanmoqda...
                </span>
            </button>
        </div>
    </div>

    <style>
        @keyframes spin { to { transform: rotate(360deg); } }
    </style>
</div>
