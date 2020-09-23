<?php

namespace App\Repositories\Contracts;

interface CategoryRepositoryInterface
{
    public function getCategoriesByTenantUuId(string $uuid);

    public function getCategoriesByTenantId(int $idTenant);

    public function getCategoryByUuId(string $uuid);
}