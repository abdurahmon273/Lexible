<?php

namespace App\Http\Controllers;

class BotController extends Controller
{
    public function dashboard()
    {
        $levels = $this->buildLevels();

        $completedLevels = collect($levels)->where('status', 'done')->count();

        $activeLessons = collect($levels)
            ->whereIn('status', ['done', 'current'])
            ->map(fn($l) => [
                'name'       => $l['name'],
                'progress'   => $l['progress'],
                'date'       => $l['date'],
                'word_count' => $l['word_count'],
                'ring_color' => $l['status'] === 'done' ? '#4ade80' : '#60a5fa',
                'status'     => $l['status'],
            ])
            ->values()
            ->toArray();

        return view('bot.dashboard', [
            'currentPage'    => 'dashboard',
            'todayLabel'     => $this->uzbekDate(now()),
            'userName'       => 'Abduraxmon',
            'streakDays'     => 12,
            'totalWords'     => 184,
            'weekWords'      => 38,
            'todayLearned'   => 7,
            'todayGoal'      => 10,
            'completedLevels'=> $completedLevels,
            'totalLevels'    => count($levels),
            'forecast3m'     => 340,
            'activeLessons'  => $activeLessons,
        ]);
    }

    public function roadmap()
    {
        return view('bot.roadmap', ['currentPage' => 'roadmap']);
    }

    /* ─────────────────────────────────── */

    private function buildLevels(): array
    {
        $raw = [
            ['name' => 'Tabiat',           'word_count' => 8,  'status' => 'done',    'progress' => 100, 'date' => '02 Iyn 2026'],
            ['name' => 'Sayohat',          'word_count' => 10, 'status' => 'current', 'progress' => 41,  'date' => '12 Iyn 2026'],
            ['name' => 'Kundalik hayot',   'word_count' => 8,  'status' => 'locked',  'progress' => 0,   'date' => null],
            ['name' => 'Sifatlar',         'word_count' => 8,  'status' => 'locked',  'progress' => 0,   'date' => null],
            ['name' => 'Texnologiya',      'word_count' => 8,  'status' => 'locked',  'progress' => 0,   'date' => null],
            ['name' => "Ovqat & Ichimlik", 'word_count' => 8,  'status' => 'locked',  'progress' => 0,   'date' => null],
        ];

        return array_map(fn($item, $i) => array_merge($item, ['color' => $i % 6]), $raw, array_keys($raw));
    }

    private function uzbekDate(\Carbon\Carbon $date): string
    {
        $months = [
            1 => 'Yanvar', 2 => 'Fevral', 3 => 'Mart', 4 => 'Aprel',
            5 => 'May', 6 => 'Iyun', 7 => 'Iyul', 8 => 'Avgust',
            9 => 'Sentabr', 10 => 'Oktabr', 11 => 'Noyabr', 12 => 'Dekabr',
        ];

        return $date->day . ' ' . $months[$date->month] . ', ' . $date->year;
    }
}
