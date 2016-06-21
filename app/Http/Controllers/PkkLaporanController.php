<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use Session;

use App\PkkLaporan;

class PkkLaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $data['content'] = PkkLaporan::orderBy( 'created_at', 'desc' )->where( 'id_pkk', Auth::user()->id_pkk )->get();

        return view( 'pages.pkk.pengurus.laporan.index', compact( 'data' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];

        return view( 'pages.pkk.pengurus.laporan.create', compact( 'data' ) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'id_pkk'    => Auth::user()->id_pkk,
            'subjek'    => $request->subjek,
        ];

        if ( $request->file( 'file' ) != null ) {
            if ( !( $request->file( 'file' )->isValid() ) ) {
                Session::flash( 'danger', "File tidak berhasil diunggah" );
                return redirect()->route( 'pkk.laporan.create' )->withInput();
            }
            $data['file'] = time().'.'.$request->file( 'file' )->getClientOriginalExtension();
            $request->file( 'file' )->move( 'files/laporan', $data['file'] );
        }
        else {
            Session::flash( 'danger', "Harus mengunggah file" );
            return redirect()->route( 'pkk.laporan.create' )->withInput();
        }

        PkkLaporan::create( $data );
        Session::flash( 'success', "Laporan bidang baru berhasil diunggah" );
        return redirect()->route( 'pkk.laporan.index' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $file = PkkLaporan::find( $id );

        if ( $file->file ) {
            unlink( 'files/laporan/'.$file->file );
        }
        $file->delete();

        Session::flash( 'success', "Data laporan berhasil dihapus" );
        return redirect()->route( 'pkk.laporan.index' );
    }

    /**
     * Download the specified resource form storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function download( $id )
    {
        $file = PkkLaporan::find( $id );

        return response()->download( 'files/laporan/'.$file->file );
    }
}
