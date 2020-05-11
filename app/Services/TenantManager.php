<?php

namespace App\Services;

use App\Tenant;

class TenantManager {
    private $tenant;

    public function setTenant(?Tenant $tenant) {
        $this->tenant = $tenant;        
        return $this;
    }

    public function getTenant(): ?Tenant {
        return $this->tenant;
    }

    public function loadTenant(string $identifier): bool {
        $tenant = Tenant::query()->where('id', '=', $identifier)->first();        
        if($tenant) {
            $this->setTenant($tenant);            
            return true;
        }                
        return false;
    }
}
    
