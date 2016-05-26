@extends( 'pages.posyandu.template')

@section( 'main-container-header-title', "Perbarui Data Posyandu" )

@section( 'main-container-breadcrumb' )
  <li><a href="{!! route( 'posyandu' ) !!}"><i class="fa fa-dashboard"></i> Menu Utama</a></li>
  <li><a href="{!! route( 'posyandu.data' ) !!}">Data Posyandu</a></li>
  <li class="active">Perbarui Data Posyandu</li>
@endsection

@section( 'main-content' )
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="glyphicon glyphicon-tag"></i> Data Rinci Posyandu</h3>
        </div>
        {!! BootForm::open()->action( route( 'posyandu.data.update', ['id'=>$posyandu->id, 'kel_id'=>$posyandu->kel_id] ) ) !!}
          {!! BootForm::bind( $posyandu ) !!}
          @include( 'pages.posyandu.data.form' ) 
        {!! BootForm::close() !!}
      </div>
    </div>
  </div>
@endsection