<?php


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// URL::forceRootUrl('http://simposyandu.if.its.ac.id');

/*
 * Routing Umum...
 */
Route::get( '/', ['as' => 'home', 'uses' => function () {
    return view( 'pages.home.index' );
}] );



/*
 * Routing Halaman PKK...
 */
// LOGIN
Route::get( 'pkk/login', ['as' => 'pkk.login', 'uses' => 'PkkAuthController@index'] );
Route::post( 'pkk/login', ['as' => 'pkk.login.post', 'uses' => 'PkkAuthController@login'] );
Route::get( 'pkk/logout', ['as' => 'pkk.logout', 'uses' => 'PkkAuthController@logout'] );


// REGISTRATION
Route::match( ['get', 'post'], 'pkk/register', ['as' => 'pkk.register', 'uses' => 'PkkAuthController@register'] );

// FORGET PASSWORD
Route::get( 'pkk/password/email', ['as' => 'pkk.password.email', 'uses' => 'Auth\PasswordController@getEmail'] );
Route::post( 'pkk/password/email', ['as' => 'pkk.password.email.post', 'uses' => 'Auth\PasswordController@postEmail'] );
Route::get( 'pkk/password/reset/{token}', ['as' => 'pkk.password.reset', 'uses' => 'Auth\PasswordController@getReset'] );
Route::post( 'pkk/password/reset', ['as' => 'pkk.password.reset.post', 'uses' => 'Auth\PasswordController@postReset'] );

