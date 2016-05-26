<?php

namespace App\Http\Controllers;

use Request;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\KabupatenKota;
use App\Kecamatan;

class PosyanduKecamatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $kecamatan = Kecamatan::orderBy( 'kode', 'asc' )
                        ->where( 'kecamatan.kab_id' , $id )
                        ->get();
        return view( 'pages.posyandu.kecamatan.index' , compact( 'kecamatan' ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kabupaten = KabupatenKota::orderBy( 'nama' , 'asc' )->get();
        return view( 'pages.posyandu.kecamatan.create' , compact( 'kabupaten'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $kecamatan = Request::all();
        Kecamatan::create( $kecamatan );
        Session::flash( 'success', "Data kecamatan baru berhasil ditambahkan!" );
        return redirect()->route( 'posyandu.kecamatan' );
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
        $kecamatan = Kecamatan::find( $id );
        $kabupaten = KabupatenKota::orderBy( 'nama' , 'asc' )->get();
        return view( 'pages.posyandu.kecamatan.edit', compact( 'kecamatan' ,'kabupaten' ) );
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
        $lokasi = Kecamatan::find( $id );
        $lokasi->update( $lokasiUpdate );
        Session::flash( 'success', "Data kecamatan berhasil diperbarui!" );
        return redirect()->route( 'posyandu.kecamatan' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Kecamatan::find( $id )->delete();
        Session::flash( 'success', "Data kecamatan berhasil dihapus!" );
        return redirect()->route( 'posyandu.kecamatan' );
    }
}
