<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Input;
use Response;

use App\Cryptography;

use App\PosyanduIbu;

class PosyanduMobileController extends Controller
{
    public function login()
    {
        $data = Input::all();

        $ibu = PosyanduIbu::where( 'telp', $data['telp'] )->first();
        if ( $ibu ) {
            $db = Cryptography::cryptoJsAesDecrypt( "sistemPKK", $ibu->password_mobile );
            $send = Cryptography::cryptoJsAesDecrypt( "sistemPKK", $data['pass'] );

            if ( $db == $send ) {
                $dbtoken = Cryptography::cryptoJsAesDecrypt( "sistemPKK", $ibu->token );
                $sendtoken = Cryptography::cryptoJsAesDecrypt( "sistemPKK", $data['token'] );
                $tokenstatus = ( $dbtoken == $sendtoken ) ? "VERIFIED" : "FAILED";

                return Response::json( ['status' => "SUCCESS", 'id' => $ibu->id, 'token' => $tokenstatus] );
            }
        }

        return Response::json( ['status' => "FAILED"] );
    }

    public function verifyToken()
    {
        $data = Input::all();

        $ibu = PosyanduIbu::find( $data['session'] );
        if ( $ibu ) {
            $db = Cryptography::cryptoJsAesDecrypt( "sistemPKK", $ibu->token );
            $send = Cryptography::cryptoJsAesDecrypt( "sistemPKK", $data['token'] );

            if ( $db == $send ) {
                return Response::json( ['status' => "SUCCESS"] );
            }
        }

        return Response::json( ['status' => Cryptography::cryptoJsAesDecrypt( "sistemPKK", $ibu->token )] );
    }
}
