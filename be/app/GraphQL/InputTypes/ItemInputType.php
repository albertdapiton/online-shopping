<?php

namespace App\GraphQL\InputTypes;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\InputType;

final class ItemInputType extends InputType 
{
    protected $attributes = [
        'name'          => 'ItemInput',
        'description'   => 'A item with id, price and quantity'
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'description' => 'A item id',
                'type' => Type::int(),
            ],
            'price' => [
                'name' => 'price',
                'description' => 'A item price',
                'type' => Type::string(),
            ],
            'quantity' => [
                'name' => 'quantity',
                'description' => 'A item quantity',
                'type' => Type::int(),
            ]
        ];
    }
}