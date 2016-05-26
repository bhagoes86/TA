<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use Hash;
use Session;
use Validator;

use App\Role;
use App\User;

class PosyanduAuthController extends Controller
{
    /**
     * Display login page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // check if any user logged in
        if ( Auth::check() ) {
            Auth::logout();
        }
        return view( 'pages.posyandu.login.index' );
    }

    /**
     * User login authentication
     *
     * @param  Request $request             request post parse data
     * @return \Illuminate\Http\Response
     */
    public function login( Request $request ) {
        // login attempt
        if ( Auth::attempt( ['username' => $request->username, 'password' => $request->password], $request->remember_me ? true : false ) ) {
            // check previlege & redirect
            if ( Auth::user()->roles()->first()->id == Role::where( 'slug', 'posyandu' )->first()->id ) {
                Auth::user()->update( ['last_login' => date( "Y-m-d H:i:s" )] );
                return redirect()->route( 'posyandu' );
            }
            else if ( Auth::user()->roles()->first()->id == Role::where( 'slug', 'admin' )->first()->id ) {
                Auth::user()->update( ['last_login' => date( "Y-m-d H:i:s" )] );
                return redirect()->route( 'posyandu.admin' );
            }

            Auth::logout();
            Session::flash( 'danger', "Username tidak terdaftar untuk mengakses sistem ini, mohon registrasi Posyandu anda terlebih dahulu!" );
            return redirect()->route( 'posyandu.login' );
        }

        Session::flash( 'danger', "Username dan kata sandi tidak cocok" );
        return redirect()->route( 'posyandu.login' );
    }

    /**
     * User logout
     *
     * @return \Illuminate\Http\Response
     */
    public function logout() {
        Auth::logout();
        Session::flash( 'info', "Logout sukses!" );
        return redirect()->route( 'posyandu.login' );
    }

    // /**
    //  * Register new PKK
    //  *
    //  * @param  Request $request             request data
    //  * @return \Illuminate\Http\Response
    //  */
    // public function register( Request $request ) {
    //     // check if any user logged in
    //     if ( Auth::check() ) {
    //         Auth::logout();
    //     }

    //     if ( $request->step != 6 ) {
    //         $data = [];

    //         // check if its first or next step
    //         $data['step'] = $request->step != null ? $request->step + 1 : 0;

    //         // boolean if user pick any location
    //         $user_not_pick = ( ( $request->step == 1 && $request->kab_id == 0 ) || ( $request->step == 2 && $request->kec_id == 0 ) || ( $request->step == 3 && $request->kel_id == 0 ) || ( $request->step == 4 && $request->rw == "" ) );

    //         // get location data
    //         $data['location'] = $this->get_location( $data['step'], $request->kel_id ?: $request->kec_id ?: $request->kab_id ?: $request->prov_id ?: 0, $request->rw, $request->rt, $user_not_pick );

    //         // if no location picked at certain stage then location pick considered done
    //         $data['step'] = $user_not_pick ? 6 : $data['step'];

    //         return view( 'pages.pkk.registration.index', compact( 'data' ) );
    //     }
    //     else {
    //         $new_location = [
    //             'prov_id'       => $request->prov_id,
    //             'kab_id'        => $request->kab_id,
    //             'kec_id'        => $request->kec_id,
    //             'kel_id'        => $request->kel_id,
    //             'rw'            => $request->rw,
    //             'rt'            => $request->rt,
    //         ];

    //         $validator = Validator::make( [
    //             'username' => $request->username,
    //             'password' => $request->password,
    //             're_password' => $request->re_password,
    //         ], [
    //             'username' => 'required|min:4|alpha_dash',
    //             'password' => 'required|min:4',
    //             're_password' => 'required|same:password',
    //         ], [
    //             'username.required' => "Kolom username harus terisi",
    //             'password.required' => "Kolom kata sandi harus terisi",
    //             're_password.required' => "Kolom masukkan ulang kata sandi harus terisi",
    //             'username.min' => "Username minimal terdiri dari 4 karakter",
    //             'password.min' => "Kata sandi minimal terdiri dari 4 karakter",
    //             're_password.same' => "Kolom konfirmasi kata sandi baru tidak sesuai",
    //             'username.alpha_dash' => "Username hanya terdiri atas huruf, angka, tanda min (-), dan garis bawah (_)",
    //             ''
    //         ] );

    //         if ( $validator->fails() ) {
    //             $data = [];
    //             return redirect()
    //                    ->back()
    //                    ->withErrors( $validator )
    //                    ->withInput();
    //         }
    //         if ( User::where( 'username', $request->username )->first() ) {
    //             Session::flash( 'danger', "Username sudah digunakan" );
    //             return redirect()
    //                    ->back()
    //                    ->withInput();
    //         }

    //         $new_location[ 'kode_wilayah' ] = Provinsi::find( $request->prov_id )->kode.( $request->kab_id > 0 ? '.'.KabupatenKota::find( $request->kab_id )->kode.( $request->kec_id > 0 ? '.'.Kecamatan::find( $request->kec_id )->kode.( $request->kel_id > 0 ? '.'.DesaKelurahan::find( $request->kel_id )->kode : "" ) : "" ) : "" );
    //         if ( PkkData::where( 'kode_wilayah', $new_location['kode_wilayah'] )->where( 'rw', $new_location['rw'] )->where( 'rt', $new_location['rt'] )->first() ) {
    //             Session::flash( 'danger', "Daerah sudah terdaftar" );
    //             return redirect()
    //                    ->back()
    //                    ->withInput();
    //         }

