@extends( 'pages.pkk.pengurus.template' )

@section( 'custom-css' )
  @include( 'layouts.select2.head' )
@endsection

@section( 'custom-footer' )
  @include( 'layouts.select2.foot' )
@endsection

@section( 'main-container-header-title', "Tambah Pengurus" )

@section( 'main-container-breadcrumb' )
  <li><a href="{!! route( 'pkk' ) !!}"><i class="fa fa-dashboard"></i> Menu Utama</a></li>
  <li><a href="{!! route( 'pkk.pengurus.index' ) !!}">Pengurus PKK</a></li>
  <li class="active">Tambah Pengurus</li>
@endsection

@section( 'main-content' )
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="glyphicon glyphicon-user"></i> Data Pengurus PKK Baru</h3>
        </div>
        {!! BootForm::open()->action( route( 'pkk.pengurus.store' ) ) !!}
          @include( 'pages.pkk.pengurus.pengurus.form' )
        {!! BootForm::close() !!}
      </div>
    </div>
  </div>
@endsection
