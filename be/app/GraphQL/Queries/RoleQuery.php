<?php 

namespace App\GraphQL\Queries;

use App\Models\Role;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;

final class RoleQuery extends Query
{
    protected $attributes = [
        'name' => 'role'
    ];

    public function type()
    {
        return GraphQL::type('Role');
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
        return Role::findOrFail($args['id']);
    }
}