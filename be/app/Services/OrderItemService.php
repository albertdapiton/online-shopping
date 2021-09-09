<?php

namespace App\Services;

use App\Models\OrderItem;

final class OrderItemService extends BaseService
{
    public function __construct()
    {
        parent::__construct(OrderItem::class);
        $this->model = OrderItem::class;
    }

    public function saveOrderItems(Order $order, $params)
    {
        if (isset($params["items"]) && count($params["items"]) > 0) {
            $this->model::create([
                "order_id"      => $order->id,
                "name"          => $params["name"],
                "description"   => $params["description"],
                "price"         => $params["price"],
                "qty"           => $params["qty"],
            ]);
        }
    }
}