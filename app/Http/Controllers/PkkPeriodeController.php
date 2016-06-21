<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\PkkPeriodeRequest;
use App\Http\Controllers\Controller;

use Auth;
use Session;

use App\PkkPeriode;

class PkkPeriodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $data['content'] = PkkPeriode::orderBy( 'tahun_mulai' )->where( 'id_pkk', Auth::user()->id_pkk )->get();

        return view( 'pages.pkk.pengurus.periode.index', compact( 'data' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];

        return view( 'pages.pkk.pengurus.periode.create', compact( 'data' ) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request\PkkPeriodeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PkkPeriodeRequest $request)
    {
        PkkPeriode::create( [
            'id_pkk'        => Auth::user()->id_pkk,
            'tahun_mulai'   => $request->tahun_mulai,
            'tahun_selesai' => $request->tahun_selesai,
        ] );
        Session::flash( 'success', "Periode kepengurusan baru berhasil ditambahkan!" );
        return redirect()->route( 'pkk.periode.index' );
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
        $data['content'] = PkkPeriode::find( $id );

        return view( 'pages.pkk.pengurus.periode.edit', compact( 'data' ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request\PkkPeriodeRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PkkPeriodeRequest $request, $id)
    {
        PkkPeriode::find( $id )->update( $request->all() );
        Session::flash( 'success', "Periode kepengurusan PKK berhasil dirubah!" );
        return redirect()->route( 'pkk.periode.index' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PkkPeriode::find( $id )->delete();
        Session::flash( 'success', "Periode kepengurusan PKK berhasil dihapus!" );
        return redirect()->route( 'pkk.periode.index' );
    }
}
