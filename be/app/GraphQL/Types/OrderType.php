<?php

namespace App\GraphQL\Types;

use App\Models\Order;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class OrderType extends GraphQLType
{
    protected $attributes = [
        'name'          => 'Order',
        'description'   => 'A order',
        'model'         => Order::class,
    ];

    public function fields() : array
    {
        return [
            'id'            => [
                'type'          => Type::nonNull(Type::string()),
                'description'   => 'The id of the order',
            ],
            'items'        => [
                'type'          => Type::listOf(GraphQL::type('OrderItem')), 
                'description'   => 'List of items ordered',
            ],
            'payment'        => [
                'type'          => GraphQL::type('Payment'),
                'description'   => 'Payment of the order',
            ],
            'billing'       => [
                'type'          => GraphQL::type('OrderBilling'), 
                'description'   => 'Where to bill the order',
            ],
            'shipping'       => [
                'type'          => GraphQL::type('OrderShipping'), 
                'description'   => 'Where to ship the order',
            ],
            'created_at'     => [
                'type'          => Type::string(), 
                'description'   => 'Time when order is created',
            ],
        ];
    }
}