// PENGURUS
Route::group( ['middleware' => 'pkk-login'], function() {
  // DASHBOARD
  Route::get( 'pkk', ['as' => 'pkk', 'uses' => 'PkkDashboardController@index' ] );
  // PROFILE
  Route::get( 'pkk/profile', ['as' => 'pkk.profile', 'uses' => 'PkkProfileController@index'] );
  Route::post( 'pkk/profile/change-username', ['as' => 'pkk.profile.change-username', 'uses' => 'PkkProfileController@updateUsername'] );
  Route::post( 'pkk/profile/change-password', ['as' => 'pkk.profile.change-password', 'uses' => 'PkkProfileController@updatePassword'] );
  // IBU
  Route::resource( 'pkk/ibu', 'PkkIbuController', ['except' => ['show', 'destroy']] );
  Route::get( 'pkk/ibu/delete/{id}', ['as' => 'pkk.ibu.delete', 'uses' => 'PkkIbuController@destroy'] );
  // JENIS KAS
  Route::get( 'pkk/jeniskas', ['as' => 'pkk.jeniskas', 'uses' => 'PkkJenisKasController@index'] );
  Route::get( 'pkk/jeniskas/{type}/create', ['as' => 'pkk.jeniskas.create', 'uses' => 'PkkJenisKasController@create'] );
  Route::post( 'pkk/jeniskas/{type}/create', ['as' => 'pkk.jeniskas.store', 'uses' => 'PkkJenisKasController@store'] );
  Route::get( 'pkk/jeniskas/edit/{id}', ['as' => 'pkk.jeniskas.edit', 'uses' => 'PkkJenisKasController@edit'] );
  Route::post( 'pkk/jeniskas/edit/{id}', ['as' => 'pkk.jeniskas.update', 'uses' => 'PkkJenisKasController@update'] );
  Route::get( 'pkk/jeniskas/delete/{id}', ['as' => 'pkk.jeniskas.delete', 'uses' => 'PkkJenisKasController@destroy'] );
  // KAS
  Route::get( 'pkk/kas', ['as' => 'pkk.kas', 'uses' => 'PkkKasController@index'] );
  Route::get( 'pkk/kas/{type}/create', ['as' => 'pkk.kas.create', 'uses' => 'PkkKasController@create'] );
  Route::post( 'pkk/kas/{type}/create', ['as' => 'pkk.kas.store', 'uses' => 'PkkKasController@store'] );
  Route::get( 'pkk/kas/{type}/edit/{id}', ['as' => 'pkk.kas.edit', 'uses' => 'PkkKasController@edit'] );
  Route::post( 'pkk/kas/edit/{id}', ['as' => 'pkk.kas.update', 'uses' => 'PkkKasController@update'] );
  Route::get( 'pkk/kas/delete/{id}', ['as' => 'pkk.kas.delete', 'uses' => 'PkkKasController@destroy'] );
  // PERIODE
  Route::resource( 'pkk/periode', 'PkkPeriodeController', ['except' => ['show', 'destroy']] );
  Route::get( 'pkk/periode/delete/{id}', ['as' => 'pkk.periode.delete', 'uses' => 'PkkPeriodeController@destroy'] );
  // JABATAN
  Route::resource( 'pkk/jabatan', 'PkkJabatanController', ['except' => ['show', 'destroy']] );
  Route::get( 'pkk/jabatan/delete/{id}', ['as' => 'pkk.jabatan.delete', 'uses' => 'PkkJabatanController@destroy'] );
  // PENGURUS
  Route::resource( 'pkk/pengurus', 'PkkPengurusController', ['except' => ['show', 'destroy']] );
  Route::get( 'pkk/pengurus/delete/{id}', ['as' => 'pkk.pengurus.delete', 'uses' => 'PkkPengurusController@destroy'] );
  // AKTIVITAS
  Route::resource( 'pkk/kegiatan', 'PkkKegiatanController', ['except' => ['show', 'destroy']] );
  Route::get( 'pkk/kegiatan/delete/{id}', ['as' => 'pkk.kegiatan.delete', 'uses' => 'PkkKegiatanController@destroy'] );
  // ABSEN
  Route::resource( 'pkk/absen', 'PkkAbsenController', ['only' => ['store', 'show']] );
  Route::get( 'pkk/absen/delete/{id}', ['as' => 'pkk.absen.delete', 'uses' => 'PkkAbsenController@destroy'] );
  // NOTULENSI
  Route::resource( 'pkk/notulensi', 'PkkNotulensiController', ['only' => ['store', 'edit', 'update']] );
  Route::get( 'pkk/notulensi/create/{id}', ['as' => 'pkk.notulensi.create', 'uses' => 'PkkNotulensiController@create'] );
  Route::get( 'pkk/notulensi/delete/{id}', ['as' => 'pkk.notulensi.delete', 'uses' => 'PkkNotulensiController@destroy'] );
  // JENTIK
  Route::get( 'pkk/jentik', ['as' => 'pkk.jentik.index', 'uses' => 'PkkJentikController@index'] );
  Route::post( 'pkk/jentik', ['as' => 'pkk.jentik.indexPost', 'uses' => 'PkkJentikController@indexPost'] );
  Route::get( 'pkk/jentik/create', ['as' => 'pkk.jentik.create', 'uses' => 'PkkJentikController@create'] );
  Route::get( 'pkk/jentik/edit/{month}/{id_ibu}/{year}', ['as' => 'pkk.jentik.edit', 'uses' => 'PkkJentikController@edit'] );
  Route::post( 'pkk/jentik/update/{id}', ['as' => 'pkk.jentik.update', 'uses' => 'PkkJentikController@update'] );
  Route::get( 'pkk/jentik/delete/{month}/{id_ibu}/{year}', ['as' => 'pkk.jentik.delete', 'uses' => 'PkkJentikController@destroy'] );
  // PENGUMUMAN
  Route::resource( 'pkk/pengumuman', 'PkkPengumumanController', ['except' => ['destroy']] );
  Route::get( 'pkk/pengumuman/delete/{id}', ['as' => 'pkk.pengumuman.delete', 'uses' => 'PkkPengumumanController@destroy'] );
  // LAPORAN
  Route::resource( 'pkk/laporan', 'PkkLaporanController', ['only' => ['index', 'create', 'store']] );
  Route::get( 'pkk/laporan/delete/{id}', ['as' => 'pkk.laporan.delete', 'uses' => 'PkkLaporanController@destroy'] );
  Route::get( 'pkk/laporan/download/{id}', ['as' => 'pkk.laporan.download', 'uses' => 'PkkLaporanController@download'] );
  // KELUHAN
  Route::resource( 'pkk/keluhan', 'PkkKeluhanController', ['only' => ['index', 'show']] );
  Route::get( 'pkk/keluhan/delete/{id}', ['as' => 'pkk.keluhan.delete', 'uses' => 'PkkKeluhanController@destroy'] );
  Route::post( 'pkk/keluhan/comment/{id}', ['as' => 'pkk.keluhan.comment', 'uses' => 'PkkKeluhanController@store'] );
} );

