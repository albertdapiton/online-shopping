<?php 

namespace App\GraphQL\Queries;

use App\Models\Product;
use Auth;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

final class ProductsQuery extends Query
{
    protected $attributes = [
        'name' => 'products',
        'description' => 'A product',
        'model' => Product::class
    ];

    public function type() : Type
    {
        return GraphQL::paginate('ProductType');
    }

    public function args() : array
    {
        return [
            'page'    => [
                'name'  => 'page',
                'type'  => Type::int(),
            ],
            'limit'     => [
                'name'  => 'limit',
                'type'  => Type::int(),
            ],
            'q' => [
                'name' => 'q',
                'type' => Type::string(),
            ],
            'order_created_at' => [
                'name' => 'order_created_at',
                'type' => Type::string(),
            ],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $products = app('ProductService')->searchProducts($args);
        return $products;
    }
}