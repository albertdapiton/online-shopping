<?php

namespace App\GraphQL\Mutations;

use Closure;
use App\User;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;


class UserMutation extends Mutation
{
    protected $attributes = [
        'name' => 'updateUser'
    ];

    public function type(): Type
    {
        return Type::nonNull(GraphQL::type('User'));
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id', 
                'type' => Type::nonNull(Type::string()),
            ],
            'first_name'    => [
                'name'  => 'first_name',
                'type'  => Type::nonNull(Type::string()),
            ],
            'last_name'     => [
                'name'  => 'last_name',
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
                'name'  => 'date_of_birth',
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
            'email'     => ['required', 'email'],
            'password'  => ['required']
        ];
    }

    public function validationErrorMessages(array $args = []): array
    {
        return [
            'email.required' => 'Please enter your email address',
            'email.email' => 'Please enter a valid email address',
            'password.required' => 'Please enter your password',
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $user = User::find($args['id']);
        if(!$user) {
            return null;
        }

        $user->password = bcrypt($args['password']);
        $user->save();

        return $user;
    }
}