// ADMIN
Route::group( ['middleware' => 'pkk-admin-login'], function() {
  // DASHBOARD
  Route::get( 'pkk-admin', ['as' => 'pkk.admin', 'uses' => 'PkkAdminDashboardController@index' ] );
  // PROFILE
  Route::get( 'pkk-admin/profile', ['as' => 'pkk.admin.profile', 'uses' => 'PkkAdminProfileController@index'] );
  Route::post( 'pkk-admin/profile/change-username', ['as' => 'pkk.admin.profile.change-username', 'uses' => 'PkkAdminProfileController@updateUsername'] );
  Route::post( 'pkk-admin/profile/change-password', ['as' => 'pkk.admin.profile.change-password', 'uses' => 'PkkAdminProfileController@updatePassword'] );
  // USERS
  Route::get( 'pkk-admin/users', ['as' => 'pkk.admin.users', 'uses' => 'PkkAdminUsersController@index'] );
  Route::get( 'pkk-admin/users/create-admin', ['as' => 'pkk.admin.create', 'uses' => 'PkkAdminUsersController@createAdmin'] );
  Route::post( 'pkk-admin/users/create-admin', ['as' => 'pkk.admin.store', 'uses' => 'PkkAdminUsersController@storeAdmin'] );
  Route::get( 'pkk-admin/users/edit/{id}', ['as' => 'pkk.admin.edit', 'uses' => 'PkkAdminUsersController@edit'] );
  Route::post( 'pkk-admin/users/edit/{id}', ['as' => 'pkk.admin.update', 'uses' => 'PkkAdminUsersController@update'] );
  Route::get( 'pkk-admin/users/delete/{id}', ['as' => 'pkk.admin.delete', 'uses' => 'PkkAdminUsersController@destroy'] );
} );


/*------------------------------\
|                               |
|   Routing Halaman POSYANDU    |
|                               |
\------------------------------*/
// LOGIN
Route::get( 'posyandu/login', ['as' => 'posyandu.login', 'uses' => 'PosyanduAuthController@index'] );
Route::post( 'posyandu/login', ['as' => 'posyandu.login.post', 'uses' => 'PosyanduAuthController@login'] );
Route::get( 'posyandu/logout', ['as' => 'posyandu.logout', 'uses' => 'PosyanduAuthController@logout'] );

// REGISTRATION
// Route::match( ['get', 'post'], 'posyandu/register', ['as' => 'posyandu.register', 'uses' => 'PosyanduAuthController@register'] );

// FORGET PASSWORD
Route::get( 'posyandu/password/email', ['as' => 'posyandu.password.email', 'uses' => 'Auth\PasswordController@getEmail'] );
Route::post( 'posyandu/password/email', ['as' => 'posyandu.password.email.post', 'uses' => 'Auth\PasswordController@postEmail'] );
Route::get( 'posyandu/password/reset/{token}', ['as' => 'posyandu.password.reset', 'uses' => 'Auth\PasswordController@getReset'] );
Route::post( 'posyandu/password/reset', ['as' => 'posyandu.password.reset.post', 'uses' => 'Auth\PasswordController@postReset'] );

