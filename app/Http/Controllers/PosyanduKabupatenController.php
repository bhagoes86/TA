<?php

namespace App\Http\Controllers;

use Request;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Provinsi;
use App\KabupatenKota;

class PosyanduKabupatenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $kabupaten = KabupatenKota::orderBy( 'kode', 'asc' )
                        ->where( 'kabupaten_kota.prov_id' , $id )
                        ->get();
        return view( 'pages.posyandu.kabupaten.index' , compact( 'kabupaten' ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provinsi = Provinsi::orderBy( 'nama', 'asc' )->get();
        return view( 'pages.posyandu.kabupaten.create' , compact( 'provinsi' , 'status' ) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $kabupaten = Request::all();
        KabupatenKota::create( $kabupaten );
        Session::flash( 'success', "Data kabupaten baru berhasil ditambahkan!" );
        return redirect()->route( 'posyandu.kabupaten' );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $provinsi = Provinsi::orderBy( 'nama', 'asc' )->get();
        $kabupaten = KabupatenKota::find( $id );
        return view( 'pages.posyandu.kabupaten.edit', compact( 'kabupaten' , 'provinsi' ) );
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
        $lokasi = KabupatenKota::find( $id );
        $lokasi->update( $lokasiUpdate );
        Session::flash( 'success', "Data kabupaten berhasil diperbarui!" );
        return redirect()->route( 'posyandu.kabupaten' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        KabupatenKota::find( $id )->delete();
        Session::flash( 'success', "Data kabupaten berhasil dihapus!" );
        return redirect()->route( 'posyandu.kabupaten' );
    }
}
