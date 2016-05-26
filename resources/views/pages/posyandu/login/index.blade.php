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
  <div class="login-box">
    <div class="login-logo">
      <a href="{!! route( 'posyandu' ) !!}">
        <img src="/img/logo-posyandu.jpg" style="max-height: 300px; width: auto; margin-bottom: 20px" class="img-responsive center-block" alt="Responsive image">
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
        <div class="row">
          <div class="col-xs-8">
            <div class="checkbox icheck">
              <label>
                {!! Form::checkbox( 'remember_me' ) !!} Ingat saya
              </label>
            </div>
          </div>
          <div class="col-xs-4">
            {!! Form::submit( 'Masuk' )->addClass( 'btn btn-primary btn-block btn-flat' ) !!}
          </div>
        </div>
      {!! BootForm::close() !!}

      <div class="row text-center">
        <!-- <p>- PILIHAN LAIN -</p> -->
        <!-- <div class="col-xs-6">
          <a href="{!! route( 'posyandu.password.email' ) !!}" class="btn btn-block btn-warning">Lupa kata sandi</a><br>
        </div>
        <div class="col-xs-6">
          <a href="{!! route( 'posyandu.register' ) !!}" class="btn btn-block btn-info">Daftar PKK baru</a>
        </div> -->
        <div class="col-xs-12">
          <a href="{!! route( 'home' ) !!}" class="btn btn-block btn-success">Ke menu utama</a><br>
        </div>
      </div>
    </div>
  </div>
@endsection
