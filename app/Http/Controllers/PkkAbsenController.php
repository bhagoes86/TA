<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use Session;

use App\PkkIbu;
use App\PkkAbsen;

class PkkAbsenController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        PkkAbsen::create( $request->all() );
        Session::flash( 'success', "Data kehadiran berhasil ditambahkan!" );
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = [];
        $data['anggota'] = PkkIbu::where( 'id_pkk', Auth::user()->id_pkk )->orderBy( 'nama' )->lists( 'nama', 'id' )->toArray();
        $data['id_kegiatan'] = $id;
        $data['content'] = PkkAbsen::with( ['ibu' => function ( $q ) {
            $q->orderBy( 'nama' );
        } ] )->where( 'id_kegiatan', $id )->get();

        if ( !$data['anggota'] ) {
            Session::flash( 'info', "Belum ada anggota PKK yang terdaftar, mohon untuk menambahkan anggota PKK anda terlebih dahulu" );
            return redirect()->route( 'pkk.ibu.create' );
        }

        return view( 'pages.pkk.pengurus.absen.show', compact( 'data' ) );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PkkAbsen::find( $id )->delete();
        Session::flash( 'success', "Data kehadiran berhasil dihapus!" );
        return redirect()->back();
    }
}
