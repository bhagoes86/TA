<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\PosyanduKapsulRequest;
use App\Http\Controllers\Controller;

use Auth;
use Session;

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
    public function store(PosyanduKapsulRequest $request)
    {
        $kapsul = $request->all();
        if(($kapsul['umur'] == '6' && $kapsul['jenis'] != 'Kapsul Biru') || ($kapsul['umur'] != '6' && $kapsul['jenis'] == 'Kapsul Biru'))
        {
            Session::flash( 'info', "<b>Kapsul Biru</b> hanya untuk usia 6-11 Bulan" );
            return redirect()->back();  
        }

        $periksaKapsul = PosyanduKapsul::select( 'id' )
                        ->where( 'posyandu_pemberian_kapsul.id_balita' , $kapsul['id_balita'])
                        ->where( 'posyandu_pemberian_kapsul.umur' , $kapsul['umur'] )
                        ->get()->first();

        if($periksaKapsul == NULL)
        {
            PosyanduKapsul::create( $kapsul );
            $kapsul = PosyanduKapsul::orderBy( 'created_at' , 'desc')->get()->first();
            Session::flash( 'success', "Data pemberian kapsul baru berhasil ditambahkan!" );
            return redirect()->route( 'posyandu.balita.show' , $kapsul['id_balita'] );
        }        
        else
        {
            Session::flash( 'warning', "Data pada usia pemberian kapsul yang dipilih sudah ada!" );
            return redirect()->back()->withInput();  
        }
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
    public function update(PosyanduKapsulRequest $request, $id)
    {
        $kapsulUpdate = $request->all();
        if(($kapsulUpdate['umur'] == '6' && $kapsulUpdate['jenis'] != 'Kapsul Biru') || ($kapsulUpdate['umur'] != '6' && $kapsulUpdate['jenis'] == 'Kapsul Biru'))
        {
            Session::flash( 'info', "<b>Kapsul Biru</b> hanya untuk usia 6-11 Bulan" );
            return redirect()->back();  
        }
        $periksaKapsul = PosyanduKapsul::select( 'id' )
                        ->where( 'posyandu_pemberian_kapsul.id_balita' , $kapsulUpdate['id_balita'])
                        ->where( 'posyandu_pemberian_kapsul.umur' , $kapsulUpdate['umur'] )
                        ->get()->first();
        if($periksaKapsul == NULL || $periksaKapsul['id'] == $id)
        {
            $kapsul = PosyanduKapsul::find( $id );
            $kapsul->update( $kapsulUpdate );
            $kapsul = PosyanduKapsul::orderBy( 'updated_at' , 'desc')->get()->first();
            Session::flash( 'success', "Data pemberian kapsul berhasil diperbarui!" );
            return redirect()->route( 'posyandu.balita.show' , $kapsul->id_balita );
        }        
        else
        {
            Session::flash( 'warning', "Data pada usia pemberian kapsul yang dipilih sudah ada!" );
            return redirect()->back();  
        }           
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kapsul = PosyanduKapsul::find($id);
        PosyanduKapsul::find( $id )->delete();
        Session::flash( 'success', "Data pemberian kapsul berhasil dihapus!" );
        return redirect()->route( 'posyandu.balita.show' , $kapsul->id_balita );
    }
}
