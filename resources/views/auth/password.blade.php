@extends( 'layouts.template' )

@section( 'title', 'Website PKK - Lupa kata sandi' )

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
      {!! BootForm::open()->action( route( 'pkk.password.email.post' ) ) !!}
        <div class="form-group has-feedback">
          {!! Form::email( 'email' )->addClass( 'form-control' )->placeholder( 'Masukkan alamat email' ) !!}
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="row">
          <div class="col-xs-12">
            {!! Form::submit( 'Kirim' )->addClass( 'btn btn-primary btn-block btn-flat' ) !!}
          </div>
        </div>
      {!! BootForm::close() !!}
    </div>
  </div>
@endsection
