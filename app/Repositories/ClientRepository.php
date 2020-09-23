<?php

namespace App\Repositories;

use App\Repositories\Contracts\ClientRepositoryInterface;
use Illuminate\Support\Facades\DB;
use App\Models\Client;


class ClientRepository implements ClientRepositoryInterface
{

    protected $entity;

    public function __construct(Client $client)
    {
        $this->entity = $client;
    }

    public function CreateNewClient(array $data)
    {
        $data['password'] = bcrypt($data['password']);

        return $this->entity->create($data);
    }

    public function getClient(int $id)
    {
        
    }

    
}