// UMUM PENGURUS
Route::group( ['middleware' => 'posyandu-login'], function() {
  // DASHBOARD
  Route::get( 'posyandu', ['as' => 'posyandu', 'uses' => 'PosyanduDashboardController@index'] );
  
  // IBU
  Route::get( 'posyandu/ibu', ['as' => 'posyandu.ibu', 'uses' => 'PosyanduIbuController@index'] );
  Route::get( 'posyandu/ibu/create', ['as' => 'posyandu.ibu.create', 'uses' => 'PosyanduIbuController@create'] );
  Route::post( 'posyandu/ibu/store', ['as' => 'posyandu.ibu.store', 'uses' => 'PosyanduIbuController@store'] );
  Route::get( 'posyandu/ibu/delete{id}', ['as' => 'posyandu.ibu.delete', 'uses' => 'PosyanduIbuController@destroy'] );
  // Route::get( 'posyandu/akun', ['as' => 'posyandu.akun', 'uses' => 'PosyanduIbuController@index_akun'] );
  Route::post( 'posyandu/ibu/update/{id}', ['as' => 'posyandu.ibu.update', 'uses' => 'PosyanduIbuController@update'] );

  // BALITA
  Route::get( 'posyandu/balita', ['as' => 'posyandu.balita', 'uses' => 'PosyanduBalitaController@index'] );
  Route::post( 'posyandu/balita/store', ['as' => 'posyandu.balita.store', 'uses' => 'PosyanduBalitaController@store'] );
  Route::get( 'posyandu/balita/delete{id}', ['as' => 'posyandu.balita.delete', 'uses' => 'PosyanduBalitaController@destroy'] );
  Route::post( 'posyandu/balita/update/{id}', ['as' => 'posyandu.balita.update', 'uses' => 'PosyanduBalitaController@update'] );
  
  // PENIMBANGAN
  Route::get( 'posyandu/penimbangan', ['as' => 'posyandu.penimbangan', 'uses' => 'PosyanduPenimbanganController@index'] );
  Route::post( 'posyandu/penimbangan/store', ['as' => 'posyandu.penimbangan.store', 'uses' => 'PosyanduPenimbanganController@store'] );
  Route::post( 'posyandu/penimbangan/update/{id}', ['as' => 'posyandu.penimbangan.update', 'uses' => 'PosyanduPenimbanganController@update'] );
  Route::get( 'posyandu/penimbangan/delete{id}', ['as' => 'posyandu.penimbangan.delete', 'uses' => 'PosyanduPenimbanganController@destroy'] );
  
  // BERI IMUNISASI
  Route::get( 'posyandu/beriimunisasi', ['as' => 'posyandu.beriimunisasi', 'uses' => 'PosyanduBeriImunisasiController@index'] );
  Route::post( 'posyandu/beriimunisasi/store', ['as' => 'posyandu.beriimunisasi.store', 'uses' => 'PosyanduBeriImunisasiController@store'] );
  Route::post( 'posyandu/beriimunisasi/update/{id}', ['as' => 'posyandu.beriimunisasi.update', 'uses' => 'PosyanduBeriImunisasiController@update'] );
  Route::get( 'posyandu/beriimunisasi/delete{id}', ['as' => 'posyandu.beriimunisasi.delete', 'uses' => 'PosyanduBeriImunisasiController@destroy'] );
  
  // KAPSUL
  Route::get( 'posyandu/kapsul', ['as' => 'posyandu.kapsul', 'uses' => 'PosyanduKapsulController@index'] );
  Route::post( 'posyandu/kapsul/store', ['as' => 'posyandu.kapsul.store', 'uses' => 'PosyanduKapsulController@store'] );
  Route::post( 'posyandu/kapsul/update/{id}', ['as' => 'posyandu.kapsul.update', 'uses' => 'PosyanduKapsulController@update'] );
  Route::get( 'posyandu/kapsul/delete{id}', ['as' => 'posyandu.kapsul.delete', 'uses' => 'PosyanduKapsulController@destroy'] );

  // PENGURUS POSYANDU
  Route::get( 'posyandu/pengurus', ['as' => 'posyandu.pengurus', 'uses' => 'PosyanduPengurusController@index'] );
  Route::get( 'posyandu/pengurus/create', ['as' => 'posyandu.pengurus.create', 'uses' => 'PosyanduPengurusController@create'] );
  Route::post( 'posyandu/pengurus/store', ['as' => 'posyandu.pengurus.store', 'uses' => 'PosyanduPengurusController@store'] );
  Route::post( 'posyandu/pengurus/update/{id}', ['as' => 'posyandu.pengurus.update', 'uses' => 'PosyanduPengurusController@update'] );
  Route::get( 'posyandu/pengurus/delete{id}', ['as' => 'posyandu.pengurus.delete', 'uses' => 'PosyanduPengurusController@destroy'] );

   // KAS
  Route::get( 'posyandu/kas', ['as' => 'posyandu.kas', 'uses' => 'PosyanduKasController@index'] );
  Route::get( 'posyandu/kas/create', ['as' => 'posyandu.kas.create', 'uses' => 'PosyanduKasController@create'] );
  Route::post( 'posyandu/kas/store', ['as' => 'posyandu.kas.store', 'uses' => 'PosyanduKasController@store'] );
  Route::post( 'posyandu/kas/update/{id}', ['as' => 'posyandu.kas.update', 'uses' => 'PosyanduKasController@update'] );
  Route::get( 'posyandu/kas/delete{id}', ['as' => 'posyandu.kas.delete', 'uses' => 'PosyanduKasController@destroy'] );
  
  // ABSEN
  Route::get( 'posyandu/absen', ['as' => 'posyandu.absen', 'uses' => 'PosyanduAbsenController@index'] );
  Route::get( 'posyandu/absen/create', ['as' => 'posyandu.absen.create', 'uses' => 'PosyanduAbsenController@create'] );
  Route::post( 'posyandu/absen/store', ['as' => 'posyandu.absen.store', 'uses' => 'PosyanduAbsenController@store'] );
  Route::post( 'posyandu/absen/update/{id}', ['as' => 'posyandu.absen.update', 'uses' => 'PosyanduAbsenController@update'] );
  Route::get( 'posyandu/absen/delete{id}', ['as' => 'posyandu.absen.delete', 'uses' => 'PosyanduAbsenController@destroy'] );

  // POSYANDU PROFILE
  Route::get( 'posyandu/profile', ['as' => 'posyandu.profile' , 'uses' => 'PosyanduProfileController@index'] );
  Route::post( 'posyandu/profile/change-username', ['as' => 'posyandu.profile.change-username', 'uses' => 'PosyanduProfileController@updateUsername'] );
  Route::post( 'posyandu/profile/change-password', ['as' => 'posyandu.profile.change-password', 'uses' => 'PosyanduProfileController@updatePassword'] );

  // KELUHAN
  Route::get( 'posyandu/keluhan', ['as' => 'posyandu.keluhan', 'uses' => 'PosyanduKeluhanController@index'] );
  Route::get( 'posyandu/keluhan/delete{id}', ['as' => 'posyandu.keluhan.delete', 'uses' => 'PosyanduKeluhanController@destroy'] );
  Route::post( 'posyandu/jawabkeluhan/create/{id}', ['as' => 'posyandu.jawabkeluhan.create', 'uses' => 'PosyanduKeluhanController@comment'] );
  Route::get( 'posyandu/jawabkeluhan/delete{id}', ['as' => 'posyandu.jawabkeluhan.delete', 'uses' => 'PosyandukeluhanController@delete_comment'] );

  // PENGUMUMAN
  Route::get( 'posyandu/pengumuman', ['as' => 'posyandu.pengumuman', 'uses' => 'PosyanduPengumumanController@index'] );
  Route::get( 'posyandu/pengumuman/create', ['as' => 'posyandu.pengumuman.create', 'uses' => 'PosyanduPengumumanController@create'] );
  Route::post( 'posyandu/pengumuman/store', ['as' => 'posyandu.pengumuman.store', 'uses' => 'PosyanduPengumumanController@store'] );
  Route::get( 'posyandu/pengumuman/show/{id}', ['as' => 'posyandu.pengumuman.show', 'uses' => 'PosyanduPengumumanController@show'] );
  Route::get( 'posyandu/pengumuman/edit/{id}', ['as' => 'posyandu.pengumuman.edit', 'uses' => 'PosyanduPengumumanController@edit'] );
  Route::post( 'posyandu/pengumuman/update/{id}', ['as' => 'posyandu.pengumuman.update', 'uses' => 'PosyanduPengumumanController@update'] );
  Route::get( 'posyandu/pengumuman/delete{id}', ['as' => 'posyandu.pengumuman.delete', 'uses' => 'PosyanduPengumumanController@destroy'] );

});

