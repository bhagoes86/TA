<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Session;

use App\PkkKeluhan;
use App\PkkKomentar;

class PkkKeluhanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $data['content'] = PkkKeluhan::with( 'ibu' )->orderBy( 'created_at', 'desc' )->get();

        return view( 'pages.pkk.pengurus.keluhan.index', compact( 'data' ) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        PkkKomentar::create( [
            'id_ibu'        => 0,
            'id_keluhan'    => $id,
            'isi'           => $request->isi,
        ] );
        Session::flash( 'success', "Komentar berhasil disimpan" );
        return redirect()->route( 'pkk.keluhan.show', $id );
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
        $data['content'] = PkkKeluhan::with( 'komentar' )->where( 'id', $id )->first();

        return view( 'pages.pkk.pengurus.keluhan.show', compact( 'data' ) );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $keluhan = PkkKeluhan::find( $id );

        PkkKomentar::where( 'id_keluhan', $keluhan->id )->delete();
        $keluhan->delete();

        Session::flash( 'success', "Data keluhan berhasil dihapus" );
        return redirect()->route( 'pkk.keluhan.index' );
    }
}
