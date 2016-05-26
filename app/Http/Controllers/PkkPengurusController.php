<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use Session;

use App\PkkIbu;
use App\PkkJabatan;
use App\PkkPeriode;
use App\PkkPengurus;

class PkkPengurusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $data['content'] = PkkPengurus::with( [ 'ibu', 'periode', 'jabatan' => function ( $q ) {
            $q->where( 'id_pkk', Auth::user()->id_pkk );
        } ] )->get();

        return view( 'pages.pkk.pengurus.pengurus.index', compact( 'data' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id_pkk = Auth::user()->id_pkk;

        $data = [];
        $data['anggota'] = PkkIbu::where( 'id_pkk', $id_pkk )->lists( 'nama', 'id' )->toArray();
        $data['periode'] = PkkPeriode::where( 'id_pkk', $id_pkk )->get()->lists( 'fullPeriod', 'id' )->toArray();
        $data['jabatan'] = PkkJabatan::where( 'id_pkk', $id_pkk )->lists( 'nama', 'id' )->toArray();

        if ( !$data['anggota'] && $type ) {
            Session::flash( 'info', "Belum ada anggota PKK yang terdaftar, mohon untuk menambahkan anggota PKK anda terlebih dahulu" );
            return redirect()->route( 'pkk.jeniskas.create', $type );
        }
        if ( !$data['periode'] ) {
            Session::flash( 'info', "PKK anda belum menambahkan data periode kepengurusan, mohon untuk menambahkan data baru terlebih dahulu" );
            return redirect()->route( 'pkk.periode.create' );
        }
        if ( !$data['jabatan'] ) {
            Session::flash( 'info', "PKK anda belum menambahkan data jabatan kepengurusan, mohon untuk menambahkan data baru terlebih dahulu" );
            return redirect()->route( 'pkk.jabatan.create' );
        }

        return view( 'pages.pkk.pengurus.pengurus.create', compact( 'data' ) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        PkkPengurus::create( $request->all() );
        Session::flash( 'success', "Pengurus baru berhasil ditambahkan!" );
        return redirect()->route( 'pkk.pengurus.index' );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id_pkk = Auth::user()->id_pkk;

        $data = [];
        $data['content'] = PkkPengurus::find( $id );
        $data['anggota'] = PkkIbu::where( 'id_pkk', $id_pkk )->lists( 'nama', 'id' )->toArray();
        $data['periode'] = PkkPeriode::where( 'id_pkk', $id_pkk )->get()->lists( 'fullPeriod', 'id' )->toArray();
        $data['jabatan'] = PkkJabatan::where( 'id_pkk', $id_pkk )->lists( 'nama', 'id' )->toArray();

        return view( 'pages.pkk.pengurus.pengurus.edit', compact( 'data' ) );
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
        PkkPengurus::find( $id )->update( $request->all() );
        Session::flash( 'success', "Data pengurus berhasil dirubah!" );
        return redirect()->route( 'pkk.pengurus.index' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PkkPengurus::find( $id )->delete();
        Session::flash( 'success', "Data pengurus berhasil dihapus!" );
        return redirect()->route( 'pkk.pengurus.index' );
    }
}
