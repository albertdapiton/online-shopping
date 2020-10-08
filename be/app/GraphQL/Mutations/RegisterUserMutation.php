<?php

namespace App\GraphQL\Mutations;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;

final class RegisterUserMutation extends Mutation
{
    protected $attributes = [
        'name' => 'Register'
    ];

    public function type(): Type
    {
        return Type::string();
    }

    public function args() : array
    {
        return [
            'first_name' => [
                'type'          => Type::nonNull(Type::string()),
                'description'   => 'The first name of the user',
            ],
            'last_name' => [
                'type'          => Type::nonNull(Type::string()),
                'description'   => 'The last name of the user',
            ],
            'email'     => [
                'type'          => Type::nonNull(Type::string()),
                'description'   => 'The email of the user',
            ],
            'password'  => [
                'type'          => Type::nonNull(Type::string()),
                'description'   => 'The password of the user',
            ],
            'role'      => [
                'type'          => Type::nonNull(Type::string()),
                'description'   => 'The role of the user',
            ]
        ];
    }

    public function rules(array $args = []) : array
    {
        return [
            'first_name'    => ['required'],
            'last_name'     => ['required'],
            'email'         => ['required', 'email_address', 'unique:App\Models\User'],
            'password'      => ['required', 'min:6'],
            'role'          => ['required'],
        ];
    }

    public function resolve($root, $args)
    {
        return app('RegisterService')->register($args);
    }
}