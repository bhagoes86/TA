@extends( 'pages.pkk.pengurus.template' )

@section( 'custom-css' )
  @include( 'layouts.datatables.head' )
@endsection

@section( 'custom-footer' )
  @include( 'layouts.datatables.foot' )
@endsection

@section( 'main-container-header-title', "Jenis Iuran PKK" )

@section( 'main-container-breadcrumb' )
  <li><a href="{!! route( 'pkk' ) !!}"><i class="fa fa-dashboard"></i> Menu Utama</a></li>
  <li class="active">Jenis Iuran PKK</li>
@endsection

@section( 'main-content' )
  <div class="row">
    @for( $i = 0; $i < 2; $i++ )
      <?php
        $title = $i ? 'Pemasukan' : 'Pengeluaran';
      ?>
      <div class="col-xs-12 col-md-6">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">
              Daftar Jenis Iuran {!! $title !!}&nbsp;&nbsp;&nbsp;
              <a href="{!! route( 'pkk.jeniskas.create', $i ) !!}" class="btn btn-primary btn-sm">Tambah Jenis {!! $title !!}</a>
            </h3>
          </div>
          <div class="box-body">
            <table class="table table-bordered table-striped dataTable">
              <thead>
                <tr>
                  <th class="col-xs-1">No</th>
                  <th>Nama</th>
                  <th class="col-xs-4">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $a = 0; ?>
                @foreach( $i ? $data['pemasukan'] : $data['pengeluaran'] as $row )
                  <tr>
                    <td>{!! ++$a !!}</td>
                    <td>{!! $row->nama !!}</td>
                    <td>
                      <div class="btn-group btn-group-justified">
                        <div class="btn-group" role="group">
                          <a href="{!! route( 'pkk.jeniskas.edit', $row->id ) !!}" class="btn btn-warning">
                            <i class="fa fa-pencil-square-o"></i>
                            &nbsp;Ubah
                          </a>
                        </div>
                        <div class="btn-group" role="group">
                          <a href="javascript:void(0);" onclick="deleteModal(this)" data-href="{!! route( 'pkk.jeniskas.delete', $row->id ) !!}" class="btn btn-danger">
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
    @endfor
  </div>
  @include( 'layouts.scripts.delete-modal' )
@endsection
