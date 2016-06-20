<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\PosyanduIbuRequest;
use App\Http\Controllers\Controller;

use Auth;
use Session;

use App\PosyanduIbu;
use App\PosyanduData;
use App\PosyanduBalita;

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
         return view( 'pages.posyandu.ibu.index', compact( 'ibu' ) );
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
    public function store(PosyanduIbuRequest $request)
    {
        $ibu = $request->all();
        PosyanduIbu::create( $ibu );
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
    public function update(PosyanduIbuRequest $request, $id)
    {
        $ibuUpdate = $request->all();
        $ibu = PosyanduIbu::find( $id );
   
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

        $ibu = PosyanduIbu::orderBy( 'created_at' , 'desc' )->get()->first();
        Session::flash( 'success', "Data Ibu berhasil diperbarui!" );
        return redirect()->route( 'posyandu.ibu.show' , $ibu['id'] );
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
