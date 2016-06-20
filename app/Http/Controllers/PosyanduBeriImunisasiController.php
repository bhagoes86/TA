<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\PosyanduBeriImunisasiRequest;
use App\Http\Controllers\Controller;

use Auth;
use Session;

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
    public function store(PosyanduBeriImunisasiRequest $request)
    {
        $beriimunisasi = $request->all();
        $periksaImunisasi = PosyanduBeriImunisasi::select( 'id' )
                        ->where( 'posyandu_pemberian_imunisasi.id_balita' , $beriimunisasi['id_balita'])
                        ->where( 'posyandu_pemberian_imunisasi.id_imunisasi' , $beriimunisasi['id_imunisasi'] )
                        ->get()->first();

        if($periksaImunisasi == NULL)
        {
            PosyanduBeriImunisasi::create( $beriimunisasi );
            $beriimunisasi = PosyanduBeriImunisasi::orderBy( 'created_at' , 'desc')->get()->first();
            Session::flash( 'success', "Data pemberian imunisasi baru berhasil ditambahkan!" );
            return redirect()->route( 'posyandu.balita.show' , $beriimunisasi['id_balita'] );
        }        
        else
        {
            Session::flash( 'warning', "Data pada jenis imunisasi yang dipilih sudah ada!" );
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
    public function update(PosyanduBeriImunisasiRequest $request, $id)
    {
        $beriimunisasiUpdate = $request->all();
       
        $periksaImunisasi = PosyanduBeriImunisasi::select( 'id' )
                        ->where( 'posyandu_pemberian_imunisasi.id_balita' , $beriimunisasiUpdate['id_balita'])
                        ->where( 'posyandu_pemberian_imunisasi.id_imunisasi' , $beriimunisasiUpdate['id_imunisasi'] )
                        ->get()->first();
                        
        if($periksaImunisasi == NULL || $periksaImunisasi['id'] == $id)
        {
            $beriimunisasi = PosyanduBeriImunisasi::find( $id );
            $beriimunisasi->update( $beriimunisasiUpdate );
            $beriimunisasi = PosyanduBeriImunisasi::orderBy( 'updated_at' , 'desc')->get()->first();
            Session::flash( 'success', "Data pemberian kapsul berhasil diperbarui!" );
            return redirect()->route( 'posyandu.balita.show' , $beriimunisasi->id_balita );
        }        
        else
        {
            Session::flash( 'warning', "Data pada jenis imunisasi yang dipilih sudah ada!" );
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
        $imunisasi = PosyanduBeriImunisasi::find($id);
        PosyanduBeriImunisasi::find( $id )->delete();
        Session::flash( 'success', "Data pemberian imunisasi berhasil dihapus!" );
        return redirect()->route( 'posyandu.balita.show' , $imunisasi->id_balita );
    }
}