// ADMIN
Route::group( ['middleware' => 'posyandu-admin-login'], function() {

  // DASHBOARD
  Route::get( 'posyandu-admin', ['as' => 'posyandu.admin', 'uses' => 'PosyanduDashboardController@index' ] );
  
  // PROFILE
  Route::get( 'posyandu-admin/profile', ['as' => 'posyandu.admin.profile', 'uses' => 'PosyanduAdminProfileController@index'] );
  Route::post( 'posyandu-admin/profile/change-username', ['as' => 'posyandu.admin.profile.change-username', 'uses' => 'PosyanduAdminProfileController@updateUsername'] );
  Route::post( 'posyandu-admin/profile/change-password', ['as' => 'posyandu.admin.profile.change-password', 'uses' => 'PosyanduAdminProfileController@updatePassword'] );

  // DATA POSYANDU
  Route::get( 'posyandu/data', ['as' => 'posyandu.data', 'uses' => 'PosyanduDataController@index'] );
  Route::get( 'posyandu/data/register', ['as' => 'posyandu.data.register', 'uses' => 'PosyanduDataController@register'] );
  Route::get( 'posyandu/data/create/{id}', ['as' => 'posyandu.data.create', 'uses' => 'PosyanduDataController@create'] );
  Route::post( 'posyandu/data/store/{id}', ['as' => 'posyandu.data.store', 'uses' => 'PosyanduDataController@store'] );
  Route::get( 'posyandu/data/edit/{id}', ['as' => 'posyandu.data.edit', 'uses' => 'PosyanduDataController@edit'] );
  Route::post( 'posyandu/data/update/{id}/{kel_id}', ['as' => 'posyandu.data.update', 'uses' => 'PosyanduDataController@update'] );
  Route::get( 'posyandu/data/delete{id}', ['as' => 'posyandu.data.delete', 'uses' => 'PosyanduDataController@destroy'] );

  // JENIS IMUNISASI
  Route::get( 'posyandu-admin/jenisimunisasi', ['as' => 'posyandu.jenisimunisasi', 'uses' => 'PosyanduImunisasiController@index'] );
  Route::get( 'posyandu-admin/jenisimunisasi/create', ['as' => 'posyandu.jenisimunisasi.create', 'uses' => 'PosyanduImunisasiController@create'] );
  Route::post( 'posyandu-admin/jenisimunisasi/store', ['as' => 'posyandu.jenisimunisasi.store', 'uses' => 'PosyanduImunisasiController@store'] );
  Route::get( 'posyandu-admin/jenisimunisasi/edit/{id}', ['as' => 'posyandu.jenisimunisasi.edit', 'uses' => 'PosyanduImunisasiController@edit'] );
  Route::post( 'posyandu-admin/jenisimunisasi/update/{id}', ['as' => 'posyandu.jenisimunisasi.update', 'uses' => 'PosyanduImunisasiController@update'] );
  Route::get( 'posyandu-admin/jenisimunisasi/delete{id}', ['as' => 'posyandu.jenisimunisasi.delete', 'uses' => 'PosyanduImunisasiController@destroy'] );
    
    Route::get( 'posyandu-admin/backup', ['as' => 'backup', 'uses' => function(){
      exec("C:/xampp/mysql/bin/mysqldump -uroot -hlocalhost sim_stranas > E:\sim_stranas.". date("Y-m-d_H-i-s") . ".sql");
      Session::flash( 'success', "Basis data berhasil di <i>backup</i>!" );
      return redirect()->back();
  }] );
  
  // PROVINSI
  Route::get( 'posyandu-admin/provinsi', ['as' => 'posyandu.provinsi', 'uses' => 'PosyanduProvinsiController@index'] );
  Route::get( 'posyandu-admin/provinsi/create', ['as' => 'posyandu.provinsi.create', 'uses' => 'PosyanduProvinsiController@create'] );
  Route::post( 'posyandu-admin/provinsi/store', ['as' => 'posyandu.provinsi.store', 'uses' => 'PosyanduProvinsiController@store'] );
  Route::get( 'posyandu-admin/provinsi/edit/{id}', ['as' => 'posyandu.provinsi.edit', 'uses' => 'PosyanduProvinsiController@edit'] );
  Route::post( 'posyandu-admin/provinsi/update/{id}', ['as' => 'posyandu.provinsi.update', 'uses' => 'PosyanduProvinsiController@update'] );
  Route::get( 'posyandu-admin/provinsi/delete{id}', ['as' => 'posyandu.provinsi.delete', 'uses' => 'PosyanduProvinsiController@destroy'] );

  // KABUPATEN
  Route::get( 'posyandu-admin/kabupaten/{id}', ['as' => 'posyandu.kabupaten', 'uses' => 'PosyanduKabupatenController@index'] );
  Route::get( 'posyandu-admin/kabupaten/create', ['as' => 'posyandu.kabupaten.create', 'uses' => 'PosyanduKabupatenController@create'] );
  Route::post( 'posyandu-admin/kabupaten/store', ['as' => 'posyandu.kabupaten.store', 'uses' => 'PosyanduKabupatenController@store'] );
  Route::get( 'posyandu-admin/kabupaten/edit/{id}', ['as' => 'posyandu.kabupaten.edit', 'uses' => 'PosyanduKabupatenController@edit'] );
  Route::post( 'posyandu-admin/kabupaten/update/{id}', ['as' => 'posyandu.kabupaten.update', 'uses' => 'PosyanduKabupatenController@update'] );
  Route::get( 'posyandu-admin/kabupaten/delete{id}', ['as' => 'posyandu.kabupaten.delete', 'uses' => 'PosyanduKabupatenController@destroy'] );

  // KECAMATAN
  Route::get( 'posyandu-admin/kecamatan/{id}', ['as' => 'posyandu.kecamatan', 'uses' => 'PosyanduKecamatanController@index'] );
  Route::get( 'posyandu-admin/kecamatan/create', ['as' => 'posyandu.kecamatan.create', 'uses' => 'PosyanduKecamatanController@create'] );
  Route::post( 'posyandu-admin/kecamatan/store', ['as' => 'posyandu.kecamatan.store', 'uses' => 'PosyanduKecamatanController@store'] );
  Route::get( 'posyandu-admin/kecamatan/edit/{id}', ['as' => 'posyandu.kecamatan.edit', 'uses' => 'PosyanduKecamatanController@edit'] );
  Route::post( 'posyandu-admin/kecamatan/update/{id}', ['as' => 'posyandu.kecamatan.update', 'uses' => 'PosyanduKecamatanController@update'] );
  Route::get( 'posyandu-admin/kecamatan/delete{id}', ['as' => 'posyandu.kecamatan.delete', 'uses' => 'PosyanduKecamatanController@destroy'] );

  // KELURAHAN
  Route::get( 'posyandu-admin/kelurahan/{id}', ['as' => 'posyandu.kelurahan', 'uses' => 'PosyanduKelurahanController@index'] );
  Route::get( 'posyandu-admin/kelurahan/create', ['as' => 'posyandu.kelurahan.create', 'uses' => 'PosyanduKelurahanController@create'] );
  Route::post( 'posyandu-admin/kelurahan/store', ['as' => 'posyandu.kelurahan.store', 'uses' => 'PosyanduKelurahanController@store'] );
  Route::get( 'posyandu-admin/kelurahan/show/{id}', ['as' => 'posyandu.kelurahan.show', 'uses' => 'PosyanduKelurahanController@show'] );
  Route::get( 'posyandu-admin/kelurahan/edit/{id}', ['as' => 'posyandu.kelurahan.edit', 'uses' => 'PosyanduKelurahanController@edit'] );
  Route::post( 'posyandu-admin/kelurahan/update/{id}', ['as' => 'posyandu.kelurahan.update', 'uses' => 'PosyanduKelurahanController@update'] );
  Route::get( 'posyandu-admin/kelurahan/delete{id}', ['as' => 'posyandu.kelurahan.delete', 'uses' => 'PosyanduKelurahanController@destroy'] );

} );

