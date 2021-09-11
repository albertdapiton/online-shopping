<?php

namespace App\GraphQL\Mutations\Users;

use Closure;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;


class CreateUserBillingMutation extends Mutation
{
    protected $attributes = [
        'name' => 'createUserBilling'
    ];

    public function type(): Type
    {
        return Type::nonNull(GraphQL::type('BillingType'));
    }

    public function args(): array
    {
        return [
            'user_id' => [
                'name' => 'user_id',
                'description' => 'User id',
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
            'user_id'   => ['required'],
            'primary'   => ['required'],
            'address_1' => ['required'],
            'city'      => ['required'],
            'country'   => ['required'],
        ];
    }

    public function validationErrorMessages(array $args = []): array
    {
        return [
            'user_id'   => 'Please set user to save the billing address',
            'primary.required' => 'Please set billing status',
            'address_1.required' => 'Please enter your address',
            'city.required' => 'Please enter your city',
            'country.required' => 'Please enter your country',
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {   
        $user = app('UserService')->findUser($args['user_id']);
        $billing = app('BillingService')->createBilling($user, $args);
        return $billing;
    }
}
