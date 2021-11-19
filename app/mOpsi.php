<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mOpsi extends Model
{
    protected $fillable = [
        'judul_opsi','nomor_opsi',

        'pertanyaan_id'
    ];

    public function pertanyaan(){
        return $this->belongsTo('App\mPertanyaan','pertanyaan_id','id');
    }
}
