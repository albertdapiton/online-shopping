<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => [
                'required',
                'email',
                'unique:users,email,NULL,id,deleted_at,NULL',
                function ($attribute, $value, $fail) {
                    $customer = app('UserService')->checkExistingUser($value, false, true);

                    if ($customer && $customer->trashed()) {
                        return $fail(trans('user.account_deactivated', ['admin' => config('mail.email')]));
                    }
                },
            ],
            'password' => ['required'],
            'date_birth' =>['required'],
            'country' => ['required'],
        ];
    }
}
