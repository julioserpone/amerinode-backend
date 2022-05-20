<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $itemsMenu = [
            [
                'name' => 'Dashboard',
                'icon' => 'ChartSquareBarIcon',
                'href' => 'dashboard',
                'roles' => ['All','Amerinode','Financial','Master','Operations'],
            ],
            [
                'name' => 'Tickets',
                'icon' => 'TicketIcon',
                'href' => 'tickets',
                'roles' => ['All','Amerinode','Financial','Master','Operations'],
            ],
            [
                'name' => 'Tickets Package',
                'icon' => 'BriefcaseIcon',
                'href' => 'tickets-package',
                'roles' => ['All','Master','Project Admin'],
            ],
            [
                'name' => 'Manage SLAs',
                'icon' => 'PresentationChartLineIcon',
                'href' => 'manage-sla',
                'roles' => ['All','Master','Project Admin'],
            ],
            [
                'name' => 'Parametric',
                'icon' => 'TableIcon',
                'href' => 'parametric',
                'roles' => ['All','Master'],
            ],
            [
                'name' => 'Permissions',
                'icon' => 'KeyIcon',
                'href' => 'permissions',
                'roles' => ['All','Master'],
            ],
            [
                'name' => 'Projects',
                'icon' => 'FolderOpenIcon',
                'href' => 'projects',
                'roles' => ['All','Master','Project Admin'],
            ],
            [
                'name' => 'Roles',
                'icon' => 'UserGroupIcon',
                'href' => 'roles',
                'roles' => ['All','Master'],
            ],
            [
                'name' => 'Reports',
                'icon' => 'DocumentReportIcon',
                'href' => 'reports',
                'roles' => ['All','Master','Reports'],
            ],
            [
                'name' => 'Users',
                'icon' => 'UsersIcon',
                'href' => 'users',
                'roles' => ['All','Master'],
            ],
        ];

        foreach ($itemsMenu as $item) {
            $menu = Menu::create([
                'name' => $item['name'],
                'icon' => $item['icon'],
                'href' => $item['href'],
            ]);
            $menu->assignRole($item['roles']);
        }
    }
}
