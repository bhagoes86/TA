@extends( 'pages.posyandu.template' )

@section( 'main-container-header-title', "Akun Saya" )

@section( 'main-container-breadcrumb' )
  <li><a href="{!! route( 'posyandu' ) !!}"><i class="fa fa-dashboard"></i> Menu Utama</a></li>
  <li class="active">Profile Akun Saya</li>
@endsection

@section( 'main-content' )
  <div class="row">
    <!-- DATA RINCI POSYANDU -->
    <div class="col-md-4">
      <div class="box box-primary">
        <div class="box-body box-profile">
          <h3 class="profile-username text-center">Profil Posyandu</h3>
          <p class="text-muted text-center">Data Posyandu</p>
          <ul class="list-group list-group-unbordered">
            <li class="list-group-item">
              <b>Kode Wilayah</b> <a class="pull-right">{!!$provinsi->kode!!}.{!!$kabupaten->kode!!}.{!!$kecamatan->kode!!}.{!!$kelurahan->kode!!}</a>
            </li>
            <li class="list-group-item">
              <b>Daerah</b> <a class="pull-right">{!! $daerah !!}</a>
            </li>
            <li class="list-group-item">
              <b>Provinsi</b> <a class="pull-right">{!! $provinsi->nama !!}</a>
            </li>
            <li class="list-group-item">
              <b>Kabupaten/Kota</b> <a class="pull-right">{!! $kabupaten->nama !!}</a>
            </li>
            <li class="list-group-item">
              <b>Kecamatan</b> <a class="pull-right">{!! $kecamatan->nama !!}</a>
            </li>
            <li class="list-group-item">
              <b>Desa/Kelurahan</b> <a class="pull-right">{!! $kelurahan->nama !!}</a>
            </li>
            <li class="list-group-item">
              <b>RW</b> <a class="pull-right">{!! $posyandu->rw !!}</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <!-- USER ACCOUNT -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="glyphicon glyphicon-user"></i> Username Pengguna</h3>
        </div>
        {!! BootForm::open()->action( route( 'posyandu.profile.change-username' ) ) !!}
          {!! BootForm::bind( $data['user'] ) !!}
          {!! BootForm::hidden( 'id' ) !!}
          <div class="box-body">
            {!! BootForm::text( 'Username:', 'username' ) !!}
            {!! BootForm::submit( 'Simpan username baru' )->removeClass( 'btn-default' )->addClass( 'btn-primary' ) !!}
          </div>
        {!! BootForm::close() !!}
      </div>
    </div>
    <div class="col-md-4">
      <!-- PASSWORD MANAGEMENT -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="glyphicon glyphicon-lock"></i> Manajemen Kata Sandi Akun</h3>
        </div>
        {!! BootForm::open()->action( route( 'posyandu.profile.change-password' ) ) !!}
          {!! BootForm::bind( $data['user'] ) !!}
          {!! BootForm::hidden( 'id' ) !!}
          <div class="box-body">
            {!! BootForm::password( 'Kata sandi lama:', 'old_pass' ) !!}
            {!! BootForm::password( 'Kata sandi baru:', 'new_pass' ) !!}
            {!! BootForm::password( 'Masukkan ulang kata sandi baru:', 're_new_pass' ) !!}
            {!! BootForm::submit( 'Simpan kata sandi baru' )->removeClass( 'btn-default' )->addClass( 'btn-primary' ) !!}
          </div>
        {!! BootForm::close() !!}
      </div>
    </div>
  </div>
@endsection
