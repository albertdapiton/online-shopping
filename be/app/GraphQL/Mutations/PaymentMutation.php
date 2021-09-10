<?php

namespace App\GraphQL\Mutations;

use Closure;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class PaymentMutation extends Mutation
{
    protected $attributes = [
        'name' => 'Payment'
    ];

    public function type(): Type
    {
        return Type::nonNull(GraphQL::type('Payment'));
    }

    public function args(): array
    {
        return [
            'items' => [
                'type'  => Type::listOf(GraphQL::type('ItemInput')),
            ],
            'billing' => [
                'type'  => Type::listOf(GraphQL::type('BillingInput')), 
            ],
            'shipping' => [
                'type'  => Type::listOf(GraphQL::type('ShippingInput')), 
            ],
            'payment' => [
                'type'  => Type::listOf(GraphQL::type('PaymentInput')), 
            ]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        return null;
    }
}
