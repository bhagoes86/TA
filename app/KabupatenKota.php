<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KabupatenKota extends Model
{
  protected $table = 'kabupaten_kota';
  public $timestamps = false;

  protected $fillable = [
    'prov_id',
    'kode',
    'nama',
  ];

  public function pkk() {
    return $this->hasMany( 'App\PkkData', 'kab_id' );
  }

  public function kecamatan() {
    return $this->hasMany( 'App\Kecamatan', 'kab_id' );
  }

  public function provinsi() {
    return $this->belongsTo( 'App\Provinsi', 'prov_id' );
  }

  public function get_pair() {
    return [$this->id => $this->nama];
  }
}
