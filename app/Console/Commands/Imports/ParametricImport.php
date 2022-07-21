<?php

namespace App\Console\Commands\Imports;

use App\Models\Branch;
use App\Models\Company;
use App\Models\Country;
use App\Models\Oem;
use App\Models\Project;
use App\Models\ProjectType;
use App\Models\ServiceType;
use App\Models\Status;
use App\Models\Technology;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ParametricImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:parametric';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports parametric data';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->insertCountries();
        $this->importCompanies();
        $this->importBranches();
        $this->importTechnologies();
        $this->importOEMs();
        $this->importStatuses();
        $this->importServiceTypes();
        $this->importProjectTypes();
        $this->importProjects();

        $this->info('The process import command was successful!');

        return 1;
    }

    /**
     * Importing companies from SQL Server
     *
     * @return void
     */
    private function importCompanies(): void
    {
        $companiesSQL = DB::connection('sqlsrv_core')->select('select * from tblCompany');

        if ($companiesSQL) {
            foreach ($companiesSQL as $companySQL) {
                Company::create([
                    'companyId' => $companySQL->ID,
                    'description' => $companySQL->Name,
                ]);
            }
        }
    }

    /**
     * Importing technologies from SQL Server
     *
     * @return void
     */
    private function importTechnologies(): void
    {
        $technologiesSQL = DB::connection('sqlsrv_core')->select('select * from tblTechnology');

        if ($technologiesSQL) {
            foreach ($technologiesSQL as $technologySQL) {
                Technology::create([
                    'technologyId' => $technologySQL->ID,
                    'description' => $technologySQL->Name,
                ]);
            }
        }
    }

    /**
     * Importing OEM from SQL Server
     *
     * @return void
     */
    private function importOEMs(): void
    {
        $OemsSQL = DB::connection('sqlsrv_core')->select('select * from tblOEM');

        if ($OemsSQL) {
            foreach ($OemsSQL as $OemSQL) {
                Oem::create([
                    'OemId' => $OemSQL->ID,
                    'description' => $OemSQL->Name,
                ]);
            }
        }
    }

    /**
     * Importing Status from SQL Server
     *
     * @return void
     */
    private function importStatuses(): void
    {
        //status for tickets
        $statusTicketsSQL = DB::connection('sqlsrv_core')->select('select * from tblStatus');

        if ($statusTicketsSQL) {
            foreach ($statusTicketsSQL as $statusSQL) {
                Status::create([
                    'statusId' => $statusSQL->ID,
                    'module' => 'tickets',
                    'description' => $statusSQL->Name,
                ]);
            }
        }

        //status for laboratory
        $statusLaboratorySQL = DB::connection('sqlsrv_core')->select('select * from tblSPMLABStatus');

        if ($statusLaboratorySQL) {
            foreach ($statusLaboratorySQL as $statusSQL) {
                Status::create([
                    'statusId' => $statusSQL->ID,
                    'module' => 'laboratory',
                    'description' => $statusSQL->Status,
                ]);
            }
        }
    }

    /**
     * Insert countries manually
     *
     * @return void
     */
    private function insertCountries(): void
    {
        $countries = ['ar', 'br', 'pe', 'cl', 'mx', 'ec', 'co'];

        foreach ($countries as $code) {
            $country = country($code);
            $name = '';
            $currency = '';
            foreach ($country->get('name.native') as $data) {
                $name = $data['common'] ?: '';
            }
            foreach ($country->get('currency') as $data) {
                $currency = $data['iso_4217_code'] ?: '';
            }

            Storage::disk('public')->put('flags/'.$code.'.svg', $country->getFlag());
            $flag_url = Storage::disk('public')->url('flags/'.$code.'.svg');

            Country::create([
                'name' => $name,
                'capital' => $country->get('capital'),
                'code_iso' => $country->get('iso_3166_1_alpha2'),
                'code_iso3' => $country->get('iso_3166_1_alpha3'),
                'currency' => $currency,
                'calling_code' => $country->get('dialling.calling_code')[0],
                'flag_url' => $flag_url,
            ]);

            //TO-DO uploading to AWS S3 not working
            //Storage::disk('s3')->put('flags/'.$code.'.svg', $country->getFlag());
        }
    }

    /**
     * Import branches with associations from SQL Server
     *
     * @return void
     */
    private function importBranches(): void
    {
        $branchesSQL = DB::connection('sqlsrv_core')->select('select * from tblBranch');

        if ($branchesSQL) {
            $countries = Country::all();
            foreach ($branchesSQL as $branchSQL) {
                $country_name = $branchSQL->Name;   //Country
                if (! Str::contains($branchSQL->Name, 'AN-') && ! Str::contains($branchSQL->Name, 'TEF-')) {
                    $country = $countries->filter(function ($item) use ($country_name) {
                        $str = htmlentities($item->name, ENT_COMPAT, 'UTF-8');
                        $str = preg_replace('/&([a-zA-Z])(uml|acute|grave|circ|tilde);/', '$1', $str);
                        $str = html_entity_decode($str);

                        return $str == $country_name;
                    })->first();

                    if ($country) {
                        $branch = Branch::where('company_id', $branchSQL->CompanyID)->where('country_id', $country->id)->first();
                        $company = Company::where('companyId', $branchSQL->CompanyID)->first();
                        if (! $branch) {
                            Branch::create([
                                'branchId' => $branchSQL->ID,
                                'company_id' => $company->id,
                                'country_id' => $country->id,
                            ]);
                        }
                    }
                }
            }
        }
    }

    /**
     * Importing Service types from SQL Server
     *
     * @return void
     */
    private function importServiceTypes(): void
    {
        $serviceTypesSQL = DB::connection('sqlsrv_core')->select('select * from tblService');

        if ($serviceTypesSQL) {
            foreach ($serviceTypesSQL as $serviceTypeSQL) {
                ServiceType::create([
                    'description' => $serviceTypeSQL->Service,
                ]);
            }
        }
    }

    /**
     * Importing Project types from SQL Server
     *
     * @return void
     */
    private function importProjectTypes(): void
    {
        $projectTypesSQL = DB::connection('sqlsrv_core')->select('select * from tblProjectType');

        if ($projectTypesSQL) {
            foreach ($projectTypesSQL as $projectTypeSQL) {
                ProjectType::create([
                    'service_type_id' => ServiceType::where('description', $projectTypeSQL->Service)->first()->id,
                    'description' => $projectTypeSQL->ProjectType,
                ]);
            }
        }
    }

    /**
     * Importing Projects from SQL Server
     *
     * @return void
     */
    private function importProjects(): void
    {
        $projectsSQL = DB::connection('sqlsrv_core')->select('select * from tblProject');

        if ($projectsSQL) {
            foreach ($projectsSQL as $projectSQL) {
                Project::create([
                    'projectId' => $projectSQL->ID,
                    'project_type_id' => ProjectType::where('description', $projectSQL->ProjectType)->first()->id,
                    'branch_id' => Branch::where('branchId', $projectSQL->BranchID2)->first()->id,
                    'name' => $projectSQL->Project,
                    'description' => $projectSQL->Description,
                ]);
            }
        }
    }
}
