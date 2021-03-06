<?php

namespace App\Repositories;

use App\Repositories\Contracts\TenantRepositoryInterface;
use App\Models\Tenant;

class TenantRepository implements TenantRepositoryInterface
{

    protected $entity;

    public function __construct(Tenant $tenant)
    {
        $this->entity = $tenant;
    }

    public function getAllTenants($per_page)
    {
        return $this->entity->paginate($per_page);
    }

    public function getTenantByUuId(string $uuid)
    {
        return $this->entity->where('uuid', $uuid)->first(); 
    }
}