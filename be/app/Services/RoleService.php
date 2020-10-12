<?php

namespace App\Services;

use App\Models\Role;
use App\Models\User;

final class RoleService extends BaseService
{
    public function __construct()
    {
        parent::__construct(Role::class);
        $this->model = Role::class;
    }

    public function checkRoleExists(String $role) : boolean
    {
        return $this->model::where('name', $role)->first() ? true : false;
    }

    public function attachDetachUserRole(User $user, String $role, String $action = 'attach') : bool
    {
        $role = $this->model::where('name', $role);

        if ($role->count() && $action === 'attach') {
            return is_null($role->first()->users()->attach([$user->id])) ? true : false;
        } else if ($role->count() && $action === 'detach') {
            return $role->first()->users()->detach([$user->id]);
        }
        
        return false;
    }
}