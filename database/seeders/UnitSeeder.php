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
            ['name' => 'minute', 'unit' => 'minute', 'description' => 'Minutes', 'type' => 'time', 'factor_conversion' => 60],
            ['name' => 'hour', 'unit' => 'hour', 'description' => 'Hours', 'type' => 'time', 'factor_conversion' => 3600],
            ['name' => 'working-hour', 'unit' => 'hour', 'description' => 'Workings Hours', 'type' => 'time', 'factor_conversion' => 3600],
            ['name' => 'calendar-days', 'unit' => 'day', 'description' => 'Calendar days', 'type' => 'time,resolution', 'factor_conversion' => 86400, 'weekdays' => false],
            ['name' => 'week', 'unit' => 'week', 'description' => 'Weeks', 'type' => 'time', 'factor_conversion' => 604800, 'weekdays' => false],
            ['name' => '24*7', 'unit' => 'hour', 'description' => 'This refers to availability at all hours', 'type' => 'availability', 'factor_conversion' => null, 'weekdays' => false],
            ['name' => '8*5', 'unit' => 'hour', 'description' => 'This refers to availability working hours only', 'type' => 'availability', 'factor_conversion' => null, 'weekdays' => false],
            ['name' => 'next-business-day', 'unit' => 'day', 'description' => 'Next business day', 'type' => 'time,resolution', 'factor_conversion' => 86400, 'weekdays' => true],
            ['name' => 'next-release', 'unit' => 'next release', 'description' => 'Next release', 'type' => 'resolution', 'factor_conversion' => null, 'weekdays' => false],
            ['name' => 'not-available', 'unit' => 'N/A', 'description' => 'Not available', 'type' => 'time,resolution,availability', 'factor_conversion' => null, 'weekdays' => false],
        ];

        foreach ($units as $unit) {
            Unit::create($unit);
        }
    }
}
