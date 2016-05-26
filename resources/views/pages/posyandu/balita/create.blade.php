@extends('pages.posyandu.template')

@section( 'main-container-header-title', "Masukkan Data Balita" )

@section( 'custom-css' )
  {!! HTML::style( 'adminlte/plugins/datepicker/datepicker3.css' ) !!}
@endsection

@section( 'custom-footer' )
  {!! HTML::script( 'adminlte/plugins/datepicker/bootstrap-datepicker.js' ) !!}
  {!! HTML::script( 'adminlte/plugins/datepicker/locales/bootstrap-datepicker.id.js' ) !!}
  <script type="text/javascript">
    $( function() {
      $( '.datepicker3' ).datepicker({
        format: "yyyy-mm-dd",
        todayBtn: "linked",
        clearBtn: true,
        language: "id",
        autoclose: true,
        todayHighlight: true
      });
    });
  </script>
@endsection

@section( 'main-container-breadcrumb' )
  <li><a href="{!! route( 'posyandu' ) !!}"><i class="fa fa-dashboard"></i> Menu Utama</a></li>
  <li><a href="{!! route( 'posyandu.balita' ) !!}">Data Balita</a></li>
  <li class="active">Tambah Data Balita</li>
@endsection

@section( 'main-content' )
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="glyphicon glyphicon-user"></i> Data Balita</h3>
        </div>
          {!! BootForm::open()->action( route( 'posyandu.balita.store' ))!!}
          <div class="box-body">
              <div class="hidden"> 
                <select class="special-flexselect form-control" id="data-posyandu" name="id_posyandu" tabindex="1">
                  <option value="{!! Auth::user()->id_posyandu !!}" selected>{!! Auth::user()->id_posyandu !!}</option>
                </select>
                <select class="special-flexselect form-control" id="umur" name="umur" tabindex="1">
                  <option value="0" selected>0</option>
                </select>
                <select class="special-flexselect form-control" id="id_ibu" name="id_ibu" tabindex="1">
                  <option value="{!! $ibu->id !!}" selected>{!! $ibu->id !!}</option>
                </select>
              </div>
          </div>
          @include( 'pages.posyandu.balita.form' )
       
        {!! BootForm::close() !!}
       </div>
    </div>
  </div>
@endsection 
