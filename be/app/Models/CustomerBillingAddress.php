<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerBillingAddress extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'address_1', 'address_2', 'state', 'province', 'city', 'country',
    ];
}
