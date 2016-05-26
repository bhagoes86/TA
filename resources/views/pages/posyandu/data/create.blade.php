@extends('pages.posyandu.template')

@section( 'main-container-header-title', "Masukkan Data Posyandu" )


@section( 'main-container-breadcrumb' )
  <li><a href="{!! route( 'posyandu' ) !!}"><i class="fa fa-dashboard"></i> Menu Utama</a></li>
  <li><a href="{!! route( 'posyandu.data' ) !!}">Data Posyandu</a></li>
  <li class="active">Tambah Data Posyandu</li>
@endsection


@section( 'main-content' )
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="glyphicon glyphicon-user"></i> Data Posyandu Kecamatan {!! $kelurahan->nama !!}</h3>
        </div>
          {!! BootForm::open()->action( route( 'posyandu.data.store', $kelurahan->id) ) !!}
            <div class="box-body">
              {!! BootForm::text( 'Username:', 'username' ) !!}
              {!! BootForm::text( 'Password website:', 'password' ) !!}
              <div class="hidden">{!! BootForm::text( 'Kode Kelurahan/Desa:', 'kel_id' , $kelurahan->id) !!}</div>
            </div>
          @include( 'pages.posyandu.data.form' )
        {!! BootForm::close() !!}
       </div>
    </div>
  </div>
@endsection