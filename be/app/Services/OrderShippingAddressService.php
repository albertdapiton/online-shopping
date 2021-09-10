<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderShipping;

final class OrderShippingAddressService extends BaseService
{
    public function __construct()
    {
        parent::__construct(OrderShipping::class);
        $this->model = OrderShipping::class;
    }

    protected function isPrimarySetOthers()
    {
        $this->model::where('primary', true)
            ->get()
            ->each(function($q) {
                $q->primary = false;
                $q->save();
            });
    }

    public function createShippingAddress(User $user, array $params) : OrderShippingAddress
    {   
        if (isset($params['primary']) && $params['primary']) {
            $this->isPrimarySetOthers();
        }

        $shipping = new $this->model;
        $shipping->primary = (isset($params['primary']) ? true : false);
        $shipping->address_1 = $params['address_1'];
        $shipping->address_2 = $params['address_2'];
        $shipping->state = (isset($params['state']) ? $params['state'] : null);
        $shipping->province = (isset($params['province']) ? $params['province'] : null);
        $shipping->city = $params['city'];
        $shipping->country = $params['country'];
        $shipping->save();

        $user->profile()->shippings()->associate($shipping);

        return $shipping;
    }

    public function deleteShippingAddress(OrderShippingAddress $shipping_address)
    {   
        $shipping_address->delete();
    }

    public function findShippingAddress(int $id) : OrderShippingAddress
    {
        return $this->model::findOrFail($id);
    }

    public function updateShippingAddress(OrderShippingAddress $shipping_address, array $params) : OrderShippingAddress
    {   
        if (isset($params['primary']) && $params['primary']) {
            $this->isPrimarySetOthers();
        }

        $shipping = $shipping_address;
        $shipping->primary = (isset($params['primary']) ? true : false);
        $shipping->address_1 = $params['address_1'];
        $shipping->address_2 = $params['address_2'];
        $shipping->state = (isset($params['state']) ? $params['state'] : null);
        $shipping->province = (isset($params['province']) ? $params['province'] : null);
        $shipping->city = $params['city'];
        $shipping->country = $params['country'];
        $shipping->save();

        return $shipping;
    }

    public function saveOrderShippingAddress(Order $order, $params)
    {
        $this->model::create([
            "order_id"  => $order->id,
            "address_1" => $params["address_1"],
            "address_2" => (isset($params["address_2"]) ? $params["address_2"] : null),
            "state"     => (isset($params["state"]) ? $params["state"] : null),
            "province"  => (isset($params["province"]) ? $params["province"] : null),
            "city"      => (isset($params["city"]) ? $params["city"] : null),
            "country"   => (isset($params["country"]) ? $params["country"] : null),
        ]);
    }
}