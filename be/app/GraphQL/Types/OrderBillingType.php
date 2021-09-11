<?php

namespace App\GraphQL\Types;

use App\Models\OrderBilling;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class OrderBillingType extends GraphQLType
{
    protected $attributes = [
        'name'          => 'OrderBilling',
        'description'   => 'A order item',
        'model'         => OrderBilling::class,
    ];

    public function fields() : array
    {
        return [
            'id'            => [
                'type'          => Type::nonNull(Type::string()),
                'description'   => 'The id of the order shipping',
            ],
            'address_1'        => [
                'type'          => Type::string(), 
                'description'   => 'Address where the order be ship',
            ],
            'address_2'       => [
                'type'          => Type::string(),
                'description'   => 'Optional address where the order be ship',
            ],
            'state'       => [
                'type'          => Type::string(), 
                'description'   => 'State where the order be ship',
            ],
            'province'         => [
                'type'          => Type::string(), 
                'description'   => 'Province where the order be ship',
            ],
            'city'         => [
                'type'          => Type::string(), 
                'description'   => 'City where the order be ship',
            ],
            'country'         => [
                'type'          => Type::string(), 
                'description'   => 'Country where the order be ship',
            ],
            'created_at'     => [
                'type'          => Type::string(), 
                'description'   => 'Time when product is created',
            ],
        ];
    }
}