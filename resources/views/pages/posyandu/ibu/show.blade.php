@extends( 'pages.posyandu.template' )

@section( 'main-container-header-title', "Data Ibu" )

@section( 'main-container-breadcrumb' )
  <li><a href="{!! route( 'posyandu' ) !!}"><i class="fa fa-dashboard"></i> Menu Utama</a></li>
  <li><a href="{!! route( 'posyandu.kelurahan' ) !!}">Ibu</a></li>
  <li class="active">Rincian Data Ibu</li>
@endsection

@section( 'main-content' )
  <div class="row">
    <div class="col-md-4">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">
            Rincian Data Ibu&nbsp;&nbsp;&nbsp;
          </h3>
        </div>
        <div class="box-body">
          <li class="list-group-item"><strong>Nama:</strong> <a class="pull-right">{{ $ibu->nama }}</a></li>
          <li class="list-group-item"><strong>Alamat:</strong> <a class="pull-right">{{ $ibu->alamat }}</a></li>
          <li class="list-group-item"><strong>No. KTP:</strong> <a class="pull-right">{{ $ibu->no_ktp }}</a></li>
          <li class="list-group-item"><strong>No. Telp:</strong> <a class="pull-right">{{ $ibu->telp }}</a></li>
          <li class="list-group-item"><strong>KB Ibu:</strong> <a class="pull-right">{{ $ibu->kb }}</a></li>
          <li class="list-group-item"><strong>Tanggal Lahir:</strong> <a class="pull-right">{{ $ibu->tanggal_lahir }}</a></li>
          <li class="list-group-item"><strong>Password Mobile:</strong> <a class="pull-right">{{ $ibu->password_mobile }}</a></li>
        </div>
        <div class="box-footer">
          <a href="{!! route( 'posyandu.ibu' ) !!}" class="btn btn-info">Kembali</a>
          <a href="{!! route( 'posyandu.ibu.edit', $ibu->id ) !!}" class="btn btn-warning">Ubah</a>
          <a href="javascript:void(0);" onclick="deleteModal(this)" data-href="{!! route( 'posyandu.ibu.delete', $ibu->id ) !!}" class="btn btn-danger">Hapus</a>
        </div>
      </div>
    </div>
    <div class="col-md-8">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">
            Daftar Anak &nbsp;&nbsp;&nbsp;
          </h3>
          <a href="{!! route( 'posyandu.balita.create', $ibu->id ) !!}" class="btn btn-primary btn-sm">Tambah Anak</a>
        </div>
        <div class="box-body">
          <table class="table table-bordered table-striped dataTable">
              <thead>
                <tr>
                  <th class="col-xs-1">No</th>
                  <th>Nama Balita</th>
                  <th>Tanggal Lahir</th>
                  <th class="col-xs-5">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $a = 0; ?>
                @foreach($balita as $anak)
                  <tr>
                      <td>{!! ++$a !!}</td>
                      <td>{!! $anak->nama !!}</td>
                      <td>{!! $anak->tanggal_lahir !!}</td>
                      <td>
                        <div class="btn-group btn-group-justified">
                          <div class="btn-group" role="group">
                            <a href="{!! route( 'posyandu.balita.show', $anak->id ) !!}" class="btn btn-info">
                              <i class="fa fa-pencil-square-o"></i>
                              &nbsp;Detail
                            </a>
                          </div>
                          <div class="btn-group" role="group">
                            <a href="{!! route( 'posyandu.balita.edit', $anak->id ) !!}" class="btn btn-warning">
                              <i class="fa fa-pencil-square-o"></i>
                              &nbsp;Ubah
                            </a>
                          </div>
                          <div class="btn-group" role="group">
                          <a href="javascript:void(0);" onclick="deleteModal(this)" data-href="{!! route( 'posyandu.balita.delete', $anak->id ) !!}" class="btn btn-danger">
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