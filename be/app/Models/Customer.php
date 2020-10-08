<?php

namespace App\Models;

use App\Models\User;
use App\Traits\HasRole;
use Illuminate\Database\Eloquent\Model;

class Customer extends User
{
    use HasRole;
}
