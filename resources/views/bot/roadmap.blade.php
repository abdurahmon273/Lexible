@extends('bot.layouts.app')

@section('title', "Yo'l Xarita")

@php
/* ── STATIC FOLDER DATA (no backend) ── */
$folders = [
    [
        'id' => 1, 'name' => 'Tabiat', 'color' => 0,
        'status' => 'done', 'date' => '02.06.26', 'progress' => 100,
        'words' => [
            ['en' => 'nature',   'uz' => 'tabiat'],
            ['en' => 'tree',     'uz' => 'daraxt'],
            ['en' => 'river',    'uz' => 'daryo'],
            ['en' => 'mountain', 'uz' => "tog'"],
            ['en' => 'sky',      'uz' => 'osmon'],
            ['en' => 'grass',    'uz' => "o't"],
            ['en' => 'flower',   'uz' => 'gul'],
            ['en' => 'sun',      'uz' => 'quyosh'],
        ],
    ],
    [
        'id' => 2, 'name' => 'Sayohat', 'color' => 1,
        'status' => 'current', 'date' => '12.06.26', 'progress' => 41,
        'words' => [
            ['en' => 'travel',   'uz' => 'sayohat'],
            ['en' => 'ticket',   'uz' => 'chipta'],
            ['en' => 'hotel',    'uz' => 'mehmonxona'],
            ['en' => 'passport', 'uz' => 'pasport'],
            ['en' => 'luggage',  'uz' => 'bagaj'],
            ['en' => 'airport',  'uz' => 'aeroport'],
            ['en' => 'bus',      'uz' => 'avtobus'],
            ['en' => 'map',      'uz' => 'xarita'],
            ['en' => 'tourist',  'uz' => 'sayyoh'],
            ['en' => 'visa',     'uz' => 'viza'],
        ],
    ],
    [
        'id' => 3, 'name' => 'Kundalik hayot', 'color' => 2,
        'status' => 'locked', 'date' => null, 'progress' => 0,
        'words' => [
            ['en' => 'morning',   'uz' => 'ertalab'],
            ['en' => 'breakfast', 'uz' => 'nonushta'],
            ['en' => 'work',      'uz' => 'ish'],
            ['en' => 'lunch',     'uz' => 'tushlik'],
            ['en' => 'evening',   'uz' => 'kechqurun'],
            ['en' => 'dinner',    'uz' => 'kechki ovqat'],
            ['en' => 'sleep',     'uz' => 'uxlamoq'],
            ['en' => 'home',      'uz' => 'uy'],
        ],
    ],
    [
        'id' => 4, 'name' => 'Sifatlar', 'color' => 3,
        'status' => 'locked', 'date' => null, 'progress' => 0,
        'words' => [
            ['en' => 'big',       'uz' => 'katta'],
            ['en' => 'small',     'uz' => 'kichik'],
            ['en' => 'fast',      'uz' => 'tez'],
            ['en' => 'slow',      'uz' => 'sekin'],
            ['en' => 'hot',       'uz' => 'issiq'],
            ['en' => 'cold',      'uz' => 'sovuq'],
            ['en' => 'beautiful', 'uz' => 'chiroyli'],
            ['en' => 'ugly',      'uz' => 'xunuk'],
        ],
    ],
    [
        'id' => 5, 'name' => 'Texnologiya', 'color' => 4,
        'status' => 'locked', 'date' => null, 'progress' => 0,
        'words' => [
            ['en' => 'phone',    'uz' => 'telefon'],
            ['en' => 'computer', 'uz' => 'kompyuter'],
            ['en' => 'internet', 'uz' => 'internet'],
            ['en' => 'app',      'uz' => 'ilova'],
            ['en' => 'password', 'uz' => 'parol'],
            ['en' => 'screen',   'uz' => 'ekran'],
            ['en' => 'battery',  'uz' => 'batareya'],
            ['en' => 'download', 'uz' => 'yuklab olish'],
        ],
    ],
    [
        'id' => 6, 'name' => "Ovqat & Ichimlik", 'color' => 5,
        'status' => 'locked', 'date' => null, 'progress' => 0,
        'words' => [
            ['en' => 'food',   'uz' => 'ovqat'],
            ['en' => 'water',  'uz' => 'suv'],
            ['en' => 'bread',  'uz' => 'non'],
            ['en' => 'rice',   'uz' => 'guruch'],
            ['en' => 'meat',   'uz' => "go'sht"],
            ['en' => 'tea',    'uz' => 'choy'],
            ['en' => 'coffee', 'uz' => 'kofe'],
            ['en' => 'juice',  'uz' => 'sharbat'],
        ],
    ],
];

