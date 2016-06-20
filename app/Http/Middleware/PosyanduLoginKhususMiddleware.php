<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Session;

use App\Role;
use App\PosyanduIbu;
use App\PosyanduBalita;
use App\PosyanduPenimbangan;
use App\PosyanduBeriImunisasi;
use App\PosyanduKapsul;
use App\PosyanduPengurus;
use App\PosyanduKas;
use App\PosyanduAbsen;
use App\PosyanduKeluhan;

class PosyanduLoginKhususMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ( Auth::check() && $request->user()->roles()->first()->id == Role::where( 'slug', 'posyandu' )->first()->id ) {
            if($tipe = preg_match("/ibu/", $request->path()))
            {
                $ibu = PosyanduIbu::select('id_posyandu')->where( 'posyandu_ibu.id' , $request->route()->id)->get()->first();
                if(Auth::user()->id_posyandu == $ibu->id_posyandu)
                return $next( $request );
            } else 
            
            if($tipe = preg_match("/balita/", $request->path()))
            {
                if($tipe = preg_match("/create/", $request->path()))
                {
                    $ibu = PosyanduIbu::select('id_posyandu')->where( 'posyandu_ibu.id' , $request->route()->id)->get()->first();
                    if(Auth::user()->id_posyandu == $ibu->id_posyandu)
                    return $next( $request );
                }
                else
                {
                    $balita = PosyanduBalita::select('id_posyandu')->where( 'posyandu_balita.id' , $request->route()->id)->get()->first();
                    if(Auth::user()->id_posyandu == $balita->id_posyandu)
                    return $next( $request );
                }
            } else 

            if($tipe = preg_match("/penimbangan/", $request->path()))
            {
                if($tipe = preg_match("/create/", $request->path()))
                {
                    $penimbangan = PosyanduBalita::select('id_posyandu')->where( 'posyandu_balita.id' , $request->route()->id)->get()->first();
                    if(Auth::user()->id_posyandu == $penimbangan->id_posyandu)
                    return $next( $request );
                }
                else
                {
                    $balita = PosyanduPenimbangan::select('id_balita')->where( 'posyandu_penimbangan.id' , $request->route()->id)->get()->first();
                    $penimbangan = PosyanduBalita::select('id_posyandu')->where( 'posyandu_balita.id' , $balita->id_balita)->get()->first();
                    if(Auth::user()->id_posyandu == $penimbangan->id_posyandu)
                    return $next( $request );
                }
            } else 

            if($tipe = preg_match("/beriimunisasi/", $request->path()))
            {
                if($tipe = preg_match("/create/", $request->path()))
                {
                    $imunisasi = PosyanduBalita::select('id_posyandu')->where( 'posyandu_balita.id' , $request->route()->id)->get()->first();
                    if(Auth::user()->id_posyandu == $imunisasi->id_posyandu)
                    return $next( $request );
                }
                else
                {
                    $balita = PosyanduBeriImunisasi::select('id_balita')->where( 'posyandu_pemberian_imunisasi.id' , $request->route()->id)->get()->first();
                    $imunisasi = PosyanduBalita::select('id_posyandu')->where('posyandu_balita.id' , $balita->id_balita)->get()->first();
                    if(Auth::user()->id_posyandu == $imunisasi->id_posyandu)
                    return $next( $request );
                }
            } else 

            if($tipe = preg_match("/kapsul/", $request->path()))
            {
                if($tipe = preg_match("/create/", $request->path()))
                {
                    $kapsul = PosyanduBalita::select('id_posyandu')->where( 'posyandu_balita.id' , $request->route()->id)->get()->first();
                    if(Auth::user()->id_posyandu == $kapsul->id_posyandu)
                    return $next( $request );
                }
                else
                {
                    $balita = PosyanduKapsul::select('id_balita')->where( 'posyandu_pemberian_kapsul.id' , $request->route()->id)->get()->first();
                    $kapsul = PosyanduBalita::select('id_posyandu')->where('posyandu_balita.id' , $balita->id_balita)->get()->first();
                    if(Auth::user()->id_posyandu == $kapsul->id_posyandu)
                    return $next( $request );
                }
            } else 

            if($tipe = preg_match("/pengurus/", $request->path()))
            {
                $pengurus = PosyanduPengurus::select('id_posyandu')->where( 'posyandu_pengurus.id' , $request->route()->id)->get()->first();
                if(Auth::user()->id_posyandu == $pengurus->id_posyandu)
                return $next( $request );
            } else 

            if($tipe = preg_match("/kas/", $request->path()))
            {
                $kas = PosyanduKas::select('id_posyandu')->where( 'posyandu_kas.id' , $request->route()->id)->get()->first();
                if(Auth::user()->id_posyandu == $kas->id_posyandu)
                return $next( $request );
            } else 

            if($tipe = preg_match("/absen/", $request->path()))
            {
                $absen = PosyanduAbsen::select('id_posyandu')->where( 'posyandu_absen.id' , $request->route()->id)->get()->first();
                if(Auth::user()->id_posyandu == $absen->id_posyandu)
                return $next( $request );
            } else 

            if($tipe = preg_match("/keluhan/", $request->path()))
            {
                $keluhan = PosyanduKeluhan::select( 'id_ibu' )->where( 'posyandu_keluhan.id' , $request->route()->id )->get()->first(); 
                $ibu = PosyanduIbu::select( 'id_posyandu' )->where( 'posyandu_ibu.id' ,  $keluhan->id_ibu)->get()->first();
                if(Auth::user()->id_posyandu == $ibu->id_posyandu)
                return $next( $request );
            } 
        }

        Session::flash( 'info', "Silakan akses halaman sesuai akun login Anda!" );
        return redirect()->route( 'posyandu.login' );
    }
}
