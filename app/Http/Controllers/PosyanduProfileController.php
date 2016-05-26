<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ProfileController;

use Auth;

use App\PosyanduData;
use App\PkkData;
use App\Provinsi;
use App\KabupatenKota;
use App\Kecamatan;
use App\DesaKelurahan;

class PosyanduProfileController extends ProfileController
{
    /**
     * Display Posyandu profile page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $data['user'] = Auth::user();

        // GET Posyandu LOCATION
        $posyandu = PosyanduData::find( $data['user']->id_posyandu );
        $kelurahan = DesaKelurahan::find( $posyandu->kel_id );
        $kecamatan = Kecamatan::find( $kelurahan->kec_id );
        $kabupaten = KabupatenKota::find( $kecamatan->kab_id );
        $provinsi = Provinsi::find( $kabupaten->prov_id );
        $daerah = PkkData::daerah( $provinsi->kode[0] );

        return view( 'pages.posyandu.profile.index', compact( 'data' , 'posyandu' , 'kelurahan' , 'kecamatan' , 'kabupaten' , 'provinsi' , 'daerah') );
    }
}
