<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mUjian extends Model
{
    protected $fillable = [
        'judul','tgl_ujian', 'durasi','status', 'nilai_keandalan_kr21', 'nilai_keandalan_kr20', 'jumlah_soal', 'tgl_ujian_end',

        'user_id',
    ];

    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }

}