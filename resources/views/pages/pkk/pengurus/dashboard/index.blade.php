@extends( 'pages.pkk.pengurus.template' )

@section( 'main-container-header-title', "Halaman Utama" )

@section( 'main-container-breadcrumb' )
  <li><a href="{!! route( 'pkk' ) !!}"><i class="fa fa-dashboard"></i> Menu Utama</a></li>
  <li class="active">Halaman Utama</li>
@endsection

@section( 'main-content' )
  <div class="row">
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3>{!! $data['anggota'] !!}</h3>
          <p>Jumlah anggota</p>
        </div>
        <div class="icon"><i class="fa fa-users"></i></div>
        <a href="" class="small-box-footer">Info lebih lanjut <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-green">
        <div class="inner">
          <h3>{!! $data['jentik'] !!}</h3>
          <p>Jentik nyamuk bulan ini</p>
        </div>
        <div class="icon"><i class="fa fa-medkit"></i></div>
        <a href="" class="small-box-footer">Info lebih lanjut <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
  </div>
@endsection
