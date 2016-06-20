<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Input;
use Response;

use App\Date;
use App\Cryptography;

use App\PkkIbu;
use App\PkkKas;
use App\PkkJentik;
use App\PkkKeluhan;
use App\PkkKomentar;
use App\PkkKegiatan;
use App\PkkNotulensi;
use App\PkkPengumuman;

class PkkMobileController extends Controller
{
    /**
     * PKK mobile login handler
     * @return JSON
     */
    public function login()
    {
        $data = Input::all();

        $ibu = PkkIbu::where( 'telp', $data['telp'] )->first();
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

        $ibu = PkkIbu::find( $data['session'] );
        if ( $ibu ) {
            $db = Cryptography::cryptoJsAesDecrypt( "sistemPKK", $ibu->token );
            $send = Cryptography::cryptoJsAesDecrypt( "sistemPKK", $data['token'] );

            if ( $db == $send ) {
                return Response::json( ['status' => "SUCCESS"] );
            }
        }

        return Response::json( ['status' => "FAILED"] );
    }

    /**
     * PKK mobile contribution years getter
     * @return JSON
     */
    public function yearContribution()
    {
        $data = Input::all();
        $array = [];

        $kas = PkkKas::select( 'created_at' )->where( 'id_ibu', $data['session'] )->orderBy( 'created_at', 'desc' )->get();
        foreach ( $kas as $row ) {
            array_push( $array, $row->created_at->year );
        }

        return Response::json( ['tahuniuran' => array_unique( $array )] );
    }

    /**
     * PKK mobile contribution table fill
     * @return JSON
     */
    public function fillContribution()
    {
        $data = Input::all();
        $array = [];

        $kas = PkkKas::whereYear( 'created_at', '=', $data['year'] )->where( 'id_ibu', $data['session'] )->get();
        foreach ( $kas as $row ) {
            $hash = [
                'tanggal' => $row->created_at->day,
                'bulan'   => $row->created_at->month,
                'tahun'   => $row->created_at->year,
                'nominal' => $row->nominal,
            ];
            array_push( $array, $hash );
        }

        return Response::json( ['iuran' => $array] );
    }

    public function yearWiggler()
    {
        $data = Input::all();
        $array = [];

        $jentik = PkkJentik::select( 'tahun_data' )->where( 'id_ibu', $data['session'] )->orderBy( 'tahun_data', 'desc' )->get();
        foreach ( $jentik as $row ) {
            array_push( $array, $row->tahun_data );
        }

        return Response::json( ['tahunjentik' => array_unique( $array )] );
    }

    public function fillWiggler()
    {
        $data = Input::all();
        $array = [];

        $jentik = PkkJentik::where( 'tahun_data', $data['year'] )->where( 'id_ibu', $data['session'] )->get();
        foreach ( $jentik as $row ) {
            $hash = [
                'tanggal_periksa' => $row->created_at->day,
                'bulan_periksa'   => $row->created_at->month,
                'tahun_periksa'   => $row->created_at->year,
                'bulan'           => $row->bulan_data,
                'tahun'           => $row->tahun_data,
                'jumlah'          => $row->jumlah,
            ];
            array_push( $array, $hash );
        }

        return Response::json( ['jentik' => $array] );
    }

    public function saveWiggler()
    {
        $data = Input::all();
        $jentik = PkkJentik::where( 'id_ibu', $data['session'] )->where( 'bulan_data', $data['bulan'] )->where( 'tahun_data', $data['tahun'] )->first();

        if ( $jentik ) {
            if ( $data['jumlah'] > 0 ) {
                $jentik->update( ['jumlah' => $data['jumlah']] );
            }
            else {
                $jentik->delete();
            }
        }
        else if ( $data['jumlah'] > 0 ) {
            PkkJentik::create( [
                'id_ibu'     => $data['session'],
                'jumlah'     => $data['jumlah'],
                'bulan_data' => $data['bulan'],
                'tahun_data' => $data['tahun'],
            ] );
        }

        return Response::json();
    }

