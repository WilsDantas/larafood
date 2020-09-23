<?php

namespace App\Services;

use App\Repositories\Contracts\TableRepositoryInterface;
use App\Repositories\Contracts\TenantRepositoryInterface;

class TableService{

    private $tenantRepository, $tableRepository;

    public function __construct(
        TableRepositoryInterface $tableRepository,
        TenantRepositoryInterface $tenantRepository
    ){
        $this->tableRepository = $tableRepository;
        $this->tenantRepository = $tenantRepository;
    }

    public function getTablesByUuId(string $uuid)
    {
        $tenant = $this->tenantRepository->getTenantByUuId($uuid); 
        return $this->tableRepository->getTablesByTenantId($tenant->id);
    }
    
    public function getTableByUuId(string $uuid)
    {
        return $this->tableRepository->getTableByUuId($uuid);
    }

}