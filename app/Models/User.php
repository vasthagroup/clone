<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'email',
        'password',
    ];
    
    // Never expose the password hash in API responses or toArray()
    protected $hidden = [
        'password',
    ];
}
