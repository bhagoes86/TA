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

@section( 'main-container-header-title', "Pengurus PKK" )

@section( 'main-container-breadcrumb' )
  <li><a href="{!! route( 'pkk' ) !!}"><i class="fa fa-dashboard"></i> Menu Utama</a></li>
  <li class="active">Pengurus PKK</li>
@endsection

@section( 'main-content' )
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">
            Daftar Pengurus PKK&nbsp;&nbsp;&nbsp;
            <a href="{!! route( 'pkk.pengurus.create' ) !!}" class="btn btn-primary btn-sm">Tambah Pengurus</a>
          </h3>
        </div>
        <div class="box-body">
          <table class="table table-bordered table-striped dataTable">
            <thead>
              <tr>
                <th class="col-xs-1">No</th>
                <th>Nama</th>
                <th>Periode</th>
                <th>Jabatan</th>
                <th class="col-xs-2">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $a = 0; ?>
              @foreach( $data['content'] as $row )
                <tr>
                  <td>{!! ++$a !!}</td>
                  <td>{!! $row->ibu->nama !!}</td>
                  <td>{!! $row->periode->tahun_mulai !!}{!! $row->periode->tahun_mulai == $row->periode->tahun_selesai ? null : '/'.$row->periode->tahun_selesai !!}</td>
                  <td>{!! $row->jabatan->nama !!}</td>
                  <td>
                    <div class="btn-group btn-group-justified">
                      <div class="btn-group" role="group">
                        <a href="{!! route( 'pkk.pengurus.edit', $row->id ) !!}" class="btn btn-warning">
                          <i class="fa fa-pencil-square-o"></i>
                          <span class="btn-title">&nbsp;Ubah</span>
                        </a>
                      </div>
                      <div class="btn-group" role="group">
                        <a href="javascript:void(0);" onclick="deleteModal(this)" data-href="{!! route( 'pkk.pengurus.delete', $row->id ) !!}" class="btn btn-danger">
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
