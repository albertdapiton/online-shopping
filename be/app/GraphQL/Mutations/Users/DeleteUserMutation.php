<?php

namespace App\GraphQL\Mutations\Users;

use Closure;
use App\User;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;


class DeleteUserMutation extends Mutation
{
    protected $attributes = [
        'name' => 'deleteUser'
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
            ]
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
        $user = app('UserService')->deleteUser($args['id']);
        return $user;
    }
}
