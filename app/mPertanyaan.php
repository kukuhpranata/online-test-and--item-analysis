<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mPertanyaan extends Model
{
    protected $fillable = [
        'judul_soal','jawaban','opsi1', 'opsi2', 'opsi3', 'opsi4', 'opsi5', 'nilai_validitas', 'nilai_derajat_kesukaran', 'fungsi_pengecoh',
        'nilai_dayabeda',

        'ujian_id'
    ];

    public function ujian(){
        return $this->belongsTo('App\mUjian','ujian_id','id');
    }

}
