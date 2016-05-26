@extends( 'pages.posyandu.template' )

@section( 'main-container-header-title', "Data Kelurahan" )

@section( 'main-container-breadcrumb' )
  <li><a href="{!! route( 'posyandu' ) !!}"><i class="fa fa-dashboard"></i> Menu Utama</a></li>
  <li><a href="{!! route( 'posyandu.kelurahan' ) !!}">Kelurahan</a></li>
  <li class="active">Rincian Data Kelurahan</li>
@endsection

@section( 'main-content' )
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">
            Rincian Data Kelurahan&nbsp;&nbsp;&nbsp;
          </h3>
        </div>
        <div class="box-body">
          <table>
            <tbody>
              <tr>
                <td class="col-xs-2"><strong>Kelurahan</strong></td>
                <td class="col-xs-1">:</td>
                <td class="col-xs-9">{!! $kelurahan->nama !!}</td>
              </tr> 
              <tr>
                <td class="col-xs-2"><strong>Kecamatan</strong></td>
                <td class="col-xs-1">:</td>
                <td class="col-xs-9">{!! $kecamatan->nama !!}</td>
              </tr> 
              <tr>
                <td class="col-xs-2"><strong>Kabupaten</strong></td>
                <td class="col-xs-1">:</td>
                <td class="col-xs-9">{!! $kabupaten->nama !!}</td>
              </tr> 
              <tr>
                <td class="col-xs-2"><strong>Provinsi</strong></td>
                <td class="col-xs-1">:</td>
                <td class="col-xs-9">{!! $provinsi->nama !!}</td>
              </tr> 
            </tbody>
          </table>
        </div>
        <div class="box-footer">
          <a href="{!! URL::previous() !!}" class="btn btn-primary">Kembali</a>
          <a href="{!! route( 'posyandu.data.create' , $kelurahan->id ) !!}" class="btn btn-warning">Tambah Posyandu</a>
        </div>
      </div>
    </div>
  </div>
   
   <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">
            Data Posyandu&nbsp;&nbsp;&nbsp;
          </h3>
        </div>
        <div class="box-body">
          <table class="table table-bordered table-striped dataTable">
              <thead>
                <tr>
                  <th class="col-xs-1">No</th>
                  <th>Nama Posyandu</th>
                  <th>Alamat</th>
                  <th>RW</th>
                  <th class="col-xs-6">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $a = 0; ?>
                  @foreach($posyandu as $pos)
                  <tr>
                    <td>{!! ++$a !!}</td>
                    <td>{!! $pos->nama !!}</td>
                    <td>{!! $pos->alamat !!}</td>
                    <td>{!! $pos->rw !!}</td>
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
  @include( 'layouts.scripts.delete-modal' )
@endsection
