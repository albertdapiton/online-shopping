<?php 

namespace App\GraphQL\Queries;


use App\Models\Customer;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;

final class CustomersQuery extends Query
{
    protected $attributes = [
        'name' => 'customers'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('Customer'));
    }

    public function resolve($root, $args)
    {
        return Customer::all();
    }
}