<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mJawaban extends Model
{
    
    protected $fillable = [
        'jawaban_user', 'poin',

        'user_id', 'ujian_id', 'pertanyaan_id',
    ];

    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }

    public function ujian(){
        return $this->belongsTo('App\mUjian','ujian_id','id');
    }

    public function pertanyaan(){
        return $this->belongsTo('App\mPertanyaan','pertanyaan_id','id');
    }


}
