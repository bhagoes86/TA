<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PosyanduPengurus extends Model
{
  protected $table = 'posyandu_pengurus';

  protected $fillable = [
    'no_ktp',
    'id_posyandu',
    'nama',
    'alamat',
    'telp'
  ];

  public function posyandu() {
    return $this->belongsTo( 'App\PosyanduData', 'id_posyandu' );
  }
}
