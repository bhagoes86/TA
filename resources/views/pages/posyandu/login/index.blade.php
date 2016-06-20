@extends( 'layouts.template' )

@section( 'title', 'Halaman Login Website Posyandu' )

@section( 'css' )
  {!! HTML::style( 'adminlte/dist/css/AdminLTE.min.css' ) !!}
  {!! HTML::style( 'adminlte/plugins/iCheck/square/blue.css' ) !!}
@endsection

@section( 'script' )
  {!! HTML::script( 'adminlte/plugins/iCheck/icheck.min.js' ) !!}
  <script type="text/javascript">
    $( function () {
      $( 'input' ).iCheck( {
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%'
      } );
    } );
  </script>
@endsection

@section( 'body-class', 'class="hold-transition login-page"' )

@section( 'content' )
  <div class="login-box" style="margin-top: 25px">
    <div class="login-logo">
      <a href="{!! route( 'posyandu' ) !!}">
        <img src="../img/logo-posyandu.png" style="max-height: 200px; width: auto; margin-bottom: 20px" class="img-responsive center-block" alt="Responsive image">
      </a>
    </div>
    <div class="login-box-body">
      <p class="login-box-msg">Login untuk menggunakan sistem</p>
      @include( 'layouts.adminlte.scripts.alert' )
      {!! BootForm::open()->action( route( 'posyandu.login.post' ) ) !!}
        <div class="form-group has-feedback">
          {!! Form::text( 'username' )->addClass( 'form-control' )->placeholder( 'Masukkan username' ) !!}
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          {!! Form::password( 'password' )->addClass( 'form-control' )->placeholder( 'Masukkan kata sandi' ) !!}
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row text-center">
          <div class="col-xs-12">
            {!! Form::submit( 'Masuk' )->addClass( 'btn btn-primary btn-block btn-flat' ) !!}
          </div>
        </div>
      {!! BootForm::close() !!}
      <br>
      <div class="row text-center">
        <div class="col-xs-12">
          <a href="{!! route( 'home' ) !!}" class="btn btn-block btn-success">Ke menu utama</a><br>
        </div>
      </div>
    </div>
  </div>
@endsection
