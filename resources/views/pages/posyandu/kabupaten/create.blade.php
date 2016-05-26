@extends('pages.posyandu.template')

@section( 'main-container-header-title', "Masukkan Data Kabupaten" )

@section( 'main-container-breadcrumb' )
  <li><a href="{!! route( 'posyandu' ) !!}"><i class="fa fa-dashboard"></i> Menu Utama</a></li>
  <li><a href="{!! route( 'posyandu.kabupaten' ) !!}">Data Kabupaten</a></li>
  <li class="active">Tambah Kabupaten</li>
@endsection

@section( 'main-content' )
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="glyphicon glyphicon-user"></i>Data Kabupaten</h3>
        </div>
        {!! BootForm::open()->action( route( 'posyandu.kabupaten.store' ) ) !!}
          <div class="box-body">
            {!! Form::label('Provinsi', 'Pilih Provinsi:') !!}
            <select class="special-flexselect form-control" id="data-provinsi" name="prov_id" tabindex="1">
              <option value=""></option>
              @foreach($provinsi as $lokasiProvinsi)
                <option value="{!! $lokasiProvinsi->id !!}">{!! $lokasiProvinsi->nama !!}</option>
              @endforeach
            </select>
          </div>
          @include( 'pages.posyandu.kabupaten.form' )
        {!! BootForm::close() !!}
      </div>
    </div>
  </div>
@endsection
