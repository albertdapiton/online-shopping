<?php

namespace App\Traits;

trait HasRole
{
    /**
     * Trait boot function
     *
     * @return void
     */
    protected static function bootHasRole()
    {
        static::addGlobalScope(function ($query) {
            $class = explode('\\', __CLASS__);
            $class = strtolower(end($class));
            $query->whereHas('roles', function ($query) use ($class) {
                return $query->where('name', $class);
            });
        });
    }

    /**
     * Get the user admin profile data
     *
     * @return Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile()
    {
        return $this->hasOne(__CLASS__.'Profile', 'user_id');
    }
}