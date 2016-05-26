@extends('pages.posyandu.template')

@section( 'main-container-header-title', "Masukkan Data Kelurahan / Desa" )

@section( 'main-container-breadcrumb' )
  <li><a href="{!! route( 'posyandu' ) !!}"><i class="fa fa-dashboard"></i> Menu Utama</a></li>
  <li><a href="{!! route( 'posyandu.kelurahan' ) !!}">Data Kelurahan / Desa</a></li>
  <li class="active">Tambah Kelurahan/Desa</li>
@endsection

@section( 'main-content' )
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="glyphicon glyphicon-user"></i>Data Kecamatan</h3>
        </div>
        {!! BootForm::open()->action( route( 'posyandu.kelurahan.store' ) ) !!}
          <div class="box-body">
            {!! Form::label('Kecamatan', 'Pilih Kecamatan:') !!}
            <select class="special-flexselect form-control" id="data-kecamatan" name="kec_id" tabindex="1">
              <option value=""></option>
              @foreach($kecamatan as $lokasiKecamatan)
                <option value="{!! $lokasiKecamatan->id !!}">{!! $lokasiKecamatan->nama !!}</option>
              @endforeach
            </select>
          </div>
          @include( 'pages.posyandu.kelurahan.form' )
        {!! BootForm::close() !!}
      </div>
    </div>
  </div>
@endsection
