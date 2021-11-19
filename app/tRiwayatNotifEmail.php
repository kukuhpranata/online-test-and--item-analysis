<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tRiwayatNotifEmail extends Model
{
    protected $fillable = [
        'email_tujuan',
        // foreign
        'laporan_monitoring_id'
    ];

    public function laporan_monitoring(){
        return $this->belongsTo('App\tLaporanMonitoring','laporan_monitoring_id','id');
    }
}
