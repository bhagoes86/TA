<?php

namespace App\Http\Controllers;

use Request;
use Auth;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\PosyanduJawabKeluhan;
use App\PosyanduKeluhan;
use App\PosyanduIbu;

class PosyanduKeluhanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $keluhan = PosyanduKeluhan::join( 'posyandu_ibu', 'posyandu_keluhan.id_ibu', '=', 'posyandu_ibu.id' )
                   ->where( 'posyandu_ibu.id_posyandu' ,  Auth::user()->id_posyandu )
                   ->select( 'posyandu_keluhan.*', 'posyandu_ibu.nama', 'posyandu_ibu.id_posyandu' )
                   ->get();
        return view( 'pages.posyandu.keluhan.index', compact( 'keluhan' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view( 'posyandu.keluhan.create' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $keluhan = Request::all();
        // PosyanduKeluhan::create( $keluhan );
        // return redirect( 'posyandu/keluhan' )
        //        ->with( 'status', 'Data Keluhan berhasil disimpan!' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function comment(Request $request, $id)
    {
        $data = Request::all();
        PosyanduJawabKeluhan::create( [
            'id_keluhan' => $id,
            'isi' => $data['komentar'],
            'user' => '1'
        ] );

        $newdata = PosyanduJawabKeluhan::orderBy( 'created_at', 'desc' )
                   ->first();
        
        Session::flash( 'success', "Jawaban keluhan berhasil disimpan!" );
        return redirect()->route( 'posyandu.keluhan.show' , $newdata['id_keluhan'] );
    }

    public function delete_comment(Request $request, $id)
    {
        // $data = Request::all();
        $idkeluhan = PosyanduJawabKeluhan::find( $id )->get()->first();
        PosyanduJawabKeluhan::find( $id )->delete();
        Session::flash( 'success', "Jawaban keluhan berhasil dihapus!" );
        return redirect()->route( 'posyandu.keluhan.show' , $idkeluhan['id_keluhan'] );
    }

    public function edit_comment(Request $request)
    {
        $data = Request::all();
        $idkeluhan = PosyanduJawabKeluhan::find( $data['id'])->get()->first();
        PosyanduJawabKeluhan::find( $data['id'] )->delete();

        return redirect()
               ->action( 'PosyanduKeluhanController@show', [$idkeluhan['id_keluhan']] )
               ->with( 'status', 'Komentar/balasan berhasil dihapus!' );
        dd($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $keluhan = PosyanduKeluhan::join( 'posyandu_ibu', 'posyandu_keluhan.id_ibu', '=', 'posyandu_ibu.id' )
                   ->select( 'posyandu_keluhan.*', 'posyandu_ibu.nama', 'posyandu_ibu.no_ktp' )
                   ->where( 'posyandu_keluhan.id', $id )
                   ->first();
        $komentar = PosyanduJawabKeluhan::where( 'id_keluhan', $id )->get();
        return view( 'pages.posyandu.keluhan.show', compact( 'keluhan', 'komentar' ) );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $keluhan = PosyanduKeluhan::find( $id );
        return view( 'posyandu.keluhan.edit', compact( 'keluhan' ) );
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
        $keluhanUpdate = Request::all();
        $keluhan = PosyanduKeluhan::find( $id );
        $keluhan->update( $keluhanUpdate );
        return redirect( 'posyandu/keluhan' )
               ->with( 'status', 'Data Keluhan berhasil diperbarui!' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PosyanduKeluhan::find( $id )->delete();
        return redirect( 'posyandu/keluhan' )
               ->with( 'status', 'Data Keluhan berhasil dihapus!' );
    }
}
