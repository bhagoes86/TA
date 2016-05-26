@extends( 'layouts.adminlte.app' )

@section( 'title', 'SIM PKK' )
@section( 'adminlte-logo-mini', '<b>PKK</b>' )
@section( 'adminlte-logo-lg', 'Sistem <b>PKK</b>' )
@section( 'adminlte-user-route', '#' )

@section( 'adminlte-menu-main' )
  <li class="treeview">
    <a href="{!! route( 'pkk.logout' ) !!}">
      <i class="glyphicon glyphicon-off"></i>
      <span>Keluar dari sistem</span>
    </a>
  </li>
@endsection

@section( 'main-container' )
  <!-- HEADER -->
  <section class="content-header">
    <h1>
      @yield( 'main-container-header' )
    </h1>
    <ol class="breadcrumb">
      @yield( 'main-container-breadcrumb' )
    </ol>
  </section>

  <!-- MAIN CONTENT -->
  <section class="content">
    @include( 'layouts.adminlte.scripts.alert' )
    @yield( 'main-content' )
  </section>
@endsection
