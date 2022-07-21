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
                'info' => [
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
                ],
            ],
        ];

        foreach ($slas as $item) {
            $sla = Sla::create([
                'name' => $item['name']
            ]);
            foreach ($item['info'] as $info_sla) {
                $data_sla = $sla->infos()->create([
                    'severity_id' => Severity::where('code', $info_sla['severity'])->first()->id,
                    'time_response' => $info_sla['time_response'],
                    'time_response_unit_id' => Unit::where('name', $info_sla['time_response_unit'])->first()->id,
                    'time_recovery' => $info_sla['time_recovery'],
                    'time_recovery_unit_id' => Unit::where('name', $info_sla['time_recovery_unit'])->first()->id,
                ]);
                foreach ($info_sla['resolutions'] as $resolution) {
                    $data_sla->resolutions()->create([
                        'name' => $resolution['name'],
                        'time' => $resolution['time'],
                        'unit_id' => Unit::where('name', $resolution['unit'])->first()->id,
                    ]);
                }
                foreach ($info_sla['availabilities'] as $availability) {
                    $data_sla->availabilities()->create([
                        'name' => $availability['name'],
                        'unit_id' => Unit::where('name', $availability['unit'])->first()->id,
                    ]);
                }
            }
        }
    }
}
