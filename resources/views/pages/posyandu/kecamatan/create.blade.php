@extends('pages.posyandu.template')

@section( 'main-container-header-title', "Masukkan Data Kecamatan" )

@section( 'main-container-breadcrumb' )
  <li><a href="{!! route( 'posyandu' ) !!}"><i class="fa fa-dashboard"></i> Menu Utama</a></li>
  <li><a href="{!! route( 'posyandu.kecamatan' ) !!}">Data Kecamatan</a></li>
  <li class="active">Tambah Kecamatan</li>
@endsection

@section( 'main-content' )
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="glyphicon glyphicon-user"></i>Data Kecamatan</h3>
        </div>
        {!! BootForm::open()->action( route( 'posyandu.kecamatan.store' ) ) !!}
          <div class="box-body">
            {!! Form::label('Kabupaten', 'Pilih Kabupaten:') !!}
            <select class="special-flexselect form-control" id="data-kabupaten" name="kab_id" tabindex="1">
              <option value=""></option>
              @foreach($kabupaten as $lokasiKabupaten)
                <option value="{!! $lokasiKabupaten->id !!}">{!! $lokasiKabupaten->nama !!}</option>
              @endforeach
            </select>
          </div>
          @include( 'pages.posyandu.kecamatan.form' )
        {!! BootForm::close() !!}
      </div>
    </div>
  </div>
@endsection
