<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;

use Hash;
use Session;

use App\Date;
use App\User;
use App\Role;

class PkkAdminUsersController extends Controller
{
    /**
     * Display a list of PKK user and administrator accounts
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $data['admin'] = User::where( 'id_pkk', 0 )->where( 'id_posyandu', 0 )->get();
        $data['content'] = User::where( 'id_pkk', '!=', 0 )->with( ['pkk' => function ( $q ) {
            $q->with( 'provinsi', 'kabupaten_kota', 'kecamatan', 'desa_kelurahan' )->get();
        } ] )->get();

        return view( 'pages.pkk.admin.users.index', compact( 'data' ) );
    }

    /**
     * Show the form for creating a new administrator account.
     *
     * @return \Illuminate\Http\Response
     */
    public function createAdmin()
    {
        $data = [];
        return view( 'pages.pkk.admin.users.create-admin', compact( 'data' ) );
    }

    /**
     * Store a newly created administrator account in storage.
     *
     * @param  \Illuminate\Http\Request\UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function storeAdmin(UserRequest $request)
    {
        $user = User::create( ['username' => $request->username] );
        $user->password = Hash::make( $request->password );
        $user->save();
        $user->roles()->attach( Role::where( 'slug', 'admin' )->first()->id );

        Session::flash( 'success', "Akun administrator baru berhasil ditambahkan!" );
        return redirect()->route( 'pkk.admin.users' );
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
    public function edit($id)
    {
        $data = [];
        $data['content'] = User::find( $id );

        if ( !$data['content'] ) {
            Session::flash( 'warning', "Data akun pengguna tidak ditemukan!" );
            return redirect()->route( 'pkk.admin.users' );
        }

        return view( 'pages.pkk.admin.users.edit', compact( 'data' ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $user = User::find( $id );

        $user->username = $request->username;
        $user->password = Hash::make( $request->password );
        $user->save();

        Session::flash( 'success', "Akun pengguna berhasil diubah!" );
        return redirect()->route( 'pkk.admin.users' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ( $user = User::find( $id ) ) {
            $user->roles()->detach();
            $user->pkk->delete();
            $user->delete();
            Session::flash( 'success', "Akun pengguna berhasil dihapus!" );
        }

        Session::flash( 'warning', "<b>Hapus akun gagal!</b>: Akun pengguna tidak ditemukan!" );
        return redirect()->route( 'pkk.admin.users' );
    }
}
