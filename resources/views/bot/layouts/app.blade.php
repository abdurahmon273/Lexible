<!DOCTYPE html>
<html lang="uz" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Lexible — @yield('title', "Lug'at yodlash")</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@500;600;700;800&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@500;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/bot.js'])

    @stack('styles')
</head>
<body>

<div class="app-shell">

    @include('bot.partials.navbar')

    <main class="app-content">
        @yield('content')
    </main>

    @include('bot.partials.bottom-nav')

</div>

<div class="toast" id="appToast"></div>

@stack('scripts')

</body>
</html>
