<?php

namespace App\Http\Controllers;

use Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Cartalyst\Sentinel\Native\Facades\Sentinel;

class PkkLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view( 'pkk.login' );
    }

    /**
     * Log in to the system
     *
     * @return \Illuminate\Http\Response
     */
    public function login() {
        if ($auth = Sentinel::authenticate(Request::all()))
        {
            $user = Sentinel::findByCredentials(Request::all());
            Sentinel::login($user);
            return redirect('pkk/index');
        }

        return redirect()->back()->withErrors('Email atau kata sandi tidak cocok.');
    }

    /**
     * Log out from the system
     *
     * @return \Illuminate\Http\Response
     */
    public function logout() {
        Sentinel::logout(null, true);
        return redirect( 'pkk' );
    }
}
