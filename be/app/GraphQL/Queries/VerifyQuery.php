<?php 

namespace App\GraphQL\Queries;

use App\Models\User;
use Auth;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

final class VerifyQuery extends Query
{
    protected $attributes = [
        'name' => 'Verify'
    ];

    public function type() : Type
    {
        return Type::string();
    }

    public function args() : array
    {
        return [
            'id'        => [
                'name' => 'id',
                'type' => Type::nonNull(Type::string()),
            ],
            'expires'   => [
                'name'  => 'expires',
                'type'  => Type::nonNull(Type::string()),
            ]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $current_time   = now();
        $expires_at     = now()->setTimestamp($args['expires']);

        if (! request()->hasValidSignature()) {
            throw new \Exception('Invalid access to the page');
        }

        if ($current_time < $expires_at) {
            throw new \Exception('Verification link expires kindly request to send new verication in your eamil');
        }
        
        return [];
    }
}