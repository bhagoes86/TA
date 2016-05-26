<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
  protected $table = 'kecamatan';
  public $timestamps = false;

  protected $fillable = [
    'kab_id',
    'kode',
    'nama',
  ];

  public function pkk() {
    return $this->hasMany( 'App\PkkData', 'kec_id' );
  }

  public function desa_kelurahan() {
    return $this->hasMany( 'App\DesaKelurahan', 'kec_id' );
  }

  public function kabupaten_kota() {
    return $this->belongsTo( 'App\KabupatenKota', 'kab_id' );
  }

  public function get_pair() {
    return [$this->id => $this->nama];
  }
}
