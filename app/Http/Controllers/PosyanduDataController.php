<?php

namespace App\Http\Controllers;

use Request;
use Auth;
use Hash;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use App\PosyanduData;
use App\User;
use App\Role;
use App\Provinsi;
use App\KabupatenKota;
use App\Kecamatan;
use App\DesaKelurahan;

class PosyanduDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posyandu = PosyanduData::all();
        return view( 'pages.posyandu.data.index', compact( 'posyandu' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $kelurahan = DesaKelurahan::find( $id );
        return view( 'pages.posyandu.data.create' , compact( 'kelurahan' ) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $posyandu = Request::all();
        PosyanduData::create( $posyandu );
        $id_pos = PosyanduData::orderBy('id','desc')->get()->first()->id;
        $user = User::create ( [
            'id_posyandu' => $id_pos,
            'username' => $posyandu['username']
        ]);
        $user->password = Hash::make( $posyandu['password'] );
        $user->save();
        $user->roles()->attach( Role::where( 'slug', 'posyandu' )->first()->id );

        Session::flash( 'success', "Data Posyandu baru berhasil ditambahkan!" );
        return redirect()->route( 'posyandu.kelurahan.show' , $id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $posyandu = PosyanduData::find( $id );
        $kelurahan = DesaKelurahan::select()
                    ->where( 'master_desa_kelurahan.id' , $posyandu['kel_id'] )
                    ->get()->first();
        $kecamatan = Kecamatan::select()
                    ->where( 'master_kecamatan.id' , $kelurahan['kec_id'] )
                    ->get()->first();
        $kabupaten = KabupatenKota::select()
                    ->where( 'master_kabupaten_kota.id' , $kecamatan['kab_id'] )
                    ->get()->first();
        $provinsi = Provinsi::select()
                    ->where( 'master_provinsi.id' , $kabupaten['prov_id'] )
                    ->get()->first();
        return view( 'pages.posyandu.data.show', compact( 'posyandu' , 'kelurahan' , 'kecamatan' , 'kabupaten' , 'provinsi' ) );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kelurahan = DesaKelurahan::orderBy( 'nama', 'asc')->get();
        $posyandu = PosyanduData::find( $id );
        return view( 'pages.posyandu.data.edit', compact( 'posyandu' , 'kelurahan' ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $kel_id)
    {
        $posyanduUpdate = Request::all();
        $posyandu = PosyanduData::find( $id );
        $posyandu->update( $posyanduUpdate );

        Session::flash( 'success', "Data posyandu berhasil diperbarui!" );
        return redirect()->route( 'posyandu.kelurahan.show' , $kel_id);
        // return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PosyanduData::find( $id )->delete();
        User::where( 'id_posyandu' , $id)->delete();
        Session::flash( 'success', "Data posyandu berhasil dihapus!" );
        // return redirect()->route( 'posyandu.data' );
        return redirect()->back();
    }
}
