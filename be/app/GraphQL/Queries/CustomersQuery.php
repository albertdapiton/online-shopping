<?php 

namespace App\GraphQL\Queries;

use Closure;
use App\Models\Customer;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;

final class CustomersQuery extends Query
{
    protected $attributes = [
        'name' => 'customer'
    ];

    public function type() : Type
    {
        return Type::listOf(GraphQL::type('Customer'));
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        return Customer::all();
    }
}