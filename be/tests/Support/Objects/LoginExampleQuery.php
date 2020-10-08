<?php

namespace Tests\Support\Objects;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class LoginExampleQuery extends Query
{
    protected $attributes = [
        'name' => 'loginexample',
    ];

    public function type(): Type
    {
        return GraphQL::type('LoginExample');
    }

    public function args(): array
    {
        return [
            'email' => [
                'name' => 'email', 
                'type' => Type::string()
            ],
            'password' => [
                'name' => 'password', 
                'type' => Type::string()
            ]
        ];
    }

    public function resolve($root, $args)
    {
        $data   = include __DIR__ . '/data.php';
        $result = include __DIR__ . '/results.php';

        if ($args['email'] === $data['login']['email'] && $args['password'] === $data['login']['password']) {
            return $result['login']['loginexample'];
        } else {
            throw new \Exception('Incorrect email and password');
        }
    }
}