<?php

namespace App\Http\Controllers;

use Request;
use Session;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Cartalyst\Sentinel\Native\Facades\Sentinel;
use App\PosyanduIbu;
use App\PosyanduData;
use App\PosyanduBalita;
// use App\PosyanduKonjungsiIbuData;

class PosyanduIbuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ibu = PosyanduIbu::all();
        // $konjungsi = PosyanduKonjungsiIbuData::all();
         return view( 'pages.posyandu.ibu.index', compact( 'ibu' ) );
    }

    public function index_akun()
    {
        $ibu = PosyanduIbu::all();
         return view( 'pages.posyandu.akunibu.index', compact( 'ibu' ) );
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $posyandu = PosyanduData::orderBy( 'nama', 'asc' )->get();
        $user = Auth::user();
        return view( 'pages.posyandu.ibu.create', compact( 'posyandu' , 'user' ) );

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ibu = Request::all();
        PosyanduIbu::create( $ibu );
        // $id_ibu = PosyanduIbu::orderBy( 'created_at' , 'desc' )->get()->first();
        // PosyanduKonjungsiIbuData::create( [
        //     'id_posyandu' => $ibu['id_posyandu'],
        //     'id_ibu' => $id_ibu->id
        //     ] );
        Session::flash( 'success', "Data Ibu baru berhasil ditambahkan!" );
        return redirect()->route( 'posyandu.ibu' );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ibu = PosyanduIbu::find( $id );
        $balita = PosyanduBalita::orderBy( 'tanggal_lahir' , 'asc')->where( 'id_ibu' , $id )->get();
        return view( 'pages.posyandu.ibu.show', compact( 'ibu' , 'balita' ) );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ibu = PosyanduIbu::find( $id );
        $user = Auth::user();
        $posyandu = PosyanduData::orderBy( 'nama', 'asc' )->get();

        return view( 'pages.posyandu.ibu.edit', compact( 'ibu' , 'user' , 'posyandu') );
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
        $ibuUpdate = Request::all();
        $ibu = PosyanduIbu::find( $id );
        // $id_konjungsi = PosyanduKonjungsiIbuData::select( 'id' )
        //                 ->where( 'posyandu_konjungsi_ibu_data.id_ibu' , $ibu->id )
        //                 ->where( 'posyandu_konjungsi_ibu_data.id_posyandu' , $ibu->id_posyandu )
        //                 ->get();

        $ibu->update( $ibuUpdate );

        $balita = PosyanduBalita::all();
        foreach($balita as $balitaUpdate)
        {
            $posyandu_ibu = PosyanduIbu::orderBy('id','asc')
                            ->where('id' , $balitaUpdate->id_ibu)
                            ->get()
                            ->first();
            if($balitaUpdate->umur < 60)
            {
                $balitaUpdate->update( [ 'id_posyandu' => $posyandu_ibu->id_posyandu ] );
            }
        }

        Session::flash( 'success', "Data Ibu berhasil diperbarui!" );
        return redirect()->route( 'posyandu.ibu' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PosyanduIbu::find( $id )->delete();
        Session::flash( 'success', "Data Ibu berhasil dihapus!" );
        return redirect()->route( 'posyandu.ibu' );
    }
}
