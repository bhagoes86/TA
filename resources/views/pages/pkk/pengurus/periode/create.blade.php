@extends( 'pages.pkk.pengurus.template' )

@section( 'main-container-header-title', "Tambah Periode Kepengurusan" )

@section( 'main-container-breadcrumb' )
  <li><a href="{!! route( 'pkk' ) !!}"><i class="fa fa-dashboard"></i> Menu Utama</a></li>
  <li><a href="{!! route( 'pkk.periode.index' ) !!}">Periode Kepengurusan PKK</a></li>
  <li class="active">Tambah Periode Kepengurusan</li>
@endsection

@section( 'main-content' )
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="glyphicon glyphicon-user"></i> Data Periode Kepengurusan PKK Baru</h3>
        </div>
        {!! BootForm::open()->action( route( 'pkk.periode.store' ) ) !!}
          @include( 'pages.pkk.pengurus.periode.form' )
        {!! BootForm::close() !!}
      </div>
    </div>
  </div>
@endsection
