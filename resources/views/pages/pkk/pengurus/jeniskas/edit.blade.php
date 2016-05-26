@extends( 'pages.pkk.pengurus.template' )

@section( 'main-container-header-title', "Ubah Jenis Iuran" )

@section( 'main-container-breadcrumb' )
  <li><a href="{!! route( 'pkk' ) !!}"><i class="fa fa-dashboard"></i> Menu Utama</a></li>
  <li><a href="{!! route( 'pkk.jeniskas' ) !!}">Jenis Iuran PKK</a></li>
  <li class="active">Ubah Jenis Iuran</li>
@endsection

@section( 'main-content' )
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="glyphicon glyphicon-tag"></i> Data Jenis Iuran</h3>
        </div>
        {!! BootForm::open()->action( route( 'pkk.jeniskas.update', $data['content']->id ) ) !!}
          {!! BootForm::bind( $data['content'] ) !!}
          @include( 'pages.pkk.pengurus.jeniskas.form' )
        {!! BootForm::close() !!}
      </div>
    </div>
  </div>
@endsection
