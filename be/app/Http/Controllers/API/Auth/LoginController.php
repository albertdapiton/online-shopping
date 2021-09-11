<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\LoginResource;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $fields = $request->only('email', 'password');

        $user = app('AuthService')->login($fields);
        
        if (! $user) {
            return response()->json([
                'message' => trans('user.account_not_exists')
            ], 404);
        }
        
        return (new LoginResource($user))
            ->response();
    }
}
