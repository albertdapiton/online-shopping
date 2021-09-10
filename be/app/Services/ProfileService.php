<?php

namespace App\Services;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Collection;

final class ProfileService extends BaseService
{
    public function __construct()
    {
        parent::__construct(Profile::class);
        $this->model = Profile::class;
    }

    public function updateProfile(User $user, array $params) : User
    {
        $profile = $user->profile;
        $profile->first_name = $params['first_name'];
        $profile->last_name = $params['last_name'];
        $profile->date_of_birth = (isset($params['date_of_birth']) ? now()->parse($params['country']) : null);
        $profile->country = $params['country'];
        $profile->save();

        return $user;
    }
}