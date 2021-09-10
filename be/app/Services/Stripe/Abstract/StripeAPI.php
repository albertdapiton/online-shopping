<?php

namespace App\Services\Stripe\Abstract;

use Stripe\Stripe;

abstract class StripeAPI
{
    public function __construct()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    }
}