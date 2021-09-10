<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Payment;

final class PaymentService extends BaseService
{
    public function __construct()
    {
        parent::__construct(Payment::class);
        $this->model = Payment::class;
    }

    public function savePayment(Order $order, $params) 
    {
        Payment::create([
            "order_id"  => $order->id,
            "amount"    => $params["total_amount"],
            "stripe_id" => (isset($params["stripe_id"]) ? $params["stripe_id"] : null),
        ]);
    }
}