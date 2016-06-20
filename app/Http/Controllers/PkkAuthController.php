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
use App\PkkData;
use App\Provinsi;
use App\Kecamatan;
use App\KabupatenKota;
use App\DesaKelurahan;

class PkkAuthController extends Controller
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
        return view( 'pages.pkk.login.index' );
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
            if ( Auth::user()->roles()->first()->id == Role::where( 'slug', 'pkk' )->first()->id ) {
                Auth::user()->update( ['last_login' => date( "Y-m-d H:i:s" )] );
                return redirect()->route( 'pkk' );
            }
            else if ( Auth::user()->roles()->first()->id == Role::where( 'slug', 'admin' )->first()->id ) {
                Auth::user()->update( ['last_login' => date( "Y-m-d H:i:s" )] );
                return redirect()->route( 'pkk.admin' );
            }

            Auth::logout();
            Session::flash( 'danger', "Username tidak terdaftar untuk mengakses sistem ini, mohon registrasi PKK anda terlebih dahulu!" );
            return redirect()->route( 'pkk.login' );
        }

        Session::flash( 'danger', "Username dan kata sandi tidak cocok" );
        return redirect()->route( 'pkk.login' );
    }

    /**
     * User logout
     *
     * @return \Illuminate\Http\Response
     */
    public function logout() {
        Auth::logout();
        Session::flash( 'info', "Logout sukses!" );
        return redirect()->route( 'pkk.login' );
    }
}
