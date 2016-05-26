<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ProfileController;

use Auth;

use App\PkkData;

class PkkProfileController extends ProfileController
{
    /**
     * Display PKK profile page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $data['user'] = Auth::user();

        // GET PKK LOCATION
        $location = PkkData::find( $data['user']->id_pkk );
        $data['kode_wilayah']   = $location->kode_wilayah;
        $data['daerah']         = PkkData::daerah( $location->provinsi->kode[0] );
        $data['provinsi']       = $location->provinsi->nama;
        $data['kabupaten_kota'] = $location->kab_id == '0' ? '-' : $location->kabupaten_kota->nama;
        $data['kecamatan']      = $location->kec_id == '0' ? '-' : $location->kecamatan->nama;
        $data['desa_kelurahan'] = $location->kel_id == '0' ? '-' : $location->desa_kelurahan->nama;
        $data['rw']             = $location->rw == '0' ? '-' : sprintf( "%02d", $location->rw );
        $data['rt']             = $location->rt == '0' ? '-' : sprintf( "%02d", $location->rt );

        return view( 'pages.pkk.pengurus.profile.index', compact( 'data' ) );
    }
}
