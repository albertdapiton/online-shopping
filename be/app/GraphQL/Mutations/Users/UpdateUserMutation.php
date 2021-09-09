<?php

namespace App\GraphQL\Mutations\Users;

use Closure;
use App\User;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;


class UpdateUserMutation extends Mutation
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
                'type' => Type::nonNull(Type::int()),
            ],
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
            'id' => ['required'],
        ];
    }

    public function validationErrorMessages(array $args = []): array
    {
        return [
            'id.required' => 'ID is required',
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {   
        $user = app('UserService')->findUser($args['id']);
        $user = app('UserService')->updateUser($user, $args);
        return $user;
    }
}
