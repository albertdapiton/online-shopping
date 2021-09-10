<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileBillingAddress extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'profile_id', 'primary', 'address_1', 'address_2', 'state', 'province', 'city', 'country',
    ];

    public function profile()
    {
        return $this->belongTo(Profile::class);
    }
}
