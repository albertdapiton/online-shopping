<?php

namespace App\Services;

use App\Models\OrderBilling;

final class OrderBillingAddressService extends BaseService
{
    public function __construct()
    {
        parent::__construct(OrderBilling::class);
        $this->model = OrderBilling::class;
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

    public function createBillingAddress(User $user, array $params) : OrderBillingAddress
    {   
        if (isset($params['primary']) && $params['primary']) {
            $this->isPrimarySetOthers();
        }

        $billing = new $this->model;
        $billing->primary = (isset($params['primary']) ? true : false);
        $billing->address_1 = $params['address_1'];
        $billing->address_2 = $params['address_2'];
        $billing->state = (isset($params['state']) ? $params['state'] : null);
        $billing->province = (isset($params['province']) ? $params['province'] : null);
        $billing->city = $params['city'];
        $billing->country = $params['country'];
        $billing->save();

        $user->profile()->billings()->associate($billing);

        return $billing;
    }

    public function deleteBillingAddress(OrderBillingAddress $billing_address)
    {   
        $billing_address->delete();
    }

    public function findBillingAddress(int $id) : OrderBillingAddress
    {
        return $this->model::findOrFail($id);
    }

    public function updateBillingAddress(OrderBillingAddress $billing_address, array $params) : OrderBillingAddress
    {   
        if (isset($params['primary']) && $params['primary']) {
            $this->isPrimarySetOthers();
        }

        $billing = $billing_address;
        $billing->primary = (isset($params['primary']) ? true : false);
        $billing->address_1 = $params['address_1'];
        $billing->address_2 = $params['address_2'];
        $billing->state = (isset($params['state']) ? $params['state'] : null);
        $billing->province = (isset($params['province']) ? $params['province'] : null);
        $billing->city = $params['city'];
        $billing->country = $params['country'];
        $billing->save();

        return $billing;
    }

    public function saveOrderBillingAddress(Order $order, $params)
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