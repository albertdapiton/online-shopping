<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderShipping extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'address_1', 'address_2', 'state', 'province', 'city', 'country',
    ];

    public function order()
    {
        return $this->belongTo(Order::class);
    }
}
