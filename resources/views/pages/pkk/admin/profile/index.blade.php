@extends( 'pages.pkk.admin.template' )

@section( 'main-container-header-title', "Akun Saya" )

@section( 'main-container-breadcrumb' )
  <li><a href="{!! route( 'pkk.admin' ) !!}"><i class="fa fa-dashboard"></i> Menu Utama</a></li>
  <li class="active">Akun Saya</li>
@endsection

@section( 'main-content' )
  <div class="row">
    <!-- USER ACCOUNT -->
    <div class="col-md-6">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="glyphicon glyphicon-user"></i> Username Pengguna</h3>
        </div>
        {!! BootForm::open()->action( route( 'pkk.admin.profile.change-username' ) ) !!}
          {!! BootForm::bind( $data['user'] ) !!}
          {!! BootForm::hidden( 'id' ) !!}
          <div class="box-body">
            {!! BootForm::text( 'Username:', 'username' ) !!}
          </div>
          <div class="box-footer">
            {!! BootForm::submit( 'Simpan username baru' )->removeClass( 'btn-default' )->addClass( 'btn-primary' ) !!}
          </div>
        {!! BootForm::close() !!}
      </div>
    </div>

    <!-- PASSWORD MANAGEMENT -->
    <div class="col-md-6">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="glyphicon glyphicon-lock"></i> Manajemen Kata Sandi Akun</h3>
        </div>
        {!! BootForm::open()->action( route( 'pkk.admin.profile.change-password' ) ) !!}
          {!! BootForm::bind( $data['user'] ) !!}
          {!! BootForm::hidden( 'id' ) !!}
          <div class="box-body">
            {!! BootForm::password( 'Kata sandi lama:', 'old_pass' ) !!}
            {!! BootForm::password( 'Kata sandi baru:', 'new_pass' ) !!}
            {!! BootForm::password( 'Masukkan ulang kata sandi baru:', 're_new_pass' ) !!}
          </div>
          <div class="box-footer">
            {!! BootForm::submit( 'Simpan kata sandi baru' )->removeClass( 'btn-default' )->addClass( 'btn-primary' ) !!}
          </div>
        {!! BootForm::close() !!}
      </div>
    </div>
  </div>
@endsection
