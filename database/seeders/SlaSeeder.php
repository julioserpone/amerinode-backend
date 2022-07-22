<?php

namespace Database\Seeders;

use App\Models\Severity;
use App\Models\Sla;
use App\Models\Unit;
use Illuminate\Database\Seeder;

class SlaSeeder extends Seeder
{
    /**
     * Load SLAs with units
     *
     * @return void
     */
    public function run()
    {
        $slas = [
            [
                'name' => 'IRON',
                'details' => [
                    [
                        'severity' => 'P1',
                        'time_response' => 1,
                        'time_response_unit' => 'hour',
                        'time_recovery' => 1,
                        'time_recovery_unit' => 'calendar-days',
                        'resolutions' => [
                            ['name' => '1', 'time' => 30, 'unit' => 'calendar-days'],
                            ['name' => '2', 'time' => 45, 'unit' => 'calendar-days'],
                            ['name' => '3', 'time' => 60, 'unit' => 'calendar-days'],
                            ['name' => '4', 'time' => 90, 'unit' => 'calendar-days'],
                        ],
                        'availabilities' => [
                            ['name' => 'A', 'unit' => '24*7'],
                            ['name' => 'B', 'unit' => '24*7'],
                            ['name' => 'C', 'unit' => '8*5'],
                        ],
                    ],
                    [
                        'severity' => 'P2',
                        'time_response' => 1,
                        'time_response_unit' => 'hour',
                        'time_recovery' => 1,
                        'time_recovery_unit' => 'week',
                        'resolutions' => [
                            ['name' => '1', 'time' => 45, 'unit' => 'calendar-days'],
                            ['name' => '2', 'time' => 60, 'unit' => 'calendar-days'],
                            ['name' => '3', 'time' => 90, 'unit' => 'calendar-days'],
                            ['name' => '4', 'time' => 120, 'unit' => 'calendar-days'],
                        ],
                        'availabilities' => [
                            ['name' => 'A', 'unit' => '24*7'],
                            ['name' => 'B', 'unit' => '8*5'],
                            ['name' => 'C', 'unit' => '8*5'],
                        ],
                    ],
                    [
                        'severity' => 'P3',
                        'time_response' => 1,
                        'time_response_unit' => 'hour',
                        'time_recovery' => null,
                        'time_recovery_unit' => 'not-available',
                        'resolutions' => [
                            ['name' => '1', 'time' => 60, 'unit' => 'calendar-days'],
                            ['name' => '2', 'time' => 90, 'unit' => 'calendar-days'],
                            ['name' => '3', 'time' => 120, 'unit' => 'calendar-days'],
                            ['name' => '4', 'time' => null, 'unit' => 'next-release'],
                        ],
                        'availabilities' => [
                            ['name' => 'A', 'unit' => '8*5'],
                            ['name' => 'B', 'unit' => '8*5'],
                            ['name' => 'C', 'unit' => '8*5'],
                        ],
                    ],
                    [
                        'severity' => 'P4',
                        'time_response' => 1,
                        'time_response_unit' => 'hour',
                        'time_recovery' => null,
                        'time_recovery_unit' => 'not-available',
                        'resolutions' => [
                            ['name' => '1', 'time' => 180, 'unit' => 'calendar-days'],
                            ['name' => '2', 'time' => 180, 'unit' => 'calendar-days'],
                            ['name' => '3', 'time' => null, 'unit' => 'next-release'],
                            ['name' => '4', 'time' => null, 'unit' => 'next-release'],
                        ],
                        'availabilities' => [
                            ['name' => 'A', 'unit' => '8*5'],
                            ['name' => 'B', 'unit' => '8*5'],
                            ['name' => 'C', 'unit' => '8*5'],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'BRONZE',
                'details' => [
                    [
                        'severity' => 'P1',
                        'time_response' => 15,
                        'time_response_unit' => 'minute',
                        'time_recovery' => 14,
                        'time_recovery_unit' => 'hour',
                        'resolutions' => [
                            ['name' => '1', 'time' => 30, 'unit' => 'calendar-days'],
                            ['name' => '2', 'time' => 45, 'unit' => 'calendar-days'],
                            ['name' => '3', 'time' => 60, 'unit' => 'calendar-days'],
                            ['name' => '4', 'time' => 90, 'unit' => 'calendar-days'],
                        ],
                        'availabilities' => [
                            ['name' => 'A', 'unit' => '24*7'],
                            ['name' => 'B', 'unit' => '24*7'],
                            ['name' => 'C', 'unit' => '8*5'],
                        ],
                    ],
                    [
                        'severity' => 'P2',
                        'time_response' => 30,
                        'time_response_unit' => 'minute',
                        'time_recovery' => 72,
                        'time_recovery_unit' => 'hour',
                        'resolutions' => [
                            ['name' => '1', 'time' => 45, 'unit' => 'calendar-days'],
                            ['name' => '2', 'time' => 60, 'unit' => 'calendar-days'],
                            ['name' => '3', 'time' => 90, 'unit' => 'calendar-days'],
                            ['name' => '4', 'time' => 120, 'unit' => 'calendar-days'],
                        ],
                        'availabilities' => [
                            ['name' => 'A', 'unit' => '24*7'],
                            ['name' => 'B', 'unit' => '8*5'],
                            ['name' => 'C', 'unit' => '8*5'],
                        ],
                    ],
                    [
                        'severity' => 'P3',
                        'time_response' => 1,
                        'time_response_unit' => 'hour',
                        'time_recovery' => 30,
                        'time_recovery_unit' => 'calendar-days',
                        'resolutions' => [
                            ['name' => '1', 'time' => 60, 'unit' => 'calendar-days'],
                            ['name' => '2', 'time' => 90, 'unit' => 'calendar-days'],
                            ['name' => '3', 'time' => 120, 'unit' => 'calendar-days'],
                            ['name' => '4', 'time' => null, 'unit' => 'next-release'],
                        ],
                        'availabilities' => [
                            ['name' => 'A', 'unit' => '8*5'],
                            ['name' => 'B', 'unit' => '8*5'],
                            ['name' => 'C', 'unit' => '8*5'],
                        ],
                    ],
                    [
                        'severity' => 'P4',
                        'time_response' => 1,
                        'time_response_unit' => 'hour',
                        'time_recovery' => null,
                        'time_recovery_unit' => 'not-available',
                        'resolutions' => [
                            ['name' => '1', 'time' => 180, 'unit' => 'calendar-days'],
                            ['name' => '2', 'time' => 180, 'unit' => 'calendar-days'],
                            ['name' => '3', 'time' => null, 'unit' => 'next-release'],
                            ['name' => '4', 'time' => null, 'unit' => 'next-release'],
                        ],
                        'availabilities' => [
                            ['name' => 'A', 'unit' => '8*5'],
                            ['name' => 'B', 'unit' => '8*5'],
                            ['name' => 'C', 'unit' => '8*5'],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'SILVER - MINUS',
                'details' => [
                    [
                        'severity' => 'P1',
                        'time_response' => 15,
                        'time_response_unit' => 'minute',
                        'time_recovery' => 8,
                        'time_recovery_unit' => 'hour',
                        'resolutions' => [
                            ['name' => '1', 'time' => 30, 'unit' => 'calendar-days'],
                            ['name' => '2', 'time' => 45, 'unit' => 'calendar-days'],
                            ['name' => '3', 'time' => 60, 'unit' => 'calendar-days'],
                            ['name' => '4', 'time' => 90, 'unit' => 'calendar-days'],
                        ],
                        'availabilities' => [
                            ['name' => 'A', 'unit' => '24*7'],
                            ['name' => 'B', 'unit' => '24*7'],
                            ['name' => 'C', 'unit' => '8*5'],
                        ],
                    ],
                    [
                        'severity' => 'P2',
                        'time_response' => 30,
                        'time_response_unit' => 'minute',
                        'time_recovery' => 72,
                        'time_recovery_unit' => 'hour',
                        'resolutions' => [
                            ['name' => '1', 'time' => 45, 'unit' => 'calendar-days'],
                            ['name' => '2', 'time' => 60, 'unit' => 'calendar-days'],
                            ['name' => '3', 'time' => 90, 'unit' => 'calendar-days'],
                            ['name' => '4', 'time' => 120, 'unit' => 'calendar-days'],
                        ],
                        'availabilities' => [
                            ['name' => 'A', 'unit' => '24*7'],
                            ['name' => 'B', 'unit' => '8*5'],
                            ['name' => 'C', 'unit' => '8*5'],
                        ],
                    ],
                    [
                        'severity' => 'P3',
                        'time_response' => 1,
                        'time_response_unit' => 'hour',
                        'time_recovery' => 15,
                        'time_recovery_unit' => 'calendar-days',
                        'resolutions' => [
                            ['name' => '1', 'time' => 60, 'unit' => 'calendar-days'],
                            ['name' => '2', 'time' => 90, 'unit' => 'calendar-days'],
                            ['name' => '3', 'time' => 120, 'unit' => 'calendar-days'],
                            ['name' => '4', 'time' => null, 'unit' => 'next-release'],
                        ],
                        'availabilities' => [
                            ['name' => 'A', 'unit' => '8*5'],
                            ['name' => 'B', 'unit' => '8*5'],
                            ['name' => 'C', 'unit' => '8*5'],
                        ],
                    ],
                    [
                        'severity' => 'P4',
                        'time_response' => 1,
                        'time_response_unit' => 'hour',
                        'time_recovery' => null,
                        'time_recovery_unit' => 'not-available',
                        'resolutions' => [
                            ['name' => '1', 'time' => 180, 'unit' => 'calendar-days'],
                            ['name' => '2', 'time' => 180, 'unit' => 'calendar-days'],
                            ['name' => '3', 'time' => null, 'unit' => 'next-release'],
                            ['name' => '4', 'time' => null, 'unit' => 'next-release'],
                        ],
                        'availabilities' => [
                            ['name' => 'A', 'unit' => '8*5'],
                            ['name' => 'B', 'unit' => '8*5'],
                            ['name' => 'C', 'unit' => '8*5'],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'SILVER',
                'details' => [
                    [
                        'severity' => 'P1',
                        'time_response' => 15,
                        'time_response_unit' => 'minute',
                        'time_recovery' => 6,
                        'time_recovery_unit' => 'hour',
                        'resolutions' => [
                            ['name' => '1', 'time' => 30, 'unit' => 'calendar-days'],
                            ['name' => '2', 'time' => 45, 'unit' => 'calendar-days'],
                            ['name' => '3', 'time' => 60, 'unit' => 'calendar-days'],
                            ['name' => '4', 'time' => 90, 'unit' => 'calendar-days'],
                        ],
                        'availabilities' => [
                            ['name' => 'A', 'unit' => '24*7'],
                            ['name' => 'B', 'unit' => '24*7'],
                            ['name' => 'C', 'unit' => '8*5'],
                        ],
                    ],
                    [
                        'severity' => 'P2',
                        'time_response' => 30,
                        'time_response_unit' => 'minute',
                        'time_recovery' => 24,
                        'time_recovery_unit' => 'hour',
                        'resolutions' => [
                            ['name' => '1', 'time' => 45, 'unit' => 'calendar-days'],
                            ['name' => '2', 'time' => 60, 'unit' => 'calendar-days'],
                            ['name' => '3', 'time' => 90, 'unit' => 'calendar-days'],
                            ['name' => '4', 'time' => 120, 'unit' => 'calendar-days'],
                        ],
                        'availabilities' => [
                            ['name' => 'A', 'unit' => '24*7'],
                            ['name' => 'B', 'unit' => '8*5'],
                            ['name' => 'C', 'unit' => '8*5'],
                        ],
                    ],
                    [
                        'severity' => 'P3',
                        'time_response' => 1,
                        'time_response_unit' => 'hour',
                        'time_recovery' => 15,
                        'time_recovery_unit' => 'calendar-days',
                        'resolutions' => [
                            ['name' => '1', 'time' => 60, 'unit' => 'calendar-days'],
                            ['name' => '2', 'time' => 90, 'unit' => 'calendar-days'],
                            ['name' => '3', 'time' => 120, 'unit' => 'calendar-days'],
                            ['name' => '4', 'time' => null, 'unit' => 'next-release'],
                        ],
                        'availabilities' => [
                            ['name' => 'A', 'unit' => '8*5'],
                            ['name' => 'B', 'unit' => '8*5'],
                            ['name' => 'C', 'unit' => '8*5'],
                        ],
                    ],
                    [
                        'severity' => 'P4',
                        'time_response' => 1,
                        'time_response_unit' => 'hour',
                        'time_recovery' => null,
                        'time_recovery_unit' => 'not-available',
                        'resolutions' => [
                            ['name' => '1', 'time' => 180, 'unit' => 'calendar-days'],
                            ['name' => '2', 'time' => 180, 'unit' => 'calendar-days'],
                            ['name' => '3', 'time' => null, 'unit' => 'next-release'],
                            ['name' => '4', 'time' => null, 'unit' => 'next-release'],
                        ],
                        'availabilities' => [
                            ['name' => 'A', 'unit' => '8*5'],
                            ['name' => 'B', 'unit' => '8*5'],
                            ['name' => 'C', 'unit' => '8*5'],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'GOLD - MINUS',
                'details' => [
                    [
                        'severity' => 'P1',
                        'time_response' => 15,
                        'time_response_unit' => 'minute',
                        'time_recovery' => 4,
                        'time_recovery_unit' => 'hour',
                        'resolutions' => [
                            ['name' => '1', 'time' => 30, 'unit' => 'calendar-days'],
                            ['name' => '2', 'time' => 45, 'unit' => 'calendar-days'],
                            ['name' => '3', 'time' => 60, 'unit' => 'calendar-days'],
                            ['name' => '4', 'time' => 90, 'unit' => 'calendar-days'],
                        ],
                        'availabilities' => [
                            ['name' => 'A', 'unit' => '24*7'],
                            ['name' => 'B', 'unit' => '24*7'],
                            ['name' => 'C', 'unit' => '8*5'],
                        ],
                    ],
                    [
                        'severity' => 'P2',
                        'time_response' => 30,
                        'time_response_unit' => 'minute',
                        'time_recovery' => 48,
                        'time_recovery_unit' => 'hour',
                        'resolutions' => [
                            ['name' => '1', 'time' => 45, 'unit' => 'calendar-days'],
                            ['name' => '2', 'time' => 60, 'unit' => 'calendar-days'],
                            ['name' => '3', 'time' => 90, 'unit' => 'calendar-days'],
                            ['name' => '4', 'time' => 120, 'unit' => 'calendar-days'],
                        ],
                        'availabilities' => [
                            ['name' => 'A', 'unit' => '24*7'],
                            ['name' => 'B', 'unit' => '8*5'],
                            ['name' => 'C', 'unit' => '8*5'],
                        ],
                    ],
                    [
                        'severity' => 'P3',
                        'time_response' => 1,
                        'time_response_unit' => 'hour',
                        'time_recovery' => 10,
                        'time_recovery_unit' => 'calendar-days',
                        'resolutions' => [
                            ['name' => '1', 'time' => 60, 'unit' => 'calendar-days'],
                            ['name' => '2', 'time' => 90, 'unit' => 'calendar-days'],
                            ['name' => '3', 'time' => 120, 'unit' => 'calendar-days'],
                            ['name' => '4', 'time' => null, 'unit' => 'next-release'],
                        ],
                        'availabilities' => [
                            ['name' => 'A', 'unit' => '8*5'],
                            ['name' => 'B', 'unit' => '8*5'],
                            ['name' => 'C', 'unit' => '8*5'],
                        ],
                    ],
                    [
                        'severity' => 'P4',
                        'time_response' => 1,
                        'time_response_unit' => 'hour',
                        'time_recovery' => null,
                        'time_recovery_unit' => 'not-available',
                        'resolutions' => [
                            ['name' => '1', 'time' => 180, 'unit' => 'calendar-days'],
                            ['name' => '2', 'time' => 180, 'unit' => 'calendar-days'],
                            ['name' => '3', 'time' => null, 'unit' => 'next-release'],
                            ['name' => '4', 'time' => null, 'unit' => 'next-release'],
                        ],
                        'availabilities' => [
                            ['name' => 'A', 'unit' => '8*5'],
                            ['name' => 'B', 'unit' => '8*5'],
                            ['name' => 'C', 'unit' => '8*5'],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'GOLD',
                'details' => [
                    [
                        'severity' => 'P1',
                        'time_response' => 15,
                        'time_response_unit' => 'minute',
                        'time_recovery' => 4,
                        'time_recovery_unit' => 'hour',
                        'resolutions' => [
                            ['name' => '1', 'time' => 30, 'unit' => 'calendar-days'],
                            ['name' => '2', 'time' => 45, 'unit' => 'calendar-days'],
                            ['name' => '3', 'time' => 60, 'unit' => 'calendar-days'],
                            ['name' => '4', 'time' => 90, 'unit' => 'calendar-days'],
                        ],
                        'availabilities' => [
                            ['name' => 'A', 'unit' => '24*7'],
                            ['name' => 'B', 'unit' => '24*7'],
                            ['name' => 'C', 'unit' => '8*5'],
                        ],
                    ],
                    [
                        'severity' => 'P2',
                        'time_response' => 30,
                        'time_response_unit' => 'minute',
                        'time_recovery' => 12,
                        'time_recovery_unit' => 'hour',
                        'resolutions' => [
                            ['name' => '1', 'time' => 45, 'unit' => 'calendar-days'],
                            ['name' => '2', 'time' => 60, 'unit' => 'calendar-days'],
                            ['name' => '3', 'time' => 90, 'unit' => 'calendar-days'],
                            ['name' => '4', 'time' => 120, 'unit' => 'calendar-days'],
                        ],
                        'availabilities' => [
                            ['name' => 'A', 'unit' => '24*7'],
                            ['name' => 'B', 'unit' => '8*5'],
                            ['name' => 'C', 'unit' => '8*5'],
                        ],
                    ],
                    [
                        'severity' => 'P3',
                        'time_response' => 1,
                        'time_response_unit' => 'hour',
                        'time_recovery' => 10,
                        'time_recovery_unit' => 'calendar-days',
                        'resolutions' => [
                            ['name' => '1', 'time' => 60, 'unit' => 'calendar-days'],
                            ['name' => '2', 'time' => 90, 'unit' => 'calendar-days'],
                            ['name' => '3', 'time' => 120, 'unit' => 'calendar-days'],
                            ['name' => '4', 'time' => null, 'unit' => 'next-release'],
                        ],
                        'availabilities' => [
                            ['name' => 'A', 'unit' => '8*5'],
                            ['name' => 'B', 'unit' => '8*5'],
                            ['name' => 'C', 'unit' => '8*5'],
                        ],
                    ],
                    [
                        'severity' => 'P4',
                        'time_response' => 1,
                        'time_response_unit' => 'hour',
                        'time_recovery' => null,
                        'time_recovery_unit' => 'not-available',
                        'resolutions' => [
                            ['name' => '1', 'time' => 180, 'unit' => 'calendar-days'],
                            ['name' => '2', 'time' => 180, 'unit' => 'calendar-days'],
                            ['name' => '3', 'time' => null, 'unit' => 'next-release'],
                            ['name' => '4', 'time' => null, 'unit' => 'next-release'],
                        ],
                        'availabilities' => [
                            ['name' => 'A', 'unit' => '8*5'],
                            ['name' => 'B', 'unit' => '8*5'],
                            ['name' => 'C', 'unit' => '8*5'],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'PLATINUM',
                'details' => [
                    [
                        'severity' => 'P1',
                        'time_response' => 15,
                        'time_response_unit' => 'minute',
                        'time_recovery' => 2,
                        'time_recovery_unit' => 'hour',
                        'resolutions' => [
                            ['name' => '1', 'time' => 30, 'unit' => 'calendar-days'],
                            ['name' => '2', 'time' => 45, 'unit' => 'calendar-days'],
                            ['name' => '3', 'time' => 60, 'unit' => 'calendar-days'],
                            ['name' => '4', 'time' => 90, 'unit' => 'calendar-days'],
                        ],
                        'availabilities' => [
                            ['name' => 'A', 'unit' => '24*7'],
                            ['name' => 'B', 'unit' => '24*7'],
                            ['name' => 'C', 'unit' => '8*5'],
                        ],
                    ],
                    [
                        'severity' => 'P2',
                        'time_response' => 30,
                        'time_response_unit' => 'minute',
                        'time_recovery' => 6,
                        'time_recovery_unit' => 'hour',
                        'resolutions' => [
                            ['name' => '1', 'time' => 45, 'unit' => 'calendar-days'],
                            ['name' => '2', 'time' => 60, 'unit' => 'calendar-days'],
                            ['name' => '3', 'time' => 90, 'unit' => 'calendar-days'],
                            ['name' => '4', 'time' => 120, 'unit' => 'calendar-days'],
                        ],
                        'availabilities' => [
                            ['name' => 'A', 'unit' => '24*7'],
                            ['name' => 'B', 'unit' => '8*5'],
                            ['name' => 'C', 'unit' => '8*5'],
                        ],
                    ],
                    [
                        'severity' => 'P3',
                        'time_response' => 1,
                        'time_response_unit' => 'hour',
                        'time_recovery' => 10,
                        'time_recovery_unit' => 'calendar-days',
                        'resolutions' => [
                            ['name' => '1', 'time' => 60, 'unit' => 'calendar-days'],
                            ['name' => '2', 'time' => 90, 'unit' => 'calendar-days'],
                            ['name' => '3', 'time' => 120, 'unit' => 'calendar-days'],
                            ['name' => '4', 'time' => null, 'unit' => 'next-release'],
                        ],
                        'availabilities' => [
                            ['name' => 'A', 'unit' => '8*5'],
                            ['name' => 'B', 'unit' => '8*5'],
                            ['name' => 'C', 'unit' => '8*5'],
                        ],
                    ],
                    [
                        'severity' => 'P4',
                        'time_response' => 1,
                        'time_response_unit' => 'hour',
                        'time_recovery' => null,
                        'time_recovery_unit' => 'not-available',
                        'resolutions' => [
                            ['name' => '1', 'time' => 180, 'unit' => 'calendar-days'],
                            ['name' => '2', 'time' => 180, 'unit' => 'calendar-days'],
                            ['name' => '3', 'time' => null, 'unit' => 'next-release'],
                            ['name' => '4', 'time' => null, 'unit' => 'next-release'],
                        ],
                        'availabilities' => [
                            ['name' => 'A', 'unit' => '8*5'],
                            ['name' => 'B', 'unit' => '8*5'],
                            ['name' => 'C', 'unit' => '8*5'],
                        ],
                    ],
                ],
            ],
        ];

        foreach ($slas as $item) {
            $sla = Sla::create([
                'name' => $item['name']
            ]);
            foreach ($item['details'] as $info_sla) {
                $detail = $sla->details()->create([
                    'severity_id' => Severity::where('code', $info_sla['severity'])->first()->id,
                    'time_response' => $info_sla['time_response'],
                    'time_response_unit_id' => Unit::where('name', $info_sla['time_response_unit'])->first()->id,
                    'time_recovery' => $info_sla['time_recovery'],
                    'time_recovery_unit_id' => Unit::where('name', $info_sla['time_recovery_unit'])->first()->id,
                ]);
                foreach ($info_sla['resolutions'] as $resolution) {
                    $detail->resolutions()->create([
                        'name' => $resolution['name'],
                        'time' => $resolution['time'],
                        'unit_id' => Unit::where('name', $resolution['unit'])->first()->id,
                    ]);
                }
                foreach ($info_sla['availabilities'] as $availability) {
                    $detail->availabilities()->create([
                        'name' => $availability['name'],
                        'unit_id' => Unit::where('name', $availability['unit'])->first()->id,
                    ]);
                }
            }
        }
    }
}
