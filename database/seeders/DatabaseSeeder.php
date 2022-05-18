<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
        ]);

        User::factory()->count(10)->create()->map(function ($user) {
            $user->assignRole(Role::select('name')->where('name', '!=', 'All')->inRandomOrder()->get()->first()->name);
        });

        $user = User::factory()->superadmin()->create();
        $user->assignRole('All');
    }
}
