<?php 

namespace App\GraphQL\Queries;

use Closure;
use App\Models\Role;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;

final class RolesQuery extends Query
{
    protected $attributes = [
        'name' => 'role'
    ];

    public function type() : Type
    {
        return Type::listOf(GraphQL::type('Role'));
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        return Role::get();
    }
}