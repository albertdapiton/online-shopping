<?php

namespace App\GraphQL\Types;

use App\Models\Profile;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class ProfileType extends GraphQLType
{
    protected $attributes = [
        'name'          => 'Profile',
        'description'   => 'A user profile',
        'model'         => Profile::class,
    ];

    public function fields() : array
    {
        return [
            'id'            => [
                'type'          => Type::nonNull(Type::string()),
                'description'   => 'The id of the profile',
            ],
            'first_name'        => [
                'type'          => Type::string(),
                'description'   => 'The first name of the user',
            ],
            'last_name'        => [
                'type'          => Type::string(),
                'description'   => 'The last name of the user',
            ],
            'date_birth'       => [
                'type'          => Type::string(), 
                'description'   => 'The date of birth of the user',
            ],
            'country' => [
                'type'          => Type::string(),
                'description'   => 'The country of the user',
            ],
        ];
    }
}