<?php

namespace App\Services;

use App\Models\ProfileShippingAddress;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

final class ShippingService extends BaseService
{   
    public function __construct()
    {
        parent::__construct(ProfileShippingAddress::class);
        $this->model = ProfileShippingAddress::class;
    }

    public function bulkDeleteShipping(array $ids) : Collection
    {
        return $this->model::find($ids)->get()->delete();
    }

    public function createShipping(User $user, array $params) : ProfileShippingAddress
    {
        $shipping = $this->model::create([
            'profile_id'=> $user->profile->id,
            'primary'   => $params['primary'],
            'address_1' => $params['address_1'],
            'address_2' => (isset($params['address_2']) ? $params['address_2'] : null),
            'state'     => $params['state'],
            'province'  => $params['province'],
            'city'      => $params['city'],
            'country'   => $params['country'],
        ]);

        return $shipping;
    }

    public function deleteShipping(int $id) : ProfileShippingAddress
    {
        return $this->model::find($id)->delete();
    }

    public function findShipping(int $id) : ProfileShippingAddress
    {
        return $this->model::findOrFail($id);
    }

    public function searchShippings(array $params)
    {
        $shippings = $this->model::orderBy('profile_shipping_addresses.created_at', 'desc');

        return $shippings->paginate($params['limit'], ['*'], 'page', $params['page']);
    }

    public function updateBilling(ProfileShippingAddress $shipping, array $params)
    {
        $shipping->update([
            'primary'   => $params['primary'],
            'address_1' => $params['address_1'],
            'address_2' => (isset($params['address_2']) ? $params['address_2'] : null),
            'state'     => $params['state'],
            'province'  => $params['province'],
            'city'      => $params['city'],
            'country'   => $params['country'],
        ]);

        return $shipping;
    }
}