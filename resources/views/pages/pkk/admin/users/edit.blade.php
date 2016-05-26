@extends( 'pages.pkk.admin.template' )

@section( 'main-container-header-title', "Ubah Akun Admin" )

@section( 'main-container-breadcrumb' )
  <li><a href="{!! route( 'pkk.admin' ) !!}"><i class="fa fa-dashboard"></i> Menu Utama</a></li>
  <li><a href="{!! route( 'pkk.admin.users' ) !!}">Manajemen Akun Pengguna</a></li>
  <li class="active">Ubah Akun Admin</li>
@endsection

@section( 'main-content' )
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="glyphicon glyphicon-user"></i> Data Akun</h3>
        </div>
        {!! BootForm::open()->action( route( 'pkk.admin.update', $data['content']->id ) ) !!}
          {!! BootForm::bind( $data['content'] ) !!}
          @include( 'pages.pkk.admin.users.form' )
        {!! BootForm::close() !!}
      </div>
    </div>
  </div>
@endsection
