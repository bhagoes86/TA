<?php

namespace App\Http\Controllers;

use Request;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\PosyanduPengumuman;
use App\PosyanduData;

class PosyanduPengumumanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengumuman = PosyanduPengumuman::join('posyandu_data' , 'posyandu_pengumuman.id_posyandu', '=' , 'posyandu_data.id')
                        ->select( 'posyandu_pengumuman.*' , 'posyandu_data.nama')->get();
        $posyandu = PosyanduData::orderBy( 'nama', 'asc')->get();
        return view( 'pages.posyandu.pengumuman.index', compact( 'pengumuman', 'posyandu'  ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $posyandu = PosyanduData::orderBy( 'nama', 'asc' )->get();
        return view( 'pages.posyandu.pengumuman.create', compact( 'posyandu' ) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = Request::all();
        PosyanduPengumuman::create( [
            'id_posyandu' => $data['id_posyandu'],
            'judul' => $data['judul'],
            'isi' => $data['isi'],
            'link' => $data['link']
        ] );
        Session::flash( 'success', "Data Pengumuman baru berhasil ditambahkan!" );
        return redirect()->route( 'posyandu.pengumuman' );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pengumuman = PosyanduPengumuman::find( $id );
        return view( 'pages.posyandu.pengumuman.show', compact( 'pengumuman') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pengumuman = PosyanduPengumuman::find( $id );
        $posyandu = PosyanduData::orderBy( 'nama', 'asc' )->get();
        return view( 'pages.posyandu.pengumuman.edit', compact( 'pengumuman', 'posyandu' ) );
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
        $pengumumanUpdate = Request::all();
        $pengumuman = PosyanduPengumuman::find( $id );
        $pengumuman->update( $pengumumanUpdate );
        Session::flash( 'success', "Data Pengumuman berhasil diperbarui!" );
        return redirect()->route( 'posyandu.pengumuman' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PosyanduPengumuman::find( $id )->delete();
        Session::flash( 'success', "Data pengumuman berhasil dihapus!" );
        return redirect()->route( 'posyandu.pengumuman' );
    }
}
