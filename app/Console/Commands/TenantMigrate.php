<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\TenantManager;
use App\Tenant;

class TenantMigrate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenants:migrate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate tenant databases';

    protected $tenantManager;
    protected $migrator;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(TenantManager $tenantManager)
    {
        parent::__construct();
        $this->tenantManager = $tenantManager;
        
        $this->migrator = app('migrator');
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $tenants = Tenant::all();
        
        foreach ($tenants as $tenant) {
            $this->tenantManager->setTenant($tenant);                       
            $this->migrate();
        }
    }

    private function migrate() {
        $this->prepareDatabase();        
        $this->migrator->run(database_path('migrations/tenants'), []);
    }

    protected function prepareDatabase() {
        $this->migrator->setConnection('tenant');
                
        if(! $this->migrator->repositoryExists()) {
            $this->call('migrate:install');
        }
        
    }
}
