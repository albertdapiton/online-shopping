<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

final class UserService extends BaseService
{   
    const DEFAULT_ROLE = "customer";

    public function __construct()
    {
        parent::__construct(User::class);
        $this->model = User::class;
    }

    protected function concatName(string $first_name, string $last_name) : string
    {
        return $first_name . ' ' . $last_name;
    }

    protected function encryptPassword(string $password) : string
    {
        return Hash::make($password);
    }

    public function billingsByUser(User $user, $params)
    {
        return $user->profile()->first()->billings()->paginate($params['limit'], ['*'], 'page', $params['page']);
    }

    public function bulkDeleteUser(array $ids) : Collection
    {
        return $this->model::find($ids)->get()->delete();
    }

    public function checkExistingUser(string $email, bool $isDeleted = false)
    {
        if ($isDeleted) {
            $user = $this->model::withTrashed()->where('email', $email);
        } else {
            $user = $this->model::where('email', $email);
        }

        return $user->first();
    }

    public function createUser($params) : User
    {
        $user = $this->model::create([
            'name'      => $this->concatName($params['first_name'], $params['last_name']),
            'email'     => $params['email'],
            'password'  => $this->encryptPassword($params['password']),
        ]);

        $user->sendEmailVerificationNotification();

        if (app('RoleService')->checkRoleExists(self::DEFAULT_ROLE)) {
            app('RoleService')->attachDetachUserRole($user, self::DEFAULT_ROLE);
        }

        $user->profile()->create([
            'first_name'    => $params['first_name'],
            'last_name'     => $params['last_name'],
            'nickname'      => (isset($params['nickname']) ? $params['nickname'] : null),
            'date_birth'    => $params['date_birth'],
            'country'       => $params['country'],
        ]);

        return $user;
    }

    public function deleteUser(int $id) : User
    {
        return $this->model::find($id)->delete();
    }

    public function findUser(int $id) : User
    {
        return $this->model::findOrFail($id);
    }

    public function shippingsByUser(User $user, $params)
    {
        return $user->profile()->first()->shippings()->paginate($params['limit'], ['*'], 'page', $params['page']);
    }

    public function searchByUserRole(array $params, $searchBy = null)
    {
        $users = $this->model::orderBy('users.created_at', 'desc')->with('profile');

        if (isset($params['role']) && ! is_null($params['role'])) {
            $users = $users->whereHas('roles', function($query) use ($params) {
                $query->where('name', $params['role']);
            });
        }

        return $users->paginate($params['limit'], ['*'], 'page', $params['page']);
    }

    public function updateUser(User $user, array $params) : User
    {
        if (isset($params['password'])) {
            $user->update([
                'password' => $this->encryptPassword($params['password']),
            ]);
        }

        $user->profile()->update([
            'first_name'    => $params['first_name'],
            'last_name'     => $params['last_name'],
            'nickname'      => (isset($params['nickname']) ? $params['nickname'] : null),
            'date_birth'    => $params['date_birth'],
            'country'       => $params['country'],
        ]);
        
        return $user;
    }

    public function updatePassword(User $user, array $details) : User
    {
        $user->password = $this->encryptPassword($details['password']);
        $user->save();

        return $user;
    }

    public function verifyUser(int $id) : bool
    {
        $user       = $this->model::findOrFail($id);
        return $user->markEmailAsVerified();
    }
}