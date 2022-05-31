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
                'name' => 'DashboardPage',
                'description' => 'Dashboard',
                'icon' => 'ChartSquareBarIcon',
                'href' => env('APP_URL_FRONT').'/dashboard',
                'roles' => ['All','Amerinode','Financial','Master','Operations'],
            ],
            [
                'name' => 'TicketsPage',
                'description' => 'Tickets',
                'icon' => 'TicketIcon',
                'href' => env('APP_URL_FRONT').'/tickets',
                'roles' => ['All','Amerinode','Financial','Master','Operations'],
            ],
            [
                'name' => 'TicketsPackagePage',
                'description' => 'Tickets Package',
                'icon' => 'BriefcaseIcon',
                'href' => env('APP_URL_FRONT').'/tickets-package',
                'roles' => ['All','Master','Project Admin'],
            ],
            [
                'name' => 'ManageSLAPage',
                'description' => 'Manage SLAs',
                'icon' => 'PresentationChartLineIcon',
                'href' => env('APP_URL_FRONT').'/manage-sla',
                'roles' => ['All','Master','Project Admin'],
            ],
            [
                'name' => 'ParametricPage',
                'description' => 'Parametric',
                'icon' => 'TableIcon',
                'href' => env('APP_URL_FRONT').'/parametric',
                'roles' => ['All','Master'],
            ],
            [
                'name' => 'PermissionsPage',
                'description' => 'Permissions',
                'icon' => 'KeyIcon',
                'href' => env('APP_URL_FRONT').'/permissions',
                'roles' => ['All','Master'],
            ],
            [
                'name' => 'ProjectsPage',
                'description' => 'Projects',
                'icon' => 'FolderOpenIcon',
                'href' => env('APP_URL_FRONT').'/projects',
                'roles' => ['All','Master','Project Admin'],
            ],
            [
                'name' => 'RolesPage',
                'description' => 'Roles',
                'icon' => 'UserGroupIcon',
                'href' => env('APP_URL_FRONT').'/roles',
                'roles' => ['All','Master'],
            ],
            [
                'name' => 'ReportsPage',
                'description' => 'Reports',
                'icon' => 'DocumentReportIcon',
                'href' => env('APP_URL_FRONT').'/reports',
                'roles' => ['All','Master','Reports'],
            ],
            [
                'name' => 'UsersPage',
                'description' => 'Users',
                'icon' => 'UsersIcon',
                'href' => env('APP_URL_FRONT').'/users',
                'roles' => ['All','Master'],
            ],
        ];

        foreach ($itemsMenu as $item) {
            $menu = Menu::create([
                'name' => $item['name'],
                'description' => $item['description'],
                'icon' => $item['icon'],
                'href' => $item['href'],
            ]);
            $menu->assignRole($item['roles']);
        }
    }
}
