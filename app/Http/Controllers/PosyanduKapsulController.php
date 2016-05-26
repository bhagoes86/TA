<?php

namespace App\Http\Controllers;

use Request;
use Session;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\PosyanduKapsul;
use App\PosyanduData;
use App\PosyanduBalita;

class PosyanduKapsulController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kapsul = PosyanduKapsul::orderBy( 'created_at', 'desc' )
                        ->join( 'posyandu_balita', 'posyandu_pemberian_kapsul.id_balita', '=', 'posyandu_balita.id' )
                        ->select( 'posyandu_pemberian_kapsul.*', 'posyandu_balita.nama' )
                        ->where( 'posyandu_balita.id_posyandu' , '=' , Auth::user()->id_posyandu )
                        ->get();
        return view( 'pages.posyandu.kapsul.index' , compact( 'kapsul' ));
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
        return view( 'pages.posyandu.kapsul.create', compact( 'posyandu', 'balita' ) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $kapsul = Request::all();
        if($kapsul['umur'] == NULL)
        {
            Session::flash( 'warning', "Data umur pemberian kapsul harus diisi!" );
            return redirect()->back();
        }
        PosyanduKapsul::create( $kapsul );
        $kapsul = PosyanduKapsul::orderBy( 'created_at' , 'desc')->get()->first();
        Session::flash( 'success', "Data pemberian kapsul baru berhasil ditambahkan!" );
        return redirect()->route( 'posyandu.balita.show' , $kapsul['id_balita'] );
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
        $kapsul = PosyanduKapsul::find( $id );
        $posyandu = PosyanduData::orderBy( 'nama', 'asc' )->get();
        $balita = PosyanduBalita::orderBy( 'nama', 'asc' )->get();
        return view( 'pages.posyandu.kapsul.edit', compact( 'kapsul', 'posyandu', 'balita' ) );
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
        $kapsulUpdate = Request::all();
        if($kapsulUpdate['umur'] == NULL)
        {
            Session::flash( 'warning', "Data umur pemberian kapsul harus diisi!" );
            return redirect()->back();
        }
        $kapsul = PosyanduKapsul::find( $id );
        $kapsul->update( $kapsulUpdate );
        $kapsul = PosyanduKapsul::orderBy( 'updated_at' , 'desc')->get()->first();
        Session::flash( 'success', "Data pemberian kapsul berhasil diperbarui!" );
        return redirect()->route( 'posyandu.balita.show' , $kapsul->id_balita );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kapsul = PosyanduKapsul::find($id)->get()->first();
        PosyanduKapsul::find( $id )->delete();
        Session::flash( 'success', "Data pemberian kapsul berhasil dihapus!" );
        return redirect()->route( 'posyandu.balita.show' , $kapsul->id_balita );
    }
}
