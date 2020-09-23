<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\StoreClient;
use App\Services\ClientService;
use App\Http\Resources\ClientResource;


class RegisterController extends Controller
{


    protected $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    public function store(StoreClient $request)
    {
        $client = $this->clientService->createNewClient($request->all());

        return New ClientResource($client);
    }
}
