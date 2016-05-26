<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use Session;

use App\PkkKegiatan;

class PkkKegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $data['content'] = PkkKegiatan::with( 'notulensi' )->orderBy( 'tanggal', 'desc' )->get();

        return view( 'pages.pkk.pengurus.kegiatan.index', compact( 'data' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];

        return view( 'pages.pkk.pengurus.kegiatan.create', compact( 'data' ) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        PkkKegiatan::create( [
            'id_pkk'    => Auth::user()->id_pkk,
            'nama'      => $request->nama,
            'tanggal'   => $request->tanggal,
        ] );
        Session::flash( 'success', "Kegiatan baru berhasil ditambahkan!" );
        return redirect()->route( 'pkk.kegiatan.index' );
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
        $data['content'] = PkkKegiatan::find( $id );

        return view( 'pages.pkk.pengurus.kegiatan.edit', compact( 'data' ) );
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
        PkkKegiatan::find( $id )->update( $request->all() );
        Session::flash( 'success', "Data kegiatan berhasil dirubah!" );
        return redirect()->route( 'pkk.kegiatan.index' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PkkKegiatan::find( $id )->delete();
        Session::flash( 'success', "Data kegiatan berhasil dihapus!" );
        return redirect()->route( 'pkk.kegiatan.index' );
    }
}
