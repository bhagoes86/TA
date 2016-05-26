<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Date;

class PkkKomentar extends Model
{
  protected $table = 'pkk_komentar';

  protected $fillable = [
    'id_ibu',
    'id_keluhan',
    'isi',
  ];

  public function ibu() {
    return $this->belongsTo( 'App\PkkIbu', 'id_ibu' );
  }

  public function keluhan() {
    return $this->belongsTo( 'App\PkkKeluhan', 'id_keluhan' );
  }

  /**
   * get user last_login attribute in Indonesian date format
   *
   * @param  string $value      last_login real value
   * @return string             last_login in Indonesia date format
   */
  public function getCreatedAtAttribute( $value ) {
    return Date::indonesian_date( $value );
  }
}
