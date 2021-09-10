<?php 

namespace App\GraphQL\Queries;

use App\Models\ProfileShippingsAddress;
use Auth;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

final class UserShippingsQuery extends Query
{
    protected $attributes = [
        'name' => 'userShippings',
        'description' => 'User shippings',
        'model' => ProfileShippingsAddress::class
    ];

    public function type() : Type
    {
        return GraphQL::paginate('BillingType');
    }

    public function args() : array
    {
        return [
            'user_id' => [
                'name' => 'user_id',
                'type' => Type::int(),
                'rules' => ['required']
            ],
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
        $user    = app('UserService')->findUser($args['user_id']);
        $shippings = app('UserService')->shippingsByUser($user, $args);
        return $shippings;
    }
}