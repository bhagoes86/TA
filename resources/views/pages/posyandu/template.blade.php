@extends( 'layouts.adminlte.app' )

@section( 'title', 'SIM POSYANDU' )
@section( 'adminlte-logo-mini', '<b>Posyandu</b>' )
@section( 'adminlte-logo-lg', 'Sistem <b>Posyandu</b>' )
@section( 'adminlte-user-route', '#' )

@if(Auth::user()->id == '1')
  @section( 'adminlte-user', 'Administrator Posyandu' )
@else
  @section( 'adminlte-user', 'Pengurus Posyandu' )
@endif

@section( 'adminlte-menu-main' )
  <li class="treeview">
    <a href="{!! route( 'posyandu.logout' ) !!}">
      <i class="glyphicon glyphicon-off"></i>
      <span>Keluar dari sistem</span>
    </a>
  </li>
    <li class="treeview">
      @if(Auth::user()->id == '1')
        <a href="{!! route( 'posyandu.admin.profile' ) !!}">
      @else
        <a href="{!! route( 'posyandu.profile' ) !!}">
      @endif
        <i class="glyphicon glyphicon-user"></i>
        <span>Profil Akun Saya</span>
      </a>
    </li>
@endsection

@section( 'adminlte-menu-system' )
  <ul class="sidebar-menu">
    @if(Auth::user()->id == '1')
      <li class="treeview">
        <a href="{!! route( 'posyandu.data' ) !!}">
          <i class="glyphicon glyphicon-tags"></i> <span>Data Posyandu</span>
        </a>
      </li>
      <li class="treeview">
        <a href="{!! route( 'posyandu.jenisimunisasi' ) !!}">
          <i class="glyphicon glyphicon-tags"></i> <span>Data Jenis Imunisasi</span>
        </a>
      </li>
      <li class="treeview">
        <a href="{!! route( 'posyandu.provinsi' ) !!}">
          <i class="glyphicon glyphicon-tags"></i> <span>Data Lokasi</span>
        </a>
      </li>
    @else
      <li class="treeview">
        <a href="{!! route( 'posyandu.ibu' ) !!}">
          <i class="glyphicon glyphicon-tags"></i> <span>Data Ibu</span>
        </a>
      </li>
      <li class="treeview">
        <a href="{!! route( 'posyandu.balita' ) !!}">
          <i class="glyphicon glyphicon-tags"></i> <span>Data Balita</span>
        </a>
      </li>
      <li class="treeview">
        <a href="">
          <i class="glyphicon glyphicon-tags"></i> <span>Data Posyandu</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li>
            <a href="{!! route( 'posyandu.pengurus' ) !!}">
              <span>Pengurus Posyandu</span>
            </a>
          </li>
          <li>
            <a href="{!! route( 'posyandu.kas' ) !!}">
              <span>Kas Posyandu</span>
            </a>
          </li>
          <li>
            <a href="#">
              <span>Absen Posyandu</span>
            </a>
          </li>
        </ul>
      </li>      
      <li class="treeview">
        <a href="#">
          <i class="glyphicon glyphicon-tags"></i> <span>Laporan</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li>
            <a href="{!! route( 'posyandu.penimbangan' ) !!}">
              <span>Data Penimbangan</span>
            </a>
          </li>
          <li>
            <a href="{!! route( 'posyandu.beriimunisasi' ) !!}">
              <span>Data Imunisasi</span>
            </a>
          </li>
          <li>
            <a href="{!! route( 'posyandu.kapsul' ) !!}">
              <span>Data Vitamin</span>
            </a>
          </li>
        </ul>
      </li>
      <li class="treeview">
          <a href="{!! route( 'posyandu.pengumuman' ) !!}">
          <i class="glyphicon glyphicon-tags"></i> <span>Data Pengumuman</span>
        </a>
      </li>
      <li class="treeview">
          <a href="{!! route( 'posyandu.keluhan' ) !!}">
          <i class="glyphicon glyphicon-tags"></i> <span>Data Keluhan</span>
        </a>
      </li>
      @endif
  </ul>
@endsection


@section( 'main-container' )
  <!-- HEADER -->
  <section class="content-header">
    <h1>
      @yield( 'main-container-header-title')
      @if(Auth::user()->id == '1')
        <small>Administrator</small>
      @else
        <small>Pengurus Posyandu</small>
      @endif
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
