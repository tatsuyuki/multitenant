<?php

namespace App\Policies;

use App\Tenant;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TenantPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Tenant $tenant)
    {
        return $user->tenant_id == $tenant->id;
    }

}
