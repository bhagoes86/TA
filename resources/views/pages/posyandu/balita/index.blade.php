@extends( 'pages.posyandu.template' )

@section( 'custom-css' )
  @include( 'layouts.datatables.head' )
@endsection

@section( 'custom-footer' )
  @include( 'layouts.datatables.foot' )
@endsection

@section( 'main-container-header-title', "Daftar Balita" )

@section( 'main-container-breadcrumb' )
  <li><a href="{!! route( 'posyandu' ) !!}"><i class="fa fa-dashboard"></i>Menu Utama</a></li>
  <li class="active">Daftar Balita</li>
@endsection

@section( 'main-content')
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">
              Detail Data Balita&nbsp;&nbsp;&nbsp;
              <!-- <a href="{!! route( 'posyandu.balita.create' ) !!}" class="btn btn-primary btn-sm">Tambah Balita</a> -->
            </h3>
          </div>
          <div class="box-body">
            <table class="table table-bordered table-striped dataTable">
              <thead>
                <tr>
                  <th class="col-xs-1">No</th>
                  <th>Nama Balita</th>
                  <th>Tanggal Lahir</th>
                  <th class="col-xs-4">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $a = 0; ?>
                @if(Auth::user()->id == '1')
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
                @else
                  @foreach($balita as $anak)
                    @if(isset($anak) && $anak->id_posyandu == Auth::user()->id_posyandu)
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
                    @endif
                  @endforeach
                @endif             
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  @include( 'layouts.scripts.delete-modal' )
@endsection