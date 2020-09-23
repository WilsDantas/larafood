<?php

namespace App\Services;

use App\Repositories\Contracts\EvaluationRepositoryInterface;
use App\Repositories\Contracts\OrderRepositoryInterface;


class EvaluationService{

    private $evaluationRepository, $orderRepository;

    public function __construct(
        EvaluationRepositoryInterface $evaluation,
        OrderRepositoryInterface $order
    ){
        $this->evaluationRepository = $evaluation;
        $this->orderRepository = $order;
    }

    public function createNewEvaluation(string $identifyOrder, array $evaluation)
    {
        $clientId = $this->getIdClient();
        $order = $this->orderRepository->getOrderByIdentify($identifyOrder);

        return  $this->evaluationRepository->newEvaluationOrder($order->id, $clientId, $evaluation);
    }

    private function getIdClient()
    {
        return auth()->user()->id;
    }

    

}