<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PkkData extends Model
{
  protected $table = 'pkk_data';

  protected $fillable = [
    'prov_id',
    'kab_id',
    'kec_id',
    'kel_id',
    'rw',
    'rt',
    'kode_wilayah',
  ];

  public function jabatan() {
    return $this->hasMany( 'App\PkkJabatan', 'id_pkk' );
  }

  public function kas() {
    return $this->hasMany( 'App\PkkKas', 'id_pkk' );
  }

  public function ibu() {
    return $this->hasMany( 'App\PkkIbu', 'id_pkk' );
  }

  public function periode() {
    return $this->hasMany( 'App\PkkPeriode', 'id_pkk' );
  }

  public function jeniskas() {
    return $this->hasMany( 'App\PkkJenisKas', 'id_pkk' );
  }

  public function kegiatan() {
    return $this->hasMany( 'App\Kegiatan', 'id_pkk' );
  }

  public function pengumuman() {
    return $this->hasMany( 'App\PkkPengumuman', 'id_pkk' );
  }

  public function laporan() {
    return $this->hasMany( 'App\PkkLaporan', 'id_pkk' );
  }

  public function provinsi() {
    return $this->belongsTo( 'App\Provinsi', 'prov_id' );
  }

  public function kabupaten_kota() {
    return $this->belongsTo( 'App\KabupatenKota', 'kab_id' );
  }

  public function kecamatan() {
    return $this->belongsTo( 'App\Kecamatan', 'kec_id' );
  }

  public function desa_kelurahan() {
    return $this->belongsTo( 'App\DesaKelurahan', 'kel_id' );
  }

  /**
   * Get PKK main big location
   *
   * @param  integer $idx   location index
   * @return string         location name
   */
  public static function daerah( $idx ) {
    if ( $idx == 1 ) return "Sumatera";
    else if ( $idx == 2 ) return "Kepulauan Riau";
    else if ( $idx == 3 ) return "Jawa";
    else if ( $idx == 5 ) return "Bali & Kepulauan Nusa Tenggara";
    else if ( $idx == 6 ) return "Kalimantan";
    else if ( $idx == 7 ) return "Sulawesi";
    else if ( $idx == 8 ) return "Kepulauan Maluku";
    else if ( $idx == 9 ) return "Papua";
    return "Tidak diketahui";
  }

  /**
   * Model cascade delete
   */
  public static function boot() {
    parent::boot();

    static::deleted( function( $data ) {
      $data->jabatan()->delete();
      $data->kas()->delete();
      $data->ibu()->delete();
      $data->periode()->delete();
      $data->jeniskas()->delete();
      $data->kegiatan()->delete();
      $data->pengumuman()->delete();
      $data->laporan()->delete();
    } );
  }
}
