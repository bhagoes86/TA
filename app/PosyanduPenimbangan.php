<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PosyanduPenimbangan extends Model
{
  protected $table = 'posyandu_penimbangan';

  protected $fillable = [
    'id_balita',
    'umur',
    'berat',
    'tinggi',
    'ntob',
    'asi'
  ];

  public function balita() {
    return $this->belongsTo( 'App\PosyanduBalita', 'id_balita' );
  }
}
