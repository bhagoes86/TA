@extends( 'pages.pkk.pengurus.template' )

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

@section( 'main-container-header-title', "Ubah Kegiatan" )

@section( 'main-container-breadcrumb' )
  <li><a href="{!! route( 'pkk' ) !!}"><i class="fa fa-dashboard"></i> Menu Utama</a></li>
  <li><a href="{!! route( 'pkk.kegiatan.index' ) !!}">Kegiatan PKK</a></li>
  <li class="active">Ubah Kegiatan</li>
@endsection

@section( 'main-content' )
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="glyphicon glyphicon-user"></i> Data Kegiatan PKK Baru</h3>
        </div>
        {!! BootForm::open()->action( route( 'pkk.kegiatan.update', $data['content']->id ) )->put() !!}
          {!! BootForm::bind( $data['content'] ) !!}
          @include( 'pages.pkk.pengurus.kegiatan.form' )
        {!! BootForm::close() !!}
      </div>
    </div>
  </div>
@endsection
