<?php

namespace App\GraphQL\Types;

use App\Models\ProfileShippingAddress;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class ShippingType extends GraphQLType
{
    protected $attributes = [
        'name'          => 'Shipping',
        'description'   => 'A shipping information',
        'model'         => ProfileShippingAddress::class,
    ];

    public function fields() : array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The id of the shipping',
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
            ],
            'created_at'     => [
                'type'          => Type::string(), 
                'description'   => 'Time when product is created',
            ],
        ];
    }
}