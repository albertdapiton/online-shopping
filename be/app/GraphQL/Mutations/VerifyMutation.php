<?php

namespace App\GraphQL\Mutations;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;

final class VerifyMutation extends Mutation
{
    protected $attributes = [
        'name' => 'Verify User Email'
    ];

    public function type(): Type
    {
        return Type::string();
    }

    public function args() : array
    {
        return [
            'id' => [
                'type'          => Type::nonNull(Type::string()),
                'description'   => 'The first name of the user',
            ],
            'expires' => [
                'type'          => Type::nonNull(Type::string()),
                'description'   => 'The last name of the user',
            ],
        ];
    }

    public function rules(array $args = []) : array
    {
        return [
            'id'            => ['required'],
            'expires'       => ['required'],
        ];
    }

    public function resolve($root, $args)
    {   
        if (! request()->hasValidSignature()) {
            throw new \Exception('Invalid access to the page');
        }
        
        return app('UserService')->verifyUser($args['id']);
    }
}