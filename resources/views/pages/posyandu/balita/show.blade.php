@extends( 'pages.posyandu.template' )

@section( 'main-container-header-title', "Data Balita" )

@section('script')
    {!! HTML::script('bower_components/flot/excanvas.min.js') !!}
    {!! HTML::script('bower_components/flot/jquery.flot.js') !!}
    {!! HTML::script('bower_components/flot/jquery.flot.resize.js') !!}
    {!! HTML::script('bower_components/flot/jquery.flot.time.js') !!}
    {!! HTML::script('bower_components/flot/jquery.flot.axislabels.js') !!}
    {!! HTML::script('bower_components/flot.tooltip/js/jquery.flot.tooltip.min.js') !!}
    {!! HTML::script( 'adminlte/plugins/flot/jquery.flot.min.js') !!}
    {!! HTML::script( 'adminlte/plugins/flot/jquery.resize.min.js') !!}
    {!! HTML::script( 'adminlte/plugins/flot/jquery.pie.min.js') !!}
    {!! HTML::script( 'adminlte/plugins/flot/jquery.categories.min.js') !!}
    @include('layout/grafik')
@endsection

@section( 'main-container-breadcrumb' )
  <li><a href="{!! route( 'posyandu' ) !!}"><i class="fa fa-dashboard"></i> Menu Utama</a></li>
  <li><a href="{!! route( 'posyandu.balita' ) !!}">Balita</a></li>
  <li class="active">Rincian Data Balita</li>
@endsection

