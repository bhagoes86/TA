<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\PosyanduKasRequest;
use App\Http\Controllers\Controller;

use Auth;
use Session;

use App\PosyanduJenisKas;
use App\PosyanduKas;
use App\PosyanduData;

class PosyanduKasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kas = PosyanduKas::join( 'posyandu_data', 'posyandu_kas.id_posyandu', '=', 'posyandu_data.id' )
               ->join( 'posyandu_jenis_kas', 'posyandu_kas.id_jenis', '=', 'posyandu_jenis_kas.id' )
               ->select( 'posyandu_kas.*', 'posyandu_data.nama as nama_pos', 'posyandu_jenis_kas.nama as nama_jenis' )
               ->where( 'posyandu_kas.id_posyandu' , Auth::user()->id_posyandu )
               ->get();
        return view( 'pages.posyandu.kas.index', compact( 'kas' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $posyandu = PosyanduData::orderBy( 'nama', 'asc' )->get();
        $jeniskas = PosyanduJenisKas::orderBy( 'jenis', 'asc' )->get();
        return view( 'pages.posyandu.kas.create', compact( 'posyandu', 'jeniskas' ) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PosyanduKasRequest $request)
    {
        $kas = $request->all();
        PosyanduKas::create( $kas );
        Session::flash( 'success', "Data kas baru berhasil ditambahkan!" );
        return redirect()->route( 'posyandu.kas' );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kas = PosyanduKas::join( 'posyandu_data', 'posyandu_kas.id_posyandu', '=', 'posyandu_data.id' )
               ->join( 'posyandu_jenis_kas', 'posyandu_kas.id_jenis', '=', 'posyandu_jenis_kas.id' )
               ->select( 'posyandu_kas.*', 'posyandu_data.nama as nama_pos', 'posyandu_jenis_kas.nama as nama_jenis', 'posyandu_jenis_kas.jenis as jenis_kas' )
               ->where( 'posyandu_kas.id', $id )
               ->first();
        return view( 'posyandu.kas.show', compact( 'kas' ) );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kas = PosyanduKas::find( $id );
        $posyandu = PosyanduData::orderBy( 'nama', 'asc' )->get();
        $jeniskas = PosyanduJenisKas::orderBy( 'jenis', 'asc' )->get();
        return view( 'pages.posyandu.kas.edit', compact( 'kas', 'posyandu', 'jeniskas' ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PosyanduKasRequest $request, $id)
    {
        $kasUpdate = $request->all();
        $kas = PosyanduKas::find( $id );
        $kas->update( $kasUpdate );
        Session::flash( 'success', "Data kas berhasil diperbarui!" );
        return redirect()->route( 'posyandu.kas' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PosyanduKas::find( $id )->delete();
        Session::flash( 'success', "Data kas berhasil dihapus!" );
        return redirect()->route( 'posyandu.kas' );
    }
}