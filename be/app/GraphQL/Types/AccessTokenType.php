<?php

namespace App\GraphQL\Types;

use Laravel\Passport\Token;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class AccessTokenType extends GraphQLType
{
    protected $attributes = [
        'name'          => 'AccessToken',
        'description'   => 'Access token of user',
        'model'         => Token::class,
    ];

    public function fields() : array
    {
        return [
            'token'            => [
                'type'          => Type::string(),
                'description'   => 'The access token',
                'alias'         => 'id',
            ],
            'expires_at'    => [
                'type'          => Type::string(),
                'description'   => 'The id of the profile',
                'resolve' => function($root, $args) {
                    return strtotime($root->expires_at);
                }
            ],
        ];
    }
}