    //         $new_pkk = PkkData::create( [
    //             'prov_id'       => $request->prov_id,
    //             'kab_id'        => $request->kab_id,
    //             'kec_id'        => $request->kec_id,
    //             'kel_id'        => $request->kel_id,
    //             'rw'            => $request->rw,
    //             'rt'            => $request->rt,
    //             'kode_wilayah'  => $new_location[ 'kode_wilayah' ],
    //         ] );

    //         $user = User::create( [
    //             'username' => $request->username,
    //             'id_pkk'   => $new_pkk->id,
    //         ] );
    //         $user->password = Hash::make( $request->password );
    //         $user->save();
    //         $user->roles()->attach( Role::where( 'slug', 'pkk' )->first()->id );

    //         Session::flash( 'success', "Registrasi berhasil!" );
    //         return redirect()->route( 'pkk.login' );
    //     }
    // }

    // /**
    //  * get location for each generating page
    //  *
    //  * @param  integer $step            current location pick stage
    //  * @param  integer $id              current/last location ID
    //  * @param  integer $rw              current RW number
    //  * @param  integer $rt              current RT number
    //  * @param  boolean $user_not_pick   flag showing if user picked any location at current stage
    //  * @return array                    complete location list
    //  */
    // private function get_location( $step, $id, $rw, $rt, $user_not_pick ) {
    //     $default = ['0' => "Tidak memilih lokasi"];
    //     $location = [
    //         'provinsi' => null,
    //         'kabupaten' => null,
    //         'kecamatan' => null,
    //         'kelurahan' => null,
    //         'rw' => $rw,
    //         'rt' => $rt,
    //     ];

    //     if ( $step == 0 ) {
    //         $location['provinsi'] = Provinsi::orderBy( 'nama' )->lists( 'nama', 'id' )->toArray();
    //     }
    //     else if ( !$user_not_pick ) {
    //         if ( $step == 1 ) {
    //             $location['kabupaten'] = $default + KabupatenKota::where( 'prov_id', $id )->orderBy( 'nama' )->lists( 'nama', 'id' )->toArray();
    //             $location['provinsi'] = Provinsi::find( $id )->get_pair();
    //         }
    //         else if ( $step == 2 ) {
    //             $location['kecamatan'] = $default + Kecamatan::where( 'kab_id', $id )->orderBy( 'nama' )->lists( 'nama', 'id' )->toArray();
    //             $location['kabupaten'] = KabupatenKota::find( $id );
    //             $location['provinsi'] = $location['kabupaten']->provinsi->get_pair();
    //             $location['kabupaten'] = $location['kabupaten']->get_pair();
    //         }
    //         else if ( $step == 3 ) {
    //             $location['kelurahan'] = $default + DesaKelurahan::where( 'kec_id', $id )->orderBy( 'nama' )->lists( 'nama', 'id' )->toArray();
    //             $location['kecamatan'] = Kecamatan::find( $id );
    //             $location['kabupaten'] = $location['kecamatan']->kabupaten_kota;
    //             $location['provinsi'] = $location['kabupaten']->provinsi->get_pair();
    //             $location['kabupaten'] = $location['kabupaten']->get_pair();
    //             $location['kecamatan'] = $location['kecamatan']->get_pair();
    //         }
    //         else if ( $step >= 4 ) {
    //             $location['kelurahan'] = DesaKelurahan::find( $id );
    //             $location['kecamatan'] = $location['kelurahan']->kecamatan;
    //             $location['kabupaten'] = $location['kecamatan']->kabupaten_kota;
    //             $location['provinsi'] = $location['kabupaten']->provinsi->get_pair();
    //             $location['kabupaten'] = $location['kabupaten']->get_pair();
    //             $location['kecamatan'] = $location['kecamatan']->get_pair();
    //             $location['kelurahan'] = $location['kelurahan']->get_pair();
    //         }
    //     }
    //     else {
    //         if ( $step == 2 ) {
    //             $location['provinsi']  = Provinsi::find( $id )->get_pair();
    //             $location['kabupaten'] = $default;
    //             $location['kecamatan'] = $default;
    //             $location['kelurahan'] = $default;
    //         }
    //         else if ( $step == 3 ) {
    //             $location['kabupaten'] = KabupatenKota::find( $id );
    //             $location['provinsi'] = $location['kabupaten']->provinsi->get_pair();
    //             $location['kabupaten'] = $location['kabupaten']->get_pair();
    //             $location['kecamatan'] = $default;
    //             $location['kelurahan'] = $default;
    //         }
    //         else if ( $step == 4 ) {
    //             $location['kecamatan'] = Kecamatan::find( $id );
    //             $location['kabupaten'] = $location['kecamatan']->kabupaten_kota;
    //             $location['provinsi'] = $location['kabupaten']->provinsi->get_pair();
    //             $location['kabupaten'] = $location['kabupaten']->get_pair();
    //             $location['kecamatan'] = $location['kecamatan']->get_pair();
    //             $location['kelurahan'] = $default;
    //         }
    //         else if ( $step >= 5 ) {
    //             $location['kelurahan'] = DesaKelurahan::find( $id );
    //             $location['kecamatan'] = $location['kelurahan']->kecamatan;
    //             $location['kabupaten'] = $location['kecamatan']->kabupaten_kota;
    //             $location['provinsi'] = $location['kabupaten']->provinsi->get_pair();
    //             $location['kabupaten'] = $location['kabupaten']->get_pair();
    //             $location['kecamatan'] = $location['kecamatan']->get_pair();
    //             $location['kelurahan'] = $location['kelurahan']->get_pair();
    //         }
    //     }

    //     return $location;
    // }
}
