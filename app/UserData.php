<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserData extends Model
{
    protected $fillable = ['name', 'email', 'city', 'address', 'salary'];
}
