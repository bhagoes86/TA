<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\PkkKasRequest;
use App\Http\Controllers\Controller;

use Auth;
use Session;

use App\PkkIbu;
use App\PkkKas;
use App\PkkJenisKas;

class PkkKasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $data['pemasukan'] = PkkKas::with( 'ibu', 'jenis_kas' )->whereHas( 'jenis_kas', function ( $q ) {
            $q->where( 'jenis', '1' );
        } )->orderBy( 'created_at', 'desc' )->get();
        $data['pengeluaran'] = PkkKas::with( 'ibu', 'jenis_kas' )->whereHas( 'jenis_kas', function ( $q ) {
            $q->where( 'jenis', '0' );
        } )->orderBy( 'created_at', 'desc' )->get();

        return view( 'pages.pkk.pengurus.kas.index', compact( 'data' ) );
    }

    /**
     * Show the form for createing a new contribution.
     *
     * @param  character $type      0 = pengeluaran, 1 = pemasukan
     * @return \Illuminate\Http\Response
     */
    public function create( $type )
    {
        $data = [];
        $data['type'] = $type;
        $data['anggota'] = PkkIbu::where( 'id_pkk', Auth::user()->id_pkk )->orderBy( 'nama' )->lists( 'nama', 'id' )->toArray();
        $data['jeniskas'] = PkkJenisKas::where( 'id_pkk', Auth::user()->id_pkk )->where( 'jenis', $type )->lists( 'nama', 'id' )->toArray();

        if ( !$data['anggota'] && $type ) {
            Session::flash( 'info', "Belum ada anggota PKK yang terdaftar, mohon untuk menambahkan anggota PKK anda terlebih dahulu" );
            return redirect()->route( 'pkk.ibu.create' );
        }
        if ( !$data['jeniskas'] ) {
            Session::flash( 'info', "PKK anda belum menambahkan data jenis iuran ini, mohon untuk menambahkan data jenis iuran baru terlebih dahulu" );
            return redirect()->route( 'pkk.jeniskas.create', $type );
        }

        return view( 'pages.pkk.pengurus.kas.create', compact( 'data' ) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request\PkkKasRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store( PkkKasRequest $request, $type )
    {
        PkkKas::create( [
            'id_ibu'        => $request->id_ibu,
            'id_jenis_kas'  => $request->id_jenis_kas,
            'id_pkk'        => Auth::user()->id_pkk,
            'nominal'       => $request->nominal,
        ] );
        Session::flash( 'success', "Data iuran ".( $type ? "pemasukan" : "pengeluaran" )." baru berhasil ditambahkan!" );
        return redirect()->route( 'pkk.kas' );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $type, $id )
    {
        $data = [];
        $data['content'] = PkkKas::find( $id );
        $data['type'] = $type;
        $data['anggota'] = PkkIbu::where( 'id_pkk', Auth::user()->id_pkk )->lists( 'nama', 'id' )->toArray();
        $data['jeniskas'] = PkkJenisKas::where( 'id_pkk', Auth::user()->id_pkk )->where( 'jenis', $type )->lists( 'nama', 'id' )->toArray();

        return view( 'pages.pkk.pengurus.kas.edit', compact( 'data' ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request\PkkKasRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PkkKasRequest $request, $id)
    {
        PkkKas::find( $id )->update( [
            'id_ibu'        => $request->id_ibu,
            'id_jenis_kas'  => $request->id_jenis_kas,
            'id_pkk'        => Auth::user()->id_pkk,
            'nominal'       => $request->nominal,
        ] );
        Session::flash( 'success', "Data iuran berhasil dirubah!" );
        return redirect()->route( 'pkk.kas' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PkkKas::find( $id )->delete();
        Session::flash( 'success', "Data iuran berhasil dihapus!" );
        return redirect()->route( 'pkk.kas' );
    }
}
