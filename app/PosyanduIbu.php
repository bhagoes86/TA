<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PosyanduIbu extends Model
{
  protected $table = 'posyandu_ibu';

  protected $fillable = [
    'id_posyandu',
    'no_ktp',
    'nama',
    'alamat',
    'telp',
    'kb',
    'tanggal_lahir',
    'password_mobile',
    'token'
  ];

  public function posyandu() {
    return $this->belongsTo( 'App\PosyanduData', 'id_posyandu' );
  }

  public function keluhan() {
    return $this->hasMany( 'App\PosyanduKeluhan', 'id_ibu' );
  }

  public function balita() {
    return $this->hasMany( 'App\PosyanduBalita', 'id_ibu' );
  }
}
