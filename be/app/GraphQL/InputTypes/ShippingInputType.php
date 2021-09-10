<?php

namespace App\GraphQL\InputTypes;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\InputType;

final class ShippingInputType extends InputType 
{
    protected $attributes = [
        'name'          => 'ShippingInput',
        'description'   => 'A item with id, price and quantity'
    ];

    public function fields(): array
    {
        return [
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
}