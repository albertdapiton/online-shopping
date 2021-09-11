<?php

namespace App\GraphQL\Mutations\Users;

use Closure;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;


class CreateUserShippingMutation extends Mutation
{
    protected $attributes = [
        'name' => 'createUserShipping'
    ];

    public function type(): Type
    {
        return Type::nonNull(GraphQL::type('ShippingType'));
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
                'description' => 'A shipping address 1',
                'type' => Type::string(),
            ],
            'address_2' => [
                'name' => 'address_2',
                'description' => 'A shipping address 2',
                'type' => Type::string(),
            ],
            'state' => [
                'name' => 'state',
                'description' => 'A shipping state',
                'type' => Type::string(),
            ],
            'province' => [
                'name' => 'province',
                'description' => 'A shipping province',
                'type' => Type::string(),
            ],
            'city' => [
                'name' => 'city',
                'description' => 'A shipping city',
                'type' => Type::string(),
            ],
            'country' => [
                'name' => 'country',
                'description' => 'A shipping country',
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
            'user_id'   => 'Please set user to save the shipping address',
            'primary.required' => 'Please set shipping status',
            'address_1.required' => 'Please enter your address',
            'city.required' => 'Please enter your city',
            'country.required' => 'Please enter your country',
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {   
        $user = app('UserService')->findUser($args['user_id']);
        $shipping = app('ShippingService')->createShipping($user, $args);
        return $shipping;
    }
}