$N         = count($folders);
$LANES     = [0.76, 0.24, 0.76, 0.24, 0.76, 0.24];
$gap       = 130;   /* px between tile centres (vertical) */
$padTop    = 55;    /* top padding inside container */
$tileH     = 96;
/* container height = padTop + (N-1)*gap + tileH + bottom buffer */
$containerH = $padTop + ($N - 1) * $gap + $tileH + 58;

$DECOS = ['🌿', '💎', '🍂', '🌸', '⚡', '🌾'];

/* overall progress */
$doneCount = 0;
$curProgress = 0;
foreach ($folders as $f) {
    if ($f['status'] === 'done')    $doneCount++;
    if ($f['status'] === 'current') $curProgress = $f['progress'];
}
$overallProgress = ($N > 0)
    ? (int) round(($doneCount * 100 + $curProgress) / ($N * 100) * 100)
    : 0;
@endphp

@section('content')

{{-- HEADER --}}
<div class="roadmap-header fade-up">
    <h1>🗺️ Yo'l Xarita</h1>
</div>

{{-- TOTAL PROGRESS --}}
<div class="total-progress fade-up">
    <div class="total-progress-header">
        <span class="total-progress-label">Umumiy progress</span>
        <span class="total-progress-pct">{{ $overallProgress }}%</span>
    </div>
    <div class="total-bar-wrap">
        <div class="total-bar-fill" style="width: {{ $overallProgress }}%"></div>
    </div>
</div>

{{-- LEGEND --}}
<div class="rm-legend fade-up">
    <div class="rm-legend-item"><span class="rm-legend-dot done"></span>Bajarilgan</div>
    <div class="rm-legend-item"><span class="rm-legend-dot current"></span>Yaxshi</div>
    <div class="rm-legend-item"><span class="rm-legend-dot poor"></span>Kam</div>
    <div class="rm-legend-item"><span class="rm-legend-dot locked"></span>Qulflangan</div>
</div>

