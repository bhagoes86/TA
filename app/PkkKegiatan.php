<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PkkKegiatan extends Model
{
  protected $table = 'pkk_kegiatan';

  protected $fillable = [
    'id_pkk',
    'nama',
    'tanggal',
  ];

  public function pkk() {
    return $this->belongsTo( 'App\PkkData', 'id_pkk' );
  }

  public function notulensi() {
    return $this->hasOne( 'App\PkkNotulensi', 'id_kegiatan' );
  }

  public function absen() {
    return $this->hasMany( 'App\PkkAbsen', 'id_kegiatan' );
  }

  /**
   * get user tanggal attribute in Indonesian date format
   *
   * @param  string $value      tanggal real value
   * @return string             tanggal in Indonesia date format
   */
  public function getTanggalAttribute( $value ) {
    return Date::indonesian_date( $value, 'l, j F Y', null );
  }

  /**
   * Model cascade delete
   */
  public static function boot() {
    parent::boot();

    static::deleted( function( $kegiatan ) {
      $kegiatan->notulensi()->delete();
      $kegiatan->absen()->delete();
    } );
  }
}
