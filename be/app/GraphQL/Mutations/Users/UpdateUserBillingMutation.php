<?php

namespace App\GraphQL\Mutations\Users;

use Closure;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;


class UpdateUserBillingMutation extends Mutation
{
    protected $attributes = [
        'name' => 'updateUserBilling'
    ];

    public function type(): Type
    {
        return Type::nonNull(GraphQL::type('BillingType'));
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'description' => 'ID of the billing',
                'type' => Type::int(),
            ],
            'primary' => [
                'name' => 'primary',
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

    protected function rules(array $args = []): array
    {
        return [
            'id'        => ['required'],
            'primary'   => ['required'],
            'address_1' => ['required'],
            'city'      => ['required'],
            'country'   => ['required'],
        ];
    }

    public function validationErrorMessages(array $args = []): array
    {
        return [
            'id'   => 'Please set the billing id',
            'primary.required' => 'Please set billing status',
            'address_1.required' => 'Please enter your address',
            'city.required' => 'Please enter your city',
            'country.required' => 'Please enter your country',
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {   
        $billing = app('BillingService')->findBilling($args['id']);
        $billing = app('BillingService')->updateBilling($billing, $args);
        return $billing;
    }
}
