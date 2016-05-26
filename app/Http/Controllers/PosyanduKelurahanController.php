<?php

namespace App\Http\Controllers;

use Request;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\PosyanduData;
use App\Provinsi;
use App\KabupatenKota;
use App\Kecamatan;
use App\DesaKelurahan;

class PosyanduKelurahanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $kelurahan = DesaKelurahan::orderBy( 'kode', 'asc' )
                        ->where( 'desa_kelurahan.kec_id' , $id )
                        ->get();
        $kecamatan = Kecamatan::orderBy( 'kode', 'asc' )->get();
        $kabupaten = KabupatenKota::orderBy( 'kode', 'asc' )->get();
        $provinsi = Provinsi::orderBy( 'kode', 'asc' )->get();
        return view( 'pages.posyandu.kelurahan.index' , compact( 'kelurahan', 'kecamatan', 'kabupaten', 'provinsi' ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kecamatan = Kecamatan::orderBy( 'nama' , 'asc' )->get();
        return view( 'pages.posyandu.kelurahan.create', compact( 'kecamatan') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $kelurahan = Request::all();
        DesaKelurahan::create( $kelurahan );
        Session::flash( 'success', "Data Kelurahan baru berhasil ditambahkan!" );
        return redirect()->route( 'posyandu.kelurahan' );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kelurahan = DesaKelurahan::find( $id );
        $kecamatan = Kecamatan::find( $kelurahan->kec_id );
        $kabupaten = KabupatenKota::find( $kecamatan->kab_id );
        $provinsi = Provinsi::find( $kabupaten->prov_id );
        $posyandu = PosyanduData::orderBy( 'rw' , 'asc' )
                        ->where( 'kel_id' , $id)
                        ->get();
        return view( 'pages.posyandu.kelurahan.show' , compact( 'kelurahan', 'kecamatan', 'kabupaten', 'provinsi', 'posyandu' ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kecamatan = Kecamatan::orderBy( 'nama' , 'asc' )->get();
        $kelurahan = DesaKelurahan::find( $id );
        return view( 'pages.posyandu.kelurahan.edit', compact( 'kelurahan' , 'kecamatan' ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $lokasiUpdate = Request::all();
        $lokasi = DesaKelurahan::find( $id );
        $lokasi->update( $lokasiUpdate );
        Session::flash( 'success', "Data kelurahan berhasil diperbarui!" );
        return redirect()->route( 'posyandu.kelurahan' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DesaKelurahan::find( $id )->delete();
        Session::flash( 'success', "Data kelurahan berhasil dihapus!" );
        return redirect()->route( 'posyandu.kelurahan' );
    }
}
