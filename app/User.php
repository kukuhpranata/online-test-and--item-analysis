<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email','nama',
        // foreign 
        'role_id','password', 'status_akun'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function useremail(){
        return $this->belongsTo('App\User','email','id');
    }

    public function role(){
        return $this->belongsTo('App\Role','role_id','id');
    }

    public function pas(){
        return $this->belongsTo('App\User','password','id');
    }


}
