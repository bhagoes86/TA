@extends( 'pages.posyandu.template' )

@section( 'custom-css' )
  @include( 'layouts.datatables.head' )
@endsection

@section( 'custom-footer' )
  @include( 'layouts.datatables.foot' )
@endsection

@section( 'main-container-header-title', "Daftar Pengurus" )

@section( 'main-container-breadcrumb' )
  <li><a href="{!! route( 'posyandu' ) !!}"><i class="fa fa-dashboard"></i>Menu Utama</a></li>
  <li class="active">Daftar Pengurus</li>
@endsection

@section( 'main-content')
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">
              Detail Data Pengurus&nbsp;&nbsp;&nbsp;
              <a href="{!! route( 'posyandu.pengurus.create' ) !!}" class="btn btn-primary btn-sm">Tambah Pengurus</a>
            </h3>
          </div>
          <div class="box-body">
            <table class="table table-bordered table-striped dataTable">
              <thead>
                <tr>
                  <th class="col-xs-1">No</th>
                  <th>Nama Pengurus</th>
                  <th>No. KTP</th>
                  <th>Alamat</th>
                  <th>No Telp</th>
                  <th class="col-xs-4">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $a = 0; ?>
                  @foreach($pengurus as $pengurusposyandu)
                    <tr>
                      <td>{!! ++$a !!}</td>
                      <td>{!! $pengurusposyandu->nama !!}</td>
                      <td>{!! $pengurusposyandu->no_ktp !!}</td>
                      <td>{!! $pengurusposyandu->alamat !!}</td>
                      <td>{!! $pengurusposyandu->telp !!}</td>
                      <td>
                        <div class="btn-group btn-group-justified">
                          <div class="btn-group" role="group">
                            <a href="{!! route( 'posyandu.pengurus.edit', $pengurusposyandu->id ) !!}" class="btn btn-warning">
                              <i class="fa fa-pencil-square-o"></i>
                              &nbsp;Ubah
                            </a>
                          </div>
                          <div class="btn-group" role="group">
                          <a href="javascript:void(0);" onclick="deleteModal(this)" data-href="{!! route( 'posyandu.pengurus.delete', $pengurusposyandu->id ) !!}" class="btn btn-danger">
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