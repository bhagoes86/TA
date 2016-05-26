@extends( 'pages.pkk.template' )

@section( 'adminlte-user', 'Pengurus PKK' )

@section( 'adminlte-menu-main' )
  @parent
  <li class="treeview">
    <a href="{!! route( 'pkk' ) !!}">
      <i class="fa fa-dashboard"></i>
      <span>Halaman Utama</span>
    </a>
  </li>
  <li class="treeview">
    <a href="{!! route( 'pkk.profile' ) !!}">
      <i class="glyphicon glyphicon-user"></i>
      <span>Profil Akun PKK</span>
    </a>
  </li>
@endsection

@section( 'adminlte-menu-system' )
  <li class="treeview">
    <a href="{!! route( 'pkk.ibu.index' ) !!}">
      <i class="fa fa-users"></i>
      <span>Anggota PKK</span>
    </a>
  </li>
  <li class="treeview">
    <a href="#">
      <i class="glyphicon glyphicon-tags"></i> <span>Iuran PKK</span>
      <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
      <li>
        <a href="{!! route( 'pkk.kas' ) !!}">
          <span>Data Iuran PKK</span>
        </a>
      </li>
      <li>
        <a href="{!! route( 'pkk.jeniskas' ) !!}">
          <span>Jenis Iuran PKK</span>
        </a>
      </li>
    </ul>
  </li>
  <li class="treeview">
    <a href="#">
      <i class="fa fa-sitemap"></i> <span>Organisasi PKK</span>
      <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
      <li>
        <a href="{!! route( 'pkk.periode.index' ) !!}">
          <span>Periode Kepengurusan</span>
        </a>
      </li>
      <li>
        <a href="{!! route( 'pkk.jabatan.index' ) !!}">
          <span>Jabatan Kepengurusan</span>
        </a>
      </li>
      <li>
        <a href="{!! route( 'pkk.pengurus.index' ) !!}">
          <span>Pengurus PKK</span>
        </a>
      </li>
      <li>
        <a href="{!! route( 'pkk.laporan.index' ) !!}">
          <span>Laporan Bidang</span>
        </a>
      </li>
    </ul>
  </li>
  <li class="treeview">
    <a href="#">
      <i class="glyphicon glyphicon-list"></i> <span>Aktivitas</span>
      <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
      <li>
        <a href="{!! route( 'pkk.kegiatan.index' ) !!}">
          <span>Kegiatan PKK</span>
        </a>
      </li>
      <li>
        <a href="{!! route( 'pkk.jentik.index' ) !!}">
          <span>Jentik Nyamuk</span>
        </a>
      </li>
      <li>
        <a href="{!! route( 'pkk.pengumuman.index' ) !!}">
          <span>Pengumuman</span>
        </a>
      </li>
      <li>
        <a href="{!! route( 'pkk.keluhan.index' ) !!}">
          <span>Keluhan</span>
        </a>
      </li>
    </ul>
  </li>
@endsection

@section( 'main-container-header' )
  @yield( 'main-container-header-title')
  <small>Pengurus PKK</small>
@endsection
