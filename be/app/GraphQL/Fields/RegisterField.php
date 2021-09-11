<?php

namespace App\GraphQL\Fields;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Field;

class RegisterField extends Field
{
    protected $attributes = [
        'description'   => 'Register user',
    ];

    public function type(): Type
    {
        return Type::string();
    }

    public function args(): array
    {
        return [
            'first_name' => [
                'name'          => 'first_name',
                'type'          => Type::string(),
                'description'   => 'First name of the user',
                'rules'         => [
                    'required',
                ],
            ],
            'last_name' => [
                'name'          => 'last_name',
                'type'          => Type::string(),
                'description'   => 'Last name of the user',
                'rules'         => [
                    'required',
                ],
            ],
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
            ],
            'confirm_password' => [
                'name'          => 'confirm_password',
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
        /* $width = isset($args['width']) ? $args['width']:100;
        $height = isset($args['height']) ? $args['height']:100;

        return 'http://placehold.it/'.$width.'x'.$height; */
    }
}