<!DOCTYPE html>
<html lang="uz" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lexible Dashboard</title>
    <style>
        :root {
            color-scheme: light;
            --bg: #f5f1e8;
            --bg-soft: #ede5d7;
            --surface: rgba(255, 255, 255, 0.82);
            --surface-strong: #ffffff;
            --surface-muted: #f7f1e7;
            --text: #1d2433;
            --text-soft: #5f6878;
            --line: rgba(29, 36, 51, 0.1);
            --accent: #ff6a3d;
            --accent-soft: rgba(255, 106, 61, 0.14);
            --accent-2: #2057f5;
            --success: #2f8f62;
            --warning: #f0b54a;
            --shadow: 0 24px 60px rgba(28, 32, 42, 0.09);
            --radius-xl: 28px;
            --radius-lg: 22px;
            --radius-md: 16px;
            --radius-sm: 12px;
            --font-display: "Trebuchet MS", "Avenir Next", "Segoe UI", sans-serif;
            --font-body: "Avenir Next", "Segoe UI", sans-serif;
            --font-mono: "SFMono-Regular", "Menlo", "Consolas", monospace;
        }

        html[data-theme="dark"] {
            color-scheme: dark;
            --bg: #10141b;
            --bg-soft: #171d27;
            --surface: rgba(23, 29, 39, 0.88);
            --surface-strong: #1c2430;
            --surface-muted: #131923;
            --text: #f3f5f8;
            --text-soft: #9ca7b8;
            --line: rgba(255, 255, 255, 0.08);
            --accent: #ff875e;
            --accent-soft: rgba(255, 135, 94, 0.16);
            --accent-2: #79a5ff;
            --success: #50c08d;
            --warning: #efc264;
            --shadow: 0 28px 80px rgba(0, 0, 0, 0.32);
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: var(--font-body);
            color: var(--text);
            background:
                radial-gradient(circle at top left, rgba(255, 106, 61, 0.16), transparent 28%),
                radial-gradient(circle at top right, rgba(32, 87, 245, 0.12), transparent 24%),
                linear-gradient(180deg, var(--bg) 0%, var(--bg-soft) 100%);
        }

        .page {
            width: min(1180px, calc(100% - 32px));
            margin: 0 auto;
            padding: 28px 0 48px;
        }

        .shell {
            position: relative;
            overflow: hidden;
            border: 1px solid var(--line);
            border-radius: 36px;
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.08), transparent), var(--surface);
            box-shadow: var(--shadow);
            backdrop-filter: blur(18px);
        }

        .shell::before,
        .shell::after {
            content: "";
            position: absolute;
            border-radius: 999px;
            filter: blur(16px);
            opacity: 0.5;
            pointer-events: none;
        }

        .shell::before {
            top: -80px;
            right: -40px;
            width: 220px;
            height: 220px;
            background: rgba(255, 106, 61, 0.14);
        }

        .shell::after {
            bottom: -100px;
            left: -40px;
            width: 260px;
            height: 260px;
            background: rgba(32, 87, 245, 0.1);
        }

        .topbar,
        .hero,
        .dashboard {
            position: relative;
            z-index: 1;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 22px 24px 10px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .brand-mark {
            width: 46px;
            height: 46px;
            border-radius: 14px;
            display: grid;
            place-items: center;
            font-size: 22px;
            background: linear-gradient(135deg, var(--accent), #ffb36b);
            color: #fff;
            box-shadow: 0 14px 28px rgba(255, 106, 61, 0.26);
        }

        .brand h1,
        .hero-copy h2,
        .section-title,
        .card-title,
        .category-title {
            margin: 0;
            font-family: var(--font-display);
            letter-spacing: -0.03em;
        }

        .brand h1 {
            font-size: 1.15rem;
        }

        .brand p,
        .muted,
        .chip,
        .subline,
        .list-meta,
        .streak-label {
            margin: 0;
            color: var(--text-soft);
        }

        .brand p,
        .chip,
        .subline,
        .list-meta {
            font-size: 0.9rem;
        }

        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .date-pill,
        .theme-toggle {
            border: 1px solid var(--line);
            background: var(--surface-strong);
            color: var(--text);
        }

        .date-pill {
            padding: 10px 14px;
            border-radius: 999px;
            font-size: 0.88rem;
        }

        .theme-toggle {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            padding: 10px 14px;
            border-radius: 999px;
            font-weight: 600;
        }

        .theme-toggle span:last-child {
            font-size: 0.92rem;
        }

        .hero {
            display: grid;
            grid-template-columns: 1.35fr 0.95fr;
            gap: 18px;
            padding: 14px 24px 0;
        }

        .hero-copy,
        .hero-focus,
        .panel,
        .metric-card,
        .category-card,
        .timeline-card {
            border: 1px solid var(--line);
            background: var(--surface-strong);
            border-radius: var(--radius-xl);
        }

        .hero-copy {
            padding: 28px;
            background:
                linear-gradient(135deg, rgba(255, 106, 61, 0.1), transparent 45%),
                linear-gradient(180deg, var(--surface-strong), var(--surface-muted));
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            border-radius: 999px;
            background: var(--accent-soft);
            color: var(--accent);
            font-size: 0.82rem;
            font-weight: 700;
            margin-bottom: 16px;
        }

        .hero-copy h2 {
            font-size: clamp(2rem, 4vw, 3.7rem);
            line-height: 0.95;
            max-width: 10ch;
        }

        .hero-copy p {
            max-width: 54ch;
            font-size: 1rem;
            line-height: 1.7;
            color: var(--text-soft);
            margin: 16px 0 22px;
        }

        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 13px 18px;
            border-radius: 14px;
            border: 1px solid transparent;
            font-weight: 700;
            text-decoration: none;
        }

        .button-primary {
            color: #fff;
            background: var(--accent);
            box-shadow: 0 12px 30px rgba(255, 106, 61, 0.24);
        }

        .button-secondary {
            color: var(--text);
            background: transparent;
            border-color: var(--line);
        }

        .hero-focus {
            display: grid;
            grid-template-rows: auto 1fr;
            padding: 22px;
            gap: 18px;
            background:
                radial-gradient(circle at top right, rgba(32, 87, 245, 0.14), transparent 38%),
                var(--surface-strong);
        }

        .card-head {
            display: flex;
            justify-content: space-between;
            gap: 12px;
        }

        .card-title {
            font-size: 1.15rem;
        }

        .focus-progress {
            display: grid;
            grid-template-columns: 110px 1fr;
            gap: 18px;
            align-items: center;
        }

        .progress-ring {
            width: 110px;
            aspect-ratio: 1;
            border-radius: 50%;
            display: grid;
            place-items: center;
            background:
                conic-gradient(var(--accent) 0 252deg, var(--accent-soft) 252deg 360deg);
            padding: 10px;
        }

        .progress-ring-inner {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            display: grid;
            place-items: center;
            background: var(--surface-strong);
            text-align: center;
        }

        .progress-ring strong {
            display: block;
            font-size: 1.55rem;
            font-family: var(--font-mono);
        }

        .check-list {
            display: grid;
            gap: 10px;
        }

        .check-item {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.96rem;
        }

        .check-dot {
            width: 28px;
            height: 28px;
            border-radius: 9px;
            display: grid;
            place-items: center;
            background: var(--surface-muted);
        }

        .dashboard {
            display: grid;
            grid-template-columns: 1.4fr 0.95fr;
            gap: 18px;
            padding: 18px 24px 24px;
        }

        .left-column,
        .right-column {
            display: grid;
            gap: 18px;
        }

        .metric-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 14px;
        }

        .metric-card {
            padding: 18px;
        }

        .metric-value {
            font-size: 1.9rem;
            font-family: var(--font-mono);
            line-height: 1;
            margin: 0 0 10px;
        }

        .metric-label {
            margin: 0;
            font-size: 0.92rem;
            color: var(--text-soft);
        }

        .metric-trend {
            display: inline-flex;
            margin-top: 12px;
            padding: 6px 10px;
            border-radius: 999px;
            background: var(--surface-muted);
            color: var(--success);
            font-size: 0.8rem;
            font-weight: 700;
        }

        .panel {
            padding: 22px;
        }

        .panel-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 16px;
        }

        .section-title {
            font-size: 1.2rem;
        }

        .section-link {
            color: var(--accent);
            text-decoration: none;
            font-weight: 700;
            font-size: 0.92rem;
        }

        .forecast-card {
            padding: 18px;
            border-radius: 18px;
            background:
                linear-gradient(135deg, rgba(255, 106, 61, 0.1), rgba(32, 87, 245, 0.08)),
                var(--surface-muted);
        }

        .forecast-card strong {
            font-family: var(--font-mono);
        }

        .category-list,
        .timeline-list {
            display: grid;
            gap: 12px;
        }

        .category-card,
        .timeline-card {
            padding: 16px 18px;
        }

        .category-top,
        .timeline-top {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            align-items: flex-start;
        }

        .category-title {
            font-size: 1rem;
        }

        .category-meta {
            margin-top: 4px;
            font-size: 0.87rem;
            color: var(--text-soft);
        }

        .chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 10px;
            border-radius: 999px;
            background: var(--surface-muted);
            white-space: nowrap;
        }

        .progress-bar {
            width: 100%;
            height: 10px;
            border-radius: 999px;
            background: var(--surface-muted);
            overflow: hidden;
            margin: 14px 0 10px;
        }

        .progress-fill {
            height: 100%;
            border-radius: inherit;
            background: linear-gradient(90deg, var(--accent), #ffb264);
        }

        .category-foot {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            font-size: 0.84rem;
            color: var(--text-soft);
        }

        .mini-roadmap {
            display: grid;
            gap: 12px;
        }

        .road-item {
            display: grid;
            grid-template-columns: 38px 1fr;
            gap: 12px;
            align-items: start;
        }

        .road-step {
            width: 38px;
            height: 38px;
            border-radius: 12px;
            display: grid;
            place-items: center;
            font-weight: 800;
            color: #fff;
        }

        .road-step.done {
            background: var(--success);
        }

        .road-step.active {
            background: var(--accent-2);
        }

        .road-step.locked {
            color: var(--text-soft);
            background: var(--surface-muted);
        }

        .timeline-card {
            background:
                linear-gradient(180deg, rgba(32, 87, 245, 0.07), transparent),
                var(--surface-strong);
        }

        .timeline-time {
            font-family: var(--font-mono);
            font-size: 0.84rem;
            color: var(--accent-2);
        }

        .footer-note {
            padding: 0 24px 24px;
            color: var(--text-soft);
            font-size: 0.88rem;
        }

        @media (max-width: 980px) {
            .hero,
            .dashboard {
                grid-template-columns: 1fr;
            }

            .metric-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 640px) {
            .page {
                width: min(100% - 16px, 100%);
                padding-top: 8px;
            }

            .shell {
                border-radius: 24px;
            }

            .topbar,
            .hero,
            .dashboard,
            .footer-note {
                padding-left: 16px;
                padding-right: 16px;
            }

            .topbar {
                align-items: flex-start;
                flex-direction: column;
            }

            .topbar-actions {
                width: 100%;
                justify-content: space-between;
            }

            .date-pill {
                display: none;
            }

            .hero-copy,
            .hero-focus,
            .panel {
                padding: 18px;
            }

            .focus-progress {
                grid-template-columns: 1fr;
            }

            .progress-ring {
                margin: 0 auto;
            }

            .metric-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="page">
        <main class="shell">
            <header class="topbar">
                <div class="brand">
                    <div class="brand-mark">L</div>
                    <div>
                        <h1>Lexible</h1>
                        <p>Lug'at yodlashni oddiy va doimiy qilish uchun</p>
                    </div>
                </div>

                <div class="topbar-actions">
                    <div class="date-pill" id="todayLabel">Bugun</div>
                    <button class="theme-toggle" id="themeToggle" type="button" aria-label="Tungi rejim">
                        <span id="themeIcon">🌙</span>
                        <span id="themeLabel">Tungi rejim</span>
                    </button>
                </div>
            </header>

            <section class="hero">
                <div class="hero-copy">
                    <div class="eyebrow">Bugungi fokus: 12 ta so'z</div>
                    <h2>Dashboard sodda, o'qilishi oson, har kuni ishlatishga tayyor.</h2>
                    <p>
                        Bu birinchi katta qadam uchun tayyorlangan web bot dashboardi. Hozircha faqat dizayn:
                        o'quvchi bugungi reja, umumiy progress, kategoriyalar va qayta takrorlash oqimini bir
                        qarashda tushunadi.
                    </p>

                    <div class="hero-actions">
                        <a class="button button-primary" href="#categories">Kategoriyalarni ko'rish</a>
                        <a class="button button-secondary" href="#roadmap">Roadmap preview</a>
                    </div>
                </div>

                <aside class="hero-focus">
                    <div class="card-head">
                        <div>
                            <p class="subline">Bugungi holat</p>
                            <h3 class="card-title">Kunlik plan</h3>
                        </div>
                        <div class="chip">12 kun streak</div>
                    </div>

                    <div class="focus-progress">
                        <div class="progress-ring">
                            <div class="progress-ring-inner">
                                <div>
                                    <strong>70%</strong>
                                    <span class="muted">bajarildi</span>
                                </div>
                            </div>
                        </div>

                        <div class="check-list">
                            <div class="check-item">
                                <div class="check-dot">1</div>
                                <span>7 ta yangi so'z yodlandi</span>
                            </div>
                            <div class="check-item">
                                <div class="check-dot">2</div>
                                <span>3 kunlik qayta test kutmoqda</span>
                            </div>
                            <div class="check-item">
                                <div class="check-dot">3</div>
                                <span>Bugun kamida 1 kategoriya yakunlash tavsiya qilinadi</span>
                            </div>
                        </div>
                    </div>
                </aside>
            </section>

            <section class="dashboard">
                <div class="left-column">
                    <div class="metric-grid">
                        <article class="metric-card">
                            <p class="metric-value">184</p>
                            <p class="metric-label">Jami yodlangan so'z</p>
                            <span class="metric-trend">+18 bu hafta</span>
                        </article>

                        <article class="metric-card">
                            <p class="metric-value">7/10</p>
                            <p class="metric-label">Bugungi natija</p>
                            <span class="metric-trend">70% bajarildi</span>
                        </article>

                        <article class="metric-card">
                            <p class="metric-value">38</p>
                            <p class="metric-label">Haftalik o'sish</p>
                            <span class="metric-trend">barqaror</span>
                        </article>

                        <article class="metric-card">
                            <p class="metric-value">524</p>
                            <p class="metric-label">3 oylik forecast</p>
                            <span class="metric-trend">taxminiy</span>
                        </article>
                    </div>

                    <section class="panel">
                        <div class="panel-head">
                            <h3 class="section-title">3 oylik bashorat</h3>
                            <a class="section-link" href="#">To'liq hisobot</a>
                        </div>

                        <div class="forecast-card">
                            Shu temp saqlansa, 3 oy ichida yana <strong>340 ta</strong> so'z qo'shiladi va umumiy
                            natija <strong>524 taga</strong> yetadi. Bu blok keyin real analytics bilan
                            backenddan to'ldiriladi.
                        </div>
                    </section>

                    <section class="panel" id="categories">
                        <div class="panel-head">
                            <h3 class="section-title">Faol kategoriyalar</h3>
                            <a class="section-link" href="#">Hammasi</a>
                        </div>

                        <div class="category-list">
                            <article class="category-card">
                                <div class="category-top">
                                    <div>
                                        <h4 class="category-title">Sayohat so'zlari</h4>
                                        <p class="category-meta">18 ta so'z · 12-iyun ochilgan</p>
                                    </div>
                                    <div class="chip">Joriy</div>
                                </div>
                                <div class="progress-bar"><div class="progress-fill" style="width: 41%"></div></div>
                                <div class="category-foot">
                                    <span>Progress: 41%</span>
                                    <span>Keyingi test: bugun 19:00</span>
                                </div>
                            </article>

                            <article class="category-card">
                                <div class="category-top">
                                    <div>
                                        <h4 class="category-title">Tabiat</h4>
                                        <p class="category-meta">12 ta so'z · tugallangan kategoriya</p>
                                    </div>
                                    <div class="chip">Yakunlangan</div>
                                </div>
                                <div class="progress-bar"><div class="progress-fill" style="width: 100%"></div></div>
                                <div class="category-foot">
                                    <span>Progress: 100%</span>
                                    <span>Qayta eslatma: 3 kun</span>
                                </div>
                            </article>

                            <article class="category-card">
                                <div class="category-top">
                                    <div>
                                        <h4 class="category-title">Kundalik hayot</h4>
                                        <p class="category-meta">15 ta so'z · keyingi bosqich</p>
                                    </div>
                                    <div class="chip">Qulflangan</div>
                                </div>
                                <div class="progress-bar"><div class="progress-fill" style="width: 12%"></div></div>
                                <div class="category-foot">
                                    <span>Ochish sharti: oldingi kategoriya 70%+</span>
                                    <span>Tayyor turibdi</span>
                                </div>
                            </article>
                        </div>
                    </section>
                </div>

                <aside class="right-column">
                    <section class="panel" id="roadmap">
                        <div class="panel-head">
                            <h3 class="section-title">Roadmap preview</h3>
                            <a class="section-link" href="#">Batafsil</a>
                        </div>

                        <div class="mini-roadmap">
                            <div class="road-item">
                                <div class="road-step done">1</div>
                                <div>
                                    <strong>Tabiat</strong>
                                    <p class="list-meta">Tugallangan. Qayta test 3 kun, 7 kun, 30 kun.</p>
                                </div>
                            </div>

                            <div class="road-item">
                                <div class="road-step active">2</div>
                                <div>
                                    <strong>Sayohat</strong>
                                    <p class="list-meta">Hozirgi bosqich. Flashcard va variant test faol.</p>
                                </div>
                            </div>

                            <div class="road-item">
                                <div class="road-step locked">3</div>
                                <div>
                                    <strong>Kundalik hayot</strong>
                                    <p class="list-meta">Oldingi bosqich 70% dan oshgach ochiladi.</p>
                                </div>
                            </div>

                            <div class="road-item">
                                <div class="road-step locked">E</div>
                                <div>
                                    <strong>Aralash exam</strong>
                                    <p class="list-meta">3 kategoriya tugagach avtomatik yaratiladi.</p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="panel">
                        <div class="panel-head">
                            <h3 class="section-title">Qayta takrorlash oqimi</h3>
                            <a class="section-link" href="#">Sozlash</a>
                        </div>

                        <div class="timeline-list">
                            <article class="timeline-card">
                                <div class="timeline-top">
                                    <div>
                                        <strong>3 kunlik eslatma</strong>
                                        <p class="list-meta">Sayohat so'zlari bo'yicha tezkor test yuboriladi</p>
                                    </div>
                                    <span class="timeline-time">Bugun</span>
                                </div>
                            </article>

                            <article class="timeline-card">
                                <div class="timeline-top">
                                    <div>
                                        <strong>7 kunlik mustahkamlash</strong>
                                        <p class="list-meta">Oldingi xatolar bo'yicha qayta ishlash sessiyasi</p>
                                    </div>
                                    <span class="timeline-time">19:00</span>
                                </div>
                            </article>

                            <article class="timeline-card">
                                <div class="timeline-top">
                                    <div>
                                        <strong>30 kunlik checkpoint</strong>
                                        <p class="list-meta">Aralash exam va progress solishtirish</p>
                                    </div>
                                    <span class="timeline-time">Rejada</span>
                                </div>
                            </article>
                        </div>
                    </section>
                </aside>
            </section>

            <div class="footer-note">
                Bu sahifa hozircha static dashboard. Keyingi bosqichda student, teacher va super admin uchun alohida
                flow hamda real ma'lumotlar ulanadi.
            </div>
        </main>
    </div>

    <script>
        (function () {
            const root = document.documentElement;
            const button = document.getElementById('themeToggle');
            const icon = document.getElementById('themeIcon');
            const label = document.getElementById('themeLabel');
            const todayLabel = document.getElementById('todayLabel');
            const savedTheme = localStorage.getItem('lexible-theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

            function applyTheme(theme) {
                root.dataset.theme = theme;
                icon.textContent = theme === 'dark' ? '☀️' : '🌙';
                label.textContent = theme === 'dark' ? 'Kunduzgi rejim' : 'Tungi rejim';
                localStorage.setItem('lexible-theme', theme);
            }

            const initialTheme = savedTheme || (prefersDark ? 'dark' : 'light');
            applyTheme(initialTheme);

            button.addEventListener('click', function () {
                applyTheme(root.dataset.theme === 'dark' ? 'light' : 'dark');
            });

            const formatter = new Intl.DateTimeFormat('uz-UZ', {
                weekday: 'long',
                day: 'numeric',
                month: 'long'
            });

            todayLabel.textContent = formatter.format(new Date());
        }());
    </script>
</body>
</html>
