<?php

namespace App\Http\Controllers;

use Request;
use Session;
use Auth;
use App\Http\Controllers\Controller;
use App\PosyanduBeriImunisasi;
use App\PosyanduData;
use App\PosyanduBalita;
use App\PosyanduImunisasi;

class PosyanduBeriImunisasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $beriimunisasi = PosyanduBeriImunisasi::orderBy( 'created_at', 'desc' )
                        ->join( 'posyandu_imunisasi', 'posyandu_pemberian_imunisasi.id_imunisasi', '=', 'posyandu_imunisasi.id' )
                        ->join( 'posyandu_balita', 'posyandu_pemberian_imunisasi.id_balita', '=', 'posyandu_balita.id' )
                        ->select( 'posyandu_pemberian_imunisasi.*', 'posyandu_imunisasi.jenis', 'posyandu_balita.nama' )
                        ->where( 'posyandu_balita.id_posyandu' , '=' , Auth::user()->id_posyandu )
                        ->get();
        return view( 'pages.posyandu.beriimunisasi.index' , compact( 'beriimunisasi' ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $posyandu = PosyanduData::orderBy( 'nama', 'asc' )->get();
        // $balita = PosyanduBalita::orderBy( 'nama', 'asc' )->get();
        $balita = PosyanduBalita::find( $id );
        $imunisasi = PosyanduImunisasi::orderBy( 'jenis', 'asc' )->get();
        return view( 'pages.posyandu.beriimunisasi.create', compact( 'posyandu', 'balita', 'imunisasi' ) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $beriimunisasi = Request::all();
        if($beriimunisasi['id_imunisasi'] == NULL)
        {
            Session::flash( 'warning', "Data jenis imunisasi harus diisi!" );
            return redirect()->back();
        }
        PosyanduBeriImunisasi::create( $beriimunisasi );
        $imunisasi = PosyanduBeriImunisasi::orderBy( 'created_at' , 'desc')->get()->first();
        Session::flash( 'success', "Data pemberian imunisasi baru berhasil ditambahkan!" );
        return redirect()->route( 'posyandu.balita.show' , $imunisasi['id_balita'] );
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
    public function edit($id)
    {
        $beriimunisasi = PosyanduBeriImunisasi::find( $id );
        $posyandu = PosyanduData::orderBy( 'nama', 'asc' )->get();
        $balita = PosyanduBalita::orderBy( 'nama', 'asc' )->get();
        $imunisasi = PosyanduImunisasi::orderBy( 'jenis', 'asc' )->get();
        return view( 'pages.posyandu.beriimunisasi.edit', compact( 'beriimunisasi', 'posyandu', 'balita', 'imunisasi' ) );
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
        $beriimunisasiUpdate = Request::all();
        if($beriimunisasiUpdate['id_imunisasi'] == NULL)
        {
            Session::flash( 'warning', "Data jenis imunisasi harus diisi!" );
            return redirect()->back();
        }
        $beriimunisasi = PosyanduBeriImunisasi::find( $id );
        $beriimunisasi->update( $beriimunisasiUpdate );
        $imunisasi = PosyanduBeriImunisasi::orderBy( 'updated_at' , 'desc')->get()->first();
        Session::flash( 'success', "Data pemberian imunisasi berhasil diperbarui!" );
        return redirect()->route( 'posyandu.balita.show' , $imunisasi->id_balita );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $imunisasi = PosyanduBeriImunisasi::find($id)->get()->first();
        PosyanduBeriImunisasi::find( $id )->delete();
        Session::flash( 'success', "Data pemberian imunisasi berhasil dihapus!" );
        return redirect()->route( 'posyandu.balita.show' , $imunisasi->id_balita );
    }
}
