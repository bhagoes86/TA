<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePosyanduTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'posyandu_jenis_kas', function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->char( 'jenis', 1 );
            $table->string( 'nama' );
            $table->timestamps();
        } );
        Schema::create( 'posyandu_imunisasi', function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->string( 'jenis', 20 );
            $table->integer( 'umur' );
            $table->timestamps();
        } );
        Schema::create( 'posyandu_data', function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->integer( 'kel_id' )->unsigned();
            $table->string( 'puskesmas', 30 );
            $table->string( 'nama', 30 );
            $table->string( 'alamat' );
            $table->string( 'telp', 20 );
            $table->integer( 'rw' );
            $table->timestamps();
        } );
        Schema::create( 'posyandu_pengurus', function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->char( 'no_ktp', 16 );
            $table->integer( 'id_posyandu' )->unsigned();
            $table->string( 'nama', 30 );
            $table->string( 'alamat' );
            $table->string( 'telp', 20 );
            $table->timestamps();
        } );
        Schema::create( 'posyandu_pengumuman', function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->integer( 'id_posyandu' )->unsigned();
            $table->string( 'judul', 80 );
            $table->text( 'isi' );
            $table->string( 'link' );
            $table->timestamps();
        } );
        Schema::create( 'posyandu_kas', function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->integer( 'id_posyandu' )->unsigned();
            $table->integer( 'id_jenis' )->unsigned();
            $table->integer( 'nominal' );
            $table->text( 'keterangan' );
            $table->timestamps();
        } );
        Schema::create( 'posyandu_ibu', function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->integer( 'id_posyandu' )->unsigned();
            $table->char( 'no_ktp', 16 );
            $table->string( 'nama', 30 );
            $table->string( 'alamat' );
            $table->string( 'telp', 20 );
            $table->string( 'kb', 20 );
            $table->date( 'tanggal_lahir' );
            $table->string( 'password_mobile', 100 );
            $table->timestamps();
        } );
        Schema::create( 'posyandu_keluhan', function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->integer( 'id_ibu' )->unsigned();
            $table->string( 'judul', 80 );
            $table->text( 'isi' );
            $table->timestamps();
        } );
        Schema::create( 'posyandu_jawab_keluhan', function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->integer( 'id_keluhan' )->unsigned();
            $table->text( 'isi' );
            $table->string( 'user', 10 );
            $table->timestamps();
        } );
        Schema::create( 'posyandu_balita', function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->integer( 'id_ibu' )->unsigned();
            $table->integer( 'id_posyandu' )->unsigned();
            $table->char( 'nik', 16 );
            $table->string( 'nama', 30 );
            $table->char( 'jenis_kelamin', 1 );
            $table->integer( 'anak_ke' );
            $table->date( 'tanggal_lahir' );
            $table->decimal( 'tb_lahir', 10, 2 );
            $table->decimal( 'bb_lahir', 10, 2 );
            $table->string( 'nama_ayah', 30 );
            $table->string( 'pekerjaan_ayah', 20 );
            $table->string( 'pekerjaan_ibu', 20 );
            $table->integer( 'umur' );
            $table->timestamps();
        } );
        Schema::create( 'posyandu_absen', function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->integer( 'id_posyandu' )->unsigned();
            $table->integer( 'id_balita' )->unsigned();
            $table->timestamps();
        } );
        Schema::create( 'posyandu_pemberian_imunisasi', function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->integer( 'id_balita' )->unsigned();
            $table->integer( 'id_imunisasi' )->unsigned();
            $table->timestamps();
        } );
        Schema::create( 'posyandu_pemberian_kapsul', function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->integer( 'id_balita' )->unsigned();
            $table->string( 'umur', 20 );
            $table->string( 'jenis', 20 );
            $table->timestamps();
        } );
        Schema::create( 'posyandu_penimbangan', function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->integer( 'id_balita' )->unsigned();
            $table->integer( 'umur' );
            $table->decimal( 'berat', 10, 2 );
            $table->decimal( 'tinggi', 10, 2 );
            $table->char( 'ntob', 1 );
            $table->string( 'asi', 7 );
            $table->timestamps();
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop( 'posyandu_jenis_kas' );
        Schema::drop( 'posyandu_imunisasi' );
        Schema::drop( 'posyandu_data' );
        Schema::drop( 'posyandu_pengurus' );
        Schema::drop( 'posyandu_pengumuman' );
        Schema::drop( 'posyandu_kas' );
        Schema::drop( 'posyandu_ibu' );
        Schema::drop( 'posyandu_keluhan' );
        Schema::drop( 'posyandu_jawab_keluhan' );
        Schema::drop( 'posyandu_balita' );
        Schema::drop( 'posyandu_absen' );
        Schema::drop( 'posyandu_pemberian_imunisasi' );
        Schema::drop( 'posyandu_pemberian_kapsul' );
        Schema::drop( 'posyandu_penimbangan' );
    }
}
