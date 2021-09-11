<?php

namespace App\GraphQL\Types;

use App\Models\Customer;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class CustomerType extends GraphQLType
{
    protected $attributes = [
        'name'          => 'Customer',
        'description'   => 'A customer',
        'model'         => Customer::class,
    ];

    public function fields() : array
    {
        return [
            'id'            => [
                'type'          => Type::nonNull(Type::string()),
                'description'   => 'The id of the customer',
                'alias'         => 'customer_id',
            ],
            'email'         => [
                'type'      => Type::string(),
                'description'   => 'The email of customer',
            ]
        ];
    }
}