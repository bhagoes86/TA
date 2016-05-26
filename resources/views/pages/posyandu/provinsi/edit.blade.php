@extends( 'pages.posyandu.template')

@section( 'main-container-header-title', "Perbarui Data Provinsi" )

@section( 'main-container-breadcrumb' )
  <li><a href="{!! route( 'posyandu' ) !!}"><i class="fa fa-dashboard"></i> Menu Utama</a></li>
  <li><a href="{!! route( 'posyandu.provinsi' ) !!}">Provinsi</a></li>
  <li class="active">Perbarui Data Provinsi</li>
@endsection

@section( 'main-content' )
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="glyphicon glyphicon-tag"></i> Data Provinsi</h3>
        </div>
        {!! BootForm::open()->action( route( 'posyandu.provinsi.update', $provinsi->id ) ) !!}
          {!! BootForm::bind( $provinsi ) !!}
          @include( 'pages.posyandu.provinsi.form' ) 
        {!! BootForm::close() !!}
      </div>
    </div>
  </div>
@endsection