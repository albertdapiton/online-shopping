<?php

namespace App\Services;

use App\Models\User;

final class UserService extends BaseService
{
    public function __construct()
    {
        parent::__construct(User::class);
        $this->model = User::class;
    }

    public function createUser($params)
    {
        $user = $this->model::create([
            'email'     => $params['email'],
            'password'  => bcrypy($params['password']),
        ]);

        if (app('RoleService')->checkRoleExists($params['role'])) {
            app('RoleService')->attachDetachUserRole($user, $params['role']);

            $user->profile()->create([
                'first_name'    => $params['first_name'],
                'last_name'     => $params['last_name'], 
            ]);

            $user->sendEmailVerificationNotification();
        }

        //delete user on failed

        throw new \Exception('Unable to process request kindly try again or contact support about the issue.');
    }

    public function findUser(int $id) : User
    {
        return $this->model::findOrFail($id);
    }

    public function searchByUserRole(array $params) : User
    {
        $users = $this->model::orderBy('users.created_at', 'desc')->with('profile');
        
        if (isset($params['roles']) && ! is_null($params['roles'])) {
            $users = $users->whereHas('roles', function($query) use ($params) {
                $query->where('name', $params['roles']);
            });
        }

        return $users->get();
    }

    public function updateUser(User $user, array $details)
    {
        return $user->update($details);
    }

    public function verifyUser(int $id) : bool
    {
        $user       = $this->model::findOrFail($id);
        return $user->markEmailAsVerified();
    }
}