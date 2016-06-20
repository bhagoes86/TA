<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PosyanduKas extends Model
{
  protected $table = 'posyandu_kas';

  protected $fillable = [
    'id_posyandu',
    'id_jenis',
    'tanggal',
    'nominal',
    'keterangan'
  ];

  public function posyandu() {
    return $this->belongsTo( 'App\PosyanduData', 'id_posyandu' );
  }

  public function jenis_kas() {
    return $this->belongsTo( 'App\PosyanduJenisKas', 'id_jenis' );
  }
}