// KHUSUS PENGURUS
Route::group( ['middleware' => 'posyandu-login-khusus'], function() {
  // IBU
  Route::get( 'posyandu/ibu/show/{id}', ['as' => 'posyandu.ibu.show', 'uses' => 'PosyanduIbuController@show'] );
  Route::get( 'posyandu/ibu/edit/{id}', ['as' => 'posyandu.ibu.edit', 'uses' => 'PosyanduIbuController@edit'] );
  
  // BALITA
  Route::get( 'posyandu/balita/create/{id}', ['as' => 'posyandu.balita.create', 'uses' => 'PosyanduBalitaController@create'] );
  Route::get( 'posyandu/balita/show/{id}', ['as' => 'posyandu.balita.show', 'uses' => 'PosyanduBalitaController@show'] );
  Route::get( 'posyandu/balita/edit/{id}', ['as' => 'posyandu.balita.edit', 'uses' => 'PosyanduBalitaController@edit'] );

  // PENIMBANGAN
  Route::get( 'posyandu/penimbangan/create/{id}', ['as' => 'posyandu.penimbangan.create', 'uses' => 'PosyanduPenimbanganController@create'] );
  // Route::get( 'posyandu/penimbangan/show/{id}', ['as' => 'posyandu.penimbangan.show', 'uses' => 'PosyanduPenimbanganController@show'] );
  Route::get( 'posyandu/penimbangan/edit/{id}', ['as' => 'posyandu.penimbangan.edit', 'uses' => 'PosyanduPenimbanganController@edit'] );

  // IMUNISASI
  Route::get( 'posyandu/beriimunisasi/create/{id}', ['as' => 'posyandu.beriimunisasi.create', 'uses' => 'PosyanduBeriImunisasiController@create'] );
  // Route::get( 'posyandu/beriimunisasi/show/{id}', ['as' => 'posyandu.beriimunisasi.show', 'uses' => 'PosyanduBeriImunisasiController@show'] );
  Route::get( 'posyandu/beriimunisasi/edit/{id}', ['as' => 'posyandu.beriimunisasi.edit', 'uses' => 'PosyanduBeriImunisasiController@edit'] );

  // KAPSUL
  Route::get( 'posyandu/kapsul/create/{id}', ['as' => 'posyandu.kapsul.create', 'uses' => 'PosyanduKapsulController@create'] );
  // Route::get( 'posyandu/kapsul/show/{id}', ['as' => 'posyandu.kapsul.show', 'uses' => 'PosyanduKapsulController@show'] );
  Route::get( 'posyandu/kapsul/edit/{id}', ['as' => 'posyandu.kapsul.edit', 'uses' => 'PosyanduKapsulController@edit'] );

  // PENGURUS
  // Route::get( 'posyandu/pengurus/show/{id}', ['as' => 'posyandu.pengurus.show', 'uses' => 'PosyanduPengurusController@show'] );
  Route::get( 'posyandu/pengurus/edit/{id}', ['as' => 'posyandu.pengurus.edit', 'uses' => 'PosyanduPengurusController@edit'] );

  // KAS
  // Route::get( 'posyandu/kas/show/{id}', ['as' => 'posyandu.kas.show', 'uses' => 'PosyanduKasController@show'] );
  Route::get( 'posyandu/kas/edit/{id}', ['as' => 'posyandu.kas.edit', 'uses' => 'PosyanduKasController@edit'] );
 
  // ABSEN
  // Route::get( 'posyandu/absen/show/{id}', ['as' => 'posyandu.absen.show', 'uses' => 'PosyanduAbsenController@show'] );
  Route::get( 'posyandu/absen/edit/{id}', ['as' => 'posyandu.absen.edit', 'uses' => 'PosyanduAbsenController@edit'] );
  
  // KELUHAN
  Route::get( 'posyandu/keluhan/show/{id}', ['as' => 'posyandu.keluhan.show', 'uses' => 'PosyanduKeluhanController@show'] );
} );



























