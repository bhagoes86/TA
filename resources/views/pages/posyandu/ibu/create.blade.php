@extends('pages.posyandu.template')

@section( 'main-container-header-title', "Masukkan Data Ibu" )

@section( 'custom-css' )
  {!! HTML::style( 'adminlte/plugins/datepicker/datepicker3.css' ) !!}
@endsection

@section( 'custom-footer' )
  {!! HTML::script( 'adminlte/plugins/datepicker/bootstrap-datepicker.js' ) !!}
  {!! HTML::script( 'adminlte/plugins/datepicker/locales/bootstrap-datepicker.id.js' ) !!}
  {!! HTML::script( 'js/aes.js' ) !!}
  {!! HTML::script( 'js/aes-json-format.js' ) !!}
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
      $( 'form' ).bind( 'submit', function() {
        if ( $( "input[name=password_mobile]" )[0].value != "" ) {
          $( "input[name=password_mobile]" )[0].value = CryptoJS.AES.encrypt( JSON.stringify( $( "input[name=password_mobile]" )[0].value ), "sistemPKK", {format: CryptoJSAesJson } ).toString();
        }
      } );
    });
  </script>
@endsection

@section( 'main-container-breadcrumb' )
  <li><a href="{!! route( 'posyandu' ) !!}"><i class="fa fa-dashboard"></i> Menu Utama</a></li>
  <li><a href="{!! route( 'posyandu.ibu' ) !!}">Data Ibu</a></li>
  <li class="active">Tambah Data Ibu</li>
@endsection


@section( 'main-content' )
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="glyphicon glyphicon-user"></i> Data Ibu </h3>
        </div>
          {!! BootForm::open()->action( route( 'posyandu.ibu.store' ))!!}
          <div class="box-body">
            <div class="hidden">
              <select class="special-flexselect form-control" id="data-posyandu" name="id_posyandu" tabindex="1">
                <option value="{!! $user->id_posyandu !!}" selected>{!! $user->id_posyandu !!}</option>
              </select>
            </div>
          </div>
          @include( 'pages.posyandu.ibu.form' )
        {!! BootForm::close() !!}
       </div>
    </div>
  </div>
@endsection
