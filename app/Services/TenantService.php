<?php

namespace App\Services;

use App\Models\Plan;
use App\Repositories\Contracts\TenantRepositoryInterface;

class TenantService{

    private $plan, $data = [];
    private $repository;

    public function __construct(TenantRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAllTenants(int $per_page)
    {
        return $this->repository->getAllTenants($per_page);
    }

    public function getTenantByUuId(string $uuid)
    {
        return $this->repository->getTenantByUuId($uuid);
    }


    public function make(Plan $plan, array $data){
        $this->plan = $plan;
        $this->data = $data;

        $tenant = $this->storeTenant();

        $user = $this->storeUser($tenant);

        return $user;
    }

    public function storeTenant(){

        return $this->plan->tenants()->create([
            'cnpj' => $this->data['cnpj'],
            'name' => $this->data['name'],
            'email' => $this->data['email'],

            'subscription' => now(),
            'expires_at' => now()->addDays(7),
        ]);
    }

    public function storeUser($tenant){
        return $tenant->users()->create([
            'name' => $this->data['name'],
            'email' => $this->data['email'],
            'password' => bcrypt($this->data['password']),
        ]);
    }
}