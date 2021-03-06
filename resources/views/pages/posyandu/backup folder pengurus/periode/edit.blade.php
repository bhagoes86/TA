@extends( 'pages.pkk.pengurus.template' )

@section( 'main-container-header-title', "Ubah Periode Kepengurusan" )

@section( 'main-container-breadcrumb' )
  <li><a href="{!! route( 'pkk' ) !!}"><i class="fa fa-dashboard"></i> Menu Utama</a></li>
  <li><a href="{!! route( 'pkk.periode.index' ) !!}">Periode Kepengurusan PKK</a></li>
  <li class="active">Ubah Periode Kepengurusan</li>
@endsection

@section( 'main-content' )
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="glyphicon glyphicon-user"></i> Data Periode Kepengurusan PKK</h3>
        </div>
        {!! BootForm::open()->action( route( 'pkk.periode.update', $data['content']->id ) )->put() !!}
          {!! BootForm::bind( $data['content'] ) !!}
          @include( 'pages.pkk.pengurus.periode.form' )
        {!! BootForm::close() !!}
      </div>
    </div>
  </div>
@endsection
