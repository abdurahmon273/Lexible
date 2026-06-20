<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EnglishWordsSeeder extends Seeder
{
    public function run(): void
    {
        /* ── 1. Languages ───────────────────── */
        $enId = DB::table('languages')->insertGetId([
            'code'       => 'en',
            'name'       => 'English',
            'status'     => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $uzId = DB::table('languages')->insertGetId([
            'code'       => 'uz',
            'name'       => "O'zbek",
            'status'     => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        /* ── 2. Words ───────────────────────── */
        /*
         * Each word entry:
         *   word, phonetic, senses[]
         *     sense: pos, level, meaning_note, definitions[], translations[], synonyms[], antonyms[]
         */
        $words = [

            /* 1 */
            [
                'word'     => 'abundant',
                'phonetic' => '/əˈbʌn.dənt/',
                'senses'   => [
                    [
                        'pos'    => 'adjective',
                        'level'  => 'B2',
                        'note'   => null,
                        'defs'   => [
                            ['def' => 'Existing or available in large quantities; more than enough.', 'ex' => 'The region has abundant natural resources.'],
                        ],
                        'trans'  => [['uz' => "mo'l-ko'l, serob", 'ex_uz' => 'Bu hududda tabiiy resurslar serob.']],
                        'syns'   => ['plentiful', 'ample', 'copious'],
                        'ants'   => ['scarce', 'rare'],
                    ],
                ],
            ],

            /* 2 */
            [
                'word'     => 'accomplish',
                'phonetic' => '/əˈkʌm.plɪʃ/',
                'senses'   => [
                    [
                        'pos'    => 'verb',
                        'level'  => 'B1',
                        'note'   => null,
                        'defs'   => [
                            ['def' => 'To succeed in doing or completing something.', 'ex' => 'She accomplished all her goals by the age of thirty.'],
                        ],
                        'trans'  => [['uz' => 'erishmoq, amalga oshirmoq', 'ex_uz' => "U o'ttiz yoshida barcha maqsadlariga erishdi."]],
                        'syns'   => ['achieve', 'complete', 'fulfil'],
                        'ants'   => ['fail', 'abandon'],
                    ],
                ],
            ],

            /* 3 */
            [
                'word'     => 'acknowledge',
                'phonetic' => '/əkˈnɒl.ɪdʒ/',
                'senses'   => [
                    [
                        'pos'    => 'verb',
                        'level'  => 'B2',
                        'note'   => null,
                        'defs'   => [
                            ['def' => 'To accept, admit, or recognize something or the truth of something.', 'ex' => 'He acknowledged his mistake in front of the team.'],
                        ],
                        'trans'  => [['uz' => "tan olmoq, e'tirof etmoq", 'ex_uz' => 'U xatosini jamoa oldida tan oldi.']],
                        'syns'   => ['admit', 'concede', 'recognise'],
                        'ants'   => ['deny', 'reject'],
                    ],
                ],
            ],

            /* 4 */
            [
                'word'     => 'ambiguous',
                'phonetic' => '/æmˈbɪɡ.ju.əs/',
                'senses'   => [
                    [
                        'pos'    => 'adjective',
                        'level'  => 'C1',
                        'note'   => null,
                        'defs'   => [
                            ['def' => 'Open to more than one interpretation; not having one obvious meaning.', 'ex' => 'The instructions were ambiguous and caused confusion.'],
                        ],
                        'trans'  => [['uz' => "noaniq, ikki ma'noli", 'ex_uz' => "Ko'rsatmalar noaniq edi va chalkashlikka olib keldi."]],
                        'syns'   => ['unclear', 'vague', 'equivocal'],
                        'ants'   => ['clear', 'definite', 'unambiguous'],
                    ],
                ],
            ],

            /* 5 */
            [
                'word'     => 'analyze',
                'phonetic' => '/ˈæn.ə.laɪz/',
                'senses'   => [
                    [
                        'pos'    => 'verb',
                        'level'  => 'B2',
                        'note'   => 'British spelling: analyse',
                        'defs'   => [
                            ['def' => 'To study or examine something in detail, in order to discover more about it.', 'ex' => 'Scientists analyze data collected over many years.'],
                        ],
                        'trans'  => [['uz' => "tahlil qilmoq, o'rganmoq", 'ex_uz' => 'Olimlar ko\'p yillar davomida to\'plangan ma\'lumotlarni tahlil qiladilar.']],
                        'syns'   => ['examine', 'investigate', 'study'],
                        'ants'   => ['overlook', 'ignore'],
                    ],
                ],
            ],

            /* 6 */
            [
                'word'     => 'ancient',
                'phonetic' => '/ˈeɪn.ʃənt/',
                'senses'   => [
                    [
                        'pos'    => 'adjective',
                        'level'  => 'A2',
                        'note'   => null,
                        'defs'   => [
                            ['def' => 'Of or from a long time ago, having lasted for a very long time.', 'ex' => 'Ancient civilizations built impressive monuments.'],
                            ['def' => '(informal) Very old.', 'ex' => 'This computer is ancient — we need a new one!'],
                        ],
                        'trans'  => [['uz' => 'qadimiy, eski', 'ex_uz' => 'Qadimiy sivilizatsiyalar ajoyib yodgorliklar qurgan.']],
                        'syns'   => ['old', 'antique', 'archaic'],
                        'ants'   => ['modern', 'contemporary', 'recent'],
                    ],
                ],
            ],

            /* 7 */
            [
                'word'     => 'benefit',
                'phonetic' => '/ˈben.ɪ.fɪt/',
                'senses'   => [
                    [
                        'pos'    => 'noun',
                        'level'  => 'B1',
                        'note'   => null,
                        'defs'   => [
                            ['def' => 'A helpful or good effect, or something intended to help.', 'ex' => 'Regular exercise has many health benefits.'],
                        ],
                        'trans'  => [['uz' => 'foyda, manfaat', 'ex_uz' => 'Muntazam mashq qilishning ko\'plab sog\'liq uchun foydasi bor.']],
                        'syns'   => ['advantage', 'gain', 'profit'],
                        'ants'   => ['disadvantage', 'harm'],
                    ],
                    [
                        'pos'    => 'verb',
                        'level'  => 'B1',
                        'note'   => null,
                        'defs'   => [
                            ['def' => 'To be helped by something or to help someone.', 'ex' => 'Everyone will benefit from this new policy.'],
                        ],
                        'trans'  => [['uz' => 'foyda olmoq, foyda keltirmoq', 'ex_uz' => 'Bu yangi siyosatdan hammalar foyda oladi.']],
                        'syns'   => ['gain', 'profit', 'improve'],
                        'ants'   => ['harm', 'hurt'],
                    ],
                ],
            ],

            /* 8 */
            [
                'word'     => 'challenge',
                'phonetic' => '/ˈtʃæl.ɪndʒ/',
                'senses'   => [
                    [
                        'pos'    => 'noun',
                        'level'  => 'B1',
                        'note'   => null,
                        'defs'   => [
                            ['def' => 'Something that needs great mental or physical effort in order to be done successfully.', 'ex' => 'Learning a new language is a great challenge.'],
                        ],
                        'trans'  => [['uz' => 'qiyinchilik, sinov', 'ex_uz' => "Yangi til o'rganish katta sinov."]],
                        'syns'   => ['difficulty', 'obstacle', 'test'],
                        'ants'   => ['ease', 'simplicity'],
                    ],
                ],
            ],

            /* 9 */
            [
                'word'     => 'concentrate',
                'phonetic' => '/ˈkɒn.sən.treɪt/',
                'senses'   => [
                    [
                        'pos'    => 'verb',
                        'level'  => 'B1',
                        'note'   => null,
                        'defs'   => [
                            ['def' => 'To direct your attention or efforts towards a particular activity, subject, or problem.', 'ex' => 'Please concentrate on your studies.'],
                        ],
                        'trans'  => [['uz' => 'diqqat qilmoq, e\'tibor qaratmoq', 'ex_uz' => 'Iltimos, o\'qishingizga e\'tibor qarating.']],
                        'syns'   => ['focus', 'attend', 'apply'],
                        'ants'   => ['distract', 'ignore'],
                    ],
                ],
            ],

            /* 10 */
            [
                'word'     => 'delay',
                'phonetic' => '/dɪˈleɪ/',
                'senses'   => [
                    [
                        'pos'    => 'noun',
                        'level'  => 'A2',
                        'note'   => null,
                        'defs'   => [
                            ['def' => 'A period of time by which something is late or postponed.', 'ex' => 'There was a two-hour delay at the airport.'],
                        ],
                        'trans'  => [['uz' => "kechikish, to'xtash", 'ex_uz' => 'Aeroportda ikki soatlik kechikish bo\'ldi.']],
                        'syns'   => ['postponement', 'hold-up', 'setback'],
                        'ants'   => ['punctuality', 'promptness'],
                    ],
                    [
                        'pos'    => 'verb',
                        'level'  => 'A2',
                        'note'   => null,
                        'defs'   => [
                            ['def' => 'To make something happen at a later time than originally planned.', 'ex' => 'Bad weather delayed the flight by three hours.'],
                        ],
                        'trans'  => [['uz' => "kechiktirmoq, to'xtatmoq", 'ex_uz' => 'Yomon ob-havo reysni uch soatga kechiktirdi.']],
                        'syns'   => ['postpone', 'defer', 'put off'],
                        'ants'   => ['advance', 'expedite', 'rush'],
                    ],
                ],
            ],

            /* 11 */
            [
                'word'     => 'efficient',
                'phonetic' => '/ɪˈfɪʃ.ənt/',
                'senses'   => [
                    [
                        'pos'    => 'adjective',
                        'level'  => 'B2',
                        'note'   => null,
                        'defs'   => [
                            ['def' => 'Working well and not wasting time or resources.', 'ex' => 'The new engine is more fuel-efficient.'],
                        ],
                        'trans'  => [['uz' => 'samarali, tejamkor', 'ex_uz' => 'Yangi dvigatel yanada tejamkor.']],
                        'syns'   => ['effective', 'productive', 'capable'],
                        'ants'   => ['inefficient', 'wasteful'],
                    ],
                ],
            ],

            /* 12 */
            [
                'word'     => 'emerge',
                'phonetic' => '/ɪˈmɜːdʒ/',
                'senses'   => [
                    [
                        'pos'    => 'verb',
                        'level'  => 'B2',
                        'note'   => null,
                        'defs'   => [
                            ['def' => 'To come out from a place where you could not be seen.', 'ex' => 'The sun emerged from behind the clouds.'],
                            ['def' => 'To become known or to become a fact.', 'ex' => 'New evidence has emerged in the investigation.'],
                        ],
                        'trans'  => [['uz' => "paydo bo'lmoq, chiqmoq", 'ex_uz' => 'Quyosh bulutlar ortidan chiqdi.']],
                        'syns'   => ['appear', 'surface', 'arise'],
                        'ants'   => ['disappear', 'vanish'],
                    ],
                ],
            ],

            /* 13 */
            [
                'word'     => 'flexible',
                'phonetic' => '/ˈflek.sɪ.bəl/',
                'senses'   => [
                    [
                        'pos'    => 'adjective',
                        'level'  => 'B2',
                        'note'   => null,
                        'defs'   => [
                            ['def' => 'Able to change or be changed easily according to the situation.', 'ex' => 'A flexible work schedule helps employees balance their lives.'],
                            ['def' => 'Able to bend easily without breaking.', 'ex' => 'The gymnast has a very flexible body.'],
                        ],
                        'trans'  => [['uz' => "moslashuvchan, egiluvchan", 'ex_uz' => 'Moslashuvchan ish jadvali xodimlarga hayotni muvozanatlashtirish imkonini beradi.']],
                        'syns'   => ['adaptable', 'versatile', 'supple'],
                        'ants'   => ['rigid', 'inflexible', 'stiff'],
                    ],
                ],
            ],

            /* 14 */
            [
                'word'     => 'generate',
                'phonetic' => '/ˈdʒen.ər.eɪt/',
                'senses'   => [
                    [
                        'pos'    => 'verb',
                        'level'  => 'B2',
                        'note'   => null,
                        'defs'   => [
                            ['def' => 'To produce or create something.', 'ex' => 'Solar panels generate clean electricity.'],
                        ],
                        'trans'  => [['uz' => "yaratmoq, hosil qilmoq", 'ex_uz' => "Quyosh panellari toza elektr energiyasi hosil qiladi."]],
                        'syns'   => ['produce', 'create', 'develop'],
                        'ants'   => ['consume', 'use', 'destroy'],
                    ],
                ],
            ],

            /* 15 */
            [
                'word'     => 'influence',
                'phonetic' => '/ˈɪn.flu.əns/',
                'senses'   => [
                    [
                        'pos'    => 'noun',
                        'level'  => 'B1',
                        'note'   => null,
                        'defs'   => [
                            ['def' => 'The power to have an effect on people or things.', 'ex' => 'Music has a strong influence on our emotions.'],
                        ],
                        'trans'  => [['uz' => "ta'sir, nufuz", 'ex_uz' => "Musiqa his-tuyg'ularimizga kuchli ta'sir ko'rsatadi."]],
                        'syns'   => ['effect', 'impact', 'power'],
                        'ants'   => ['powerlessness'],
                    ],
                    [
                        'pos'    => 'verb',
                        'level'  => 'B1',
                        'note'   => null,
                        'defs'   => [
                            ['def' => 'To affect or change how someone or something develops, behaves, or thinks.', 'ex' => 'Parents greatly influence their children\'s values.'],
                        ],
                        'trans'  => [['uz' => "ta'sir qilmoq, ta'sir o'tkazmoq", 'ex_uz' => "Ota-onalar farzandlarining qadriyatlariga katta ta'sir ko'rsatadilar."]],
                        'syns'   => ['affect', 'shape', 'impact'],
                        'ants'   => ['ignore'],
                    ],
                ],
            ],

            /* 16 */
            [
                'word'     => 'precise',
                'phonetic' => '/prɪˈsaɪs/',
                'senses'   => [
                    [
                        'pos'    => 'adjective',
                        'level'  => 'B2',
                        'note'   => null,
                        'defs'   => [
                            ['def' => 'Exact and accurate in details.', 'ex' => 'The surgeon made a precise cut.'],
                        ],
                        'trans'  => [['uz' => "aniq, to'g'ri", 'ex_uz' => 'Jarroh aniq kesdi.']],
                        'syns'   => ['exact', 'accurate', 'specific'],
                        'ants'   => ['vague', 'imprecise', 'rough'],
                    ],
                ],
            ],

            /* 17 */
            [
                'word'     => 'transform',
                'phonetic' => '/trænsˈfɔːm/',
                'senses'   => [
                    [
                        'pos'    => 'verb',
                        'level'  => 'B2',
                        'note'   => null,
                        'defs'   => [
                            ['def' => 'To change something completely, usually in a positive way.', 'ex' => 'Education can transform a person\'s life.'],
                        ],
                        'trans'  => [['uz' => "o'zgartirmoq, aylantirmoq", 'ex_uz' => "Ta'lim insonning hayotini o'zgartira oladi."]],
                        'syns'   => ['convert', 'change', 'revolutionise'],
                        'ants'   => ['preserve', 'maintain'],
                    ],
                ],
            ],

            /* 18 */
            [
                'word'     => 'significant',
                'phonetic' => '/sɪɡˈnɪf.ɪ.kənt/',
                'senses'   => [
                    [
                        'pos'    => 'adjective',
                        'level'  => 'B2',
                        'note'   => null,
                        'defs'   => [
                            ['def' => 'Important or noticeable.', 'ex' => 'There has been a significant improvement in her health.'],
                        ],
                        'trans'  => [['uz' => "muhim, sezilarli", 'ex_uz' => "Uning sog'lig'ida sezilarli yaxshilanish bo'ldi."]],
                        'syns'   => ['important', 'notable', 'considerable'],
                        'ants'   => ['insignificant', 'trivial'],
                    ],
                ],
            ],

            /* 19 */
            [
                'word'     => 'persist',
                'phonetic' => '/pəˈsɪst/',
                'senses'   => [
                    [
                        'pos'    => 'verb',
                        'level'  => 'C1',
                        'note'   => null,
                        'defs'   => [
                            ['def' => 'To continue doing something despite difficulties, opposition, or failure.', 'ex' => 'Despite many setbacks, she persisted with her research.'],
                        ],
                        'trans'  => [['uz' => "davom ettirmoq, turɴmoq", 'ex_uz' => "Ko'p to'siqlarga qaramay, u o'z tadqiqotini davom ettirdi."]],
                        'syns'   => ['persevere', 'continue', 'endure'],
                        'ants'   => ['give up', 'quit', 'abandon'],
                    ],
                ],
            ],

            /* 20 */
            [
                'word'     => 'vocabulary',
                'phonetic' => '/vəˈkæb.jʊ.lər.i/',
                'senses'   => [
                    [
                        'pos'    => 'noun',
                        'level'  => 'A2',
                        'note'   => null,
                        'defs'   => [
                            ['def' => 'All the words that exist in a language, or that are known by a person.', 'ex' => 'Reading books is the best way to build your vocabulary.'],
                            ['def' => 'A list of words with their meanings, especially in a book for learning a foreign language.', 'ex' => 'Study the vocabulary at the end of each chapter.'],
                        ],
                        'trans'  => [['uz' => "lug'at, so'z boyligi", 'ex_uz' => "Kitob o'qish lug'atni boyitishning eng yaxshi usuli."]],
                        'syns'   => ['lexicon', 'wordbank', 'terminology'],
                        'ants'   => [],
                    ],
                ],
            ],
        ];

        /* ── 3. Insert ──────────────────────── */
        foreach ($words as $entry) {
            $wordId = DB::table('words')->insertGetId([
                'language_id' => $enId,
                'word'        => $entry['word'],
                'phonetic'    => $entry['phonetic'],
                'status'      => 'active',
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);

            foreach ($entry['senses'] as $order => $sense) {
                $senseId = DB::table('word_senses')->insertGetId([
                    'word_id'      => $wordId,
                    'part_of_speech' => $sense['pos'],
                    'level'        => $sense['level'],
                    'meaning_note' => $sense['note'],
                    'order_number' => $order + 1,
                    'created_at'   => now(),
                    'updated_at'   => now(),
                ]);

                foreach ($sense['defs'] as $def) {
                    DB::table('word_definitions')->insert([
                        'word_sense_id' => $senseId,
                        'definition'    => $def['def'],
                        'example'       => $def['ex'],
                        'created_at'    => now(),
                        'updated_at'    => now(),
                    ]);
                }

                foreach ($sense['trans'] as $tr) {
                    DB::table('word_translations')->insert([
                        'word_sense_id'      => $senseId,
                        'target_language_id' => $uzId,
                        'translation'        => $tr['uz'],
                        'example'            => $tr['ex_uz'] ?? null,
                        'created_at'         => now(),
                        'updated_at'         => now(),
                    ]);
                }

                foreach ($sense['syns'] as $syn) {
                    DB::table('word_synonyms')->insert([
                        'word_sense_id' => $senseId,
                        'synonym'       => $syn,
                        'created_at'    => now(),
                        'updated_at'    => now(),
                    ]);
                }

                foreach ($sense['ants'] as $ant) {
                    DB::table('word_antonyms')->insert([
                        'word_sense_id' => $senseId,
                        'antonym'       => $ant,
                        'created_at'    => now(),
                        'updated_at'    => now(),
                    ]);
                }
            }
        }
    }
}
