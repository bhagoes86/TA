<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PosyanduKeluhan extends Model
{
  protected $table = 'posyandu_keluhan';

  protected $fillable = [
    'id_ibu',
    'judul',
    'isi'
  ];

  public function ibu() {
    return $this->belongsTo( 'App\PosyanduIbu', 'id_ibu' );
  }

  public function jawab_keluhan() {
    return $this->hasMany( 'App\PosyanduJawabKeluhan', 'id_keluhan' );
  }
}
