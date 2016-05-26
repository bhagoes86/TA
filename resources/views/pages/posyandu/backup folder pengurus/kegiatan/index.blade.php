@extends( 'pages.pkk.pengurus.template' )

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

@section( 'main-container-header-title', "Kegiatan PKK" )

@section( 'main-container-breadcrumb' )
  <li><a href="{!! route( 'pkk' ) !!}"><i class="fa fa-dashboard"></i> Menu Utama</a></li>
  <li class="active">Kegiatan PKK</li>
@endsection

@section( 'main-content' )
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">
            Daftar Kegiatan PKK&nbsp;&nbsp;&nbsp;
            <a href="{!! route( 'pkk.kegiatan.create' ) !!}" class="btn btn-primary btn-sm">Tambah Kegiatan</a>
          </h3>
        </div>
        <div class="box-body">
          <table class="table table-bordered table-striped dataTable">
            <thead>
              <tr>
                <th class="col-xs-1">No</th>
                <th>Nama</th>
                <th>Tanggal</th>
                <th class="col-xs-1">Absensi</th>
                <th class="col-xs-1">Notulensi</th>
                <th class="col-xs-2">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $a = 0; ?>
              @foreach( $data['content'] as $row )
                <tr>
                  <td>{!! ++$a !!}</td>
                  <td>{!! $row->nama !!}</td>
                  <td>{!! $row->tanggal !!}</td>
                  <td><a href="{!! route( 'pkk.absen.show', $row->id ) !!}" class="btn btn-block btn-sm btn-primary">Lihat absensi</a></td>
                  <td>
                    @if( $row->notulensi->first() )
                      <a href="{!! route( 'pkk.notulensi.edit', $row->notulensi->first()->id ) !!}" class="btn btn-sm btn-success"><i class="fa fa-check"></i>&nbsp;&nbsp;Lihat notulensi</a>
                    @else
                      <a href="{!! route( 'pkk.notulensi.create', $row->id ) !!}" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i>&nbsp;&nbsp;Tambah notulensi</a>
                    @endif
                  </td>
                  <td>
                    <div class="btn-group btn-group-justified">
                      <div class="btn-group" role="group">
                        <a href="{!! route( 'pkk.kegiatan.edit', $row->id ) !!}" class="btn btn-warning">
                          <i class="fa fa-pencil-square-o"></i>
                          <span class="btn-title">&nbsp;Ubah</span>
                        </a>
                      </div>
                      <div class="btn-group" role="group">
                        <a href="javascript:void(0);" onclick="deleteModal(this)" data-href="{!! route( 'pkk.kegiatan.delete', $row->id ) !!}" class="btn btn-danger">
                          <i class="fa fa-trash-o"></i>
                          <span class="btn-title">&nbsp;Hapus</span>
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
