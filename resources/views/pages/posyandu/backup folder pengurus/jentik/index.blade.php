@extends( 'pages.pkk.pengurus.template' )

@section( 'custom-css' )
  <style type="text/css">
    @media (max-width: 767px) {
      .btn-title {
        display: none;
      }
    }
  </style>
  @include( 'layouts.select2.head' )
@endsection

@section( 'custom-footer' )
  @include( 'layouts.select2.foot' )
@endsection

@section( 'main-container-header-title', "Pendataan Jentik Nyamuk" )

@section( 'main-container-breadcrumb' )
  <li><a href="{!! route( 'pkk' ) !!}"><i class="fa fa-dashboard"></i> Menu Utama</a></li>
  <li class="active">Pendataan Jentik Nyamuk</li>
@endsection

@section( 'main-content' )
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Daftar Data Jentik Nyamuk</h3>
        </div>
        <div class="box-body">
          {!! BootForm::open()->action( route( 'pkk.jentik.indexPost' ) ) !!}
            {!! BootForm::bind( $data['request'] ) !!}
            {!! BootForm::select( 'Pilih anggota PKK', 'id_ibu', $data['anggota'] )->addClass( 'select2' ) !!}
            {!! BootForm::text( 'Masukkan tahun', 'year' ) !!}
            {!! BootForm::submit( 'Tampilkan data' )->removeClass( 'btn-default' )->addClass( 'btn-primary' ) !!}
          {!! BootForm::close() !!}
          @if( $data['content'] )
            <hr>
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th class="col-xs-2">Bulan</th>
                  <th class="col-xs-2">Jumlah</th>
                  <th class="col-xs-2">Aksi</th>
                  <th class="col-xs-2">Bulan</th>
                  <th class="col-xs-2">Jumlah</th>
                  <th class="col-xs-2">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Januari</td>
                  <td>{!! $data['content'][1] !!}</td>
                  <td>@include( 'pages.pkk.pengurus.jentik.btn-group', ['month' => 1] )</td>
                  <td>Juli</td>
                  <td>{!! $data['content'][7] !!}</td>
                  <td>@include( 'pages.pkk.pengurus.jentik.btn-group', ['month' => 7] )</td>
                </tr>
                <tr>
                  <td>Februari</td>
                  <td>{!! $data['content'][2] !!}</td>
                  <td>@include( 'pages.pkk.pengurus.jentik.btn-group', ['month' => 2] )</td>
                  <td>Agustus</td>
                  <td>{!! $data['content'][8] !!}</td>
                  <td>@include( 'pages.pkk.pengurus.jentik.btn-group', ['month' => 8] )</td>
                </tr>
                <tr>
                  <td>Maret</td>
                  <td>{!! $data['content'][3] !!}</td>
                  <td>@include( 'pages.pkk.pengurus.jentik.btn-group', ['month' => 3] )</td>
                  <td>September</td>
                  <td>{!! $data['content'][9] !!}</td>
                  <td>@include( 'pages.pkk.pengurus.jentik.btn-group', ['month' => 9] )</td>
                </tr>
                <tr>
                  <td>April</td>
                  <td>{!! $data['content'][4] !!}</td>
                  <td>@include( 'pages.pkk.pengurus.jentik.btn-group', ['month' => 4] )</td>
                  <td>Oktober</td>
                  <td>{!! $data['content'][10] !!}</td>
                  <td>@include( 'pages.pkk.pengurus.jentik.btn-group', ['month' => 10] )</td>
                </tr>
                <tr>
                  <td>Mei</td>
                  <td>{!! $data['content'][5] !!}</td>
                  <td>@include( 'pages.pkk.pengurus.jentik.btn-group', ['month' => 5] )</td>
                  <td>November</td>
                  <td>{!! $data['content'][11] !!}</td>
                  <td>@include( 'pages.pkk.pengurus.jentik.btn-group', ['month' => 11] )</td>
                </tr>
                <tr>
                  <td>Juni</td>
                  <td>{!! $data['content'][6] !!}</td>
                  <td>@include( 'pages.pkk.pengurus.jentik.btn-group', ['month' => 6] )</td>
                  <td>Desember</td>
                  <td>{!! $data['content'][12] !!}</td>
                  <td>@include( 'pages.pkk.pengurus.jentik.btn-group', ['month' => 12] )</td>
                </tr>
              </tbody>
            </table>
          @endif
        </div>
      </div>
    </div>
  </div>
  @include( 'layouts.scripts.delete-modal' )
@endsection
