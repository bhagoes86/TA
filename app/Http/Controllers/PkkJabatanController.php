<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\PkkJabatanRequest;
use App\Http\Controllers\Controller;

use Auth;
use Session;

use App\PkkJabatan;

class PkkJabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $data['content'] = PkkJabatan::orderBy( 'nama' )->get();

        return view( 'pages.pkk.pengurus.jabatan.index', compact( 'data' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];

        return view( 'pages.pkk.pengurus.jabatan.create', compact( 'data' ) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request\PkkJabatanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PkkJabatanRequest $request)
    {
        PkkJabatan::create( [
            'id_pkk'    => Auth::user()->id_pkk,
            'nama'      => $request->nama,
            'deskripsi' => $request->deskripsi,
        ] );
        Session::flash( 'success', "Jabatan baru berhasil ditambahkan!" );
        return redirect()->route( 'pkk.jabatan.index' );
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
        $data['content'] = PkkJabatan::find( $id );

        return view( 'pages.pkk.pengurus.jabatan.edit', compact( 'data' ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request\PkkJabatanRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PkkJabatanRequest $request, $id)
    {
        PkkJabatan::find( $id )->update( $request->all() );
        Session::flash( 'success', "Jabatan kepengurusan PKK berhasil dirubah!" );
        return redirect()->route( 'pkk.jabatan.index' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PkkJabatan::find( $id )->delete();
        Session::flash( 'success', "Jabatan kepengurusan PKK berhasil dihapus!" );
        return redirect()->route( 'pkk.jabatan.index' );
    }
}
