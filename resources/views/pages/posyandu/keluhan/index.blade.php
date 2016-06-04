@extends('pages.posyandu.template')

@section( 'custom-css' )
  @include( 'layouts.datatables.head' )
@endsection

@section( 'custom-footer' )
  @include( 'layouts.datatables.foot' )
@endsection

@section( 'main-container-header-title', "Daftar Keluhan" )

@section( 'main-container-breadcrumb' )
  <li><a href="{!! route( 'posyandu' ) !!}"><i class="fa fa-dashboard"></i> Menu Utama</a></li>
  <li class="active">Keluhan</li>
@endsection

@section( 'main-content')
  <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">
              Detail Data Keluhan&nbsp;&nbsp;&nbsp;
            </h3>
          </div>
          <div class="box-body">
            <table class="table table-bordered table-striped dataTable">
              <thead>
                <tr>
                  <th class="col-xs-1">No</th>
                  <th>Nama Ibu</th>
                  <th>Keluhan</th>
                  <th class="col-xs-4">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $a = 0; ?>
                  @foreach($keluhan as $keluhanposyandu)
                    <tr>
                      <td>{!! ++$a !!}</td>
                      <td>{!! $keluhanposyandu->nama !!}</td>
                      <td>{!! $keluhanposyandu->judul !!}</td>
                      <td>
                        <div class="btn-group btn-group-justified">
                          <div class="btn-group" role="group">
                            <a href="{!! route( 'posyandu.keluhan.show', $keluhanposyandu->id ) !!}" class="btn btn-warning">
                              <i class="fa fa-pencil-square-o"></i>
                              &nbsp;Lihat
                            </a>
                          </div>
                          <div class="btn-group" role="group">
                            <a href="javascript:void(0);" onclick="deleteModal(this)" data-href="{!! route( 'posyandu.keluhan.delete', $keluhanposyandu->id ) !!}" class="btn btn-danger">
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
