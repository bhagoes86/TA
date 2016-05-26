<?php

namespace App\Http\Controllers;

use Request;
use Auth;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\PosyanduPengurus;
use App\PosyanduData;

class PosyanduPengurusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengurus = PosyanduPengurus::join( 'posyandu_data' , 'posyandu_pengurus.id_posyandu' , '=' , 'posyandu_data.id' )
                                ->select( 'posyandu_pengurus.*' , 'posyandu_data.nama as nama_posyandu' )
                                ->where( 'posyandu_pengurus.id_posyandu' , Auth::user()->id_posyandu )
                                ->get();
        return view( 'pages.posyandu.pengurus.index', compact( 'pengurus' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $posyandu = PosyanduData::find( Auth::user()->id_posyandu );
        return view( 'pages.posyandu.pengurus.create', compact( 'posyandu' ) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pengurus = Request::all();
        PosyanduPengurus::create( $pengurus );
        Session::flash( 'success', "Data pengurus baru berhasil ditambahkan!" );
        return redirect()->route( 'posyandu.pengurus' );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pengurus = PosyanduPengurus::find( $id );
        return view( 'posyandu.pengurus.show', compact( 'pengurus' ) );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pengurus = PosyanduPengurus::find( $id );
        $posyandu = PosyanduData::orderBy( 'nama', 'asc' )->get();
        return view( 'pages.posyandu.pengurus.edit', compact( 'pengurus', 'posyandu' ) );
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
        $pengurusUpdate = Request::all();
        $pengurus = PosyanduPengurus::find( $id );
        $pengurus->update( $pengurusUpdate );
        Session::flash( 'success', "Data pengurus berhasil diperbarui!" );
        return redirect()->route( 'posyandu.pengurus' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PosyanduPengurus::find( $id )->delete();
        Session::flash( 'success', "Data pengurus berhasil dihapus!" );
        return redirect()->route( 'posyandu.pengurus' );
    }
}
