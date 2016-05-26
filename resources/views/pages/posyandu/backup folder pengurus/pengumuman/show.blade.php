@extends( 'pages.pkk.pengurus.template' )

@section( 'main-container-header-title', "Rincian Pengumuman PKK" )

@section( 'main-container-breadcrumb' )
  <li><a href="{!! route( 'pkk' ) !!}"><i class="fa fa-dashboard"></i> Menu Utama</a></li>
  <li><a href="{!! route( 'pkk.pengumuman.index' ) !!}">Pengumuman PKK</a></li>
  <li class="active">Rincian Pengumuman PKK</li>
@endsection

@section( 'main-content' )
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="glyphicon glyphicon-bookmark"></i> {!! $data['content']->judul !!}</h3> <small>{!! $data['content']->link !!}</small>
        </div>
        <div class="box-body">
          <p>{!! $data['content']->isi !!}</p>
        </div>
        <div class="box-footer">
          <a href="{!! route( 'pkk.pengumuman.index' ) !!}" class="btn btn-primary">Kembali</a>
          <a href="{!! route( 'pkk.pengumuman.edit', $data['content']->id ) !!}" class="btn btn-warning">Sunting</a>
          <a href="javascript:void(0);" onclick="deleteModal(this)" data-href="{!! route( 'pkk.pengumuman.delete', $data['content']->id ) !!}" class="btn btn-danger">Hapus</a>
        </div>
      </div>
    </div>
  </div>
  @include( 'layouts.scripts.delete-modal' )
@endsection
