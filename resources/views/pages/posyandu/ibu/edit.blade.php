@extends( 'pages.posyandu.template')

@section( 'main-container-header-title', "Perbarui Data Ibu" )

@section( 'main-container-breadcrumb' )
  <li><a href="{!! route( 'posyandu' ) !!}"><i class="fa fa-dashboard"></i> Menu Utama</a></li>
  <li><a href="{!! route( 'posyandu.ibu' ) !!}">Data Ibu</a></li>
  <li class="active">Perbarui Data Ibu</li>
@endsection

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

@section( 'main-content' )
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="glyphicon glyphicon-tag"></i> Data Rinci Ibu</h3>
        </div>
        {!! BootForm::open()->action( route( 'posyandu.ibu.update', $ibu->id ) ) !!}
          {!! BootForm::bind( $ibu ) !!}
          <div class="box-body">
            @if(Auth::user()->id == '1')
              <div class="form-group">
                {!! Form::label('Posyandu', 'Pilih Posyandu:') !!}
                <select class="special-flexselect form-control" id="data-posyandu" name="id_posyandu" tabindex="1">
                  <option value=""></option>
                  @foreach($posyandu as $data)
                    @if(isset($ibu) && $ibu->id_posyandu == $data->id)
                      <option value="{!! $data->id !!}" selected>{!! $data->nama !!}, {!! $data->alamat !!}</option>
                    @else
                      <option value="{!! $data->id !!}">{!! $data->nama !!}, {!! $data->alamat !!}</option>
                    @endif
                  @endforeach
                </select>
              </div>
            @else
              <div class="hidden">
                {!! Form::text('id_posyandu', $user->id_posyandu, ['class' => 'form-control']) !!}
              </div>
            @endif
          </div>
          @include( 'pages.posyandu.ibu.form' )
        {!! BootForm::close() !!}
      </div>
    </div>
  </div>
@endsection
