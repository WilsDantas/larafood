<?php

namespace App\Repositories\Contracts;

interface TenantRepositoryInterface
{
    public function getAllTenants(int $per_page);

    public function getTenantByUuId(string $uuid);
}