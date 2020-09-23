<?php

namespace App\Repositories\Contracts;

interface ClientRepositoryInterface
{
    public function CreateNewClient(array $data);
    public function getClient(int $id);

}