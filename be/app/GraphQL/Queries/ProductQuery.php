<?php 

namespace App\GraphQL\Queries;

use App\Models\Product;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

final class ProductQuery extends Query
{
    protected $attributes = [
        'name' => 'product',
        'description' => 'A product',
        'model' => Product::class
    ];

    public function type() : Type
    {
        return GraphQL::type('ProductType');
    }

    public function args() : array
    {
        return [
            'id' => [
                'name'  => 'id',
                'type'  => Type::int(),
                'rules' => ['required']
            ],
        ];
    }

    public function resolve($root, $args)
    {
        return app('ProductService')->findProduct($args['id']);
    }
}