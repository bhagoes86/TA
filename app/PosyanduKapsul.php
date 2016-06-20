<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PosyanduKapsul extends Model
{
  protected $table = 'posyandu_pemberian_kapsul';

  protected $fillable = [
    'id_balita',
    'umur',
    'tanggal',
    'jenis',
  ];

  public function balita() {
    return $this->belongsTo( 'App\PosyanduBalita', 'id_balita' );
  }
}
