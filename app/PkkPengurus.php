<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PkkPengurus extends Model
{
  protected $table = 'pkk_pengurus';

  protected $fillable = [
    'id_ibu',
    'id_periode',
    'id_jabatan',
  ];

  public function ibu() {
    return $this->belongsTo( 'App\PkkIbu', 'id_ibu' );
  }

  public function periode() {
    return $this->belongsTo( 'App\PkkPeriode', 'id_periode' );
  }

  public function jabatan() {
    return $this->belongsTo( 'App\PkkJabatan', 'id_jabatan' );
  }
}
