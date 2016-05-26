<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PkkIbu extends Model
{
  protected $table = 'pkk_ibu';

  protected $fillable = [
    'id_pkk',
    'no_ktp',
    'nama',
    'alamat',
    'telp',
    'password_mobile',
  ];

  public function pkk() {
    return $this->belongsTo( 'App\PkkData', 'id_pkk' );
  }

  public function kas() {
    return $this->hasMany( 'App\PkkKas', 'id_ibu' );
  }

  public function pengurus() {
    return $this->hasMany( 'App\PkkPengurus', 'id_ibu' );
  }

  public function komentar() {
    return $this->hasMany( 'App\PkkKomentar', 'id_ibu' );
  }

  public function keluhan() {
    return $this->hasMany( 'App\PkkKeluhan', 'id_ibu' );
  }

  public function jentik() {
    return $this->hasMany( 'App\PkkJentik', 'id_ibu' );
  }

  public function absen() {
    return $this->hasMany( 'App\PkkAbsen', 'id_ibu' );
  }

  /**
   * Model cascade delete
   */
  public static function boot() {
    parent::boot();

    static::deleted( function( $ibu ) {
      $ibu->kas()->delete();
      $ibu->pengurus()->delete();
      $ibu->komentar()->delete();
      $ibu->keluhan()->delete();
      $ibu->jentik()->delete();
      $ibu->absen()->delete();
    } );
  }
}
