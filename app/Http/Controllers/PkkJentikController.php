<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\PkkJentikFilterRequest;
use App\Http\Controllers\Controller;

use Auth;
use Session;

use App\PkkIbu;
use App\PkkJentik;

class PkkJentikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $data['content'] = [];
        $data['request'] = [];
        $data['anggota'] = PkkIbu::where( 'id_pkk', Auth::user()->id_pkk )->orderBy( 'nama' )->lists( 'nama', 'id' )->toArray();

        return view( 'pages.pkk.pengurus.jentik.index', compact( 'data' ) );
    }

    public function indexPost( PkkJentikFilterRequest $request )
    {
        $data = [];
        $data['content'] = [];
        $data['anggota'] = PkkIbu::where( 'id_pkk', Auth::user()->id_pkk )->orderBy( 'nama' )->lists( 'nama', 'id' )->toArray();
        $data['request'] = $request->all();

        $jentik = PkkJentik::where( 'id_ibu', $request->id_ibu )->where( 'tahun_data', $request->year )->get();
        for ( $i = 1; $i <= 12; $i++ ) {
            $data['content'][$i] = 0;
        }
        foreach ( $jentik as $row ) {
            $data['content'][$row->bulan_data] = $row->jumlah;
        }

        return view( 'pages.pkk.pengurus.jentik.index', compact( 'data' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $month, $id_ibu, $year )
    {
        $data = [];
        $jentik = PkkJentik::where( 'bulan_data', $month )->where( 'id_ibu', $id_ibu )->where( 'tahun_data', $year )->first();

        if ( !$jentik ) {
            $data['content'] = [
                'id'            => 0,
                'id_ibu'        => $id_ibu,
                'jumlah'        => 0,
                'bulan_data'    => $month,
                'tahun_data'    => $year,
            ];
        }
        else {
            $data['content'] = [
                'id'            => $jentik->id,
                'id_ibu'        => $jentik->id_ibu,
                'jumlah'        => $jentik->jumlah,
                'bulan_data'    => $jentik->bulan_data,
                'tahun_data'    => $jentik->tahun_data,
            ];
        }

        return view( 'pages.pkk.pengurus.jentik.edit', compact( 'data' ) );
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
        if ( $id == 0 ) {
            PkkJentik::create( $request->all() );
            Session::flash( 'success', "Data jentik nyamuk baru berhasil ditambahkan!" );
            return redirect()->route( 'pkk.jentik.index' );
        }
        else {
            $jentik = PkkJentik::find( $id );

            if ( $request->jumlah == 0 ) {
                $jentik->delete();
                Session::flash( 'success', "Data jentik nyamuk berhasil dihapus!" );
            }
            else {
                $jentik->update( ['jumlah' => $request->jumlah] );
                Session::flash( 'success', "Data jentik nyamuk berhasil dirubah!" );
            }

            return redirect()->route( 'pkk.jentik.index' );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $month, $id_ibu, $year )
    {
        PkkJentik::where( 'bulan_data', $month )->where( 'id_ibu', $id_ibu )->where( 'tahun_data', $year )->first()->delete();
        Session::flash( 'success', "Data jentik nyamuk berhasil dirubah!" );
        return redirect()->route( 'pkk.jentik.index' );
    }
}
