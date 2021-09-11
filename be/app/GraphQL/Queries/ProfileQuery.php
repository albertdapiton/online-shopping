<?php 

namespace App\GraphQL\Queries;

use App\Models\Profile;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;

final class ProfileQuery extends Query
{
    protected $attributes = [
        'name' => 'profile'
    ];

    public function type()
    {
        return GraphQL::type('Profile');
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
        return Profile::findOrFail($args['id']);
    }
}