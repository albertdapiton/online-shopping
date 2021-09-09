<?php

namespace App\Services;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

final class OrderService extends BaseService
{
    public function __construct()
    {
        parent::__construct(Order::class);
        $this->model = Order::class;
    }

    public function all() : Collection
    {
        return $this->model::all();
    }

    public function byUserId(int $user_id) : Collection
    {
        return $this->model::where("user_id", $user_id)->get();
    }

    public function find(int $id) : Order
    {
        return $this->model::find($id);
    }

    public function saveOrder(User $user)
    {
        $order = $this->model::create([
            "user_id"   => $user->id
        ]);

        return $order;
    }
}