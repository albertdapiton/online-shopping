<?php

namespace App\GraphQL\Types;

use App\Models\OrderItem;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class OrderItemType extends GraphQLType
{
    protected $attributes = [
        'name'          => 'OrderItem',
        'description'   => 'A order item',
        'model'         => OrderItem::class,
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
                'description'   => 'Description of the order item',
            ],
            'price'       => [
                'type'          => Type::string(), 
                'description'   => 'The price of order item',
            ],
            'qty'         => [
                'type'          => Type::string(), 
                'description'   => 'The remaining quantity of order item',
            ],
            'created_at'     => [
                'type'          => Type::string(), 
                'description'   => 'Time when product is created',
            ],
        ];
    }
}