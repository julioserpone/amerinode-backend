<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'create ticket']);
        Permission::create(['name' => 'edit ticket']);
        Permission::create(['name' => 'close ticket']);
        Permission::create(['name' => 'create ticket packages']);
        Permission::create(['name' => 'dashboards']);
        Permission::create(['name' => 'admin parametrics']);
        Permission::create(['name' => 'admin users']);
        Permission::create(['name' => 'create user']);
        Permission::create(['name' => 'edit user']);

        // this can be done as chaining
        Role::create(['name' => 'AN-Manager'])
            ->givePermissionTo(['create ticket', 'edit ticket', 'close ticket', 'create ticket packages', 'dashboards']);

        Role::create(['name' => 'AN-Master'])
            ->givePermissionTo(['create ticket', 'edit ticket', 'close ticket', 'admin parametrics', 'admin users', 'dashboards']);

        Role::create(['name' => 'Client-Manager'])
            ->givePermissionTo(['create ticket', 'edit ticket', 'close ticket', 'create user', 'edit user']);

        Role::create(['name' => 'Client-User'])
            ->givePermissionTo(['create ticket', 'edit ticket', 'close ticket']);

        Role::create(['name' => 'TEF Administrador'])
            ->givePermissionTo(['create ticket', 'edit ticket', 'close ticket']);

        Role::create(['name' => 'TEF Almacenista'])
            ->givePermissionTo(['create ticket', 'edit ticket', 'close ticket']);

        Role::create(['name' => 'TEF FLM'])
            ->givePermissionTo(['create ticket', 'edit ticket', 'close ticket']);

        Role::create(['name' => 'TEF TDP'])
            ->givePermissionTo(['create ticket', 'edit ticket', 'close ticket']);

        $role = Role::create(['name' => 'super-admin']);
        $role->givePermissionTo(Permission::all());

        $user = \App\Models\User::factory()->create([
            'name' => 'Super-Admin User',
            'username' => 'superadmin',
            'email' => 'superadmin@domain.com',
            'title' => 'Administrator'
        ]);
        $user->assignRole($role);
    }
}
