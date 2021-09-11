<?php 

namespace App\GraphQL\Queries;

use App\Models\ProfileBillingAddress;
use Auth;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

final class BillingsQuery extends Query
{
    protected $attributes = [
        'name' => 'billings',
        'description' => 'List of billings',
        'model' => ProfileBillingAddress::class
    ];

    public function type() : Type
    {
        return GraphQL::paginate('BillingType');
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
        $billings = app('BillingService')->searchBillings($args);
        return $billings;
    }
}