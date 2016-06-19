<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\PkkIbuRequest;
use App\Http\Controllers\Controller;

use Auth;
use Session;

use App\PkkIbu;

class PkkIbuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $data['content'] = PkkIbu::orderBy( 'nama' )->get();

        return view( 'pages.pkk.pengurus.ibu.index', compact( 'data' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];

        return view( 'pages.pkk.pengurus.ibu.create', compact( 'data' ) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\PkkIbuRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PkkIbuRequest $request)
    {
        $token = $this->generateToken();

        PkkIbu::create( [
            'id_pkk'            => Auth::user()->id_pkk,
            'no_ktp'            => $request->no_ktp,
            'nama'              => $request->nama,
            'alamat'            => $request->alamat,
            'telp'              => $request->telp,
            'password_mobile'   => $request->password_mobile,
            'token'             => $token,
        ] );

        Session::flash( 'success', "Anggota PKK baru berhasil ditambahkan!<br>Token pengguna: <strong>".$token."</strong>" );
        return redirect()->route( 'pkk.ibu.index' );
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
        $data['content'] = PkkIbu::find( $id );

        return view( 'pages.pkk.pengurus.ibu.edit', compact( 'data' ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\PkkIbuRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PkkIbuRequest $request, $id)
    {
        $token = $this->generateToken();

        PkkIbu::find( $id )->update( [
            'no_ktp'            => $request->no_ktp,
            'nama'              => $request->nama,
            'alamat'            => $request->alamat,
            'telp'              => $request->telp,
            'password_mobile'   => $request->password_mobile,
            'token'             => $token,
        ] );

        Session::flash( 'success', "Data Anggota PKK berhasil dirubah!<br>Token pengguna: <strong>".$token."</strong>" );
        return redirect()->route( 'pkk.ibu.index' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PkkIbu::find( $id )->delete();
        Session::flash( 'success', "Data Anggota PKK berhasil dihapus!" );
        return redirect()->route( 'pkk.ibu.index' );
    }

    public function reset( $id )
    {
        $token = $this->generateToken();

        PkkIbu::find( $id )->update( [
            'token' => $token,
        ] );

        Session::flash( 'success', "Token berhasil direset!<br>Token pengguna: <strong>".$token."</strong>" );
        return redirect()->route( 'pkk.ibu.index' );
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
            $token .= $chars[rand( 0, 35 )];
        }
        return $token;
    }
}
