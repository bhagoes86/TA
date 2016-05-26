@extends( 'pages.posyandu.template')

@section( 'main-container-header-title', "Perbarui Data Penimbangan" )

@section( 'main-container-breadcrumb' )
  <li><a href="{!! route( 'posyandu' ) !!}"><i class="fa fa-dashboard"></i> Menu Utama</a></li>
  <li><a href="{!! route( 'posyandu.balita' ) !!}">Data Balita</a></li>
  <li class="active">Perbarui Data Penimbangan</li>
@endsection

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

@section( 'main-content' )
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="glyphicon glyphicon-tag"></i> Data Rinci Balita</h3>
        </div>
          {!! BootForm::open()->action( route( 'posyandu.penimbangan.update', $penimbangan->id ) ) !!}
          {!! BootForm::bind( $penimbangan ) !!}
          <div class="box-body">
              <div class="hidden"> 
                <select class="special-flexselect form-control" id="id_balita" name="id_balita" tabindex="1">
                  <option value="{!! $penimbangan->id_balita !!}" selected>{!! $penimbangan->id_balita !!}</option>
                </select>
              </div>
          </div>
          @include( 'pages.posyandu.penimbangan.form' ) 
        {!! BootForm::close() !!}
      </div>
    </div>
  </div>
@endsection