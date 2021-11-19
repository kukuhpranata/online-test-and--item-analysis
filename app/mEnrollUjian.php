<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mEnrollUjian extends Model
{
    protected $fillable = [
        'status_kehadiran', 'status_daftar', 'nilai_akhir',

        'user_id', 'ujian_id',
    ];

    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }

    public function ujian(){
        return $this->belongsTo('App\mUjian','ujian_id','id');
    }

}
