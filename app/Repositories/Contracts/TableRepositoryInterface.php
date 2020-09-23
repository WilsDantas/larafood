<?php

namespace App\Repositories\Contracts;

interface TableRepositoryInterface
{
    public function getTablesByTenantUuId(string $uuid);

    public function getTablesByTenantId(int $idTenant);

    public function getTableByUuId(string $uuid);
}