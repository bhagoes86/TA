@extends('pages.posyandu.template')

@section( 'custom-css' )
  @include( 'layouts.datatables.head' )
@endsection

@section( 'custom-footer' )
  @include( 'layouts.datatables.foot' )
@endsection

@section( 'main-container-header-title', "Daftar Kelurahan / Desa" )

@section( 'main-container-breadcrumb' )
  <li><a href="{!! route( 'posyandu' ) !!}"><i class="fa fa-dashboard"></i> Menu Utama</a></li>
  <li class="active">Kelurahan / Desa</li>
@endsection

@section( 'main-content')
   <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">
              Detail Data Kelurahan&nbsp;&nbsp;&nbsp;
              <a href="{!! route( 'posyandu.kelurahan.create' ) !!}" class="btn btn-primary btn-sm">Tambah Kelurahan</a>
            </h3>
          </div>
          <div class="box-body">
            <table class="table table-bordered table-striped dataTable">
              <thead>
                <tr>
                  <th class="col-xs-1">No</th>
                  <th>Kode Kelurahan</th>
                  <th>Nama Kelurahan</th>
                  <th class="col-xs-6">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $a = 0; ?>
                  @foreach($kelurahan as $lokasiKelurahan)
                  <tr>
                    <td>{!! ++$a !!}</td>
                    <td>{!! $lokasiKelurahan->kode !!}</td>
                    <td>{!! $lokasiKelurahan->nama !!}</td>
                      <td>
                      <div class="btn-group btn-group-justified">
                        <div class="btn-group" role="group">
                          <a href="{!! route( 'posyandu.kelurahan.show', $lokasiKelurahan->id ) !!}" class="btn btn-info">
                            <i class="fa fa-info"></i>
                            &nbsp;Lihat Posyandu
                          </a>
                        </div>
                        <div class="btn-group" role="group">
                          <a href="{!! route( 'posyandu.kelurahan.edit', $lokasiKelurahan->id ) !!}" class="btn btn-warning">
                            <i class="fa fa-pencil-square-o"></i>
                            &nbsp;Ubah
                          </a>
                        </div>
                        <div class="btn-group" role="group">
                          <a href="javascript:void(0);" onclick="deleteModal(this)" data-href="{!! route( 'posyandu.kelurahan.delete', $lokasiKelurahan->id ) !!}" class="btn btn-danger">
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