@extends( 'pages.posyandu.template' )

@section( 'custom-css' )
  @include( 'layouts.datatables.head' )
@endsection

@section( 'custom-footer' )
  @include( 'layouts.datatables.foot' )
@endsection

@section( 'main-container-header-title', "Daftar Posyandu" )

@section( 'main-container-breadcrumb' )
  <li><a href="{!! route( 'posyandu' ) !!}"><i class="fa fa-dashboard"></i> Menu Utama</a></li>
  <li class="active">Profil Posyandu</li>
@endsection

@section( 'main-content')
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">
              Detail Profil Posyandu&nbsp;&nbsp;&nbsp;
            </h3>
          </div>
          <div class="box-body">
            <table class="table table-bordered table-striped dataTable">
              <thead>
                <tr>
                  <th class="col-xs-1">No</th>
                  <th>Nama Posyandu</th>
                  <th>Alamat</th>
                  <th>Telp</th>
                  <th>Puskesmas</th>
                  <th>RW</th>
                  <th class="col-xs-1">Kata sandi</th>
                  <th class="col-xs-2">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $a = 0; ?>
                @foreach($posyandu as $pos)
                  <tr>
                    <td>{!! ++$a !!}</td>
                    <td>{!! $pos->nama !!}</td>
                    <td>{!! $pos->alamat !!}</td>
                    <td>{!! $pos->telp !!}</td>
                    <td>{!! $pos->puskesmas !!}</td>
                    <td>{!! $pos->rw !!}</td>
                    <td>
                      <div class="btn-group btn-group-justified">
                        <div class="btn-group" role="group">
                          <a href="{!! route( 'posyandu.data.reset', $pos->id ) !!}" class="btn btn-danger">
                            <i class="fa fa-retweet"></i>
                            &nbsp;Reset
                          </a>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="btn-group btn-group-justified">

                        <div class="btn-group" role="group">
                          <a href="{!! route( 'posyandu.data.edit', $pos->id ) !!}" class="btn btn-warning">
                            <i class="fa fa-pencil-square-o"></i>
                            &nbsp;Ubah
                          </a>
                        </div>
                        <div class="btn-group" role="group">
                        <a href="javascript:void(0);" onclick="deleteModal(this)" data-href="{!! route( 'posyandu.data.delete', $pos->id ) !!}" class="btn btn-danger">
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
