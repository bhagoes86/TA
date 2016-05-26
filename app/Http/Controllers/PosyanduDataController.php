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

    /**
     * Register new posyandu
     *
     * @param  Request $request             request data
     * @return \Illuminate\Http\Response
     */
    public function register( Request $request ) {
        // check if any user logged in
        if ( Auth::check() ) {
            Auth::logout();
        }

        if ( $request->step != 6 ) {
            $data = [];

            // check if its first or next step
            $data['step'] = $request->step != null ? $request->step + 1 : 0;

            // boolean if user pick any location
            $user_not_pick = ( ( $request->step == 1 && $request->kab_id == 0 ) || ( $request->step == 2 && $request->kec_id == 0 ) || ( $request->step == 3 && $request->kel_id == 0 ) || ( $request->step == 4 && $request->rw == "" ) );

            // get location data
            $data['location'] = $this->get_location( $data['step'], $request->kel_id ?: $request->kec_id ?: $request->kab_id ?: $request->prov_id ?: 0, $user_not_pick );

            // if no location picked at certain stage then location pick considered done
            $data['step'] = $user_not_pick ? 6 : $data['step'];

            return view( 'pages.posyandu.data.create', compact( 'data' ) );
        }
        else {
            return view( 'pages.posyandu.data.create' , compact( 'data' ) );
        }
    }

    /**
     * get location for each generating page
     *
     * @param  integer $step            current location pick stage
     * @param  integer $id              current/last location ID
     * @param  integer $rw              current RW number
     * @param  integer $rt              current RT number
     * @param  boolean $user_not_pick   flag showing if user picked any location at current stage
     * @return array                    complete location list
     */
    private function get_location( $step, $id, $user_not_pick ) {
        $default = ['0' => "Tidak memilih lokasi"];
        $location = [
            'provinsi' => null,
            'kabupaten' => null,
            'kecamatan' => null,
            'kelurahan' => null,
        ];

        if ( $step == 0 ) {
            $location['provinsi'] = Provinsi::orderBy( 'nama' )->lists( 'nama', 'id' )->toArray();
        }
        else if ( !$user_not_pick ) {
            if ( $step == 1 ) {
                $location['kabupaten'] = $default + KabupatenKota::where( 'prov_id', $id )->orderBy( 'nama' )->lists( 'nama', 'id' )->toArray();
                $location['provinsi'] = Provinsi::find( $id )->get_pair();
            }
            else if ( $step == 2 ) {
                $location['kecamatan'] = $default + Kecamatan::where( 'kab_id', $id )->orderBy( 'nama' )->lists( 'nama', 'id' )->toArray();
                $location['kabupaten'] = KabupatenKota::find( $id );
                $location['provinsi'] = $location['kabupaten']->provinsi->get_pair();
                $location['kabupaten'] = $location['kabupaten']->get_pair();
            }
            else if ( $step == 3 ) {
                $location['kelurahan'] = $default + DesaKelurahan::where( 'kec_id', $id )->orderBy( 'nama' )->lists( 'nama', 'id' )->toArray();
                $location['kecamatan'] = Kecamatan::find( $id );
                $location['kabupaten'] = $location['kecamatan']->kabupaten_kota;
                $location['provinsi'] = $location['kabupaten']->provinsi->get_pair();
                $location['kabupaten'] = $location['kabupaten']->get_pair();
                $location['kecamatan'] = $location['kecamatan']->get_pair();
            }
            else if ( $step >= 4 ) {
                $location['kelurahan'] = DesaKelurahan::find( $id );
                $location['kecamatan'] = $location['kelurahan']->kecamatan;
                $location['kabupaten'] = $location['kecamatan']->kabupaten_kota;
                $location['provinsi'] = $location['kabupaten']->provinsi->get_pair();
                $location['kabupaten'] = $location['kabupaten']->get_pair();
                $location['kecamatan'] = $location['kecamatan']->get_pair();
                $location['kelurahan'] = $location['kelurahan']->get_pair();
            }
        }
        else {
            if ( $step == 2 ) {
                $location['provinsi']  = Provinsi::find( $id )->get_pair();
                $location['kabupaten'] = $default;
                $location['kecamatan'] = $default;
                $location['kelurahan'] = $default;
            }
            else if ( $step == 3 ) {
                $location['kabupaten'] = KabupatenKota::find( $id );
                $location['provinsi'] = $location['kabupaten']->provinsi->get_pair();
                $location['kabupaten'] = $location['kabupaten']->get_pair();
                $location['kecamatan'] = $default;
                $location['kelurahan'] = $default;
            }
            else if ( $step == 4 ) {
                $location['kecamatan'] = Kecamatan::find( $id );
                $location['kabupaten'] = $location['kecamatan']->kabupaten_kota;
                $location['provinsi'] = $location['kabupaten']->provinsi->get_pair();
                $location['kabupaten'] = $location['kabupaten']->get_pair();
                $location['kecamatan'] = $location['kecamatan']->get_pair();
                $location['kelurahan'] = $default;
            }
            else if ( $step >= 5 ) {
                $location['kelurahan'] = DesaKelurahan::find( $id );
                $location['kecamatan'] = $location['kelurahan']->kecamatan;
                $location['kabupaten'] = $location['kecamatan']->kabupaten_kota;
                $location['provinsi'] = $location['kabupaten']->provinsi->get_pair();
                $location['kabupaten'] = $location['kabupaten']->get_pair();
                $location['kecamatan'] = $location['kecamatan']->get_pair();
                $location['kelurahan'] = $location['kelurahan']->get_pair();
            }
        }

        return $location;
    }
}
