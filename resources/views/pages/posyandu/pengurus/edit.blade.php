@extends( 'pages.posyandu.template')

@section( 'main-container-header-title', "Perbarui Data Pengurus" )

@section( 'main-container-breadcrumb' )
  <li><a href="{!! route( 'posyandu' ) !!}"><i class="fa fa-dashboard"></i> Menu Utama</a></li>
  <li><a href="{!! route( 'posyandu.pengurus' ) !!}">Data Pengurus</a></li>
  <li class="active">Perbarui Data Pengurus</li>
@endsection

@section( 'main-content' )
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="glyphicon glyphicon-tag"></i> Data Rinci Pengurus</h3>
        </div>
        {!! BootForm::open()->action( route( 'posyandu.pengurus.update', $pengurus->id ) ) !!}
          {!! BootForm::bind( $pengurus ) !!}
          <div class="box-body">
            <div class="hidden"> 
                {!! Form::text('id_posyandu', Auth::user()->id_posyandu, ['class' => 'form-control']) !!}
              </div>
          </div>
          @include( 'pages.posyandu.pengurus.form' ) 
        {!! BootForm::close() !!}
      </div>
    </div>
  </div>
@endsection