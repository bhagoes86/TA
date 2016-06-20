<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\PosyanduIbuRequest;
use App\Http\Controllers\Controller;

use Auth;
use Session;

use App\Cryptography;

use App\PosyanduIbu;
use App\PosyanduData;
use App\PosyanduBalita;

class PosyanduIbuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ibu = PosyanduIbu::all();
         return view( 'pages.posyandu.ibu.index', compact( 'ibu' ) );
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $posyandu = PosyanduData::orderBy( 'nama', 'asc' )->get();
        $user = Auth::user();
        return view( 'pages.posyandu.ibu.create', compact( 'posyandu' , 'user' ) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PosyanduIbuRequest $request)
    {
        $token = $request->password_mobile ? $this->generateToken() : "";

        PosyanduIbu::create( [
            'id_posyandu'       => Auth::user()->id_posyandu,
            'no_ktp'            => $request->no_ktp,
            'nama'              => $request->nama,
            'alamat'            => $request->alamat,
            'telp'              => $request->telp,
            'kb'                => $request->kb,
            'tanggal_lahir'     => $request->tanggal_lahir,
            'password_mobile'   => $request->password_mobile,
            'token'             => $request->password_mobile ? Cryptography::cryptoJsAesEncrypt( "sistemPKK", $token ) : "",
        ] );

        Session::flash( 'success', "Data Ibu baru berhasil ditambahkan!".( $request->password_mobile ? "<br>Token pengguna: <strong>".$token."</strong>" : "" ) );
        return redirect()->route( 'posyandu.ibu' );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ibu = PosyanduIbu::find( $id );
        $balita = PosyanduBalita::orderBy( 'tanggal_lahir' , 'asc')->where( 'id_ibu' , $id )->get();
        return view( 'pages.posyandu.ibu.show', compact( 'ibu' , 'balita' ) );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ibu = PosyanduIbu::find( $id );
        $user = Auth::user();
        $posyandu = PosyanduData::orderBy( 'nama', 'asc' )->get();

        return view( 'pages.posyandu.ibu.edit', compact( 'ibu' , 'user' , 'posyandu') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PosyanduIbuRequest $request, $id)
    {
        $token = $request->password_mobile ? $this->generateToken() : "";
        $data = [
            'no_ktp'            => $request->no_ktp,
            'nama'              => $request->nama,
            'alamat'            => $request->alamat,
            'telp'              => $request->telp,
            'kb'                => $request->kb,
            'tanggal_lahir'     => $request->tanggal_lahir,
        ];

        if ( $request->password_mobile ) {
            $data['password_mobile'] = $request->password_mobile;
            $data['token'] = Cryptography::cryptoJsAesEncrypt( "sistemPKK", $token );
        }
        PosyanduIbu::find( $id )->update( $data );

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

        $ibu = PosyanduIbu::orderBy( 'created_at' , 'desc' )->get()->first();
        Session::flash( 'success', "Data Ibu berhasil diperbarui!".( $request->password_mobile ? "<br>Token pengguna: <strong>".$token."</strong>" : "" ) );
        return redirect()->route( 'posyandu.ibu.show' , $ibu['id'] );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PosyanduIbu::find( $id )->delete();
        Session::flash( 'success', "Data Ibu berhasil dihapus!" );
        return redirect()->route( 'posyandu.ibu' );
    }

    public function reset( $id )
    {
        $token = $this->generateToken();

        PosyanduIbu::find( $id )->update( [
            'token' => Cryptography::cryptoJsAesEncrypt( "sistemPKK", $token ),
        ] );

        Session::flash( 'success', "Token berhasil direset!<br>Token pengguna: <strong>".$token."</strong>" );
        return redirect()->route( 'posyandu.ibu.show' , $id );
    }

    /**
     * function to generate new token
     *
     * @return string[8]
     */
    public function generateToken()
    {
        $chars = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $token = "";
        for ( $i=0; $i < 8; $i++ ) {
            $token .= $chars[rand( 0, strlen( $chars )-1 )];
        }
        return $token;
    }
}
