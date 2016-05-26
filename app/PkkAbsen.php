<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PkkAbsen extends Model
{
  protected $table = 'pkk_absen';

  protected $fillable = [
    'id_ibu',
    'id_kegiatan',
  ];

  public function ibu() {
    return $this->belongsTo( 'App\PkkIbu', 'id_ibu' );
  }

  public function kegiatan() {
    return $this->belongsTo( 'App\PkkKegiatan', 'id_kegiatan' );
  }
}
