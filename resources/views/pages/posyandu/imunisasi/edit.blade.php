@extends( 'pages.posyandu.template')

@section( 'main-container-header-title', "Perbarui Data Jenis Imunisasi" )

@section( 'main-container-breadcrumb' )
  <li><a href="{!! route( 'posyandu' ) !!}"><i class="fa fa-dashboard"></i> Menu Utama</a></li>
  <li><a href="{!! route( 'posyandu.jenisimunisasi' ) !!}">Anggota PKK</a></li>
  <li class="active">Perbarui Jenis Imunisasi</li>
@endsection

@section( 'main-content' )
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="glyphicon glyphicon-tag"></i> Data Jenis Imunisasi</h3>
        </div>
        {!! BootForm::open()->action( route( 'posyandu.jenisimunisasi.update', $imunisasi->id ) ) !!}
          {!! BootForm::bind( $imunisasi ) !!}
          @include( 'pages.posyandu.imunisasi.form' ) 
        {!! BootForm::close() !!}
      </div>
    </div>
  </div>
@endsection