<?php

namespace App\Http\Controllers;

use Request;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Provinsi;

class PosyanduProvinsiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provinsi = Provinsi::orderBy( 'nama', 'asc' )->get();
        return view( 'pages.posyandu.provinsi.index' , compact( 'provinsi' ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view( 'pages.posyandu.provinsi.create' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $provinsi = Request::all();
        Provinsi::create( $provinsi );
        Session::flash( 'success', "Data provinsi baru berhasil ditambahkan!" );
        return redirect()->route( 'posyandu.provinsi' );
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
        $provinsi = Provinsi::find( $id );
        return view( 'pages.posyandu.provinsi.edit', compact( 'provinsi' ) );
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
        $lokasi = Provinsi::find( $id );
        $lokasi->update( $lokasiUpdate );
        Session::flash( 'success', "Data provinsi berhasil diperbarui!" );
        return redirect()->route( 'posyandu.provinsi' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Provinsi::find( $id )->delete();
        Session::flash( 'success', "Data provinsi berhasil dihapus!" );
        return redirect()->route( 'posyandu.provinsi' );
    }
}
