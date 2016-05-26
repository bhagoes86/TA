<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PkkNotulensi extends Model
{
  protected $table = 'pkk_notulensi';

  protected $fillable = [
    'id_kegiatan',
    'isi',
  ];

  public function kegiatan() {
    return $this->belongsTo( 'App\PkkKegiatan', 'id_kegiatan' );
  }
}
