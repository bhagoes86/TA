@extends( 'pages.pkk.admin.template' )

@section( 'custom-css' )
  @include( 'layouts.datatables.head' )
  @include( 'layouts.select2.head' )
@endsection

@section( 'custom-footer' )
  @include( 'layouts.datatables.foot' )
  @include( 'layouts.select2.foot' )
@endsection

@section( 'main-container-header-title', "Manajemen Akun Pengguna" )

@section( 'main-container-breadcrumb' )
  <li><a href="{!! route( 'pkk.admin' ) !!}"><i class="fa fa-dashboard"></i> Menu Utama</a></li>
  <li class="active">Manajemen Akun Pengguna</li>
@endsection

@section( 'main-content' )
  <div class="row">
    <div class="col-xs-4">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Pilih lokasi</h3>
        </div>
        <div class="box-body">
          {!! BootForm::open()->action( route( 'pkk.admin.users.filter' ) ) !!}
            {!! BootForm::hidden( 'prov_id' )->value( $data['loc_id'][0] ) !!}
            {!! BootForm::hidden( 'kab_id' )->value( $data['loc_id'][1] ) !!}
            {!! BootForm::hidden( 'kec_id' )->value( $data['loc_id'][2] ) !!}
            {!! BootForm::hidden( 'kel_id' )->value( $data['loc_id'][3] ) !!}
            {!! BootForm::select( null, 'loc', $data['location'] )->addClass( 'select2' ) !!}
            {!! BootForm::submit( 'Pilih' )->addClass( 'btn-primary' )->removeClass( 'btn-default' ) !!}
          {!! BootForm::close() !!}
        </div>
      </div>
      <div class="box">
        <div class="box-body box-profile">
          <h3 class="profile-username text-center">Rincian Penyaringan Lokasi</h3>
          <ul class="list-group list-group-unbordered">
            <li class="list-group-item">
              <b>Provinsi</b> <a class="pull-right">{!! $data['loc_desc'][0] !!}</a>
            </li>
            <li class="list-group-item">
              <b>Kabupaten/Kota</b> <a class="pull-right">{!! $data['loc_desc'][1] !!}</a>
            </li>
            <li class="list-group-item">
              <b>Kecamatan</b> <a class="pull-right">{!! $data['loc_desc'][2] !!}</a>
            </li>
            <li class="list-group-item">
              <b>Desa/Kelurahan</b> <a class="pull-right">{!! $data['loc_desc'][3] !!}</a>
            </li>
          </ul>
        </div>
      </div>
      @if( $data['loc_id'][0] != 0 )
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Tambah Pengguna Baru</h3>
          </div>
          <div class="box-body">
            {!! BootForm::open()->action( route( 'pkk.admin.users.add' ) ) !!}
              {!! BootForm::hidden( 'prov_id' )->value( $data['loc_id'][0] ) !!}
              {!! BootForm::hidden( 'kab_id' )->value( $data['loc_id'][1] ) !!}
              {!! BootForm::hidden( 'kec_id' )->value( $data['loc_id'][2] ) !!}
              {!! BootForm::hidden( 'kel_id' )->value( $data['loc_id'][3] ) !!}
              {!! BootForm::text( 'Nama pengguna:', 'username' ) !!}
              {!! BootForm::password( 'Kata sandi:', 'password' ) !!}
              @if( $data['loc_id'][3] != 0 )
                {!! BootForm::text( 'Nomor RW:', 'rw' ) !!}
                {!! BootForm::text( 'Nomor RT:', 'rt' ) !!}
              @endif
              {!! BootForm::submit( 'Simpan' )->addClass( 'btn-primary' )->removeClass( 'btn-default' ) !!}
            {!! BootForm::close() !!}
          </div>
        </div>
      @endif
    </div>

    <div class="col-xs-8">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Daftar Akun Pengguna</h3>
        </div>
        <div class="box-body">
          <table class="table table-bordered table-striped dataTable">
            <thead>
              <tr>
                <th class="col-xs-1">No</th>
                <th>Username</th>
                <th>Terakhir login</th>
                @if( $data['loc_id'][3] != 0 )
                  <th>RW</th>
                  <th>RT</th>
                @endif
                <th class="col-xs-2">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $a = 0; ?>
              @foreach( $data['content'] as $row )
                <tr>
                  <td>{!! ++$a !!}</td>
                  <td>{!! $row->username !!}</td>
                  <td>{!! $row->last_login !!}</td>
                  @if( $data['loc_id'][3] != 0 )
                    <td>-</td>
                    <td>-</td>
                  @endif
                  <td>
                    <div class="btn-group btn-group-justified">
                      <div class="btn-group" role="group">
                        <a href="{!! route( 'pkk.admin.users.reset', $row->id ) !!}" class="btn btn-warning">
                          <i class="fa fa-retweet"></i>
                        </a>
                      </div>
                      <div class="btn-group" role="group">
                        <a href="javascript:void(0);" onclick="deleteModal(this)" data-href="{!! route( 'pkk.admin.users.delete', $row->id ) !!}" class="btn btn-danger">
                          <i class="fa fa-trash-o"></i>
                        </a>
                      </div>
                    </div>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  @include( 'layouts.scripts.delete-modal' )
@endsection
