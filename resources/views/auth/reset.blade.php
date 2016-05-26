@extends( 'layouts.template' )

@section( 'title', 'Website PKK - Reset kata sandi' )

@section( 'css' )
  {!! HTML::style( 'adminlte/dist/css/AdminLTE.min.css' ) !!}
@endsection

@section( 'body-class', 'class="hold-transition login-page"' )

@section( 'content' )
  <div class="login-box">
    <div class="login-logo">
      Sistem <b>PKK</b>
    </div>
    <div class="login-box-body">
      <p class="login-box-msg">Kata sandi baru akan dikirim melalui email</p>
      @if (count($errors) > 0)
        <div class="alert alert-danger" role="alert">
          <strong>Aksi gagal</strong>:
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
      {!! BootForm::open()->action( route( 'pkk.password.reset.post' ) ) !!}
        {!! BootForm::hidden( 'token' )->value( $token ) !!}
        <div class="form-group has-feedback">
          {!! Form::text( 'username' )->addClass( 'form-control' )->placeholder( 'Masukkan alamat email' ) !!}
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          {!! Form::password( 'password' )->addClass( 'form-control' )->placeholder( 'Masukkan kata sandi' ) !!}
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          {!! Form::password( 'password_confirmation' )->addClass( 'form-control' )->placeholder( 'Masukkan ulang kata sandi' ) !!}
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
          <div class="col-xs-12">
            {!! Form::submit( 'Simpan' )->addClass( 'btn btn-primary btn-block btn-flat' ) !!}
          </div>
        </div>
      {!! BootForm::close() !!}
    </div>
  </div>
@endsection
