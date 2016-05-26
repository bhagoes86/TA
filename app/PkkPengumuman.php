<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PkkPengumuman extends Model
{
  protected $table = 'pkk_pengumuman';

  protected $fillable = [
    'id_pkk',
    'judul',
    'isi',
    'link',
  ];

  public function pkk() {
    return $this->belongsTo( 'App\PkkData', 'id_pkk' );
  }
}
