<?php

namespace App\Console\Commands\Imports;

use Illuminate\Console\Command;

class AllImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import and load the necessary data for the application';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->call('import:roles');
        $this->call('import:parametric');
        return 1;
    }
}
