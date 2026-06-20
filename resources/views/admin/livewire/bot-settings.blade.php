<div
    x-data="{ toast: null, type: 'success' }"
    x-on:settingsTokenUpdated.window="
        toast = $event.detail.message;
        type = $event.detail.type;
        setTimeout(() => toast = null, 5000);
    "
>
    <style>
        .bot-settings {
            display: grid;
            gap: 18px;
            margin-top: 22px;
        }

        .bot-toast {
            padding: 16px 18px;
            border-radius: 14px;
            font-weight: 800;
        }

        .bot-toast.success {
            background: #dcfce7;
            color: #166534;
        }

        .bot-toast.error {
            background: #fee2e2;
            color: #991b1b;
        }

        .token-field {
            display: grid;
            grid-template-columns: 190px minmax(0, 1fr);
            gap: 18px;
            align-items: start;
        }

        .token-field label {
            display: block;
            padding-top: 14px;
            font-size: 1.05rem;
            font-weight: 900;
            color: #111827;
        }

        .token-field textarea {
            width: 100%;
            min-height: 132px;
            border: 1px solid #dbe3ee;
            border-radius: 16px;
            padding: 16px;
            resize: vertical;
            background: #fff;
            color: #111827;
            font: inherit;
            font-size: 1rem;
            line-height: 1.5;
        }

        .token-field textarea:focus {
            outline: 3px solid rgba(37, 99, 235, 0.16);
            border-color: #2563eb;
        }

        .bot-error {
            margin-top: 8px;
            color: #b91c1c;
            font-size: 0.92rem;
            font-weight: 700;
        }

        .bot-actions {
            display: flex;
            justify-content: flex-end;
        }

        .bot-button {
            border: 0;
            border-radius: 16px;
            padding: 17px 24px;
            background: #2563eb;
            color: #fff;
            font: inherit;
            font-size: 1rem;
            font-weight: 900;
            cursor: pointer;
            box-shadow: 0 12px 26px rgba(37, 99, 235, 0.22);
        }

        .bot-button:disabled {
            cursor: wait;
            opacity: 0.7;
        }

        .bot-status-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 14px;
        }

        .bot-status,
        .bot-link {
            border: 1px solid #dbe3ee;
            border-radius: 16px;
            background: #f8fafc;
            padding: 17px;
        }

        .bot-status strong {
            display: block;
            margin-bottom: 6px;
            font-size: 1.45rem;
            line-height: 1;
        }

        .bot-status span,
        .bot-link strong {
            color: #64748b;
        }

        .bot-links {
            display: grid;
            gap: 12px;
        }

        .bot-link strong,
        .bot-link code {
            display: block;
        }

        .bot-link strong {
            margin-bottom: 8px;
        }

        .bot-link code {
            color: #1d4ed8;
            font-size: 0.92rem;
            line-height: 1.6;
            word-break: break-all;
        }

        @media (max-width: 900px) {
            .token-field,
            .bot-status-grid {
                grid-template-columns: 1fr;
            }

            .token-field label {
                padding-top: 0;
            }

            .bot-actions {
                justify-content: stretch;
            }

            .bot-button {
                width: 100%;
            }
        }
    </style>

    <div class="bot-settings">
        <template x-if="toast">
            <div class="bot-toast" :class="type">
                <span x-text="toast"></span>
            </div>
        </template>

        <div class="token-field">
            <label for="confirm_bot_token">Confirm Bot Token</label>

            <div>
                <textarea
                    id="confirm_bot_token"
                    wire:model="confirm_bot_token"
                    rows="3"
                    placeholder="123456:AA..."
                ></textarea>

                @error('confirm_bot_token')
                    <div class="bot-error">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="bot-actions">
            <button class="bot-button" type="button" wire:click="saveBotToken" wire:loading.attr="disabled">
                <span wire:loading.remove>Tokenni saqlash va webhook ulash</span>
                <span wire:loading>Ulanmoqda...</span>
            </button>
        </div>

        <div class="bot-status-grid">
            <div class="bot-status">
                <strong>{{ $confirm_bot_token ? 'Tayyor' : 'Bo‘sh' }}</strong>
                <span>Token</span>
            </div>
            <div class="bot-status">
                <strong>{{ $webhookUrl ? 'Hook' : 'Yo‘q' }}</strong>
                <span>Webhook</span>
            </div>
            <div class="bot-status">
                <strong>Start</strong>
                <span>Xush kelibsiz</span>
            </div>
        </div>

        <div class="bot-links">
            <div class="bot-link">
                <strong>Webhook URL</strong>
                <code>{{ $webhookUrl ?? 'Token kiritilgach ko‘rinadi' }}</code>
            </div>
            <div class="bot-link">
                <strong>Web App URL</strong>
                <code>{{ $webAppUrl }}</code>
            </div>
        </div>
    </div>
</div>
