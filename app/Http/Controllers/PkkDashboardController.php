<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;

use App\PkkIbu;
use App\PkkJentik;

class PkkDashboardController extends Controller
{
    /**
     * Display PKK Dashboard
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $data = [];
      $data['anggota'] = PkkIbu::where( 'id_pkk', Auth::user()->id_pkk )->count();
      $data['jentik'] = PkkJentik::whereHas( 'ibu', function( $q ) {
        $q->where( 'id_pkk', Auth::user()->id_pkk );
      } )->where( 'bulan_data', date( 'n' ) )->where( 'tahun_data', date( 'Y' ) )->sum( 'jumlah' );

      return view( 'pages.pkk.pengurus.dashboard.index', compact( 'data' ) );
    }
}
