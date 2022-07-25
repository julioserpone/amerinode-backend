<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Load units
     *
     * @return void
     */
    public function run()
    {
        $units = [
            ['name' => 'minute', 'unit' => 'minute', 'nomenclature' => 'min', 'description' => 'Minutes', 'type' => 'time', 'factor_conversion' => 60],
            ['name' => 'hour', 'unit' => 'hour', 'nomenclature' => 'hrs', 'description' => 'Hours', 'type' => 'time', 'factor_conversion' => 3600],
            ['name' => 'working-hour', 'unit' => 'hour', 'nomenclature' => 'WH', 'description' => 'Working Hours', 'type' => 'time', 'factor_conversion' => 3600],
            ['name' => 'working-days', 'unit' => 'day', 'nomenclature' => 'WD', 'description' => 'Working Days', 'type' => 'time', 'factor_conversion' => 86400],
            ['name' => 'calendar-days', 'unit' => 'day', 'nomenclature' => 'CD', 'description' => 'Calendar days', 'type' => 'time,resolution', 'factor_conversion' => 86400, 'weekdays' => false],
            ['name' => 'week', 'unit' => 'week', 'nomenclature' => 'Week', 'description' => 'Weeks', 'type' => 'time', 'factor_conversion' => 604800, 'weekdays' => false],
            ['name' => '24*7', 'unit' => 'hour', 'nomenclature' => null, 'description' => 'This refers to availability at all hours', 'type' => 'availability', 'factor_conversion' => null, 'weekdays' => false],
            ['name' => '8*5', 'unit' => 'hour', 'nomenclature' => null, 'description' => 'This refers to availability working hours only', 'type' => 'availability', 'factor_conversion' => null, 'weekdays' => false],
            ['name' => 'next-business-day', 'unit' => 'day', 'nomenclature' => 'NBD', 'description' => 'Next business day', 'type' => 'time,resolution', 'factor_conversion' => 86400, 'weekdays' => true],
            ['name' => 'next-release', 'unit' => 'next release', 'nomenclature' => 'Next Rel', 'description' => 'Next release', 'type' => 'resolution', 'factor_conversion' => null, 'weekdays' => false],
            ['name' => 'not-available', 'unit' => 'N/A', 'nomenclature' => 'N/A', 'description' => 'Not available', 'type' => 'time,resolution,availability', 'factor_conversion' => null, 'weekdays' => false],
        ];

        foreach ($units as $unit) {
            Unit::create($unit);
        }
    }
}
