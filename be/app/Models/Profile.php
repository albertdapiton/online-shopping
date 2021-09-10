<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'nickname',
        'date_birth',
        'country',
    ];

    public function billing()
    {
        return $this->hasMany(ProfileBillingAddress::class)->where('primary', true);
    }

    public function billings()
    {
        return $this->hasMany(ProfileBillingAddress::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shipping()
    {
        return $this->hasMany(ProfileShippingAddress::class)->where('primary', true);
    }

    public function shippings()
    {
        return $this->hasMany(ProfileShippingAddress::class);
    }
}
