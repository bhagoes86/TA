<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Session;

use App\Role;

class PkkLoginMiddleware
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
        if ( Auth::check() && $request->user()->roles()->first()->id == Role::where( 'slug', 'pkk' )->first()->id ) {
            return $next( $request );
        }

        Session::flash( 'info', "Silakan login untuk mengakses halaman ini!" );
        return redirect()->route( 'pkk.login' );
    }
}
