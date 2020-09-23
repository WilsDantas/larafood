<?php

namespace App\Services;

use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\TenantRepositoryInterface;

class ProductService{

    private $tenantRepository, $productRepository;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        TenantRepositoryInterface $tenantRepository
    ){
        $this->productRepository = $productRepository;
        $this->tenantRepository = $tenantRepository;
    }

    public function getProductsByTenantUuId(string $uuid, array $categories)
    {
        $tenant = $this->tenantRepository->getTenantByUuId($uuid);
        return $this->productRepository->getProductsByTenantId($tenant->id, $categories);
    }

    public function getProductByUuId(string $uuid)
    {
        return $this->productRepository->getProductByUuId($uuid);
    }

    

}