<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PkkJentik extends Model
{
  protected $table = 'pkk_jentik';

  protected $fillable = [
    'id_ibu',
    'jumlah',
    'bulan_data',
    'tahun_data',
  ];

  public function ibu() {
    return $this->belongsTo( 'App\PkkIbu', 'id_ibu' );
  }
}
