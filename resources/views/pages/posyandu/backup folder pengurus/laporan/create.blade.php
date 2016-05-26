@extends( 'pages.pkk.pengurus.template' )

@section( 'main-container-header-title', "Tambah Laporan Bidang PKK" )

@section( 'main-container-breadcrumb' )
  <li><a href="{!! route( 'pkk' ) !!}"><i class="fa fa-dashboard"></i> Menu Utama</a></li>
  <li><a href="{!! route( 'pkk.laporan.index' ) !!}">Laporan Bidang PKK</a></li>
  <li class="active">Tambah Laporan Bidang PKK</li>
@endsection

@section( 'main-content' )
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="glyphicon glyphicon-user"></i> Data Laporan Bidang PKK Baru</h3>
        </div>
        {!! BootForm::open()->action( route( 'pkk.laporan.store' ) )->multipart() !!}
          <div class="box-body">
            {!! BootForm::text( 'Subjek:', 'subjek' ) !!}
            {!! BootForm::file( 'Unggah file:', 'file' ) !!}
          </div>
          <div class="box-footer">
            {!! BootForm::submit( 'Simpan data' )->removeClass( 'btn-default' )->addClass( 'btn-primary' ) !!}
          </div>
        {!! BootForm::close() !!}
      </div>
    </div>
  </div>
@endsection
