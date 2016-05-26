<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Session;

use App\PkkNotulensi;

class PkkNotulensiController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function create( $id )
    {
        $data = [];
        $data['id_kegiatan'] = $id;

        return view( 'pages.pkk.pengurus.notulensi.create', compact( 'data' ) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        PkkNotulensi::create( $request->all() );
        Session::flash( 'success', "Data notulensi baru berhasil ditambahkan!" );
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
        $data['content'] = PkkNotulensi::find( $id );

        return view( 'pages.pkk.pengurus.notulensi.edit', compact( 'data' ) );
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
        PkkNotulensi::find( $id )->update( $request->all() );
        Session::flash( 'success', "Data notulensi berhasil dirubah!" );
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
        PkkNotulensi::find( $id )->delete();
        Session::flash( 'success', "Data notulensi berhasil dihapus!" );
        return redirect()->route( 'pkk.kegiatan.index' );
    }
}
