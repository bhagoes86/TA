<?php

namespace App\Http\Controllers;

use Request;
use Session;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\PosyanduAbsen;
use App\PosyanduBalita;
use App\PosyanduData;

class PosyanduAbsenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $absen = PosyanduAbsen::join( 'posyandu_balita', 'posyandu_absen.id_balita', '=', 'posyandu_balita.id' )
                 ->join( 'posyandu_data', 'posyandu_absen.id_posyandu', '=', 'posyandu_data.id' )
                 ->select( 'posyandu_absen.*', 'posyandu_balita.nama as nama_balita', 'posyandu_data.nama as nama_posyandu' )
                 ->get();
        return view( 'pages.posyandu.absen.index', compact( 'absen' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $balita = PosyanduBalita::orderBy( 'nama', 'asc' )->get();
        // $balita = PosyanduBalita::selcet(  )->get();
        // $posyandu = PosyanduData::orderBy( 'nama', 'asc' )->get();
        return view( 'pages.posyandu.absen.create', compact( 'balita') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $absen = Request::all();
        PosyanduAbsen::create( $absen );
        Session::flash( 'success', "Data absen baru berhasil ditambahkan!" );
        return redirect()->route( 'posyandu.absen' );
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
        $absen = PosyanduAbsen::find( $id );
        $balita = PosyanduBalita::orderBy( 'nama', 'asc' )->get();
        $posyandu = PosyanduData::orderBy( 'nama', 'asc' )->get();
        return view( 'pages.posyandu.absen.edit', compact( 'absen', 'balita', 'posyandu' ) );
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
        $absenUpdate = Request::all();
        $absen = PosyanduAbsen::find( $id );
        $absen->update( $absenUpdate );
        Session::flash( 'success', "Data absen berhasil diperbarui!" );
        return redirect()->route( 'posyandu.absen' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PosyanduAbsen::find( $id )->delete();
        Session::flash( 'success', "Data absen berhasil dihapus!" );
        return redirect()->route( 'posyandu.absen' );
    }
}
