<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PosyanduBalita extends Model
{
  protected $table = 'posyandu_balita';

  protected $fillable = [
    'id_ibu',
    'id_posyandu',
    'no_kk',
    'nama',
    'jenis_kelamin',
    'anak_ke',
    'tanggal_lahir',
    'tb_lahir',
    'bb_lahir',
    'nama_ayah',
    'pekerjaan_ayah',
    'pekerjaan_ibu',
    'umur'
  ];

  public function ibu() {
    return $this->belongsTo( 'App\PosyanduIbu', 'id_ibu' );
  }

  public function posyandu() {
    return $this->belongsTo( 'App\PosyanduData', 'id_posyandu' );
  }

  public function penimbangan() {
    return $this->hasMany( 'App\PosyanduPenimbangan', 'id_balita' );
  }

  public function pemberian_kapsul() {
    return $this->hasMany( 'App\PosyanduKapsul', 'id_balita' );
  }

  public function absen() {
    return $this->hasMany( 'App\PosyanduAbsen', 'id_balita' );
  }

  public function pemberian_imunisasi() {
    return $this->hasMany( 'App\PosyanduBeriImunisasi', 'id_balita' );
  }
}
