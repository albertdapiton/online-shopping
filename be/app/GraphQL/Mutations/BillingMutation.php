<?php

namespace App\GraphQL\Mutations;

use Closure;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class BillingMutation extends Mutation
{
    protected $attributes = [
        'name' => 'Checkout'
    ];

    public function type(): Type
    {
        return GraphQL::type('BillingType');
    }

    public function args(): array
    {
        return [
            'primary' => [
                'name' => 'is_primary',
                'description' => 'Set as primary',
                'type' => Type::int(),
            ],
            'address_1' => [
                'name' => 'address_1',
                'description' => 'A billing address 1',
                'type' => Type::string(),
            ],
            'address_2' => [
                'name' => 'address_2',
                'description' => 'A billing address 2',
                'type' => Type::string(),
            ],
            'state' => [
                'name' => 'state',
                'description' => 'A billing state',
                'type' => Type::string(),
            ],
            'province' => [
                'name' => 'province',
                'description' => 'A billing province',
                'type' => Type::string(),
            ],
            'city' => [
                'name' => 'city',
                'description' => 'A billing city',
                'type' => Type::string(),
            ],
            'country' => [
                'name' => 'country',
                'description' => 'A billing country',
                'type' => Type::string(),
            ]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        return null;
    }
}
