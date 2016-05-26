@extends( 'pages.pkk.pengurus.template' )

@section( 'main-container-header-title', "Tambah Jabatan Kepengurusan" )

@section( 'main-container-breadcrumb' )
  <li><a href="{!! route( 'pkk' ) !!}"><i class="fa fa-dashboard"></i> Menu Utama</a></li>
  <li><a href="{!! route( 'pkk.jabatan.index' ) !!}">Jabatan Kepengurusan PKK</a></li>
  <li class="active">Tambah Jabatan Kepengurusan</li>
@endsection

@section( 'main-content' )
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="glyphicon glyphicon-user"></i> Data Jabatan Kepengurusan PKK Baru</h3>
        </div>
        {!! BootForm::open()->action( route( 'pkk.jabatan.store' ) ) !!}
          @include( 'pages.pkk.pengurus.jabatan.form' )
        {!! BootForm::close() !!}
      </div>
    </div>
  </div>
@endsection
