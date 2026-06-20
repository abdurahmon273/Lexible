/* LEXIBLE BOT — MAIN JS */

const langData = {
    uz: {
        greeting: 'Salom',
        today_goal: 'BUGUNGI MAQSAD',
        stats: 'Statistika',
        forecast: 'Bashorat',
        active: 'Faol darslar',
        roadmap: "Yo'l xarita",
    },
    en: {
        greeting: 'Hello',
        today_goal: "TODAY'S GOAL",
        stats: 'Statistics',
        forecast: 'Forecast',
        active: 'Active Lessons',
        roadmap: 'Roadmap',
    },
};

(function () {
    'use strict';

    /* ── THEME ─────────────────────────── */
    const root = document.documentElement;
    const themeToggle = document.getElementById('themeToggle');

    function applyTheme(theme) {
        root.setAttribute('data-theme', theme);
        if (themeToggle) themeToggle.textContent = theme === 'dark' ? '☀️' : '🌙';
        localStorage.setItem('lex-theme', theme);
    }

    const savedTheme = localStorage.getItem('lex-theme')
        || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
    applyTheme(savedTheme);

    if (themeToggle) {
        themeToggle.addEventListener('click', function () {
            applyTheme(root.getAttribute('data-theme') === 'dark' ? 'light' : 'dark');
        });
    }

    /* ── LANGUAGE TOGGLE ───────────────── */
    document.querySelectorAll('.lang-btn').forEach(function (btn) {
        btn.addEventListener('click', function () {
            document.querySelectorAll('.lang-btn').forEach(function (b) { b.classList.remove('active'); });
            btn.classList.add('active');
            localStorage.setItem('lex-lang', btn.dataset.lang);
            const lang = btn.dataset.lang;
            document.querySelectorAll('[data-lang-text]').forEach(function (el) {
                const val = langData[lang] && langData[lang][el.dataset.langText];
                if (val) el.textContent = val;
            });
        });
    });

    const savedLang = localStorage.getItem('lex-lang') || 'uz';
    const activeLangBtn = document.querySelector('.lang-btn[data-lang="' + savedLang + '"]');
    if (activeLangBtn) {
        document.querySelectorAll('.lang-btn').forEach(function (b) { b.classList.remove('active'); });
        activeLangBtn.classList.add('active');
    }

    /* ── TOAST ─────────────────────────── */
    function showToast(msg) {
        const t = document.getElementById('appToast');
        if (!t) return;
        t.textContent = msg;
        t.classList.add('show');
        clearTimeout(t._tid);
        t._tid = setTimeout(function () { t.classList.remove('show'); }, 2400);
    }
    window.showToast = showToast;

    /* ── ROADMAP CONNECTOR PATHS ───────── */
    const rmContainer = document.getElementById('rmContainer');
    if (!rmContainer) return;

    function orthPath(a, b, r) {
        const midY = (a.y + b.y) / 2;
        const dirX = b.x > a.x ? 1 : -1;
        const cr = Math.min(r, Math.abs(b.x - a.x) / 2, Math.abs(a.y - b.y) / 2);
        let d = 'M ' + a.x + ' ' + a.y;
        d += ' L ' + a.x + ' ' + (midY + cr);
        d += ' Q ' + a.x + ' ' + midY + ' ' + (a.x + dirX * cr) + ' ' + midY;
        d += ' L ' + (b.x - dirX * cr) + ' ' + midY;
        d += ' Q ' + b.x + ' ' + midY + ' ' + b.x + ' ' + (midY - cr);
        d += ' L ' + b.x + ' ' + b.y;
        return d;
    }

    function drawConnectors() {
        const svg = document.getElementById('rmSvg');
        if (!svg) return;

        const cRect = rmContainer.getBoundingClientRect();
        const W = cRect.width;
        const H = cRect.height;
        svg.setAttribute('width', W);
        svg.setAttribute('height', H);
        svg.setAttribute('viewBox', '0 0 ' + W + ' ' + H);

        const tiles = Array.from(rmContainer.querySelectorAll('.rm-tile'));
        const nodes = Array.from(rmContainer.querySelectorAll('.rm-node'));

        const centers = tiles.map(function (tile) {
            const r = tile.getBoundingClientRect();
            return {
                x: r.left + r.width  / 2 - cRect.left,
                y: r.top  + r.height / 2 - cRect.top,
            };
        });

        const STATUS_COLOR = {
            done:    { color: '#2ecc71', op: '0.9' },
            current: { color: '#2563eb', op: '0.9' },
            poor:    { color: '#dc2626', op: '0.9' },
            locked:  { color: '#3a4a60', op: '0.5' },
        };

        let paths = '';
        for (let i = 0; i < centers.length - 1; i++) {
            const status = (nodes[i] && nodes[i].dataset.status) || 'locked';
            const sc = STATUS_COLOR[status] || STATUS_COLOR.locked;
            paths += '<path d="' + orthPath(centers[i], centers[i + 1], 26) + '"'
                + ' fill="none" stroke="' + sc.color + '"'
                + ' stroke-width="4" stroke-linecap="round" stroke-linejoin="round"'
                + ' stroke-dasharray="2 11" opacity="' + sc.op + '"/>';
        }
        svg.innerHTML = paths;
    }

    drawConnectors();
    window.addEventListener('resize', drawConnectors);

})();

