<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PkkJenisKas extends Model
{
  protected $table = 'pkk_jenis_kas';

  protected $fillable = [
    'id_pkk',
    'jenis',
    'nama',
  ];

  public function pkk() {
    return $this->belongsTo( 'App\PkkData', 'id_pkk' );
  }

  public function kas() {
    return $this->hasMany( 'App\PkkKas', 'id_jenis_kas' );
  }

  /**
   * Model cascade delete
   */
  public static function boot() {
    parent::boot();

    static::deleted( function( $jeniskas ) {
      $jeniskas->kas()->delete();
    } );
  }
}
