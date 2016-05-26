<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DesaKelurahan extends Model
{
  protected $table = 'desa_kelurahan';
  public $timestamps = false;

  protected $fillable = [
    'kec_id',
    'kode',
    'nama',
  ];

  public function pkk() {
    return $this->hasMany( 'App\PkkData', 'kel_id' );
  }

  public function kecamatan() {
    return $this->belongsTo( 'App\Kecamatan', 'kec_id' );
  }

  public function get_pair() {
    return [$this->id => $this->nama];
  }
}
