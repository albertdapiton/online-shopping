<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'amount', 'stripe_payment_id',
    ];

    public function order()
    {
        return $this->belongTo(Order::class);
    }
}
