<?php

namespace App\Http\Controllers;

use Request;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Cartalyst\Sentinel\Native\Facades\Sentinel;
use App\PosyanduIbu;
use App\PosyanduBalita;

class PosyanduLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
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
        return view( 'posyandu.login.index' );
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
            return redirect('posyandu/home');
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
        return redirect( 'posyandu' );
    }
}
