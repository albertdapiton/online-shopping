<?php

namespace Tests\Support\Objects;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use Tests\Support\ExampleValidationField;

class LoginExampleType extends GraphQLType
{
    protected $attributes = [
        'name' => 'LoginExample',
        'description' => 'An example of login',
    ];

    public function fields(): array
    {
        return [
            'token' => [
                'type'          => Type::string(),
                'description'   => 'A test field',
            ],
            'expires_at' => [
                'type'          => Type::string(),
                'description'   => 'A test field',
            ],
        ];
    }
}