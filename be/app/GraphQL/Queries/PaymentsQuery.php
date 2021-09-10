<?php 

namespace App\GraphQL\Queries;

use App\Models\Payment;
use Auth;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

final class PaymentsQuery extends Query
{
    protected $attributes = [
        'name' => 'payments',
        'description' => 'A payment',
        'model' => Payment::class
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
        return Type::listOf(GraphQL::type('Payment'));
    }

    public function args() : array
    {
        return [
            'id'    => [
                'name' => 'id',
                'type' => Type::int(),
            ],
        ];
    }
}