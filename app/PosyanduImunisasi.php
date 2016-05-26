<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PosyanduImunisasi extends Model
{
  protected $table = 'posyandu_imunisasi';

  protected $fillable = [
    'jenis',
    'umur'
  ];

  public function pemberian_imunisasi() {
    return $this->hasMany( 'App\PosyanduBeriImunisasi', 'id_imunisasi' );
  }
}
