<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
  protected $table = 'provinsi';
  public $timestamps = false;

  protected $fillable = [
    'kode',
    'nama',
  ];

  public function pkk() {
    return $this->hasMany( 'App\PkkData', 'prov_id' );
  }

  public function kabupaten_kota() {
    return $this->hasMany( 'App\KabupatenKota', 'prov_id' );
  }

  public function get_pair() {
    return [$this->id => $this->nama];
  }
}
