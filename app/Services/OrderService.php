<?php

namespace App\Services;

use App\Repositories\Contracts\{
    OrderRepositoryInterface,
    TenantRepositoryInterface,
    TableRepositoryInterface,
    ProductRepositoryInterface,
};

class OrderService{

    protected $orderRepository;
    protected $tenantRepository;
    protected $tableRepository;
    protected $productRepository;


    public function __construct(
        OrderRepositoryInterface $orderRepository,
        TenantRepositoryInterface $tenantRepository,
        TableRepositoryInterface $tableRepository,
        ProductRepositoryInterface $productRepository
    ){
        $this->orderRepository = $orderRepository;
        $this->tenantRepository = $tenantRepository;
        $this->tableRepository = $tableRepository;
        $this->productRepository = $productRepository;

    }

    public function ordersByClient()
    {
        $idClient = $this->getClientIdByOrder();

        return $this->orderRepository->getOrdersByClientId($idClient);
    }

    public function getOrderByIdentify(string $identify)
    {
        return $this->orderRepository->getOrderByIdentify($identify);
    }

    public function createNewOrder(array $order)
    {
        $productsOrder = $this->getProductsByOrder($order['products'] ?? []);

        $identify = $this->getIdentifyOrder();
        $total = $this->getTotalOrder($productsOrder);
        $status = 'open';
        $comment = isset($order['comment']) ? $order['comment'] : '';
        $tenantId = $this->getTenantIdByOrder($order['token_company']);
        $clientId = $this->getClientIdByOrder();
        $tableId = $this->getTableIdByOrder($order['table'] ?? '');
        $order = $this->orderRepository->createNewOrder(
            $identify,
            $total,
            $status,
            $comment,
            $tenantId,
            $clientId,
            $tableId,
        );

        $this->orderRepository->registerProductsOrder($order->id, $productsOrder);
        
        return $order;
    }

    private function getIdentifyOrder(int $qtyCaracters = 8)
    {
        $smallLetters = str_shuffle('abcdefghijklmnopqrstuvwxyz');

        $numbers = (((date('Ymd') / 12) * 24) + mt_rand(800, 9999));
        $numbers .= 1234567890;

        // $specialCharacters = str_shuffle('!@#$%*-');

        // $characters = $smallLetters.$numbers.$specialCharacters;

        $characters = $smallLetters.$numbers;

        $identify = substr(str_shuffle($characters), 0, $qtyCaracters);
        if ($this->orderRepository->getOrderByIdentify($identify)){
            $this->getIdentifyOrder($qtyCaracters + 1);
        }

        return $identify;
    }

    private function getProductsByOrder(array $productsOrder): array
    {
        $products = [];
        foreach($productsOrder as $productOrder)
        {
            $product = $this->productRepository->getProductByUuId($productOrder['identify']);

            array_push($products, [
                'id' => $product->id,
                'quantity' => $productOrder['quantity'],
                'price' => $product->price
            ]);
        }
        return $products;
    }
    
    private function getTotalOrder(array $products) :float
    {
        $total = 0;
        foreach($products as $product)
        {
            $total += ($product['price'] * $product['quantity']);
        }

        return (float) $total;
    }

    private function getTenantIdByOrder(string $uuid)
    {
        $tenant = $this->tenantRepository->getTenantByUuId($uuid);

        return $tenant->id;
    }

    private function getTableIdByOrder(string $uuid = '')
    {
        if($uuid){
            $table = $this->tableRepository->getTableByUuId($uuid);
            return $table->id;
        }

        return '';
    }

    private function getClientIdByOrder()
    {
        return auth()->check() ? auth()->user()->id : '';
    }
}