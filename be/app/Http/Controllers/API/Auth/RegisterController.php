<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $fields = $request->only('first_name', 'last_name', 'nickname', 'email', 'password', 'date_birth', 'country');

        $user = app('AuthService')->register($fields);

        if (! $user) {
            return response()->json([
                'message' => trans('user.account_not_created', ['admin' => config('mail.email')])
            ], 404);
        }

        return response()->json([
            'message' => trans('user.account_created', ['email' => $fields['email']])
        ], 200);
    }
}
