<?php 

namespace App\GraphQL\Queries;

use App\Models\Customer;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;

final class CustomerQuery extends Query
{
    protected $attributes = [
        'name' => 'customer'
    ];

    public function type()
    {
        return GraphQL::type('Customer');
    }

    public function args()
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::int(),
                'rules' => ['required']
            ],
        ];
    }

    public function resolve($root, $args)
    {
        return Customer::findOrFail($args['id']);
    }
}