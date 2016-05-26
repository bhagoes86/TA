<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Session;

use App\Role;

class PosyanduAdminLoginMiddleware
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
        if ( Auth::check() && $request->user()->roles()->first()->id == Role::where( 'slug', 'admin' )->first()->id ) {
            return $next( $request );
        }

        Session::flash( 'danger', "Anda tidak terdaftar sebagai administrator sistem Posyandu, silakan login untuk mengakses halaman sesuai hak akses anda!" );
        return redirect()->route( 'posyandu.login' );
    }
}
