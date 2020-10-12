<?php

namespace App\Services;

use App\Models\User;

final class RegisterService 
{
    public function register($details) : string
    {
        $user = User::create([
            'email'     => $details['email'],
            'password'  => bcrypy($details['password']),
        ]);

        if (app('RoleService')->checkRoleExists($details['role'])) {
            app('RoleService')->attachDetachUserRole($user, $details['role']);

            $user->profile()->create([
                'first_name'    => $details['first_name'],
                'last_name'     => $details['last_name'], 
            ]);

            $user->sendEmailVerificationNotification();
        }

        //delete user on failed

        throw new \Exception('Unable to process request kindly try again or contact support about the issue.');
    }
}