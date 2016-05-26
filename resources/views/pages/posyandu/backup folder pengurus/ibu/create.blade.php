@extends( 'pages.pkk.pengurus.template' )

@section( 'main-container-header-title', "Tambah Anggota PKK" )

@section( 'custom-footer' )
  {!! HTML::script( 'js/md5.js' ) !!}
  <script type="text/javascript">
    $( function() {
      $( 'form' ).bind( 'submit', function() {
        if ( $( "input[name=password_mobile]" )[0].value != "" ) {
          $( "input[name=password_mobile]" )[0].value = CryptoJS.MD5( $( "input[name=password_mobile]" )[0].value ).toString();
          $( "input[name=re_password]" )[0].value = CryptoJS.MD5( $( "input[name=re_password]" )[0].value ).toString();
        }
      } );
    } );
  </script>
@endsection

@section( 'main-container-breadcrumb' )
  <li><a href="{!! route( 'pkk' ) !!}"><i class="fa fa-dashboard"></i> Menu Utama</a></li>
  <li><a href="{!! route( 'pkk.ibu.index' ) !!}">Anggota PKK</a></li>
  <li class="active">Tambah Anggota PKK</li>
@endsection

@section( 'main-content' )
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="glyphicon glyphicon-user"></i> Data Anggota PKK Baru</h3>
        </div>
        {!! BootForm::open()->action( route( 'pkk.ibu.store' ) ) !!}
          @include( 'pages.pkk.pengurus.ibu.form' )
        {!! BootForm::close() !!}
      </div>
    </div>
  </div>
@endsection
