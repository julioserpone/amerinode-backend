<?php

namespace Database\Seeders;

use App\Models\Severity;
use Illuminate\Database\Seeder;

class SeveritySeeder extends Seeder
{
    /**
     * Load severities
     *
     * @return void
     */
    public function run()
    {
        $severities = [
            ['code' => 'P1', 'name' => 'Critical', 'description' => 'Critical P1', 'color' => '#ff0000'],
            ['code' => 'P2', 'name' => 'High', 'description' => 'High P2', 'color' => '#ffc100'],
            ['code' => 'P3', 'name' => 'Medium', 'description' => 'Medium P3', 'color' => '#ffff00'],
            ['code' => 'P4', 'name' => 'Low', 'description' => 'Low P4', 'color' => '#00cd00'],
        ];

        foreach ($severities as $severity) {
            Severity::create($severity);
        }
    }
}
