@extends( 'pages.pkk.pengurus.template' )

@section( 'custom-css' )
  @include( 'layouts.datatables.head' )
  @include( 'layouts.select2.head' )
@endsection

@section( 'custom-footer' )
  @include( 'layouts.datatables.foot' )
  @include( 'layouts.select2.foot' )
@endsection

@section( 'main-container-header-title', "Absensi Kegiatan PKK" )

@section( 'main-container-breadcrumb' )
  <li><a href="{!! route( 'pkk' ) !!}"><i class="fa fa-dashboard"></i> Menu Utama</a></li>
  <li><a href="{!! route( 'pkk.kegiatan.index' ) !!}">Kegiatan PKK</a></li>
  <li class="active">Absensi Kegiatan PKK</li>
@endsection

@section( 'main-content' )
  <div class="row">
    <!-- ADD PKK MEMBER -->
    <div class="col-md-4">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="glyphicon glyphicon-user"></i> Tambah Kehadiran Anggota PKK</h3>
        </div>
        {!! BootForm::open()->action( route( 'pkk.absen.store' ) ) !!}
          {!! BootForm::hidden( 'id_kegiatan' )->value( $data['id_kegiatan'] ) !!}
          <div class="box-body">
            {!! BootForm::select( 'Pilih anggota PKK', 'id_ibu', $data['anggota'] )->addClass( 'select2' ) !!}
          </div>
          <div class="box-footer">
            {!! BootForm::submit( 'Tambahkan' )->removeClass( 'btn-default' )->addClass( 'btn-primary' ) !!}
          </div>
        {!! BootForm::close() !!}
      </div>
    </div>
    <!-- PKK MEMBER ACTIVITY ATTENDANCE LIST -->
    <div class="col-md-8">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-users"></i> Daftar Kehadiran Anggota PKK</h3>
        </div>
        <div class="box-body">
          <table class="table table-bordered table-striped dataTable">
            <thead>
              <tr>
                <th class="col-xs-1">No</th>
                <th>No. KTP</th>
                <th>Nama</th>
                <th class="col-xs-2">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $a = 0; ?>
              @foreach( $data['content'] as $row )
                <tr>
                  <td>{!! ++$a !!}</td>
                  <td>{!! $row->ibu->no_ktp !!}</td>
                  <td>{!! $row->ibu->nama !!}</td>
                  <td>
                    <div class="btn-group btn-group-justified">
                      <div class="btn-group" role="group">
                        <a href="javascript:void(0);" onclick="deleteModal(this)" data-href="{!! route( 'pkk.absen.delete', $row->id ) !!}" class="btn btn-danger">
                          <i class="fa fa-trash-o"></i>
                          &nbsp;Hapus
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
