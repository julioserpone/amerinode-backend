<?php

namespace App\Console\Commands;

use App\Models\Branch;
use App\Models\Company;
use App\Models\Country;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class ImportData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Proceso de importación de datos';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->importRolesWithPermissions();
        $this->importCompanies();
        $this->insertCountries();
        $this->importBranches();
        $this->hackGuardRoles();

        $this->info('The process import command was successful!');
        return 1;
    }

    /**
     * Importing roles from SQL Server and creating permissions
     *
     * @return void
     */
    private function importRolesWithPermissions() : void
    {
        $permissions = [
            1 => ['name' => 'create-ticket', 'description' => 'Create tickets'],
            2 => ['name' => 'edit-ticket', 'description' => 'Edit tickets'],
            3 => ['name' => 'close-ticket', 'description' => 'Close tickets'],
            4 => ['name' => 'delete-ticket', 'description' => 'Delete tickets'],
            5 => ['name' => 'show-ticket', 'description' => 'Show tickets'],
            6 => ['name' => 'report-ticket', 'description' => 'report-reports'],
            7 => ['name' => 'admin-roles', 'description' => 'Manage roles'],
            8 => ['name' => 'admin-permissions', 'description' => 'Manage permissions'],
            9 => ['name' => 'admin-parametric', 'description' => 'Manage parametric'],
            10 => ['name' => 'admin-users-portal', 'description' => 'Manage portal users'],
            11 => ['name' => 'admin-users-managers', 'description' => 'Manage users ticket managers'],
            12 => ['name' => 'create-user', 'description' => 'Create user'],
            13 => ['name' => 'edit-user', 'description' => 'Edit user'],
            14 => ['name' => 'load-documents-to-project', 'description' => 'Load documents to project'],
            15 => ['name' => 'manage-financial', 'description' => 'Manage financial'],
            16 => ['name' => 'warehouse-operation', 'description' => 'Warehouse operations'],
            17 => ['name' => 'admin-project', 'description' => 'Manage projects'],
            18 => ['name' => 'admin-ticket-package', 'description' => 'Manage ticket package'],
        ];

        //Assign permissions by role
        $roleWithPermissions = [
            'All' => [
                'permissions' => '*',
                'description' => 'Alert: User administrator with all permissions'
            ],
            'Amerinode' => [
                'permissions' => [1, 2, 3, 5, 6, 14, 15, 16],
                'description' => 'Amerinode Internal  (cannot be deleted) for AMERINODE ONLY'
            ],
            'Documents' => [
                'permissions' => [14],
                'description' => 'Load Project Documents'
            ],
            'Financial' => [
                'permissions' => [15],
                'description' => 'Manage financial'
            ]
            ,
            'Master' => [
                'permissions' => [7, 8, 10, 11, 12, 13],
                'description' => 'Master Role (cannot be deleted) for AMERINODE ONLY'
            ],
            'Operations' => [
                'permissions' => [2, 3, 5, 6],
                'description' => 'Manages Tickets and generates Reports'
            ],
            'Project Admin' => [
                'permissions' => [17],
                'description' => 'Project Management'
            ],
            'Questions' => [
                'disabled' => true,
                'permissions' => [],
                'description' => 'Manage Questions'
            ],
            'Reference Tables' => [
                'permissions' => [9],
                'description' => 'Manages Key Reference Tables'
            ],
            'Reports' => [
                'permissions' => [6],
                'description' => 'Reports Tickets'
            ],
            'TEF Operations' => [
                'disabled',
                'permissions' => [],
                'description' => 'TEF Manages Tickets and generates Reports'
            ],
            'TEF Reports' => [
                'disabled',
                'permissions' => [],
                'description' => 'Reports TEF Peru'
            ],
            'TEF Tables' => [
                'disabled',
                'permissions' => [],
                'description' => 'Manage TEF Tables'
            ],
            'TEF Tools' => [
                'disabled',
                'permissions' => [],
                'description' => 'Admin Tools'
            ],
            'Warehouse' => [
                'permissions' => [16],
                'description' => 'Manages Warehouse Operations'
            ],
        ];

        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        //create permissions
        foreach ($permissions as $permission) {
            //Guard name is 'api' by default
            Permission::create([
                'name' => $permission['name'],
                'description' => $permission['description']
            ]);
        }

        $rolesSQL = DB::connection('sqlsrv_users')->select('select * from aspnet_Roles');
        if ($rolesSQL) {
            foreach ($rolesSQL as $roleSQL) {
                $roleConfig = Arr::first($roleWithPermissions, function($value, $key) use ($roleSQL)
                {
                    return $key == $roleSQL->RoleName;
                });
                if ($roleConfig) {
                    $role = Role::updateOrCreate([
                        'roleId' => $roleSQL->RoleId,
                        'name' => $roleSQL->RoleName,
                        'description' => $roleConfig['description'],
                    ]);
                    //If disabled, no permissions are assigned to it
                    if (!Arr::has($roleConfig, 'disabled')) {
                        //Multiples permissions are assigned
                        if (is_array($roleConfig['permissions'])) {
                            foreach ($roleConfig['permissions'] as $permission) {
                                $permissionFound = Arr::first($permissions, function ($value, $key) use ($permission) {
                                    return $key == $permission;
                                });
                                if ($permissionFound) {
                                    $role->givePermissionTo($permissionFound['name']);
                                }
                            }
                        } else {
                            if (is_string($roleConfig['permissions']) && $roleConfig['permissions'] == "*") {
                                $role->givePermissionTo(Permission::all());
                            }
                        }
                    }
                }
            }


        }
    }

    /**
     * Importing companies from SQL Server
     *
     * @return void
     */
    private function importCompanies() : void
    {
        $companiesSQL = DB::connection('sqlsrv_core')->select('select * from tblCompany');

        if ($companiesSQL) {
            foreach ($companiesSQL as $companySQL) {
                Company::create([
                    'companyId' =>  $companySQL->ID,
                    'description' => $companySQL->Name
                ]);
            }
        }
    }

    /**
     * Insert countries manually
     *
     * @return void
     */
    private function insertCountries() : void
    {
        $countries = ['Brasil', 'Peru', 'Chile', 'Mexico', 'Ecuador', 'Colombia'];
        foreach ($countries as $country) {
            Country::create([
                'description' => $country
            ]);
        }
    }

    /**
     * Import branches with associations from SQL Server
     *
     * @return void
     */
    private function importBranches() : void
    {
        $branchesSQL = DB::connection('sqlsrv_core')->select('select * from tblBranch');

        if ($branchesSQL) {
            foreach ($branchesSQL as $branchSQL) {
                if (!Str::contains($branchSQL->Name,'AN-') && !Str::contains($branchSQL->Name,'TEF-')) {
                    $country = Country::where('description', $branchSQL->Name)->first();
                    if ($country) {
                        $branch = Branch::where('company_id',$branchSQL->CompanyID)->where('country_id', $country->id)->first();
                        $company = Company::where('companyId', $branchSQL->CompanyID)->first();
                        if (!$branch) {
                            Branch::create([
                                'company_id' => $company->id,
                                'country_id' => $country->id
                            ]);
                        }
                    }
                }
            }
        }
    }

    /**
     * Hack guard name to roles package
     *
     * @return void
     */
    private function hackGuardRoles() :void
    {
        //Hack laravel permissions guard
        DB::table('permissions')->update(['guard_name' => 'sanctum']);
        DB::table('roles')->update(['guard_name' => 'sanctum']);
    }
}
