<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PkkLaporan extends Model
{
  protected $table = 'pkk_laporan';

  protected $fillable = [
    'id_pkk',
    'subjek',
    'file',
  ];

  public function pkk() {
    return $this->belongsTo( 'App\PkkData', 'id_pkk' );
  }
}
