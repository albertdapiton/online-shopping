<?php

namespace App\GraphQL\Types;

use App\Models\Product;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class ProductType extends GraphQLType
{
    protected $attributes = [
        'name'          => 'Product',
        'description'   => 'A product',
        'model'         => Product::class,
    ];

    public function fields() : array
    {
        return [
            'id'            => [
                'type'          => Type::int(),
                'description'   => 'The id of the product',
            ],
            'name'        => [
                'type'          => Type::string(), 
                'description'   => 'The product name',
            ],
            'description'        => [
                'type'          => Type::string(), 
                'description'   => 'The product description',
            ],
            'price'        => [
                'type'          => Type::string(), 
                'description'   => 'The product price',
            ],
            'qty'        => [
                'type'          => Type::string(), 
                'description'   => 'The product quantity',
            ],
            'created_at'     => [
                'type'          => Type::string(), 
                'description'   => 'Time when product is created',
            ],
        ];
    }
}