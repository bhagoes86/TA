@extends( 'pages.pkk.pengurus.template' )

@section( 'main-container-header-title', "Tambah Notulensi" )

@section( 'main-container-breadcrumb' )
  <li><a href="{!! route( 'pkk' ) !!}"><i class="fa fa-dashboard"></i> Menu Utama</a></li>
  <li><a href="{!! route( 'pkk.kegiatan.index' ) !!}">Kegiatan PKK</a></li>
  <li class="active">Tambah Notulensi</li>
@endsection

@section( 'main-content' )
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="glyphicon glyphicon-user"></i> Data Notulensi Baru</h3>
        </div>
        {!! BootForm::open()->action( route( 'pkk.notulensi.store' ) ) !!}
          {!! BootForm::hidden( 'id_kegiatan' )->value( $data['id_kegiatan'] ) !!}
          @include( 'pages.pkk.pengurus.notulensi.form' )
        {!! BootForm::close() !!}
      </div>
    </div>
  </div>
@endsection
