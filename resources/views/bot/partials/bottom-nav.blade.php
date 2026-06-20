@php
    $currentPage = $currentPage ?? '';
@endphp

<nav class="bottom-nav">
    <a href="{{ route('bot.dashboard') }}"
       class="nav-item {{ $currentPage === 'dashboard' ? 'active' : '' }}">
        <span class="nav-ic">🏠</span>
        <span>Bosh sahifa</span>
    </a>

    <a href="{{ route('bot.roadmap') }}"
       class="nav-item {{ $currentPage === 'roadmap' ? 'active' : '' }}">
        <span class="nav-ic">🗺️</span>
        <span>Yo'l xarita</span>
    </a>

    <a href="#"
       class="nav-item {{ $currentPage === 'rating' ? 'active' : '' }}"
       onclick="window.showToast && window.showToast('Tez kunda... 🔒'); return false;">
        <span class="nav-ic">📊</span>
        <span>Reyting</span>
    </a>

    <a href="#"
       class="nav-item {{ $currentPage === 'profile' ? 'active' : '' }}"
       onclick="window.showToast && window.showToast('Tez kunda... 🔒'); return false;">
        <span class="nav-ic">👤</span>
        <span>Profil</span>
    </a>
</nav>
