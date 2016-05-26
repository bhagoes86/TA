<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\ChangeUsernameRequest;
use App\Http\Controllers\Controller;

use Hash;
use Session;

use App\User;

class ProfileController extends Controller
{
    /**
     * Update profile username
     *
     * @param  ChangeUsernameRequest $request       request post data + validation
     * @return \Illuminate\Http\Response
     */
    protected function updateUsername( ChangeUsernameRequest $request )
    {
        if ( $user = User::where( 'username', $request->username )->first() ) {
            Session::flash( 'danger', "<b>Gagal merubah username</b>: Username sudah digunakan!" );
            return redirect()
                   ->back()
                   ->withInput();
        }

        User::find( $request->id )->update( ['username' => $request->username] );
        Session::flash( 'success', "<b>Username berhasil diubah!</b>");
        return redirect()->back();
    }

    /**
     * Update profile password
     *
     * @param  ChangePasswordRequest $request       request post data + validation
     * @return \Illuminate\Http\Response
     */
    protected function updatePassword( ChangePasswordRequest $request )
    {
        $user = User::find( $request->id );
        if ( Hash::check( $request->old_pass, $user->password ) ) {
            $user->password = Hash::make( $request->new_pass );
            $user->save();
            Session::flash( 'success', "<b>Kata sandi berhasil diperbarui</b>");
        }
        else {
            Session::flash( 'danger', "<b>Gagal merubah kata sandi</b>: Kata sandi tidak cocok" );
        }
        return redirect()->back();
    }
}
