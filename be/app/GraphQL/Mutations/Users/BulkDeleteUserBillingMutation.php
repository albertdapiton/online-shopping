<?php

namespace App\GraphQL\Mutations\Users;

use Closure;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;


class BulkDeleteUserBillingMutation extends Mutation
{
    protected $attributes = [
        'name' => 'bulkDeleteUserBilling'
    ];

    public function type(): Type
    {
        return Type::nonNull(GraphQL::type('BillingType'));
    }

    public function args(): array
    {
        return [
            'ids' => [
                'name' => 'ids', 
                'type' => Type::listof(Type::int()),
            ]
        ];
    }

    protected function rules(array $args = []): array
    {
        return [
            'ids' => ['required'],
        ];
    }

    public function validationErrorMessages(array $args = []): array
    {
        return [
            'ids.required' => 'IDs is required',
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {   
        app('BillingService')->bulkDeleteBilling($args['ids']);
        return null;
    }
}
