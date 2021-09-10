<?php 

namespace App\GraphQL\Queries;

use App\Models\User;
use Auth;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

final class UsersQuery extends Query
{
    protected $attributes = [
        'name' => 'users',
        'description' => 'A user',
        'model' => User::class
    ];

    /* public function authorize($root, array $args, $ctx, ResolveInfo $resolveInfo = null, Closure $getSelectFields = null) : bool 
    {
        return ! Auth::guest();
    }

    public function getAuthorizationMessage(): string
    {
        return 'You are not authorized to perform this action';
    } */

    public function type() : Type
    {
        return GraphQL::paginate('User');
    }

    public function args() : array
    {
        return [
            'id'    => [
                'name' => 'id',
                'type' => Type::int(),
            ],
            'page'    => [
                'name'  => 'page',
                'type'  => Type::int(),
            ],
            'limit'     => [
                'name'  => 'limit',
                'type'  => Type::int(),
            ],
            'order_created_at' => [
                'name' => 'order_created_at',
                'type' => Type::string(),
            ],
            'roles' => [
                'name' => 'role',
                'type' => Type::string(),
            ],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $users = app('UserService')->searchByUserRole($args);
        return $users;
    }
}