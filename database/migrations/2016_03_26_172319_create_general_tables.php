<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeneralTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /////////////////////
        // USER MANAGEMENT //
        /////////////////////
        Schema::create( 'user', function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->integer( 'id_pkk' )->unsigned();
            $table->integer( 'id_posyandu' )->unsigned();
            $table->string( 'username', 50 );
            $table->text( 'password' );
            $table->timestamp( 'last_login' );
            $table->text( 'permissions' );
            $table->rememberToken();
            $table->timestamps();

            $table->unique( 'username' );
        } );
        Schema::create( 'role', function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->string( 'name' );
            $table->string( 'slug', 20 );
            $table->text( 'permissions' );

            $table->unique( 'slug' );
        } );
        Schema::create( 'user_role', function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->integer( 'user_id' )->unsigned();
            $table->integer( 'role_id' )->unsigned();
        } );

        //////////////
        // LOCATION //
        //////////////
        Schema::create( 'provinsi', function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->char( 'kode', 2 );
            $table->string( 'nama', 5 );
        } );
        Schema::create( 'kabupaten_kota', function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->integer( 'prov_id' )->unsigned();
            $table->char( 'kode', 2 );
            $table->string( 'nama', 25 );
        } );
        Schema::create( 'kecamatan', function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->integer( 'kab_id' )->unsigned();
            $table->char( 'kode', 2 );
            $table->string( 'nama', 25 );
        } );
        Schema::create( 'desa_kelurahan', function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->integer( 'kec_id' )->unsigned();
            $table->char( 'kode', 4 );
            $table->string( 'nama', 35 );
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /////////////////////
        // USER MANAGEMENT //
        /////////////////////
        Schema::drop( 'user' );
        Schema::drop( 'role' );
        Schema::drop( 'user_role' );

        //////////////
        // LOCATION //
        //////////////
        Schema::drop( 'provinsi' );
        Schema::drop( 'kabupaten_kota' );
        Schema::drop( 'kecamatan' );
        Schema::drop( 'desa_kelurahan' );
    }
}
