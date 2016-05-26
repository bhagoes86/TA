<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PkkKeluhan extends Model
{
  protected $table = 'pkk_keluhan';

  protected $fillable = [
    'id_ibu',
    'judul',
    'isi',
  ];

  public function komentar() {
    return $this->hasMany( 'App\PkkKomentar', 'id_keluhan' );
  }

  public function ibu() {
    return $this->belongsTo( 'App\PkkIbu', 'id_ibu' );
  }

  /**
   * Model cascade delete
   */
  public static function boot() {
    parent::boot();

    static::deleted( function( $keluhan ) {
      $keluhan->komentar()->delete();
    } );
  }
}
