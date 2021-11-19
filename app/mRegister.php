<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mRegister extends Model
{
    protected $fillable = [
        'email','nama',
        'password',
    ];
}
