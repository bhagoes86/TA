@extends( 'pages.posyandu.template')

@section( 'main-container-header-title', "Perbarui Data Kelurahan" )

@section( 'main-container-breadcrumb' )
  <li><a href="{!! route( 'posyandu' ) !!}"><i class="fa fa-dashboard"></i> Menu Utama</a></li>
  <li><a href="{!! route( 'posyandu.kelurahan' ) !!}">Kelurahan</a></li>
  <li class="active">Perbarui Data Kelurahan</li>
@endsection

@section( 'main-content' )
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="glyphicon glyphicon-tag"></i> Data Kecamatan</h3>
        </div>
        {!! BootForm::open()->action( route( 'posyandu.kelurahan.update', $kelurahan->id ) ) !!}
          {!! BootForm::bind( $kelurahan ) !!}
          <div class="box-body"> 
            {!! Form::label('Kecamatan', 'Pilih Kecamatan:') !!}
            <select class="special-flexselect form-control" id="data-kecamatan" name="kec_id" tabindex="1">
              <option value=""></option>
              @foreach($kecamatan as $lokasiKecamatan)
                @if(isset($kelurahan) && $kelurahan->kec_id == $lokasiKecamatan->id)
                  <option value="{!! $lokasiKecamatan->id !!}" selected="">{!! $lokasiKecamatan->nama !!}</option>
                @else
                  <option value="{!! $lokasiKecamatan->id !!}">{!! $lokasiKecamatan->nama !!}</option>
                @endif
              @endforeach
            </select>
          </div>
          @include( 'pages.posyandu.kelurahan.form' ) 
        {!! BootForm::close() !!}
      </div>
    </div>
  </div>
@endsection