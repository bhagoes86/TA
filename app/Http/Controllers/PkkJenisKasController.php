<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use Session;

use App\PkkJenisKas;

class PkkJenisKasController extends Controller
{
    /**
     * Display a listing of contribution type.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $data['pemasukan'] = PkkJenisKas::where( 'jenis', '1' )->orderBy( 'nama' )->get();
        $data['pengeluaran'] = PkkJenisKas::where( 'jenis', '0' )->orderBy( 'nama' )->get();

        return view( 'pages.pkk.pengurus.jeniskas.index', compact( 'data' ) );
    }

    /**
     * Show the form for createing a new contribution type.
     *
     * @param  character $type      0 = pengeluaran, 1 = pemasukan
     * @return \Illuminate\Http\Response
     */
    public function create( $type )
    {
        $data = [];
        $data['type'] = $type;

        return view( 'pages.pkk.pengurus.jeniskas.create', compact( 'data' ) );
    }

    /**
     * Store a newly created income contribution type in storage.
     *
     * @param  \Illuminate\Http\Request   $request
     * @param  character                  $type      0 = pengeluaran, 1 = pemasukan
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request, $type )
    {
        PkkJenisKas::create( [
            'id_pkk'    => Auth::user()->id_pkk,
            'jenis'     => $type,
            'nama'      => $request->nama,
        ] );
        Session::flash( 'success', "Jenis iuran ".( $type ? "pemasukan" : "pengeluaran" )." baru berhasil ditambahkan!" );
        return redirect()->route( 'pkk.jeniskas' );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [];
        $data['content'] = PkkJenisKas::find( $id );

        return view( 'pages.pkk.pengurus.jeniskas.edit', compact( 'data' ) );
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
        PkkJenisKas::find( $id )->update( $request->all() );
        Session::flash( 'success', "Data jenis iuran berhasil dirubah!" );
        return redirect()->route( 'pkk.jeniskas' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PkkJenisKas::find( $id )->delete();
        Session::flash( 'success', "Data jenis iuran berhasil dihapus!" );
        return redirect()->route( 'pkk.jeniskas' );
    }
}
