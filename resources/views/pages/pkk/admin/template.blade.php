@extends( 'pages.pkk.template' )

@section( 'adminlte-user', 'Administrator PKK' )

@section( 'adminlte-menu-main' )
  @parent
  <li class="treeview">
    <a href="{!! route( 'pkk.admin.profile' ) !!}">
      <i class="glyphicon glyphicon-user"></i>
      <span>Akun Saya</span>
    </a>
  </li>
@endsection

@section( 'adminlte-menu-system' )
  <li class="treeview">
    <a href="{!! route( 'pkk.admin.users', [0, 0, 0, 0] ) !!}">
      <i class="fa fa-users"></i>
      <span>Manajemen Akun Pengguna</span>
    </a>
  </li>
@endsection

@section( 'main-container-header' )
  @yield( 'main-container-header-title')
  <small>Administrator</small>
@endsection