    public function reportList()
    {
        $data = Input::all();
        $array = [];

        $kegiatan = PkkKegiatan::where( 'id_pkk', PkkIbu::find( $data['session'] )->id_pkk )->with( 'notulensi' )->orderBy( 'tanggal', 'desc' )->take( 5 )->get();
        foreach ( $kegiatan as $row ) {
            if ( $row->notulensi ) {
                $hash = [
                    'id'      => $row->notulensi->id,
                    'tanggal' => $row->tanggal,
                    'nama'    => $row->nama,
                ];
                array_push( $array, $hash );
            }
        }

        return Response::json( ['daftarrapat' => $array] );
    }

    public function getReport()
    {
        $data = Input::all();

        $notulensi = PkkNotulensi::where( 'id', $data['meetingno'] )->with( 'kegiatan' )->first();

        return Response::json( ['notulensi' => $notulensi->isi, 'header' => $notulensi->kegiatan->nama.' - '.$notulensi->kegiatan->tanggal] );
    }

    public function getAnnouncement()
    {
        $data = Input::all();
        $array = [];

        $pengumuman = PkkPengumuman::where( 'id_pkk', PkkIbu::find( $data['session'] )->id_pkk )->orderBy( 'created_at', 'desc' )->take( 5 )->get();
        foreach ( $pengumuman as $row ) {
            $hash = [
                'tanggal' => Date::indonesian_date( $row->created_at, 'l, j F Y', null ),
                'judul'   => $row->judul,
                'isi'     => $row->isi,
                'link'    => $row->link,
            ];
            array_push( $array, $hash );
        }

        return Response::json( ['pengumuman' => $array] );
    }

    public function saveComplaint()
    {
        $data = Input::all();

        PkkKeluhan::create( [
            'id_ibu' => $data['session'],
            'judul'  => $data['judul'],
            'isi'    => $data['isi'],
        ] );

        return Response::json();
    }

    public function getComplaint()
    {
        $data = Input::all();
        $array = [];

        $keluhan = PkkKeluhan::where( 'id_ibu', $data['session'] )->orderBy( 'created_at', 'desc' )->get();
        foreach ( $keluhan as $row ) {
            $hash = [
                'tanggal' => Date::indonesian_date( $row->created_at, 'l, j F Y', null ),
                'judul'   => $row->judul,
                'isi'     => $row->isi,
                'id'      => $row->id,
            ];
            array_push( $array, $hash );
        }

        return Response::json( ['keluhan' => $array] );
    }

    public function getComment()
    {
        $data = Input::all();
        $komentar = [];

        $keluhan = PkkKeluhan::where( 'id_ibu', $data['session'] )->where( 'id', $data['keluhanID'] )->with( 'komentar' )->orderBy( 'created_at', 'desc' )->first();
        foreach ( $keluhan->komentar as $row ) {
            $hash = [
                'tanggal'  => $row->created_at,
                'isi'      => $row->isi,
                'pengirim' => $row->id_ibu
            ];
            array_push( $komentar, $hash );
        }

        return Response::json( ['komentar' => [
            'tanggal'  => Date::indonesian_date( $keluhan->created_at, 'l, j F Y', null ),
            'judul'    => $keluhan->judul,
            'isi'      => $keluhan->isi,
            'id'       => $keluhan->id,
            'komentar' => $komentar,
        ]] );
    }

    public function saveComment()
    {
        $data = Input::all();

        PkkKomentar::create( [
            'id_keluhan' => $data['idkel'],
            'isi'        => $data['isi'],
            'pengirim'   => $data['session'],
        ] );

        return Response::json();
    }

    public function changePass()
    {
        $data = Input::all();
        $status = "noMatchUser";

        $ibu = PkkIbu::find( $data['session'] );
        if ( $ibu ) {
            $curpass = Cryptography::cryptoJsAesDecrypt( "sistemPKK", $ibu->password_mobile );
            $oldpass = Cryptography::cryptoJsAesDecrypt( "sistemPKK", $data['oldpass'] );
            $newpass = Cryptography::cryptoJsAesDecrypt( "sistemPKK", $data['newpass'] );
            $renewpass = Cryptography::cryptoJsAesDecrypt( "sistemPKK", $data['renewpass'] );
            if ( ( $newpass == $renewpass ) && ( $oldpass == $curpass ) ) {
                $ibu->update( ['password_mobile' => $data['newpass']] );
                $status = "success";
            }
            else {
                $status = "noMatchPass";
            }
        }

        return Response::json( ['status' => $status] );
    }
}
