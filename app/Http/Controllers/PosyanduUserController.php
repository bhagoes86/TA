<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use App\PosyanduUser;
use App\PosyanduIbu;
use App\PosyanduData;
use App\PosyanduKonjungsiIbuData;

class PosyanduUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = PosyanduUser::join('posyandu_data', 'users.id_posyandu', '=', 'posyandu_data.id')
                            ->select('users.*', 'posyandu_data.nama', 'posyandu_data.password_website')
                            ->get();
        return view( 'posyandu.users.index', compact( 'users' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $ibu = PosyanduIbu::orderBy( 'nama', 'asc' )->get();
        // return view( 'posyandu.users.create', compact( 'ibu' ) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // $data = Request::all();

        // /*jika mendaftarkan user untuk posyandu*/
        // if( $null = [$data['id_ibu'] => '']) {
        //     if(Sentinel::getUser()->permissions) {
        //         $user = Sentinel::create( [
        //         'email' => $data['email'],
        //         'password' => bcrypt($data['password'])
        //         ] );  

        //         $activation = Activation::create( $user );
        //         Activation::complete( $user, $activation['code'] );
        //     }
        // }
        // else {
        //     $ibu = PosyanduIbu::select( 'no_ktp' )
        //            ->where( 'id', $data['id_ibu'] )
        //            ->first();

        //     $user = Sentinel::create( [
        //         'email' => $data['email'],
        //         'password' => bcrypt($data['password'])
        //     ] );

        //     $activation = Activation::create( $user );
        //     Activation::complete( $user, $activation['code'] );

        //     $update = PosyanduUser::find( $user['id'] );
        //     $update->update( [ 'no_ktp' => $ibu->no_ktp ] );
        //     $update->update( [ 'password_mobile' => $data->password ] );
            
        // }

        // return redirect( 'posyandu/users' );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $id_konjungsi)
    {
        // $users = PosyanduUser::find( $id );
        // $ibu = PosyanduIbu::orderBy( 'nama', 'asc' )->get();
        // return view( 'posyandu.users.edit', compact( 'users', 'ibu' ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $data = Request::all();

        // $ibu = PosyanduIbu::select( 'no_ktp' )
        //        ->where( 'id', $data['id_ibu'] )
        //        ->first();

        // $ktp = PosyanduUser::select('id')
        //         ->where( 'no_ktp', $ibu['no_ktp'])
        //         ->first();

        // $user = Sentinel::findById( $ktp['id'] );

        // // $check = Sentinel::findByCredentials( ['email' => 'febryan']);
        // $user->email = $data['email'];
        // $user->password = bcrypt($data['password']);
        // $user->password_mobile = $data['reinput'];
        // $user->save();
        
        // $update = PosyanduUser::find( $user['id'] );
        // $update->update( [ 'no_ktp' => $ibu->no_ktp ] );

        // return redirect( 'posyandu/users' )
        //     ->with( 'status', 'Akun berhasil diperbaharui!' );
    }    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    //     $user = Sentinel::findById( $id );
    //     $user->delete();

    //     return redirect( 'posyandu/users' )
    //            ->with( 'status', 'Akun berhasil dihapus!' );
    }
}
