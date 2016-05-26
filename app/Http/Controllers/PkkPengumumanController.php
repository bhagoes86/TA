<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use Session;

use App\PkkPengumuman;

class PkkPengumumanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $data['content'] = PkkPengumuman::orderBy( 'created_at', 'desc' )->get();

        return view( 'pages.pkk.pengurus.pengumuman.index', compact( 'data' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];

        return view( 'pages.pkk.pengurus.pengumuman.create', compact( 'data' ) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        PkkPengumuman::create( [
            'id_pkk'    => Auth::user()->id_pkk,
            'judul'     => $request->judul,
            'isi'       => $request->isi,
            'link'      => $request->link,
        ] );
        Session::flash( 'success', "Data pengumuman baru berhasil ditambahkan!" );
        return redirect()->route( 'pkk.pengumuman.index' );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = [];
        $data['content'] = PkkPengumuman::find( $id );

        return view( 'pages.pkk.pengurus.pengumuman.show', compact( 'data' ) );
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
        $data['content'] = PkkPengumuman::find( $id );

        return view( 'pages.pkk.pengurus.pengumuman.edit', compact( 'data' ) );
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
        PkkPengumuman::find( $id )->update( $request->all() );
        Session::flash( 'success', "Data pengumuman berhasil dirubah!" );
        return redirect()->route( 'pkk.pengumuman.index' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PkkPengumuman::find( $id )->delete();
        Session::flash( 'success', "Data pengumuman berhasil dihapus!" );
        return redirect()->route( 'pkk.pengumuman.index' );
    }
}
