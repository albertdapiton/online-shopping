<?php

namespace App\Services\Stripe;

use Stripe\Charge as StripeCharge;
use App\Services\Stripe\Abstract\StripeAPI;

final class StripeChargeService extends 
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Create Stripe charge
     *
     * @param mixed $details
     *
     * @return Stripe\Charge
     */
    public function createStripeCharge($details)
    {
        try {
            $charge = StripeCharge::create($details);
            return $charge;
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage());
        }
    }

    /**
     * Retrieve Stripe charge
     *
     * @param mixed $id
     *
     * @return Stripe\Charge
     */
    public function retrieveStripeCharge($id)
    {
        try {
            $charge = StripeCharge::retrieve($id);
            return $charge;
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage());
        }
    }

    /**
     * Update Stripe charge
     *
     * @param mixed $id
     * @param mixed $fields
     *
     * @return Stripe\Charge
     */
    public function updateStripeCharge($id, $fields)
    {
        try {
            $charge = StripeCharge::update($id, $fields);
            return $charge;
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage());
        }
    }
}