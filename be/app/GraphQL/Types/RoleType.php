<?php

namespace App\GraphQL\Types;

use App\Models\Role;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class RoleType extends GraphQLType
{
    protected $attributes = [
        'name'          => 'Role',
        'description'   => 'Role of the user',
        'model'         => Role::class,
    ];

    public function fields() : array
    {
        return [
            'id'            => [
                'type'          => Type::nonNull(Type::string()),
                'description'   => 'The id of the role',
                'alias'         => 'role_id',
            ],
            'name'        => [
                'type'          => Type::string(),
                'description'   => 'The name of the role',
            ],
        ];
    }
}