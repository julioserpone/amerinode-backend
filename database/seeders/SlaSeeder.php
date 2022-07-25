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
                    $this->addSLA('P1', 1, 'hour', 1, 'working-days', 'addResolutionP1', 'addAvailabilityP1'),
                    $this->addSLA('P2', 1, 'hour', 1, 'week', 'addResolutionP2', 'addAvailabilityP2'),
                    $this->addSLA('P3', 1, 'hour', null, 'not-available', 'addResolutionP3', 'addAvailabilityDefault'),
                    $this->addSLA('P4', 1, 'hour', null, 'not-available', 'addResolutionP4', 'addAvailabilityDefault'),
                ],
            ],
            [
                'name' => 'BRONZE',
                'details' => [
                    $this->addSLA('P1', 15, 'minute', 14, 'hour', 'addResolutionP1', 'addAvailabilityP1'),
                    $this->addSLA('P2', 30, 'minute', 72, 'hour', 'addResolutionP2', 'addAvailabilityP2'),
                    $this->addSLA('P3', 1, 'hour', 30, 'calendar-days', 'addResolutionP3', 'addAvailabilityDefault'),
                    $this->addSLA('P4', 1, 'hour', null, 'not-available', 'addResolutionP4', 'addAvailabilityDefault'),
                ],
            ],
            [
                'name' => 'SILVER - MINUS',
                'details' => [
                    $this->addSLA('P1', 15, 'minute', 8, 'hour', 'addResolutionP1', 'addAvailabilityP1'),
                    $this->addSLA('P2', 30, 'minute', 72, 'hour', 'addResolutionP2', 'addAvailabilityP2'),
                    $this->addSLA('P3', 1, 'hour', 15, 'calendar-days', 'addResolutionP3', 'addAvailabilityDefault'),
                    $this->addSLA('P4', 1, 'hour', null, 'not-available', 'addResolutionP4', 'addAvailabilityDefault'),
                ],
            ],
            [
                'name' => 'SILVER',
                'details' => [
                    $this->addSLA('P1', 15, 'minute', 6, 'hour', 'addResolutionP1', 'addAvailabilityP1'),
                    $this->addSLA('P2', 30, 'minute', 24, 'hour', 'addResolutionP2', 'addAvailabilityP2'),
                    $this->addSLA('P3', 1, 'hour', 11, 'working-days', 'addResolutionP3', 'addAvailabilityDefault'),
                    $this->addSLA('P4', 1, 'hour', null, 'not-available', 'addResolutionP4', 'addAvailabilityDefault'),
                ],
            ],
            [
                'name' => 'GOLD - MINUS',
                'details' => [
                    $this->addSLA('P1', 15, 'minute', 4, 'hour', 'addResolutionP1', 'addAvailabilityP1'),
                    $this->addSLA('P2', 30, 'minute', 48, 'hour', 'addResolutionP2', 'addAvailabilityP2'),
                    $this->addSLA('P3', 1, 'hour', 7, 'working-days', 'addResolutionP3', 'addAvailabilityDefault'),
                    $this->addSLA('P4', 1, 'hour', null, 'not-available', 'addResolutionP4', 'addAvailabilityDefault'),
                ],
            ],
            [
                'name' => 'GOLD',
                'details' => [
                    $this->addSLA('P1', 15, 'minute', 4, 'hour', 'addResolutionP1', 'addAvailabilityP1'),
                    $this->addSLA('P2', 30, 'minute', 12, 'hour', 'addResolutionP2', 'addAvailabilityP2'),
                    $this->addSLA('P3', 1, 'hour', 7, 'working-days', 'addResolutionP3', 'addAvailabilityDefault'),
                    $this->addSLA('P4', 1, 'hour', null, 'not-available', 'addResolutionP4', 'addAvailabilityDefault'),
                ],
            ],
            [
                'name' => 'PLATINUM',
                'details' => [
                    $this->addSLA('P1', 15, 'minute', 2, 'hour', 'addResolutionP1', 'addAvailabilityP1'),
                    $this->addSLA('P2', 30, 'minute', 6, 'hour', 'addResolutionP2', 'addAvailabilityP2'),
                    $this->addSLA('P3', 1, 'hour', 7, 'working-days', 'addResolutionP3', 'addAvailabilityDefault'),
                    $this->addSLA('P4', 1, 'hour', null, 'not-available', 'addResolutionP4', 'addAvailabilityDefault'),
                ],
            ],
        ];

        foreach ($slas as $item) {
            $sla = Sla::create([
                'name' => $item['name'],
            ]);
            foreach ($item['details'] as $detail_sla) {
                $detail = $sla->details()->create([
                    'severity_id' => Severity::where('code', $detail_sla['severity'])->first()->id,
                    'time_response' => $detail_sla['time_response'],
                    'time_response_unit_id' => Unit::where('name', $detail_sla['time_response_unit'])->first()->id,
                    'time_recovery' => $detail_sla['time_recovery'],
                    'time_recovery_unit_id' => Unit::where('name', $detail_sla['time_recovery_unit'])->first()->id,
                ]);
                foreach ($detail_sla['resolutions'] as $resolution) {
                    foreach ($resolution['details'] as $resolution_detail) {
                        $detail->resolutions()->create([
                            'name' => $resolution['name'],
                            'time' => $resolution_detail['time'],
                            'unit_id' => Unit::where('name', $resolution_detail['unit'])->first()->id,
                            'precision' => $resolution_detail['precision']
                        ]);
                    }
                }
                foreach ($detail_sla['availabilities'] as $availability) {
                    $detail->availabilities()->create([
                        'name' => $availability['name'],
                        'unit_id' => Unit::where('name', $availability['unit'])->first()->id,
                    ]);
                }
            }
        }
    }

    /**
     * @param string $severity
     * @param int $time_response
     * @param string $time_response_unit
     * @param int|null $time_recovery
     * @param string $time_recovery_unit
     * @param $resolution
     * @param $availability
     * @return array
     */
    public function addSLA(string $severity, int $time_response, string $time_response_unit, int|null $time_recovery, string $time_recovery_unit, $resolution, $availability)
    {
        return [
            'severity' => $severity,
            'time_response' => $time_response,
            'time_response_unit' => $time_response_unit,
            'time_recovery' => $time_recovery,
            'time_recovery_unit' => $time_recovery_unit,
            'resolutions' => $this->{$resolution}(),
            'availabilities' => $this->{$availability}(),
        ];
    }

    /**
     * @param  float|null  $time
     * @param  string  $unit
     * @param  float|null  $precision
     * @return array
     */
    public function addResolution(float $time = null, string $unit = 'next-release', float $precision = null): array
    {
        return ['time' => $time, 'unit' => $unit, 'precision' => $precision];
    }

    /**
     * @return array[]
     */
    public function addResolutionP1()
    {
        return [
            ['name' => '1', 'details' => [$this->addResolution(30, 'calendar-days', 85), $this->addResolution(45, 'calendar-days', 100)]],
            ['name' => '2', 'details' => [$this->addResolution(45, 'calendar-days', 85), $this->addResolution(60, 'calendar-days', 100)]],
            ['name' => '3', 'details' => [$this->addResolution(60, 'calendar-days', 85), $this->addResolution(90, 'calendar-days', 100)]],
            ['name' => '4', 'details' => [$this->addResolution(60, 'calendar-days', 85), $this->addResolution(90, 'calendar-days', 100)]],
        ];
    }

    /**
     * @return array[]
     */
    public function addResolutionP2()
    {
        return [
            ['name' => '1', 'details' => [$this->addResolution(45, 'calendar-days', 85), $this->addResolution(60, 'calendar-days', 100)]],
            ['name' => '2', 'details' => [$this->addResolution(60, 'calendar-days', 85), $this->addResolution(90, 'calendar-days', 100)]],
            ['name' => '3', 'details' => [$this->addResolution(90, 'calendar-days', 85), $this->addResolution(120, 'calendar-days', 100)]],
            ['name' => '4', 'details' => [$this->addResolution(90, 'calendar-days', 85), $this->addResolution(120, 'calendar-days', 100)]],
        ];
    }

    /**
     * @return array[]
     */
    public function addResolutionP3()
    {
        return [
            ['name' => '1', 'details' => [$this->addResolution(60, 'calendar-days', 85), $this->addResolution(90, 'calendar-days', 100)]],
            ['name' => '2', 'details' => [$this->addResolution(90, 'calendar-days', 85), $this->addResolution(120, 'calendar-days', 100)]],
            ['name' => '3', 'details' => [$this->addResolution(120, 'calendar-days', 85), $this->addResolution(150, 'calendar-days', 100)]],
            ['name' => '4', 'details' => [$this->addResolution()]],
        ];
    }

    /**
     * @return array[]
     */
    public function addResolutionP4(): array
    {
        return [
            ['name' => '1', 'details' => [$this->addResolution(180, 'calendar-days')]],
            ['name' => '2', 'details' => [$this->addResolution(180, 'calendar-days')]],
            ['name' => '3', 'details' => [$this->addResolution()]],
            ['name' => '4', 'details' => [$this->addResolution()]],
        ];
    }

    /**
     * @return array[]
     */
    public function addAvailabilityP1(): array
    {
        return [['name' => 'A', 'unit' => '24*7'], ['name' => 'B', 'unit' => '24*7'], ['name' => 'C', 'unit' => '8*5']];
    }

    /**
     * @return array[]
     */
    public function addAvailabilityP2(): array
    {
        return [['name' => 'A', 'unit' => '24*7'], ['name' => 'B', 'unit' => '8*5'], ['name' => 'C', 'unit' => '8*5']];
    }

    /**
     * @return array[]
     */
    public function addAvailabilityDefault(): array
    {
        return [['name' => 'A', 'unit' => '8*5'], ['name' => 'B', 'unit' => '8*5'], ['name' => 'C', 'unit' => '8*5']];
    }
}
