<?php 

namespace App\GraphQL\Queries;

use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

final class UserQuery extends Query
{
    protected $attributes = [
        'name' => 'user'
    ];

    public function type() : Type
    {
        //return GraphQL::type('User');
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
        return app('UserService')->findUser($args);
    }
}