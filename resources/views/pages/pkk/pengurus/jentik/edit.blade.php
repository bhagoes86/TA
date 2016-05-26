@extends( 'pages.pkk.pengurus.template' )

@section( 'main-container-header-title', "Ubah Data Jentik Nyamuk" )

@section( 'main-container-breadcrumb' )
  <li><a href="{!! route( 'pkk' ) !!}"><i class="fa fa-dashboard"></i> Menu Utama</a></li>
  <li><a href="{!! route( 'pkk.ibu.index' ) !!}">Pendataan Jentik Nyamuk</a></li>
  <li class="active">Ubah Data Jentik Nyamuk</li>
@endsection

@section( 'main-content' )
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="glyphicon glyphicon-user"></i> Data Jentik Nyamuk</h3>
        </div>
        {!! BootForm::open()->action( route( 'pkk.jentik.update', $data['content']['id'] ) ) !!}
          {!! BootForm::bind( $data['content'] ) !!}
          <div class="box-body">
            {!! BootForm::hidden( 'id_ibu' ) !!}
            {!! BootForm::hidden( 'tahun_data' ) !!}
            {!! BootForm::hidden( 'bulan_data' ) !!}
            {!! BootForm::text( 'Jumlah:', 'jumlah' ) !!}
          </div>
          <div class="box-footer">
            {!! BootForm::submit( 'Simpan data' )->removeClass( 'btn-default' )->addClass( 'btn-primary' ) !!}
          </div>
        {!! BootForm::close() !!}
      </div>
    </div>
  </div>
@endsection
