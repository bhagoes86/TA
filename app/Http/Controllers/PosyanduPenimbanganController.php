<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\PosyanduPenimbanganRequest;
use App\Http\Controllers\Controller;

use Session;
use Auth;

use App\PosyanduPenimbangan;
use App\PosyanduBalita;
use App\PosyanduData;

class PosyanduPenimbanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penimbangan = PosyanduPenimbangan::orderBy( 'created_at' , 'desc' )
                        ->join( 'posyandu_balita', 'posyandu_penimbangan.id_balita', '=', 'posyandu_balita.id' )
                        ->select( 'posyandu_penimbangan.*', 'posyandu_balita.nama', 'posyandu_balita.id_posyandu' )
                        ->where( 'posyandu_balita.id_posyandu' , '=' , Auth::user()->id_posyandu )
                        ->get();
        return view( 'pages.posyandu.penimbangan.index', compact( 'penimbangan' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $balita = PosyanduBalita::find( $id );
        return view( 'pages.posyandu.penimbangan.create', compact( 'balita' ) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PosyanduPenimbanganRequest $request)
    {
        $penimbangan = $request->all();

        $periksaPenimbangan = PosyanduPenimbangan::select( 'id' )
                        ->where( 'posyandu_penimbangan.id_balita' , $penimbangan['id_balita'])
                        ->where( 'posyandu_penimbangan.umur' , $penimbangan['umur'] )
                        ->get()->first();
        if($periksaPenimbangan == NULL)
        {
            PosyanduPenimbangan::create( $penimbangan );
            $penimbangan = PosyanduPenimbangan::orderBy( 'created_at' , 'desc')->get()->first();
            Session::flash( 'success', "Data Penimbangan baru berhasil ditambahkan!" );
            return redirect()->route( 'posyandu.balita.show' , $penimbangan['id_balita'] );
        }        
        else
        {
            Session::flash( 'warning', "Data pada usia penimbangan yang dipilih sudah ada!" );
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
        $penimbangan = PosyanduPenimbangan::join( 'posyandu_balita', 'posyandu_penimbangan.id_balita', '=', 'posyandu_balita.id' )
                       ->select( 'posyandu_penimbangan.*', 'posyandu_balita.nama', 'posyandu_balita.no_kk' )
                       ->where( 'posyandu_penimbangan.id', $id )
                       ->first();
        return view( 'posyandu.penimbangan.show', compact( 'penimbangan' ) );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $penimbangan = PosyanduPenimbangan::find( $id );
        $balita = PosyanduBalita::orderBy( 'nama', 'asc' )->get();
        $posyandu = PosyanduData::orderBy( 'nama', 'asc' )->get();
        return view( 'pages.posyandu.penimbangan.edit', compact( 'penimbangan', 'balita', 'posyandu' ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PosyanduPenimbanganRequest $request, $id)
    {
        $penimbanganUpdate = $request->all();

        $periksaPenimbangan = PosyanduPenimbangan::select( 'id' )
                        ->where( 'posyandu_penimbangan.id_balita' , $penimbanganUpdate['id_balita'])
                        ->where( 'posyandu_penimbangan.umur' , $penimbanganUpdate['umur'] )
                        ->get()->first();

        if($periksaPenimbangan == NULL || $periksaPenimbangan['id'] == $id)
        {
            $penimbangan = PosyanduPenimbangan::find( $id );
            $penimbangan->update( $penimbanganUpdate );
            $penimbangan = PosyanduPenimbangan::orderBy( 'updated_at' , 'desc')->get()->first();
            Session::flash( 'success', "Data penimbangan berhasil diperbarui!" );
            return redirect()->route( 'posyandu.balita.show' , $penimbangan->id_balita );
        }        
        else
        {
            Session::flash( 'warning', "Data pada usia penimbangan yang dipilih sudah ada!" );
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
        $penimbangan = PosyanduPenimbangan::find($id);
        PosyanduPenimbangan::find( $id )->delete();
        Session::flash( 'success', "Data penimbangan berhasil dihapus!" );
        return redirect()->route( 'posyandu.balita.show' , $penimbangan->id_balita );
    }

    /**
     * Filter data.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function find(Request $request)
    {
        $data = Request::all();

        if ( $data['id_pos'] == "" && $data['tanggal'] == "" ) {
            return redirect( 'posyandu/penimbangan' );
        }
        else if ( $data['id_pos'] != "" && $data['tanggal'] == "" ) {
            $penimbangan = PosyanduPenimbangan::join( 'posyandu_balita', 'posyandu_penimbangan.id_balita', '=', 'posyandu_balita.id' )
                           ->select( 'posyandu_penimbangan.*', 'posyandu_balita.nama', 'posyandu_balita.no_kk' )
                           ->where( 'id_pos', $data['id_pos'] )
                           ->get();
        }
        else if ( $data['id_pos'] == "" && $data['tanggal'] != "" ) {
            $penimbangan = PosyanduPenimbangan::join( 'posyandu_balita', 'posyandu_penimbangan.id_balita', '=', 'posyandu_balita.id' )
                           ->select( 'posyandu_penimbangan.*', 'posyandu_balita.nama', 'posyandu_balita.no_kk' )
                           ->where( 'tanggal', $data['tanggal'] )
                           ->get();
        }
        else {
            $penimbangan = PosyanduPenimbangan::join( 'posyandu_balita', 'posyandu_penimbangan.id_balita', '=', 'posyandu_balita.id' )
                           ->select( 'posyandu_penimbangan.*', 'posyandu_balita.nama', 'posyandu_balita.no_kk' )
                           ->where( ['tanggal' => $data['tanggal'], 'id_pos' => $data['id_pos']] )
                           ->get();
        }

        $posyandu = PosyanduData::orderBy( 'nama', 'asc' )->get();
        return view( 'posyandu.penimbangan.index', compact( 'penimbangan', 'posyandu' ) );
    }
}
