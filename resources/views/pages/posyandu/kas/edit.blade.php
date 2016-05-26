@extends( 'pages.posyandu.template')

@section( 'main-container-header-title', "Perbarui Data Kas" )

@section( 'main-container-breadcrumb' )
  <li><a href="{!! route( 'posyandu' ) !!}"><i class="fa fa-dashboard"></i> Menu Utama</a></li>
  <li><a href="{!! route( 'posyandu.kas' ) !!}">Data Kas</a></li>
  <li class="active">Perbarui Data Kas</li>
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
          <h3 class="box-title"><i class="glyphicon glyphicon-tag"></i> Data Rinci Kas</h3>
        </div>
        {!! BootForm::open()->action( route( 'posyandu.kas.update', $kas->id ) ) !!}
          {!! BootForm::bind( $kas ) !!}
          <div class="box-body">
              <div class="hidden"> 
                {!! Form::text('id_posyandu', Auth::user()->id_posyandu, ['class' => 'form-control']) !!}
              </div>
          </div>
          @include( 'pages.posyandu.kas.form' ) 
        {!! BootForm::close() !!}
      </div>
    </div>
  </div>
@endsection