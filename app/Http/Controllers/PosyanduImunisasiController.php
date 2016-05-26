<?php

namespace App\Http\Controllers;

use Request;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\PosyanduImunisasi;

class PosyanduImunisasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $imunisasi = PosyanduImunisasi::orderBy( 'umur' , 'desc' )->get();
        return view( 'pages.posyandu.imunisasi.index' , compact( 'imunisasi' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view( 'pages.posyandu.imunisasi.create' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $imunisasi = Request::all();
        PosyanduImunisasi::create( $imunisasi );
        Session::flash( 'success', "Jenis imunisasi baru berhasil ditambahkan!" );
        return redirect()->route( 'posyandu.jenisimunisasi' );
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
        $imunisasi = PosyanduImunisasi::find($id);
        return view( 'pages.posyandu.imunisasi.edit' , compact( 'imunisasi') );
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
        $jenis = Request::all();
        $imunisasi = PosyanduImunisasi::find( $id );
        $imunisasi->update( $jenis );
        Session::flash( 'success', "Jenis imunisasi berhasil diperbarui!" );
        return redirect()->route( 'posyandu.jenisimunisasi' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PosyanduImunisasi::find( $id )->delete();
        Session::flash( 'success', "Jenis imunisasi berhasil dihapus!" );
        return redirect()->route( 'posyandu.jenisimunisasi' );
    }
}