// /*
//  * Routing Halaman Posyandu...
//  */
// Route::get( 'posyandu/home', function () {
//     return view( 'posyandu.home.index' );
// } );
// Route::get( 'main', 'PosyanduMainController@index');
// Route::get( 'download', 'PosyanduDownloadController@index');
// Route::post( 'posyandu', 'PosyanduLoginController@login' );
// Route::get( 'posyandu', 'PosyanduLoginController@index' );
// Route::get( 'posyandu/logout', 'PosyanduLoginController@logout' );

// Route::get( 'panduan', function () {
//   $file= public_path(). "\dist\apk\Panduan.apk";
//   return response()->download( $file );
// } );

// Route::get( 'mobile', function () {
//   $file= public_path(). "\dist\apk\Posyandu.apk";
//   return response()->download( $file );
// } );

// Route::group( ['middleware' => 'login'], function() {
//   Route::post( 'posyandu/balita/find', 'PosyanduBalitaController@find' );
//   Route::post( 'posyandu/penimbangan/find', 'PosyanduPenimbanganController@find' );
//   Route::post( 'posyandu/jawabkeluhan', 'PosyanduKeluhanController@comment' );
//   Route::post( 'posyandu/hapusjawabkeluhan', 'PosyanduKeluhanController@delete_comment' );