/* ═══════════════════════════════════════════
   ROADMAP MODAL — word selection
   ═══════════════════════════════════════════ */
(function () {
    'use strict';

    let currentIdx  = null;
    let selectedSet = new Set();

    function getFolder() {
        return window.RM_FOLDERS ? window.RM_FOLDERS[currentIdx] : null;
    }

    function updateCount() {
        const n = selectedSet.size;
        const el = document.getElementById('wmCount');
        if (el) el.textContent = n + " ta so'z tanlangan";
        const btn = document.getElementById('wmStartBtn');
        if (btn) {
            btn.disabled = n === 0;
            btn.style.opacity = n === 0 ? '0.45' : '1';
        }
    }

    function renderGrid(filterText) {
        const grid = document.getElementById('wordGrid');
        const folder = getFolder();
        if (!grid || !folder) return;

        const q = (filterText || '').toLowerCase().trim();

        grid.innerHTML = folder.words.map(function (word, i) {
            if (q && !word.en.toLowerCase().includes(q) && !word.uz.toLowerCase().includes(q)) {
                return '';
            }
            const sel = selectedSet.has(i);
            return '<div class="word-chip' + (sel ? ' selected' : '') + '"'
                + ' onclick="window.rmToggleWord(' + i + ')">'
                + '<span class="wc-en">' + word.en + '</span>'
                + '<span class="wc-uz">' + word.uz + '</span>'
                + (sel ? '<span class="wc-check">✓</span>' : '')
                + '</div>';
        }).join('');
    }

    window.rmOpenModal = function (idx) {
        if (!window.RM_FOLDERS) return;
        currentIdx  = idx;
        selectedSet = new Set();
        const folder = getFolder();
        if (!folder) return;

        /* pre-select all words for done/current folders */
        if (folder.status === 'done' || folder.status === 'current') {
            folder.words.forEach(function (_, i) { selectedSet.add(i); });
        }

        const numEl = document.getElementById('modalFolderNum');
        const ttlEl = document.getElementById('modalTitle');
        const srchEl = document.getElementById('wordSearch');
        if (numEl) numEl.textContent = idx + 1;
        if (ttlEl) ttlEl.textContent = folder.name;
        if (srchEl) srchEl.value = '';

        renderGrid('');
        updateCount();

        const modal = document.getElementById('wordModal');
        if (modal) modal.classList.add('open');
        document.body.style.overflow = 'hidden';
    };

    window.rmCloseModal = function () {
        const modal = document.getElementById('wordModal');
        if (modal) modal.classList.remove('open');
        document.body.style.overflow = '';
    };

    window.rmToggleWord = function (i) {
        if (selectedSet.has(i)) { selectedSet.delete(i); } else { selectedSet.add(i); }
        renderGrid(document.getElementById('wordSearch') ? document.getElementById('wordSearch').value : '');
        updateCount();
    };

    window.rmFilterWords = function () {
        const el = document.getElementById('wordSearch');
        renderGrid(el ? el.value : '');
    };

    window.rmSelectAll = function () {
        const folder = getFolder();
        if (!folder) return;
        folder.words.forEach(function (_, i) { selectedSet.add(i); });
        renderGrid(document.getElementById('wordSearch') ? document.getElementById('wordSearch').value : '');
        updateCount();
    };

    window.rmDeselectAll = function () {
        selectedSet.clear();
        renderGrid(document.getElementById('wordSearch') ? document.getElementById('wordSearch').value : '');
        updateCount();
    };

    window.rmStartPractice = function () {
        const folder = getFolder();
        if (!folder || selectedSet.size === 0) return;
        const words = Array.from(selectedSet).map(function (i) { return folder.words[i]; });
        window.showToast && window.showToast(words.length + " ta so'z bilan mashq boshlanmoqda 🚀");
        window.rmCloseModal();
    };

    /* close on Escape key */
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') window.rmCloseModal();
    });
})();
