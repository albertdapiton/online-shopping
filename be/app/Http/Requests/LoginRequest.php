<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => [
                'required',
                'email',
                function ($attribute, $value, $fail) {
                    $customer = app('UserService')->checkExistingUser($value, false, true);

                    if ($customer && $customer->trashed()) {
                        return $fail(trans('user.account_deactivated', ['admin' => config('mail.email')]));
                    } else if ($customer && ! $customer->hasVerifiedEmail()) {
                        return $fail(trans('user.email_not_verified'));
                    }
                },
            ],
            'password'  => 'required',
        ];
    }
}
