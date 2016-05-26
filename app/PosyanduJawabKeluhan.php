<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PosyanduJawabKeluhan extends Model
{
  protected $table = 'posyandu_jawab_keluhan';

  protected $fillable = [
    'id_keluhan',
    'isi',
    'user'
  ];

  public function keluhan() {
    return $this->belongsTo( 'App\PosyanduKeluhan', 'id_keluhan' );
  }
}