//   Route::resource( 'posyandu/data', 'PosyanduDataController' );
//   Route::resource( 'posyandu/ibu', 'PosyanduIbuController' );
//   Route::resource( 'posyandu/imunisasi', 'PosyanduImunisasiController' );
//   Route::resource( 'posyandu/jeniskas', 'PosyanduJenisKasController' );
//   Route::resource( 'posyandu/pengumuman', 'PosyanduPengumumanController' );
//   Route::resource( 'posyandu/balita', 'PosyanduBalitaController' );
//   Route::resource( 'posyandu/pengurus', 'PosyanduPengurusController' );
//   Route::resource( 'posyandu/kas', 'PosyanduKasController' );
//   Route::resource( 'posyandu/keluhan', 'PosyanduKeluhanController' );
//   Route::resource( 'posyandu/absen', 'PosyanduAbsenController' );
//   Route::resource( 'posyandu/kapsul', 'PosyanduKapsulController' );
//   Route::resource( 'posyandu/penimbangan', 'PosyanduPenimbanganController' );
//   Route::resource( 'posyandu/beriimunisasi', 'PosyanduBeriImunisasiController' );
//   Route::resource( 'posyandu/users', 'PosyanduUserController' );
//   Route::resource( 'posyandu/provinsi', 'PosyanduProvinsiController' );
//   Route::resource( 'posyandu/kabupaten', 'PosyanduKabupatenController' );
//   Route::resource( 'posyandu/kecamatan', 'PosyanduKecamatanController' );
//   Route::resource( 'posyandu/kelurahan', 'PosyanduKelurahanController' );
//   Route::resource( 'posyandu/akunibu', 'PosyanduAkunIbuController' );
// } );
