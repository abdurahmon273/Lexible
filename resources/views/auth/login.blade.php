<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lexible Admin Login</title>
    <style>
        :root {
            --bg: #eef2f6;
            --surface: #ffffff;
            --text: #1d2433;
            --text-soft: #6b7484;
            --line: rgba(29, 36, 51, 0.1);
            --accent: #2563eb;
            --accent-dark: #1d4ed8;
            --shadow: 0 24px 70px rgba(27, 33, 44, 0.12);
            --radius-xl: 24px;
            --radius-lg: 18px;
            --radius-md: 14px;
        }

        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 20px;
            font-family: "Avenir Next", "Segoe UI", sans-serif;
            color: var(--text);
            background: var(--bg);
        }

        .card {
            width: min(100%, 460px);
            padding: 36px;
            border-radius: var(--radius-xl);
            border: 1px solid var(--line);
            background: var(--surface);
            box-shadow: var(--shadow);
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 9px 12px;
            border-radius: var(--radius-md);
            background: rgba(37, 99, 235, 0.1);
            color: var(--accent);
            font-size: 0.85rem;
            font-weight: 800;
        }

        h1 {
            margin: 18px 0 10px;
            font-size: clamp(2.4rem, 6vw, 3.6rem);
            line-height: 1;
            letter-spacing: -0.03em;
        }

        p {
            margin: 0;
            color: var(--text-soft);
            line-height: 1.7;
        }

        .email-box {
            margin-top: 26px;
            margin-bottom: 16px;
            padding: 16px 18px;
            border-radius: var(--radius-md);
            background: #fff;
            border: 1px solid var(--line);
        }

        .email-box strong {
            display: block;
            font-size: 1.05rem;
            margin-bottom: 4px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 0.92rem;
            font-weight: 700;
        }

        input[type="password"] {
            width: 100%;
            border: 1px solid var(--line);
            border-radius: var(--radius-md);
            padding: 15px 16px;
            font: inherit;
            background: #fff;
        }

        input[type="password"]:focus {
            outline: 2px solid rgba(37, 99, 235, 0.16);
            border-color: rgba(37, 99, 235, 0.32);
        }

        .error {
            margin-top: 8px;
            color: #cb4329;
            font-size: 0.88rem;
        }

        .submit {
            width: 100%;
            margin-top: 18px;
            border: none;
            border-radius: var(--radius-md);
            padding: 15px;
            color: #fff;
            font: inherit;
            font-weight: 800;
            background: linear-gradient(180deg, var(--accent), var(--accent-dark));
            cursor: pointer;
            box-shadow: 0 14px 32px rgba(37, 99, 235, 0.22);
        }

        .hint {
            margin-top: 14px;
            font-size: 0.88rem;
        }
    </style>
</head>
<body>
    <main class="card">
        <div class="badge">Lexible Admin</div>
        <h1>Kirish</h1>
        <p>Super admin parolini kiriting.</p>

        <div class="email-box">
            <span style="color: var(--text-soft); font-size: 0.88rem;">Email</span>
            <strong>{{ $superAdminEmail }}</strong>
        </div>

        <form method="POST" action="{{ route('login.store') }}">
            @csrf
            <input type="hidden" name="email" value="{{ $superAdminEmail }}">

            <label for="password">Parol</label>
            <input id="password" name="password" type="password" placeholder="password" required autofocus>

            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror

            <button class="submit" type="submit">Kirish</button>
        </form>

        <p class="hint">Demo parol: <strong style="color: var(--text);">password</strong></p>
    </main>
</body>
</html>
