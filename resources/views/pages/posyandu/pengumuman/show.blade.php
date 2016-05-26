@extends( 'pages.posyandu.template' )

@section( 'main-container-header-title', "Data Pengumuman" )

@section( 'main-container-breadcrumb' )
  <li><a href="{!! route( 'posyandu' ) !!}"><i class="fa fa-dashboard"></i> Menu Utama</a></li>
  <li><a href="{!! route( 'posyandu.pengumuman' ) !!}">Pengumuman</a></li>
  <li class="active">Rincian Data Pengumuman</li>
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
           <li class="list-group-item"><strong>Tanggal : </strong> {{ $pengumuman->created_at }}</li>
           <li class="list-group-item"><strong>Judul : </strong> {{ $pengumuman->judul }}</li>
           <li class="list-group-item"><strong>Isi : </strong> {{ $pengumuman->isi }}</li>
  			   <li class="list-group-item"><strong>Link : </strong> {{ $pengumuman->link }}</li>
        </div>
        <div class="box-footer">
          <a href="{!! route( 'posyandu.pengumuman' ) !!}" class="btn btn-info">Kembali</a>
          <a href="{!! route( 'posyandu.pengumuman.edit', $pengumuman->id ) !!}" class="btn btn-warning">Ubah</a>
          <a href="javascript:void(0);" onclick="deleteModal(this)" data-href="{!! route( 'posyandu.pengumuman.delete', $pengumuman->id ) !!}" class="btn btn-danger">Hapus</a>
        </div>
      </div>
    </div>
  </div>
  @include( 'layouts.scripts.delete-modal' )
@endsection
