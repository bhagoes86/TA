@extends( 'pages.posyandu.template' )

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

@section( 'main-container-header-title', "Pengumuman Posyandu" )

@section( 'main-container-breadcrumb' )
  <li><a href="{!! route( 'posyandu' ) !!}"><i class="fa fa-dashboard"></i> Menu Utama</a></li>
  <li class="active">Pengumuman Posyandu</li>
@endsection

@section( 'main-content' )
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">
            Detail Pengumuman Posyandu&nbsp;&nbsp;&nbsp;
            <a href="{!! route( 'posyandu.pengumuman.create' ) !!}" class="btn btn-primary btn-sm">Tambah Pengumuman</a>
          </h3>
        </div>
        <div class="box-body">
          <table class="table table-bordered table-striped dataTable">
            <thead>
              <tr>
                <th class="col-xs-1">No</th>
                <th>Tanggal</th>
                <th>Judul</th>
                <th>Tautan</th>
                <th>Posyandu</th>
                <th class="col-xs-3">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $a = 0; ?>
              @if(Auth::user()->id == '1')
                @foreach($pengumuman as $pengumumanposyandu)
                    <tr>
                      <td>{!! ++$a !!}</td>
                      <td>{!! $pengumumanposyandu->created_at !!}</td>
                      <td>{!! $pengumumanposyandu->judul !!}</td>
                      <td>{!! $pengumumanposyandu->link !!}</td>
                        @foreach($posyandu as $pos)
                          @if($pos->id == $pengumumanposyandu->id_posyandu)
                            <td>{!! $pos->nama !!}</td>
                          @endif
                        @endforeach
                      <td>
                      <div class="btn-group btn-group-justified">
                        <div class="btn-group" role="group">
                          <a href="{!! route( 'posyandu.pengumuman.show', $pengumumanposyandu->id ) !!}" class="btn btn-info">
                            <i class="glyphicon glyphicon-search"></i>
                            <span class="btn-title">&nbsp;Lihat</span>
                          </a>
                        </div>
                        <div class="btn-group" role="group">
                          <a href="{!! route( 'posyandu.pengumuman.edit', $pengumumanposyandu->id ) !!}" class="btn btn-warning">
                            <i class="fa fa-pencil-square-o"></i>
                            <span class="btn-title">&nbsp;Ubah</span>
                          </a>
                        </div>
                        <div class="btn-group" role="group">
                          <a href="javascript:void(0);" onclick="deleteModal(this)" data-href="{!! route( 'posyandu.pengumuman.delete', $pengumumanposyandu->id ) !!}" class="btn btn-danger">
                            <i class="fa fa-trash-o"></i>
                            <span class="btn-title">&nbsp;Hapus</span>
                          </a>
                        </div>
                      </div>
                    </td>
                    </tr>
                @endforeach
              @else
              @foreach($pengumuman as $pengumumanposyandu)
                @if(isset($pengumumanposyandu) && $pengumumanposyandu->id_posyandu == Auth::user()->id_posyandu)
                  <tr>
                    <td>{!! ++$a !!}</td>
                    <td>{!! $pengumumanposyandu->tanggal !!}</td>
                    <td>{!! $pengumumanposyandu->judul !!}</td>
                    <td>{!! $pengumumanposyandu->link !!}</td>
                    <td>
                    <div class="btn-group btn-group-justified">
                      <div class="btn-group" role="group">
                        <a href="{!! route( 'posyandu.pengumuman.show', $pengumumanposyandu->id ) !!}" class="btn btn-info">
                          <i class="glyphicon glyphicon-search"></i>
                          <span class="btn-title">&nbsp;Lihat</span>
                        </a>
                      </div>
                      <div class="btn-group" role="group">
                        <a href="{!! route( 'posyandu.pengumuman.edit', $pengumumanposyandu->id ) !!}" class="btn btn-warning">
                          <i class="fa fa-pencil-square-o"></i>
                          <span class="btn-title">&nbsp;Ubah</span>
                        </a>
                      </div>
                      <div class="btn-group" role="group">
                        <a href="javascript:void(0);" onclick="deleteModal(this)" data-href="{!! route( 'posyandu.pengumuman.delete', $pengumumanposyandu->id ) !!}" class="btn btn-danger">
                          <i class="fa fa-trash-o"></i>
                          <span class="btn-title">&nbsp;Hapus</span>
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
