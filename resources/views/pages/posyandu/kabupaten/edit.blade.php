@extends( 'pages.posyandu.template')

@section( 'main-container-header-title', "Perbarui Data Kabupaten" )

@section( 'main-container-breadcrumb' )
  <li><a href="{!! route( 'posyandu' ) !!}"><i class="fa fa-dashboard"></i> Menu Utama</a></li>
  <li><a href="{!! route( 'posyandu.kabupaten' ) !!}">Kabupaten</a></li>
  <li class="active">Perbarui Data Kabupaten</li>
@endsection

@section( 'main-content' )
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="glyphicon glyphicon-tag"></i> Data Kabupaten</h3>
        </div>
        {!! BootForm::open()->action( route( 'posyandu.kabupaten.update', $kabupaten->id ) ) !!}
          {!! BootForm::bind( $kabupaten ) !!}
          <div class="box-body"> 
            {!! Form::label('Provinsi', 'Pilih Provinsi:') !!}
            <select class="special-flexselect form-control" id="data-provinsi" name="prov_id" tabindex="1">
              <option value=""></option>
              @foreach($provinsi as $lokasiProvinsi)
                @if(isset($kabupaten) && $kabupaten->prov_id == $lokasiProvinsi->id)
                    <option value="{!! $lokasiProvinsi->id !!}" selected>{!! $lokasiProvinsi->nama !!}</option>
                @else
                    <option value="{!! $lokasiProvinsi->id !!}">{!! $lokasiProvinsi->nama !!}</option>
                @endif
              @endforeach
            </select>
          </div>
          @include( 'pages.posyandu.kabupaten.form' ) 
        {!! BootForm::close() !!}
      </div>
    </div>
  </div>
@endsection