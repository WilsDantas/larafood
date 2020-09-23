<?php

namespace App\Repositories;

use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class OrderRepository implements OrderRepositoryInterface
{

    protected $entity;

    public function __construct(Order $order)
    {
        $this->entity = $order;
    }

    public function createNewOrder(
        string $identify,
        float $total,
        string $status,
        string $comment,
        int $tenantId,
        $clientId = '',
        $tableId = ''
    ){

        $data = [
            'identify' => $identify,
            'total' => $total,
            'status' => $status,
            'comment' => $comment,
            'tenant_id' => $tenantId,
        ];

        if($clientId) $data['client_id'] = $clientId;
        if($tableId) $data['table_id'] = $tableId;

        $order = $this->entity->create($data);
        return $order;
    }

    public function getOrderByIdentify(string $identify)
    {
        return $this->entity->where('identify', $identify)->first();
    }

    public function registerProductsOrder(int $orderId, array $products)
    {
        $order = $this->entity->find($orderId);
        $orderProducts = [];

        foreach ($products as $product) {
            $orderProducts[$product['id']] = [
                'quantity'  => $product['quantity'],
                'price'     => $product['price'],
            ];
        }

        return $order->products()->attach($orderProducts);


        // foreach ($products as $product) {
        //     array_push($orderProducts, [
        //         'order_id'      => $orderId,
        //         'product_id'    => $product['id'],
        //         'quantity'      => $product['quantity'],
        //         'price'         => $product['price'],
        //     ]);
        // }

        // DB::table('order_product')->insert($orderProducts);
    }

    public function getOrdersByClientId(int $idClient)
    {
        $orders = $this->entity->where('client_id', $idClient)->paginate();

        return $orders;
    }
}