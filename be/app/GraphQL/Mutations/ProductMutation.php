<?php

namespace App\GraphQL\Mutations;

use Closure;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class ProductMutation extends Mutation
{
    protected $attributes = [
        'name' => 'Product'
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Checkout'));
    }

    public function args(): array
    {
        return [
            'name'          => [
                'name'  => 'name',
                'type'  => Type::nonNull(Type::string()),
            ],
            'description'   => [
                'name'  => 'description',
                'type'  => Type::nonNull(Type::string()),
            ],
            'price'   => [
                'name'  => 'price',
                'type'  => Type::nonNull(Type::string()),
            ],
            'quantity'   => [
                'name'  => 'quantity',
                'type'  => Type::nonNull(Type::string()),
            ]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        return null;
    }
}
