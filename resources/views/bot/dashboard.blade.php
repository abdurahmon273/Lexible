@extends('bot.layouts.app')

@section('title', 'Dashboard')

@section('content')

{{-- GREETING --}}
<div class="greeting fade-up">
    <div class="greeting-tag">
        <span class="dot"></span>
        {{ $todayLabel }}
    </div>
    <h1>Salom, {{ $userName }} 👋</h1>
{{--    <p>Bugun yana bir qadam. Kichik bo'lsa ham, doimiy bo'lsin.</p>--}}
</div>

{{-- TODAY GOAL --}}
<div class="goal-banner fade-up">
    <div class="goal-left">
        <div class="goal-label">BUGUNGI MAQSAD</div>
        <div class="goal-progress-row">
            <div class="goal-nums">
                {{ $todayLearned }}<span> / {{ $todayGoal }}</span>
            </div>
        </div>
        <div class="goal-bar-wrap">
            <div class="goal-bar-fill" style="width: {{ $todayGoal > 0 ? round($todayLearned / $todayGoal * 100) : 0 }}%"></div>
        </div>
    </div>
    <div class="goal-icon">📚</div>
</div>

{{-- STATS GRID --}}
<div class="section-hd fade-up">
    <h2>Statistika</h2>
</div>

<div class="stats-grid">
    <div class="stat-card accent fade-up">
        <span class="stat-icon">🔥</span>
        <div class="stat-num">{{ $streakDays }}<span class="stat-unit"> kun</span></div>
        <div class="stat-label">Ketma-ket kirgan kunlar</div>
    </div>

    <div class="stat-card fade-up">
        <span class="stat-icon">💎</span>
        <div class="stat-num">{{ $totalWords }}</div>
        <div class="stat-label">Jami yotlangan so'zlar</div>
    </div>

    <div class="stat-card fade-up">
        <span class="stat-icon">📅</span>
        <div class="stat-num">{{ $weekWords }}</div>
        <div class="stat-label">Bu hafta yotlangan</div>
    </div>

    <div class="stat-card fade-up">
        <span class="stat-icon">🏆</span>
        <div class="stat-num">{{ $completedLevels }}<span class="stat-unit"> / {{ $totalLevels }}</span></div>
        <div class="stat-label">Bosqichlar bajarildi</div>
    </div>
</div>

{{-- FORECAST --}}
<div class="section-hd fade-up">
    <h2>Bashorat</h2>
</div>

<div class="forecast-card fade-up">
    <div class="forecast-icon">🔮</div>
    <div class="forecast-body">
        <p>
            Shu sur'atda davom etsangiz, <b>3 oy</b> ichida yana
            <b>~{{ $forecast3m }}</b> so'z yotlaysiz.
            Jami <b>{{ $totalWords + $forecast3m }}</b> so'zga yetasiz.
        </p>
    </div>
</div>

{{-- ACTIVE LESSONS --}}
<div class="section-hd fade-up">
    <h2>Faol darslar</h2>
    <a href="{{ route('bot.roadmap') }}">Yo'l xarita →</a>
</div>

<div class="lesson-list">
    @forelse($activeLessons as $lesson)
    <a href="{{ route('bot.roadmap') }}" class="lesson-card fade-up">
        <div class="lesson-ico {{ $lesson['status'] === 'done' ? 'done' : 'current' }}">
            {{ $lesson['status'] === 'done' ? '🔄' : '▶️' }}
        </div>
        <div class="lesson-info">
            <div class="lesson-name">{{ $lesson['name'] }}</div>
            <div class="lesson-meta">
                {{ $lesson['word_count'] }} so'z
                @if($lesson['date'])
                    · {{ $lesson['date'] }}
                @endif
            </div>
        </div>
        <div class="ring-wrap">
            @php
                $r = 18;
                $c = 2 * M_PI * $r;
                $pct = $lesson['progress'];
            @endphp
            <svg width="44" height="44">
                <circle cx="22" cy="22" r="{{ $r }}" fill="none"
                    stroke="rgba(255,255,255,0.08)" stroke-width="4"/>
                <circle cx="22" cy="22" r="{{ $r }}" fill="none"
                    stroke="{{ $lesson['ring_color'] }}" stroke-width="4"
                    stroke-dasharray="{{ $c }}"
                    stroke-dashoffset="{{ $c - ($pct / 100) * $c }}"
                    stroke-linecap="round"
                    transform="rotate(-90 22 22)"/>
            </svg>
            <div class="ring-pct">{{ $pct }}%</div>
        </div>
    </a>
    @empty
    <div class="forecast-card fade-up">
        <div class="forecast-icon">🎯</div>
        <div class="forecast-body">
            <p>Hozircha faol dars yo'q. <b>Yo'l xaritadan</b> boshlang!</p>
        </div>
    </div>
    @endforelse
</div>

<div class="h-3"></div>

@endsection
