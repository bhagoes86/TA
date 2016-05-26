<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PkkJabatan extends Model
{
  protected $table = 'pkk_jabatan';

  protected $fillable = [
    'id_pkk',
    'nama',
    'deskripsi'
  ];

  public function pengurus() {
    return $this->hasMany( 'App\PkkPengurus', 'id_jabatan' );
  }

  public function pkk() {
    return $this->belongsTo( 'App\PkkData', 'id_pkk' );
  }

  /**
   * Model cascade delete
   */
  public static function boot() {
    parent::boot();

    static::deleted( function( $jabatan ) {
      $jabatan->pengurus()->delete();
    } );
  }
}
