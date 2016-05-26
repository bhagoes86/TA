<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PosyanduPengumuman extends Model
{
  protected $table = 'posyandu_pengumuman';

  protected $fillable = [
    'id_posyandu',
    'judul',
    'isi',
    'link'
  ];

  public function posyandu() {
    return $this->belongsTo( 'App\PosyanduData', 'id_posyandu' );
  }
}
