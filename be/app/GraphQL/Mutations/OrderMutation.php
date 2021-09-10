<?php

namespace App\GraphQL\Mutations;

use Closure;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class OrderMutation extends Mutation
{
    protected $attributes = [
        'name' => 'Order'
    ];

    public function type(): Type
    {
        return Type::nonNull(GraphQL::type('Order'));
    }

    public function args(): array
    {
        return [
            'id' => ['
                name' => 'id', 
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
            'nickname'     => [
                'name'  => 'nickname',
                'type'  => Type::string(),
            ],
            'date_of_birth' => [
                'name'  => 'date_of_birth',
                'type'  => Type::string(),
            ],
            'country'   => [
                'name'  => 'country',
                'type'  => Type::nonNUll(Type::string()),
            ],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        return null;
    } 
}
