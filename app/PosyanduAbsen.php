<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PosyanduAbsen extends Model
{
  protected $table = 'posyandu_absen';

  protected $fillable = [
    'id_posyandu',
    'id_balita',
  ];

  public function posyandu() {
    return $this->belongsTo( 'App\PosyanduData', 'id_posyandu' );
  }

  public function balita() {
    return $this->belongsTo( 'App\PosyanduBalita', 'id_balita' );
  }
}
