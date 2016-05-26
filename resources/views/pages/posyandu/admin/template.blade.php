@extends( 'pages.posyandu.template' )

@section( 'adminlte-user', 'Administrator Posyandu' )

@section( 'adminlte-menu-main' )
  @parent
  <li class="treeview">
    <a href="{!! route( 'posyandu.admin.profile' ) !!}">
      <i class="glyphicon glyphicon-user"></i>
      <span>Akun Saya</span>
    </a>
  </li>
@endsection

@section( 'adminlte-menu-system' )
  <ul class="sidebar-menu">
    <li class="treeview">
      <a href="#">
        <i class="glyphicon glyphicon-tags"></i> <span>Data Ibu</span>
        <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
        <li>
          <a href="{!! route( 'posyandu.ibu.create') !!}">
            <span>Tambah data ibu</span>
          </a>
        </li>
        <li>
          <a href="#">
            <span>Ubah data ibu</span>
          </a>
        </li>
      </ul>
    </li>
    <li class="treeview">
      <a href="#">
        <i class="glyphicon glyphicon-tags"></i> <span>Data Balita</span>
        <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
        <li>
          <a href="#">
            <span>Tambah Data</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li>
              <a href="#">
                <span>Data Balita</span>
              </a>
            </li>
            <li>
              <a href="#">
                <span>Data Penimbangan</span>
              </a>
            </li>
            <li>
              <a href="#">
                <span>Data Imunisasi</span>
              </a>
            </li>
            <li>
              <a href="#">
                <span>Data Vitamin</span>
              </a>
            </li>
          </ul>
        </li>
        <li>
          <a href="#">
            <span>Kelola Data Balita</span>
          </a>
        </li>
      </ul>
    </li>
    <li class="treeview">
      <a href="#">
        <i class="glyphicon glyphicon-tags"></i> <span>Data Posyandu</span>
        <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
        <li>
          <a href="#">
            <span>Tambah Data</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li>
              <a href="#">
                <span>Data Posyandu</span>
              </a>
            </li>
            <li>
              <a href="#">
                <span>Data Kas</span>
              </a>
            </li>
            <li>
              <a href="#">
                <span>Data Pengurus</span>
              </a>
            </li>
            <li>
              <a href="#">
                <span>Data Absen</span>
              </a>
            </li>
          </ul>
        </li>
        <li>
          <a href="#">
            <span>Kelola Data</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li>
              <a href="#">
                <span>Data Posyandu</span>
              </a>
            </li>
            <li>
              <a href="#">
                <span>Data Kas</span>
              </a>
            </li>
            <li>
              <a href="#">
                <span>Data Pengurus</span>
              </a>
            </li>
            <li>
              <a href="#">
                <span>Data Absen</span>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </li>
    <li class="treeview">
      <a href="#">
        <i class="glyphicon glyphicon-tags"></i> <span>Data Akun</span>
        <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
        <li>
          <a href="#">
            <span>Kelola Akun Ibu</span>
          </a>
        </li>
        <li>
          <a href="#">
            <span>Kelola Akun Posyandu</span>
            <i class="fa fa-angle-left pull-right"></i>
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
          <a href="#">
            <span>Data Penimbangan</span>
          </a>
        </li>
      </ul>
    </li>
    <li class="treeview">
      <a href="#">
        <i class="glyphicon glyphicon-tags"></i> <span>Pengumuman & Keluhan</span>
        <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
        <li>
          <a href="#">
            <span>Tambah Pengumuman</span>
          </a>
        </li>
        <li>
          <a href="#">
            <span>Kelola Data</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li>
              <a href="#">
                <span>Data Pengumuman</span>
              </a>
            </li>
            <li>
              <a href="#">
                <span>Data Keluhan</span>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </li>
    <!-- @if(Auth::user()->id == '2') -->
    <li class="treeview">
      <a href="#">
        <i class="glyphicon glyphicon-tags"></i> <span>Data Jenis Imunisasi</span>
        <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
        <li>
          <a href="{!! route( 'posyandu.jenisimunisasi.create' ) !!}">
            <span>Tambah Jenis Imunisasi</span>
          </a>
        </li>
        <li>
          <a href="{!! route( 'posyandu.jenisimunisasi' ) !!}">
            <span>Kelola Jenis Imunisasi</span>
          </a>
        </li>
      </ul>
    </li>
    @endif
    <li class="treeview">
      <a href="#">
        <i class="glyphicon glyphicon-tags"></i> <span>Data Lokasi</span>
        <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
        <li>
          <a href="#">
            <span>Tambah Data</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li>
              <a href="#">
                <span>Data Provinsi</span>
              </a>
            </li>
            <li>
              <a href="#">
                <span>Data Kabupaten/Kota</span>
              </a>
            </li>
            <li>
              <a href="#">
                <span>Data Kecamatan</span>
              </a>
            </li>
            <li>
              <a href="#">
                <span>Data Desa/Kelurahan</span>
              </a>
            </li>
          </ul>
        </li>
        <li>
          <a href="#">
            <span>Kelola Data</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li>
              <a href="#">
                <span>Data Provinsi</span>
              </a>
            </li>
            <li>
              <a href="#">
                <span>Data Kabupaten/Kota</span>
              </a>
            </li>
            <li>
              <a href="#">
                <span>Data Kecamatan</span>
              </a>
            </li>
            <li>
              <a href="#">
                <span>Data Desa/Kelurahan</span>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </li>
  </ul>
 
@endsection

@section( 'main-container-header' )
  @yield( 'main-container-header-title')
  <small>Administrator</small>
@endsection
