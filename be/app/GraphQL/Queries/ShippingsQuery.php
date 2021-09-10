<?php 

namespace App\GraphQL\Queries;

use App\Models\ProfileShippingAddress;
use Auth;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

final class ShippingsQuery extends Query
{
    protected $attributes = [
        'name' => 'shippings',
        'description' => 'List of shipping addresses',
        'model' => ProfileShippingAddress::class
    ];

    public function type() : Type
    {
        return GraphQL::paginate('ShippingType');
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
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {   
        $shippings = app('ShippingService')->searchShippings($args);
        return $shippings;
    }
}