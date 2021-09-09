<?php 

namespace App\GraphQL\Queries;

use App\Models\ProfileBillingAddress;
use Auth;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

final class UserBillingsQuery extends Query
{
    protected $attributes = [
        'name' => 'userBillings',
        'description' => 'User billings',
        'model' => ProfileBillingAddress::class
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
        $billings = app('UserService')->billingsByUser($user, $args);
        return $billings;
    }
}