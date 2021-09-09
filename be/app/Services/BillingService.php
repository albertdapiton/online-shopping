<?php

namespace App\Services;

use App\Models\ProfileBillingAddress;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

final class BillingService extends BaseService
{   
    public function __construct()
    {
        parent::__construct(ProfileBillingAddress::class);
        $this->model = ProfileBillingAddress::class;
    }

    public function bulkDeleteBilling(array $ids) : Collection
    {
        return $this->model::find($ids)->get()->delete();
    }

    public function createBilling(User $user, array $params) : ProfileBillingAddress
    {
        $billing = $this->model::create([
            'profile_id'=> $user->profile->id,
            'primary'   => $params['primary'],
            'address_1' => $params['address_1'],
            'address_2' => (isset($params['address_2']) ? $params['address_2'] : null),
            'state'     => $params['state'],
            'province'  => $params['province'],
            'city'      => $params['city'],
            'country'   => $params['country'],
        ]);

        return $billing;
    }

    public function deleteBilling(int $id) : ProfileBillingAddress
    {
        return $this->model::find($id)->delete();
    }

    public function findBilling(int $id) : ProfileBillingAddress
    {
        return $this->model::findOrFail($id);
    }

    public function searchBillings(array $params)
    {
        $billings = $this->model::orderBy('profile_billing_addresses.created_at', 'desc');

        return $billings->paginate($params['limit'], ['*'], 'page', $params['page']);
    }

    public function updateBilling(ProfileBillingAddress $billing, array $params)
    {
        $billing->update([
            'primary'   => $params['primary'],
            'address_1' => $params['address_1'],
            'address_2' => (isset($params['address_2']) ? $params['address_2'] : null),
            'state'     => $params['state'],
            'province'  => $params['province'],
            'city'      => $params['city'],
            'country'   => $params['country'],
        ]);

        return $billing;
    }
}