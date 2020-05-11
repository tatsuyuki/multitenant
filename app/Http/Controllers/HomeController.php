<?php

namespace App\Http\Controllers;
use App\Tenant;
use App\User;
use App\Jobs\TenantDatabase;
use App\Services\TenantManager;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $tenantManager;
    protected $tenant;    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(TenantManager $tenantManager)
    {
        
        $this->tenantManager = $tenantManager;                     
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
            
        $tenant = $this->tenantManager->getTenant();
        if(auth()->user()->tenant_id != $tenant->id)
        {
            abort(403);
        }   
                  
        return view('home', compact('tenant'));        
    }
}
