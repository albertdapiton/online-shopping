<?php

namespace App\Services;

use App\Models\User;
use Auth;
use Exception;
use Log;

final class AuthService
{   
    public function login($fields)
    {
        try {
            return ((Auth::attempt($fields)) ? Auth::user() : null);
        } catch (Exception $ex) {
            Log::error(__METHOD__ . '@' . $ex->getLine() . ': ' . $ex->getMessage());
        }
    }

    public function register($fields) 
    {
        try {
            return app('UserService')->createUser($fields);
        } catch (Exception $ex) {
            Log::error(__METHOD__ . '@' . $ex->getLine() . ': ' . $ex->getMessage());
        }
    }
}