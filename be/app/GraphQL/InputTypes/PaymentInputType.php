<?php

namespace App\GraphQL\InputTypes;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\InputType;

final class PaymentInputType extends InputType 
{
    protected $attributes = [
        'name'          => 'PaymentInput',
        'description'   => 'A item with id, price and quantity'
    ];

    public function fields(): array
    {
        return [
            'amount' => [
                'name' => 'address_1',
                'description' => 'Total amount of order',
                'type' => Type::string(),
            ],
            'cc_number' => [
                'name' => 'cc_number',
                'description' => 'A credit card number',
                'type' => Type::string(),
            ],
            'exp_month' => [
                'name' => 'exp_month',
                'description' => 'A credit card expired year',
                'type' => Type::string(),
            ],
            'exp_year' => [
                'name' => 'exp_year',
                'description' => 'A credit card expired year',
                'type' => Type::string(),
            ],
            'cc_cvc' => [
                'name' => 'cc_cvc',
                'description' => 'A credit card cvc code',
                'type' => Type::string(),
            ]
        ];
    }
}