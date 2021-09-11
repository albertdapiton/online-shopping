<?php

namespace App\GraphQL\Mutations\Products;

use Closure;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;


class UpdateProductMutation extends Mutation
{
    protected $attributes = [
        'name' => 'updateProduct'
    ];

    public function type(): Type
    {
        return Type::nonNull(GraphQL::type('ProductType'));
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'description' => 'A product id',
                'type' => Type::int(),
            ],
            'name' => [
                'name' => 'name',
                'description' => 'A product name',
                'type' => Type::string(),
            ],
            'description' => [
                'name' => 'description',
                'description' => 'A product description',
                'type' => Type::string(),
            ],
            'price' => [
                'name' => 'price',
                'description' => 'A product price',
                'type' => Type::string(),
            ],
            'qty' => [
                'name' => 'qty',
                'description' => 'A product quantity',
                'type' => Type::int(),
            ],
        ];
    }

    protected function rules(array $args = []): array
    {
        return [
            'id'    => ['required'],
            'name'  => ['required'],
            'price' => ['required'],
            'qty'   => ['required'],
        ];
    }

    public function validationErrorMessages(array $args = []): array
    {
        return [
            'id.required' => 'Please set product id',
            'name.required' => 'Please enter product name',
            'price.required' => 'Please enter product price',
            'qty.required' => 'Please enter product quantity',
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {   
        $product = app('ProductService')->findProduct($args['id']);
        $product = app('ProductService')->updateProduct($product, $args);
        return $product;
    }
}
