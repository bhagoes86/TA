@extends( 'pages.posyandu.template' )

@section( 'custom-css' )
  @include( 'layouts.datatables.head' )
@endsection

@section( 'custom-footer' )
  @include( 'layouts.datatables.foot' )
@endsection

@section( 'main-container-header-title', "Data Pemberian Imunisasi" )

@section( 'main-container-breadcrumb' )
  <li><a href="{!! route( 'posyandu' ) !!}"><i class="fa fa-dashboard"></i>Menu Utama</a></li>
  <li class="active">Data Pemberian Imunisasi</li>
@endsection


@section( 'main-content')
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">
              Detail Data Pemberian Imunisasi&nbsp;&nbsp;&nbsp;
            </h3>
          </div>
          <div class="box-body">
            <table class="table table-bordered table-striped dataTable">
              <thead>
                <tr>
                  <th class="col-xs-1">No</th>
                  <th>Nama Anak</th>
                  <th>Jenis Imunisasi</th>
                  <th>Tanggal Imunisasi</th>
                  <th class="col-xs-4">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $a = 0; ?>
                  @foreach($beriimunisasi as $imunisasi)
                    <tr>
                      <td>{!! ++$a !!}</td>
                      <td>{!! $imunisasi->nama !!}</td>
                      <td>{!! $imunisasi->jenis !!}</td>
                      <td>{!! $imunisasi->tanggal !!}</td>
                      <td>
                        <div class="btn-group btn-group-justified">
                          <div class="btn-group" role="group">
                            <a href="{!! route( 'posyandu.balita.show', $imunisasi->id_balita ) !!}" class="btn btn-info">
                              <i class="fa fa-pencil-square-o"></i>
                              &nbsp;Detail
                            </a>
                          </div>
                          <div class="btn-group" role="group">
                            <a href="{!! route( 'posyandu.beriimunisasi.edit', $imunisasi->id ) !!}" class="btn btn-warning">
                              <i class="fa fa-pencil-square-o"></i>
                              &nbsp;Ubah
                            </a>
                          </div>
                          <div class="btn-group" role="group">
                          <a href="javascript:void(0);" onclick="deleteModal(this)" data-href="{!! route( 'posyandu.beriimunisasi.delete', $imunisasi->id ) !!}" class="btn btn-danger">
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