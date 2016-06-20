<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PosyanduBeriImunisasi extends Model
{
  protected $table = 'posyandu_pemberian_imunisasi';

  protected $fillable = [
    'id_balita',
    'id_imunisasi',
    'tanggal',
  ];

  public function balita() {
    return $this->belongsTo( 'App\PosyanduBalita', 'id_balita' );
  }

  public function imunisasi() {
    return $this->belongsTo( 'App\PosyanduImunisasi', 'id_imunisasi' );
  }
}
