@extends( 'pages.pkk.admin.template' )

@section( 'custom-css' )
  @include( 'layouts.datatables.head' )
  <style type="text/css">
    @media (max-width: 767px) {
      .btn-title {
        display: none;
      }
    }
  </style>
@endsection

@section( 'custom-footer' )
  @include( 'layouts.datatables.foot' )
@endsection

@section( 'main-container-header-title', "Manajemen Akun Pengguna" )

@section( 'main-container-breadcrumb' )
  <li><a href="{!! route( 'pkk.admin' ) !!}"><i class="fa fa-dashboard"></i> Menu Utama</a></li>
  <li class="active">Manajemen Akun Pengguna</li>
@endsection

@section( 'main-content' )
  <div class="row">
    <div class="col-xs-12">
      <!-- ADMIN -->
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">
            Daftar Akun Administrator&nbsp;&nbsp;&nbsp;
            <a href="{!! route( 'pkk.admin.create' ) !!}" class="btn btn-primary btn-sm">Tambah Admin</a>
          </h3>
        </div>
        <div class="box-body">
          @include( 'pages.pkk.admin.users.user-table', ['admin' => true] )
        </div>
      </div>

      <!-- USER -->
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Daftar Akun Pengguna</h3>
        </div>
        <div class="box-body">
          @include( 'pages.pkk.admin.users.user-table', ['admin' => false] )
        </div>
      </div>
    </div>
  </div>
  @include( 'layouts.scripts.delete-modal' )
@endsection
