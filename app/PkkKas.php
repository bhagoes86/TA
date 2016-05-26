<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PkkKas extends Model
{
  protected $table = 'pkk_kas';

  protected $fillable = [
    'id_ibu',
    'id_jenis_kas',
    'id_pkk',
    'nominal',
  ];

  public function jenis_kas() {
    return $this->belongsTo( 'App\PkkJenisKas', 'id_jenis_kas' );
  }

  public function pkk() {
    return $this->belongsTo( 'App\PkkData', 'id_pkk' );
  }

  public function ibu() {
    return $this->belongsTo( 'App\PkkIbu', 'id_ibu' );
  }
}
