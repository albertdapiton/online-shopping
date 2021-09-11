<?php

namespace App\GraphQL\Mutations\Products;

use Closure;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;


class DeleteProductMutation extends Mutation
{
    protected $attributes = [
        'name' => 'deleteProduct'
    ];

    public function type(): Type
    {
        return Type::nonNull(GraphQL::type('ProductType'));
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'description' => 'A product id',
                'type' => Type::int(),
            ],
        ];
    }

    protected function rules(array $args = []): array
    {
        return [
            'id'    => ['required'],
        ];
    }

    public function validationErrorMessages(array $args = []): array
    {
        return [
            'id.required' => 'Please set product id',
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {   
        $product = app('ProductService')->deleteProdut($args['id']);
        return $product;
    }
}
