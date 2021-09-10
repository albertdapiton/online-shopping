<?php

namespace App\GraphQL\Types;

use App\Models\User;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class UserType extends GraphQLType
{
    protected $attributes = [
        'name'          => 'User',
        'description'   => 'A user',
        'model'         => User::class,
    ];

    public function fields() : array
    {
        return [
            'id'            => [
                'type'          => Type::nonNull(Type::string()),
                'description'   => 'The id of the user',
            ],
            'email'         => [
                'type'          => Type::string(),
                'description'   => 'The email of the user',
            ],
            'verfiy'        => [
                'type'          => Type::string(),
                'description'   => 'The date account verify by the user',
                'alias'         => 'email_verified_at',
                'resolve'       => function($root, $args) {
                    return strtotime($root->email_verified_at);
                }
            ],
            'profile'       => [
                'type'          => GraphQL::type('Profile'), 
                'description'   => 'The profile details of the user',
            ],
            'roles' => [
                'type'          => Type::listOf(GraphQL::type('Role')),
                'description'   => 'The list of roles by the user',
            ],
        ];
    }
}