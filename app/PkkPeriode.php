<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PkkPeriode extends Model
{
  protected $table = 'pkk_periode';

  protected $fillable = [
    'id_pkk',
    'tahun_mulai',
    'tahun_selesai',
  ];

  public function pengurus() {
    return $this->hasMany( 'App\PkkPengurus', 'id_periode' );
  }

  public function pkk() {
    return $this->belongsTo( 'App\PkkData', 'id_pkk' );
  }

  /**
   * get user last_login attribute in Indonesian date format
   *
   * @param  string $value      last_login real value
   * @return string             last_login in Indonesia date format
   */
  public function getFullPeriodAttribute( $value ) {
    $start = $this->attributes['tahun_mulai'];
    $end   = $this->attributes['tahun_selesai'];
    return $start == $end ? $start : $start.'/'.$end;
  }

  /**
   * Model cascade delete
   */
  public static function boot() {
    parent::boot();

    static::deleted( function( $periode ) {
      $periode->pengurus()->delete();
    } );
  }
}
