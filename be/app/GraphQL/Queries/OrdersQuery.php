<?php 

namespace App\GraphQL\Queries;

use App\Models\Order;
use Auth;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

final class OrdersQuery extends Query
{
    protected $attributes = [
        'name' => 'orders',
        'description' => 'A order',
        'model' => Order::class
    ];

    /* public function authorize($root, array $args, $ctx, ResolveInfo $resolveInfo = null, Closure $getSelectFields = null) : bool 
    {
        return ! Auth::guest();
    }

    public function getAuthorizationMessage(): string
    {
        return 'You are not authorized to perform this action';
    } */

    public function type() : Type
    {
        return Type::listOf(GraphQL::type('Order'));
    }

    public function args() : array
    {
        return [
            'user_id' => [
                'name' => 'user_id',
                'type' => Type::int(),
            ],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        if (isset($args["id"])) {
            $orders = app('OrderService')->find($args["id"]);
        } else if (isset($args["user_id"])) {
            $orders = app('OrderService')->byUserId($args["user_id"]);
        } else {
            $orders = app('OrderService')->all();
        }

        return $orders;
    }
}