<?php

namespace App\GraphQL\Types;

use App\Models\Payment;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class PaymentType extends GraphQLType
{
    protected $attributes = [
        'name'          => 'Payment',
        'description'   => 'A payment',
        'model'         => Payment::class,
    ];

    public function fields() : array
    {
        return [
            'id'            => [
                'type'          => Type::nonNull(Type::string()),
                'description'   => 'The id of the payment',
            ],
            'amount'        => [
                'type'          => Type::string(), 
                'description'   => 'The amount paid for the order',
            ],
            'created_at'     => [
                'type'          => Type::string(), 
                'description'   => 'Time when payment is created',
            ],
        ];
    }
}