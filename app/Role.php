<?php

namespace App;

use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
    public function role(){
        return $this->belongsTo('App\Role','role_id','id');
    }
}
