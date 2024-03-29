<?php

namespace App\Models;

use App\Notifications\VerifyUserEmailNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, Notifiable, SoftDeletes;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Send verification to the user email
     * 
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyUserEmailNotification);
    }

    /**
     * Get access token
     * 
     * return mixed
     */
    public function getAccessTokenAttribute()
    {
        return $this->tokens()->where('expires_at', '>', now())->first() ?? null;
    }

    /**
     * Get email is verified
     * 
     * return boolean
     */
    public function getVerifiedAttribute() : bool
    {
        return $this->hasVerifiedEmail();
    }

    /**
     * Get the roles of the user
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    /**
     * Get the roles of the user
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_role', 'user_id', 'role_id');
    }

    /**
     * Filter users using role name
     *
     * @param $query
     * @param $role
     *
     * @return void
     */
    public function scopeRole($query, $role = '')
    {
        if (empty($role)) {
            return $query;
        }

        $query->whereHas('roles', function ($query) use ($role) {
            return $query->where('name', $role);
        });
    }
}
