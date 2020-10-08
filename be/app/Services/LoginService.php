<?php

namespace App\Services;

use Auth;
use Laravel\Passport\Token;

final class LoginService 
{
    public function signIn($credentials) : Token
    {
        if (Auth::attempt($credentials)) {
            $user   = Auth::user();

            if (is_null($user->accessToken)) {
                $user->createToken('Personal Access Token')->accessToken;
            }

            return $user->accessToken;
        }
        
        throw new \Exception('Incorrect email and password');
    }
}