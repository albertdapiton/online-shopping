<?php 

namespace App\GraphQL\Queries;

use App\Models\User;
use Auth;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;

final class LoginQuery extends Query
{
    protected $attributes = [
        'name' => 'login'
    ];

    public function type() : Type
    {
        return GraphQL::type('AccessToken');
    }

    public function args(): array
    {
        return [
            'email' => [
                'name'          => 'email',
                'type'          => Type::string(),
                'description'   => 'Email of the user',
                'rules'         => [
                    'required',
                    'email',
                ],
            ],
            'password' => [
                'name'          => 'password',
                'type'          => Type::string(),
                'description'   => 'Password of the user',
                'rules'         => [
                    'required',
                ],
            ]
        ];
    }

    protected function resolve($root, $args)
    {   
        return app('LoginService')->signIn($args);
    }
}