@section( 'main-content' )
  <div class="row">
    <div class="col-md-4">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">
            Rincian Data Balita&nbsp;&nbsp;&nbsp;
          </h3>
        </div>
        <div class="box-body">
          <li class="list-group-item"><strong>Nama:</strong> <a class="pull-right">{{ $balita->nama }}</a></li>
          <li class="list-group-item"><strong>Tanggal Lahir:</strong> <a class="pull-right">{{ $balita->tanggal_lahir }}</a></li>
          <li class="list-group-item"><strong>Nama ibu:</strong> <a class="pull-right">{{ $balita->nama_ibu }}</a></li>
          <li class="list-group-item"><strong>Nama ayah:</strong> <a class="pull-right">{{ $balita->nama_ayah }}</a></li>
          <li class="list-group-item"><strong>Anak Ke-:</strong> <a class="pull-right">{{ $balita->anak_ke }}</a></li>
          <li class="list-group-item"><strong>Jenis Kelamin:</strong> <a class="pull-right">@if($balita->jenis_kelamin = 'L') Laki-laki @else Perempuan @endif</a></li>
          <li class="list-group-item"><strong>Berat badan lahir:</strong> <a class="pull-right">{{ $balita->bb_lahir }}</a></li>
          <li class="list-group-item"><strong>Tinggi badan lahir:</strong> <a class="pull-right">{{ $balita->tb_lahir }}</a></li>
          <li class="list-group-item"><strong>Pekerjaan ibu:</strong> <a class="pull-right">{{ $balita->pekerjaan_ibu }}</a></li>
          <li class="list-group-item"><strong>Pekerjaan ayah:</strong> <a class="pull-right">{{ $balita->pekerjaan_ayah }}</a></li>
        </div>
        <div class="box-footer">
          <a href="{{ URL::previous() }}" class="btn btn-info">Kembali</a>
          <a href="{!! route( 'posyandu.balita.edit', $balita->id ) !!}" class="btn btn-warning">Ubah</a>
          <a href="javascript:void(0);" onclick="deleteModal(this)" data-href="{!! route( 'posyandu.balita.delete', $balita->id ) !!}" class="btn btn-danger">Hapus</a>
        </div>
      </div>
    </div>
    <div class="col-md-8">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">
            Tabel Perkembangan Berat Badan Balita&nbsp;&nbsp;&nbsp;
          </h3>
        </div>
        <div class="box-body">
          <div class="flot-chart">
            <div class="flot-chart-content" id="flot-line-chart" style="height: 200px"> </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-8">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">
            Tabel Perkembangan Tinggi Badan Balita&nbsp;&nbsp;&nbsp;
          </h3>
        </div>
        <div class="box-body">
            <div class="flot-chart">
              <div class="flot-chart-content" id="flot-line-chart2" style="height: 200px"> </div>
            </div>
        </div>
      </div>
    </div>
  </div>
   <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">
              Detail Data Penimbangan Balita&nbsp;&nbsp;&nbsp;
              <a href="{!! route( 'posyandu.penimbangan.create' , $balita->id ) !!}" class="btn btn-primary btn-sm">Tambah Data Penimbangan</a>
            </h3>
          </div>
          <div class="box-body">
            <table class="table table-bordered table-striped dataTable">
              <thead>
                <tr>
                  <th>No</th>
                  <th>umur</th>
                  <th>Tanggal Timbang</th>
                  <th>Berat</th>
                  <th>Tinggi</th>
                  <th>ASI</th>
                  <th class="col-md-4">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $a = 0; ?>
                  @foreach($penimbangan as $timbang)
                    <tr>
                      <td>{!! ++$a !!}</td>
                      <td>{!! $timbang->umur !!} bulan</td>
                      <td>{!! $timbang->tanggal !!}</td>
                      <td>{!! $timbang->berat !!} cm</td>
                      <td>{!! $timbang->tinggi !!} kg</td>
                      <td>{!! $timbang->asi !!}</td>
                      <td>
                        <div class="btn-group btn-group-justified">
                          <div class="btn-group" role="group">
                            <a href="{!! route( 'posyandu.penimbangan.edit', $timbang->id ) !!}" class="btn btn-warning">
                              <i class="fa fa-pencil-square-o"></i>
                              &nbsp;Ubah
                            </a>
                          </div>
                          <div class="btn-group" role="group">
                          <a href="javascript:void(0);" onclick="deleteModal(this)" data-href="{!! route( 'posyandu.penimbangan.delete', $timbang->id ) !!}" class="btn btn-danger"><i class="fa fa-trash-o"></i>&nbsp;Hapus
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
    <div class="row">
      <div class="col-md-6">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">
              Detail Data Imunisasi Balita&nbsp;&nbsp;&nbsp;
              <a href="{!! route( 'posyandu.beriimunisasi.create' , $balita->id) !!}" class="btn btn-primary btn-sm">Tambah Data Imunisasi</a>
            </h3>
          </div>
          <div class="box-body">
            <table class="table table-bordered table-striped dataTable">
              <thead>
                <tr>
                  <th class="col-md-1">No</th>
                  <th>Jenis</th>
                  <th>Umur</th>
                  <th>Tanggal Imunisasi</th>
                  <th class="col-md-4">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $a = 0; ?>
                  @foreach($beriimunisasi as $imunisasi)
                    <tr>
                      <td>{!! ++$a !!}</td>
                      <td>{!! $imunisasi->jenis !!}</td>
                      <td>{!! $imunisasi->umur !!} bulan</td>
                      <td>{!! $imunisasi->tanggal !!}</td>
                      <td>
                        <div class="btn-group btn-group-justified">
                          <div class="btn-group" role="group">
                            <a href="{!! route( 'posyandu.beriimunisasi.edit' , $imunisasi->id) !!}" class="btn btn-warning">
                              <i class="fa fa-pencil-square-o"></i>
                              &nbsp;Ubah
                            </a>
                          </div>
                          <div class="btn-group" role="group">
                          <a href="javascript:void(0);" onclick="deleteModal(this)" data-href="{!! route( 'posyandu.beriimunisasi.delete' , $imunisasi->id) !!}" class="btn btn-danger">
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
      <div class="col-md-6">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">
              Detail Data Kapsul Balita&nbsp;&nbsp;&nbsp;
              <a href="{!! route( 'posyandu.kapsul.create' , $balita->id ) !!}" class="btn btn-primary btn-sm">Tambah Data Kapsul</a>
            </h3>
          </div>
          <div class="box-body">
            <table class="table table-bordered table-striped dataTable">
              <thead>
                <tr>
                  <th class="col-md-1">No</th>
                  <th>Umur</th>
                  <th>Kapsul</th>
                  <th>Tanggal Kapsul</th>
                  <th class="col-md-4">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $a = 0; ?>
                  @foreach($kapsul as $kaps)
                    <tr>
                      <td>{!! ++$a !!}</td>
                      <td>{!! $kaps->umur !!} bulan</td>
                      <td>{!! $kaps->jenis !!}</td>
                      <td>{!! $kaps->tanggal !!}</td>
                      <td>
                        <div class="btn-group btn-group-justified">
                          <div class="btn-group" role="group">
                            <a href="{!! route( 'posyandu.kapsul.edit' , $kaps->id ) !!}" class="btn btn-warning">
                              <i class="fa fa-pencil-square-o"></i>
                              &nbsp;Ubah
                            </a>
                          </div>
                          <div class="btn-group" role="group">
                          <a href="javascript:void(0);" onclick="deleteModal(this)" data-href="{!! route( 'posyandu.kapsul.delete' , $kaps->id ) !!}" class="btn btn-danger">
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
  </div>
   
  @include( 'layouts.scripts.delete-modal' )
@endsection
