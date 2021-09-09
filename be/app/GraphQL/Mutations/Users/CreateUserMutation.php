<?php

namespace App\GraphQL\Mutations\Users;

use Closure;
use App\User;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;


class CreateUserMutation extends Mutation
{
    protected $attributes = [
        'name' => 'createUser'
    ];

    public function type(): Type
    {
        return Type::nonNull(GraphQL::type('User'));
    }

    public function args(): array
    {
        return [
            'first_name'    => [
                'name'  => 'first_name',
                'type'  => Type::nonNull(Type::string()),
            ],
            'last_name'     => [
                'name'  => 'last_name',
                'type'  => Type::nonNull(Type::string()),
            ],
            'nickname'      => [
                'name'  => 'nickname',
                'type'  => Type::nonNull(Type::string()),
            ],
            'email'     => [
                'name'  => 'email',
                'type'  => Type::nonNull(Type::string()),
            ],
            'password'  => [
                'name'  => 'password',
                'type'  => Type::nonNull(Type::string()),
            ],
            'date_birth' => [
                'name'  => 'date_birth',
                'type'  => Type::string(),
            ],
            'country'   => [
                'name'  => 'country',
                'type'  => Type::nonNUll(Type::string()),
            ],
        ];
    }

    protected function rules(array $args = []): array
    {
        return [
            'first_name'=> ['required'],
            'last_name' => ['required'],
            'email'     => ['required', 'email', 'unique:users,email'],
            'password'  => ['required'],
            'date_birth'=> ['required'],
            'country'   => ['required'],
        ];
    }

    public function validationErrorMessages(array $args = []): array
    {
        return [
            'first_name.required' => 'Please enter your first name',
            'last_name.required' => 'Please enter your first name',
            'email.required' => 'Please enter your email address',
            'email.email' => 'Please enter a valid email address',
            'email.unique' => 'Sorry, this email address is already in use',
            'password.required' => 'Please enter your password',
            'date_birth.required' => 'Please enter your date of birth',
            'country.required' => 'Please enter your country',
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {   
        $user = app('UserService')->createUser($args);
        return $user;
    }
}
