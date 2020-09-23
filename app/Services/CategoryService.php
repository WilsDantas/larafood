<?php

namespace App\Services;

use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\TenantRepositoryInterface;

class CategoryService{

    private $tenantRepository, $categoryRepository;

    public function __construct(
        CategoryRepositoryInterface $categoryRepository,
        TenantRepositoryInterface $tenantRepository
    ){
        $this->categoryRepository = $categoryRepository;
        $this->tenantRepository = $tenantRepository;
    }

    public function getCategoriesByUuId(string $uuid)
    {
        $tenant = $this->tenantRepository->getTenantByUuId($uuid); 
        return $this->categoryRepository->getCategoriesByTenantId($tenant->id);
    }
    
    public function getCategoryByUuId(string $uuid)
    {
        return $this->categoryRepository->getCategoryByUuId($uuid);
    }

}