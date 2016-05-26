@extends( 'pages.pkk.admin.template' )

@section( 'main-container-header-title', "Tambah Admin" )

@section( 'main-container-breadcrumb' )
  <li><a href="{!! route( 'pkk.admin' ) !!}"><i class="fa fa-dashboard"></i> Menu Utama</a></li>
  <li><a href="{!! route( 'pkk.admin.users' ) !!}">Manajemen Akun Pengguna</a></li>
  <li class="active">Tambah Admin</li>
@endsection

@section( 'main-content' )
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="glyphicon glyphicon-user"></i> Data Akun Administrator Baru</h3>
        </div>
        {!! BootForm::open()->action( route( 'pkk.admin.store' ) ) !!}
          @include( 'pages.pkk.admin.users.form' )
        {!! BootForm::close() !!}
      </div>
    </div>
  </div>
@endsection
