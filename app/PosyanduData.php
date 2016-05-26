<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PosyanduData extends Model
{
  protected $table = 'posyandu_data';

  protected $fillable = [
    'kel_id',
    'puskesmas',
    'nama',
    'alamat',
    'telp',
    'rw',
  ];

  public function desa_kelurahan() {
    return $this->belongsTo( 'App\DesaKelurahan', 'kel_id' );
  }

  public function kas() {
    return $this->hasMany( 'App\PosyanduKas', 'id_posyandu' );
  }

  public function pengumuman() {
    return $this->hasMany( 'App\PosyanduPengumuman', 'id_posyandu' );
  }

  public function pengurus() {
    return $this->hasMany( 'App\PosyanduPengurus', 'id_posyandu' );
  }

  public function absen() {
    return $this->hasMany( 'App\PosyanduAbsen', 'id_posyandu' );
  }
}
