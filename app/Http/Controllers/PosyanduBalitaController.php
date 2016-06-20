<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\PosyanduBalitaRequest;
use App\Http\Controllers\Controller;

use Auth;
use Session;

use App\PosyanduBalita;
use App\PosyanduIbu;
use App\PosyanduBeriImunisasi;
use App\PosyanduKapsul;
use App\PosyanduPenimbangan;
use App\PosyanduData;

class PosyanduBalitaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $balita = PosyanduBalita::all();
        $ibu = PosyanduIbu::orderBy( 'nama', 'asc' )->get();
        return view( 'pages.posyandu.balita.index', compact( 'balita', 'ibu' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $ibu = PosyanduIbu::find( $id );
        return view( 'pages.posyandu.balita.create', compact( 'ibu' ) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PosyanduBalitaRequest $request)
    {
        $data = $request->all();
        PosyanduBalita::create( $data );

        $lastBalita = PosyanduBalita::select('id')->orderBy('created_at', 'desc')->first();

        PosyanduPenimbangan::create( [
            'id_balita' => $lastBalita->id,
            'umur' => $data['umur'],
            'tanggal' => $data['tanggal_lahir'],
            'berat' => $data['bb_lahir'],
            'tinggi' => $data['tb_lahir'],
            'ntob' => 'B',
            'asi' => isset( $data['asi'] ) ? $data['asi'] : '',
        ] );

        Session::flash( 'success', "Data Balita baru berhasil ditambahkan!" );
        return redirect()->route( 'posyandu.ibu.show' , $data['id_ibu'] );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $balita = PosyanduBalita::join( 'posyandu_ibu', 'posyandu_balita.id_ibu', '=', 'posyandu_ibu.id' )
                  ->select( 'posyandu_balita.*', 'posyandu_ibu.nama as nama_ibu' )
                  ->where( 'posyandu_balita.id', $id )
                  ->first();
        $beriimunisasi = PosyanduBeriImunisasi::where( 'id_balita', $id )
                        ->join( 'posyandu_imunisasi', 'posyandu_pemberian_imunisasi.id_imunisasi', '=' , 'posyandu_imunisasi.id')
                        ->select( 'posyandu_pemberian_imunisasi.*' , 'posyandu_imunisasi.jenis' , 'posyandu_imunisasi.umur')
                        ->get();
        $kapsul = PosyanduKapsul::where( 'id_balita', $id )->get();
        $penimbangan = PosyanduPenimbangan::orderBy( 'umur', 'asc' )
                                            ->where( 'id_balita', $id )
                                            ->get();
        return view( 'pages.posyandu.balita.show', compact( 'balita', 'beriimunisasi', 'kapsul', 'penimbangan' ) );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $balita = PosyanduBalita::join( 'posyandu_penimbangan', 'posyandu_balita.id', '=', 'posyandu_penimbangan.id_balita' )
                  ->select( 'posyandu_balita.*', 'posyandu_penimbangan.asi as asi' )
                  ->where( 'posyandu_balita.id', $id )
                  ->first();
        $ibu = PosyanduIbu::orderBy( 'nama', 'asc' )->get();
        $posyandu = PosyanduData::orderBy( 'nama' , 'asc' )->get();
        return view( 'pages.posyandu.balita.edit', compact( 'balita', 'ibu' , 'posyandu' ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PosyanduBalitaRequest $request, $id)
    {
        $balitaUpdate = $request->all();
        $balita = PosyanduBalita::find( $id );
        $balita->update( $balitaUpdate );

        $penimbangan = PosyanduPenimbangan::select('posyandu_penimbangan.id')->where('posyandu_penimbangan.id_balita' , $id)->first();
        $penimbangan->update($balitaUpdate);

        Session::flash( 'success', "Data Balita berhasil diperbarui!" );
        return redirect()->route( 'posyandu.balita.show' , $id );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $balita = PosyanduBalita::find( $id );
        $balita->delete();
        Session::flash( 'success', "Data Balita berhasil dihapus!" );
        return redirect()->route( 'posyandu.ibu.show' , $balita->id_ibu );
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
        if ( $data['no_ktp'] == "" ) {
            return redirect( 'posyandu/balita' );
        }
        else {
            $balita = PosyanduBalita::where( 'no_ktp', $data['no_ktp'] )->get();
        }
        $ibu = PosyanduIbu::orderBy( 'nama', 'asc' )->get();
        return view( 'posyandu.balita.index', compact( 'balita', 'ibu' ) );
    }
}
