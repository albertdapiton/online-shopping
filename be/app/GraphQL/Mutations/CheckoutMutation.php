<?php

namespace App\GraphQL\Mutations;

use Closure;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class CheckoutMutation extends Mutation
{
    protected $attributes = [
        'name' => 'Checkout'
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Checkout'));
    }

    public function args(): array
    {
        return [
            'items' => [
                'type' => Type::listOf(GraphQL::type('ItemInput')),
            ]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $orderItems = [
            [
                'id' => 1,
                'price' => "25",
                'quantity' => 2
            ],
            [
                'id' => 2,
                'price' => "40",
                'quantity' => 3
            ],
        ];

        return $orderItems;
    }
}
