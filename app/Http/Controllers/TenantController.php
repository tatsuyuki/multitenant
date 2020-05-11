<?php

namespace App\Http\Controllers;
use App\Tenant;
use App\User;
use App\Jobs\TenantDatabase;
use App\Services\TenantManager;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class TenantController extends Controller
{
    protected $tenant;

    public function __construct(Tenant $tenant)
    {
        $this->tenant = $tenant;
    }

    public function index() 
    {
        $user = auth()->user();        
        $tenant = app(TenantManager::class)->setTenant(Tenant::find($user->tenant_id));        
        $query = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = ?";
        $dbString = "tenant_" . $tenant->getTenant()->id;
        
        $db = DB::select($query, [$dbString]);
        
        if(empty($db))
        {
            TenantDatabase::dispatchNow($tenant,
            app(TenantManager::class));
        }
        
        /* dd($tenant); */
        return view('tenants.index', [
            'tenant' => $tenant->getTenant()
        ]);        
    }
}
