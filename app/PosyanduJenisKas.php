<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PosyanduJenisKas extends Model
{
  protected $table = 'posyandu_jenis_kas';

  protected $fillable = [
    'jenis',
    'nama'
  ];

  public function kas() {
    return $this->hasMany( 'App\PosyanduKas', 'id_jenis' );
  }
}
