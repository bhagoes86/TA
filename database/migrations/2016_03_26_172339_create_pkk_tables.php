<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePkkTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'pkk_data', function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->integer( 'prov_id' )->unsigned();
            $table->integer( 'kab_id' )->unsigned();
            $table->integer( 'kec_id' )->unsigned();
            $table->integer( 'kel_id' )->unsigned();
            $table->integer( 'rw' );
            $table->integer( 'rt' );
            $table->string( 'kode_wilayah', 13 );
            $table->timestamps();
        } );
        Schema::create( 'pkk_jenis_kas', function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->integer( 'id_pkk' )->unsigned();
            $table->char( 'jenis', 1 );
            $table->string( 'nama' );
            $table->timestamps();
        });
        Schema::create( 'pkk_ibu', function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->integer( 'id_pkk' )->unsigned();
            $table->char( 'no_ktp', 16 );
            $table->string( 'nama', 30 );
            $table->string( 'alamat' );
            $table->string( 'telp', 20 );
            $table->text( 'password_mobile' );
            $table->timestamps();
        });
        Schema::create( 'pkk_periode', function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->integer( 'id_pkk' )->unsigned();
            $table->char( 'tahun_mulai', 4 );
            $table->char( 'tahun_selesai', 4 );
            $table->timestamps();
        });
        Schema::create( 'pkk_laporan', function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->integer( 'id_pkk' )->unsigned();
            $table->string( 'subjek', 50 );
            $table->string( 'file' );
            $table->timestamps();
        });
        Schema::create( 'pkk_jabatan', function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->integer( 'id_pkk' )->unsigned();
            $table->string( 'nama', 30 );
            $table->text( 'deskripsi' );
            $table->timestamps();
        });
        Schema::create( 'pkk_pengumuman', function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->integer( 'id_pkk' )->unsigned();
            $table->string( 'judul', 30 );
            $table->text( 'isi' );
            $table->string( 'link' );
            $table->timestamps();
        });
        Schema::create( 'pkk_kegiatan', function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->integer( 'id_pkk' )->unsigned();
            $table->string( 'nama', 50 );
            $table->date( 'tanggal' );
            $table->timestamps();
        });
        Schema::create( 'pkk_notulensi', function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->integer( 'id_kegiatan' )->unsigned();
            $table->text( 'isi' );
            $table->timestamps();
        });
        Schema::create( 'pkk_absen', function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->integer( 'id_ibu' )->unsigned();
            $table->integer( 'id_kegiatan' )->unsigned();
            $table->timestamps();
        });
        Schema::create( 'pkk_jentik', function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->integer( 'id_ibu' )->unsigned();
            $table->integer( 'jumlah' );
            $table->integer( 'bulan_data' );
            $table->integer( 'tahun_data' );
            $table->timestamps();
        });
        Schema::create( 'pkk_keluhan', function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->integer( 'id_ibu' )->unsigned();
            $table->string( 'judul', 80 );
            $table->text( 'isi' );
            $table->timestamps();
        });
        Schema::create( 'pkk_kas', function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->integer( 'id_ibu' )->unsigned();
            $table->integer( 'id_jenis_kas' )->unsigned();
            $table->integer( 'id_pkk' )->unsigned();
            $table->integer( 'nominal' );
            $table->timestamps();
        });
        Schema::create( 'pkk_pengurus', function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->integer( 'id_ibu' )->unsigned();
            $table->integer( 'id_periode' )->unsigned();
            $table->integer( 'id_jabatan' )->unsigned();
            $table->timestamps();
        });
        Schema::create( 'pkk_komentar', function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->integer( 'id_ibu' )->unsigned();
            $table->integer( 'id_keluhan' )->unsigned();
            $table->text( 'isi' );
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists( 'pkk_data' );
        Schema::dropIfExists( 'pkk_jenis_kas' );
        Schema::dropIfExists( 'pkk_ibu' );
        Schema::dropIfExists( 'pkk_periode' );
        Schema::dropIfExists( 'pkk_laporan' );
        Schema::dropIfExists( 'pkk_jabatan' );
        Schema::dropIfExists( 'pkk_pengumuman' );
        Schema::dropIfExists( 'pkk_kegiatan' );
        Schema::dropIfExists( 'pkk_notulensi' );
        Schema::dropIfExists( 'pkk_absen' );
        Schema::dropIfExists( 'pkk_jentik' );
        Schema::dropIfExists( 'pkk_keluhan' );
        Schema::dropIfExists( 'pkk_kas' );
        Schema::dropIfExists( 'pkk_pengurus' );
        Schema::dropIfExists( 'pkk_komentar' );
    }
}
