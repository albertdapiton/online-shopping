<?php

namespace App\GraphQL\Types;

use App\Models\OrderBilling;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class CheckoutType extends GraphQLType
{
    protected $attributes = [
        'name'          => 'Checkout',
        'description'   => 'Check the order items',
    ];

    public function fields() : array
    {
        return [
            'id'            => [
                'type'          => Type::nonNull(Type::string()),
                'description'   => 'The id of the order item',
            ],
            'name'        => [
                'type'          => Type::string(), 
                'description'   => 'Name of the order item',
            ],
            'description'       => [
                'type'          => Type::string(),
                'description'   => 'Order item description',
            ],
            'price'       => [
                'type'          => Type::string(), 
                'description'   => 'The total price of the order item',
            ],
            'quantity'         => [
                'type'          => Type::string(), 
                'description'   => 'The total qty of the order item',
            ]
        ];
    }
}