{{-- ROADMAP CANVAS --}}
<div class="rm-container fade-up" id="rmContainer" style="height: {{ $containerH }}px">
    <svg class="rm-svg" id="rmSvg"></svg>

    @foreach($folders as $i => $folder)
    @php
        $laneX      = $LANES[$i % count($LANES)];         /* 0.0 – 1.0 */
        $laneDir    = $laneX > 0.5 ? 'right' : 'left';
        $tileCtrY   = $padTop + ($N - 1 - $i) * $gap;    /* tile centre y */
        $nodeTop    = $tileCtrY - $tileH / 2;             /* tile top edge y */
        /* left = tile left edge so tile centre sits at laneX% */
        $nodeLeft   = 'calc(' . ($laneX * 100) . '% - 48px)';

        /* deco position: opposite side of tile */
        $decoOffX   = $laneDir === 'right' ? -118 : 26;
        $decoOffY   = ($i % 2 === 0) ? -14 : 14;
        $decoRot    = ($i % 3 - 1) * 9;
        $deco       = $DECOS[$i % count($DECOS)];
    @endphp

    {{-- Decoration emoji --}}
    <div class="rm-deco"
         style="left: calc({{ $laneX * 100 }}% + {{ $decoOffX }}px);
                top: {{ $tileCtrY + $decoOffY - 13 }}px;
                transform: rotate({{ $decoRot }}deg)">{{ $deco }}</div>

    {{-- Folder node --}}
    <div class="rm-node"
         style="left: {{ $nodeLeft }}; top: {{ $nodeTop }}px"
         data-folder-id="{{ $folder['id'] }}"
         data-status="{{ $folder['status'] }}"
         onclick="window.rmOpenModal({{ $i }})">

        <div class="rm-tile {{ $folder['status'] }} c{{ $folder['color'] }}">
            @if($folder['date'] && $folder['status'] !== 'locked')
                <div class="rm-date-badge">{{ $folder['date'] }}</div>
            @endif

            <div class="rm-tile-num">{{ $i + 1 }}</div>

            <div class="rm-tile-ic">
                @if($folder['status'] === 'done')
                    {{-- Replay / refresh-ccw --}}
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2.5"
                         stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 12a9 9 0 0 0-9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/>
                        <path d="M3 3v5h5"/>
                        <path d="M3 12a9 9 0 0 0 9 9 9.75 9.75 0 0 0 6.74-2.74L21 16"/>
                        <path d="M16 16h5v5"/>
                    </svg>
                @elseif($folder['status'] === 'current' || $folder['status'] === 'poor')
                    {{-- Circle-play --}}
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2.5"
                         stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 9.003a1 1 0 0 1 1.517-.859l4.997 2.997a1 1 0 0 1 0 1.718l-4.997 2.997A1 1 0 0 1 9 14.996z"/>
                        <circle cx="12" cy="12" r="10"/>
                    </svg>
                @else
                    {{-- Lock-keyhole --}}
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2.5"
                         stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="16" r="1" fill="currentColor"/>
                        <rect x="3" y="10" width="18" height="12" rx="2"/>
                        <path d="M7 10V7a5 5 0 0 1 10 0v3"/>
                    </svg>
                @endif
            </div>

            @if($folder['status'] === 'current' || $folder['status'] === 'poor')
                <div class="rm-tile-pct">{{ $folder['progress'] }}%</div>
            @endif

            @if($folder['status'] === 'done')
                <div class="rm-tile-status">✓ completed</div>
            @endif
        </div>

        <div class="rm-name-card">
            <div class="rm-name-text">{{ $folder['name'] }}</div>
        </div>
    </div>
    @endforeach
</div>

<div class="h-4"></div>

{{-- ═══════════════ WORD SELECTION MODAL ═══════════════ --}}
<div class="word-modal" id="wordModal">
    <div class="word-modal-overlay" onclick="window.rmCloseModal()"></div>
    <div class="word-modal-sheet">

        <div class="word-modal-header">
            <div class="wm-title-group">
                <div class="wm-folder-num" id="modalFolderNum">1</div>
                <h2 id="modalTitle">Tabiat</h2>
            </div>
            <button class="wm-close-btn" onclick="window.rmCloseModal()">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2.5"
                     stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 6 6 18M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <p class="wm-subtitle">O'rganmoqchi bo'lgan so'zlarni tanlang</p>

        <div class="word-search-wrap">
            <svg class="ws-icon" width="16" height="16" viewBox="0 0 24 24"
                 fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/>
            </svg>
            <input class="word-search-input" type="text" id="wordSearch"
                   placeholder="So'z qidirish..." oninput="window.rmFilterWords()">
        </div>

        <div class="wm-select-row">
            <button class="wm-btn-all" onclick="window.rmSelectAll()">Hammasini tanlash</button>
            <button class="wm-btn-none" onclick="window.rmDeselectAll()">Hammasini olib tashlash</button>
        </div>

        <div class="word-grid" id="wordGrid"></div>

        <div class="word-modal-footer">
            <span class="wm-count" id="wmCount">0 ta so'z tanlangan</span>
            <button class="wm-start-btn" id="wmStartBtn" onclick="window.rmStartPractice()">
                <svg width="17" height="17" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2.5"
                     stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 9.003a1 1 0 0 1 1.517-.859l4.997 2.997a1 1 0 0 1 0 1.718l-4.997 2.997A1 1 0 0 1 9 14.996z"/>
                    <circle cx="12" cy="12" r="10"/>
                </svg>
                Boshlash
            </button>
        </div>

    </div>
</div>

@push('scripts')
<script>
    window.RM_FOLDERS = @json($folders);
</script>
@endpush

@endsection
