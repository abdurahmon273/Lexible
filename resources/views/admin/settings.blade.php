<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lexible Admin Panel</title>
    @livewireStyles
    <style>
        :root {
            --bg: #eef2f6;
            --sidebar: #111827;
            --sidebar-soft: #cbd5e1;
            --surface: #ffffff;
            --surface-soft: #f8fafc;
            --text: #111827;
            --text-soft: #64748b;
            --line: #dbe3ee;
            --accent: #2563eb;
            --accent-soft: #dbeafe;
            --success: #15803d;
            --warning: #b45309;
            --radius: 18px;
            --shadow: 0 24px 70px rgba(15, 23, 42, 0.1);
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            background: var(--bg);
            color: var(--text);
            font-family: "Avenir Next", "Segoe UI", sans-serif;
        }

        .layout {
            display: grid;
            grid-template-columns: 260px minmax(0, 1fr);
            min-height: 100vh;
        }

        .sidebar {
            display: flex;
            flex-direction: column;
            gap: 22px;
            padding: 28px 22px;
            background: var(--sidebar);
            color: #fff;
        }

        .brand-title {
            margin: 0;
            font-size: 2.2rem;
            line-height: 1;
            letter-spacing: -0.03em;
        }

        .brand-subtitle,
        .sidebar-note,
        .page-subtitle,
        .panel-note,
        .stat span {
            color: var(--text-soft);
            line-height: 1.55;
        }

        .brand-subtitle,
        .sidebar-note {
            color: var(--sidebar-soft);
        }

        .menu {
            display: grid;
            gap: 10px;
        }

        .menu-item,
        .logout-button,
        .admin-chip,
        .stat,
        .panel,
        .info-row {
            border-radius: var(--radius);
        }

        .menu-item {
            display: block;
            padding: 16px;
            color: #fff;
            text-decoration: none;
            font-weight: 800;
            background: rgba(255, 255, 255, 0.08);
        }

        .menu-item.active {
            background: var(--accent);
        }

        .logout-form {
            margin-top: auto;
        }

        .logout-button {
            width: 100%;
            border: 1px solid rgba(255, 255, 255, 0.18);
            background: transparent;
            color: #fff;
            padding: 16px;
            font: inherit;
            font-weight: 800;
            cursor: pointer;
        }

        .content {
            padding: 32px;
        }

        .page-head {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            align-items: flex-start;
            margin-bottom: 22px;
        }

        .page-title {
            margin: 0 0 10px;
            font-size: clamp(2.4rem, 5vw, 4.6rem);
            line-height: 0.96;
            letter-spacing: -0.04em;
        }

        .admin-chip {
            display: inline-flex;
            padding: 12px 14px;
            background: var(--surface);
            border: 1px solid var(--line);
            color: var(--text);
            font-weight: 800;
            white-space: nowrap;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-bottom: 18px;
        }

        .stat,
        .panel,
        .info-row {
            border: 1px solid var(--line);
            background: var(--surface);
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.04);
        }

        .stat {
            padding: 22px;
        }

        .stat strong {
            display: block;
            margin-bottom: 8px;
            font-size: 2rem;
            line-height: 1;
        }

        .grid {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 360px;
            gap: 18px;
            align-items: start;
        }

        .panel {
            padding: 26px;
        }

        .panel-title {
            margin: 0 0 8px;
            font-size: 1.6rem;
            letter-spacing: -0.02em;
        }

        .panel-note {
            margin: 0;
        }

        .info-stack {
            display: grid;
            gap: 14px;
            margin-top: 18px;
        }

        .info-row {
            padding: 18px;
        }

        .info-row strong {
            display: block;
            margin-bottom: 6px;
            font-size: 1.05rem;
        }

        .info-row span {
            color: var(--text-soft);
            line-height: 1.55;
        }

        @media (max-width: 1000px) {
            .layout,
            .grid {
                grid-template-columns: 1fr;
            }

            .sidebar {
                min-height: auto;
            }
        }

        @media (max-width: 720px) {
            .content,
            .sidebar {
                padding: 20px;
            }

            .page-head {
                flex-direction: column;
            }

            .stats {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="layout">
        <aside class="sidebar">
            <div>
                <h1 class="brand-title">Lexible Admin</h1>
                <p class="brand-subtitle">Bot token, webhook va web app.</p>
            </div>

            <nav class="menu">
                <a class="menu-item active" href="{{ route('admin.settings') }}">Bot sozlamalari</a>
                <a class="menu-item" href="{{ route('bot.dashboard') }}" target="_blank" rel="noreferrer">Web bot</a>
            </nav>

            <p class="sidebar-note">
                Token saqlang. Webhook ulanadi. `/start` bosilganda web bot tugmasi chiqadi.
            </p>

            <form class="logout-form" method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="logout-button" type="submit">Chiqish</button>
            </form>
        </aside>

        <main class="content">
            <header class="page-head">
                <div>
                    <h2 class="page-title">Admin panel</h2>
                    <p class="page-subtitle">Sodda boshqaruv: token, webhook, web bot.</p>
                </div>

                <div class="admin-chip">{{ config('super_admin.email') }}</div>
            </header>

            <section class="stats">
                <article class="stat">
                    <strong>Bot</strong>
                    <span>Telegram token saqlanadi.</span>
                </article>
                <article class="stat">
                    <strong>Hook</strong>
                    <span>Webhook avtomatik ulanadi.</span>
                </article>
                <article class="stat">
                    <strong>Start</strong>
                    <span>Xush kelibsiz + web bot tugmasi.</span>
                </article>
            </section>

            <div class="grid">
                <section class="panel">
                    <h3 class="panel-title">Bot token</h3>
                    <p class="panel-note">BotFather tokenini kiriting va saqlang.</p>

                    <livewire:admin.bot-settings />
                </section>

                <aside class="panel">
                    <h3 class="panel-title">Ishlash tartibi</h3>

                    <div class="info-stack">
                        <div class="info-row">
                            <strong>1. Token</strong>
                            <span>Token bazaga saqlanadi.</span>
                        </div>
                        <div class="info-row">
                            <strong>2. Webhook</strong>
                            <span>Eski webhook o‘chadi, yangisi ulanadi.</span>
                        </div>
                        <div class="info-row">
                            <strong>3. Start</strong>
                            <span>Foydalanuvchi `/start` bossa web bot tugmasi bor xabar oladi.</span>
                        </div>
                        <div class="info-row">
                            <strong>APP_URL</strong>
                            <span>Telegram uchun internetdan ochiladigan HTTPS domen kerak.</span>
                        </div>
                    </div>
                </aside>
            </div>
        </main>
    </div>

    @livewireScripts
</body>
</html>
