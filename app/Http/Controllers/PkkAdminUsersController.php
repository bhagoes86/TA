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
use App\Provinsi;
use App\KabupatenKota;
use App\Kecamatan;
use App\DesaKelurahan;
use App\PkkData;

class PkkAdminUsersController extends Controller
{
    /**
     * Display a list of PKK user accounts
     *
     * @param  int $provinsi        Province ID
     * @param  int $kabupaten       City ID
     * @param  int $kecamatan       District ID
     * @param  int $kelurahan       Village ID
     *
     * @return \Illuminate\Http\Response
     */
    public function index( $provinsi, $kabupaten, $kecamatan, $kelurahan )
    {
        $data = [];

        $data['loc_id'] = [0, 0, 0, 0];
        $data['loc_desc'] = ["-", "-", "-", "-"];
        $data['content'] = User::with( 'pkk' )->where( 'id_pkk', '!=', 0 );

        if ( $provinsi > 0 ) {
            $data['loc_id'][0] = $provinsi;
            $data['loc_desc'][0] = Provinsi::find( $provinsi )->nama;
            if ( $kabupaten > 0 ) {
                $data['loc_id'][1] = $kabupaten;
                $data['loc_desc'][1] = KabupatenKota::find( $kabupaten )->nama;
                if ( $kecamatan > 0 ) {
                    $data['loc_id'][2] = $kecamatan;
                    $data['loc_desc'][2] = Kecamatan::find( $kecamatan )->nama;
                    if ( $kelurahan > 0 ) {
                        $data['loc_id'][3] = $kelurahan;
                        $data['loc_desc'][3] = DesaKelurahan::find( $kelurahan )->nama;
                        $data['content'] = $data['content']->whereHas( 'pkk', function ( $q ) use ( $kelurahan ) {
                            $q->where( 'kel_id', $kelurahan );
                        } );
                    }
                    else {
                        $data['content'] = $data['content']->whereHas( 'pkk', function ( $q ) use ( $kecamatan ) {
                            $q->where( 'kec_id', $kecamatan );
                        } );
                    }
                    $data['location'] = DesaKelurahan::where( 'kec_id', $kecamatan )->orderBy( 'nama' )->lists( 'nama', 'id' )->toArray();
                }
                else {
                    $data['content'] = $data['content']->whereHas( 'pkk', function ( $q ) use ( $kabupaten ) {
                        $q->where( 'kab_id', $kabupaten );
                    } );
                    $data['location'] = Kecamatan::where( 'kab_id', $kabupaten )->orderBy( 'nama' )->lists( 'nama', 'id' )->toArray();
                }
            }
            else {
                $data['content'] = $data['content']->whereHas( 'pkk', function ( $q ) use ( $provinsi ) {
                    $q->where( 'prov_id', $provinsi );
                } );
                $data['location'] = KabupatenKota::where( 'prov_id', $provinsi )->orderBy( 'nama' )->lists( 'nama', 'id' )->toArray();
            }
        }
        else {
            $data['location'] = Provinsi::orderBy( 'nama' )->lists( 'nama', 'id' )->toArray();
        }
        $data['content'] = $data['content']->get();

        return view( 'pages.pkk.admin.users.index', compact( 'data' ) );
    }

    /**
     * Filter PKK user accounts by location
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function filter( Request $request )
    {
        if ( $request->loc ) {
            if ( $request->prov_id == 0 ) {
                return redirect()->route( 'pkk.admin.users', [$request->loc, $request->kab_id, $request->kec_id, $request->kel_id] );
            }
            else if ( $request->kab_id == 0 ) {
                return redirect()->route( 'pkk.admin.users', [$request->prov_id, $request->loc, $request->kec_id, $request->kel_id] );
            }
            else if ( $request->kec_id == 0 ) {
                return redirect()->route( 'pkk.admin.users', [$request->prov_id, $request->kab_id, $request->loc, $request->kel_id] );
            }
            else {
                return redirect()->route( 'pkk.admin.users', [$request->prov_id, $request->kab_id, $request->kec_id, $request->loc] );
            }
        }

        Session::flash( 'warning', "Terjadi kesalahan pemilihan wilayah" );
        return redirect()->route( 'pkk.admin.users', [0,0,0,0] );
    }

    /**
     * Add new user account and PKK data
     *
     * @param  UserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function add( UserRequest $request )
    {
        $new_location[ 'kode_wilayah' ] = Provinsi::find( $request->prov_id )->kode.( $request->kab_id > 0 ? '.'.KabupatenKota::find( $request->kab_id )->kode.( $request->kec_id > 0 ? '.'.Kecamatan::find( $request->kec_id )->kode.( $request->kel_id > 0 ? '.'.DesaKelurahan::find( $request->kel_id )->kode : "" ) : "" ) : "" );
        if ( PkkData::where( 'kode_wilayah', $new_location['kode_wilayah'] )->where( 'rw', $new_location['rw'] )->where( 'rt', $new_location['rt'] )->first() ) {
            Session::flash( 'danger', "Daerah sudah terdaftar" );
            return redirect()->back();
        }

        $new_pkk = PkkData::create( [
            'prov_id'       => $request->prov_id,
            'kab_id'        => $request->kab_id,
            'kec_id'        => $request->kec_id,
            'kel_id'        => $request->kel_id,
            'rw'            => $request->rw,
            'rt'            => $request->rt,
            'kode_wilayah'  => $new_location[ 'kode_wilayah' ],
        ] );

        $user = User::create( [
            'username' => $request->username,
            'id_pkk'   => $new_pkk->id,
        ] );
        $user->password = Hash::make( $request->password );
        $user->save();
        $user->roles()->attach( Role::where( 'slug', 'pkk' )->first()->id );

        Session::flash( 'success', "Registrasi akun baru berhasil!" );
        return redirect()->back();
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
