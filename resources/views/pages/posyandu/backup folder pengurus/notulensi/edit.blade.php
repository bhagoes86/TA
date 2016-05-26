@extends( 'pages.pkk.pengurus.template' )

@section( 'main-container-header-title', "Ubah Notulensi" )

@section( 'main-container-breadcrumb' )
  <li><a href="{!! route( 'pkk' ) !!}"><i class="fa fa-dashboard"></i> Menu Utama</a></li>
  <li><a href="{!! route( 'pkk.kegiatan.index' ) !!}">Kegiatan PKK</a></li>
  <li class="active">Ubah Notulensi</li>
@endsection

@section( 'main-content' )
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">
            <i class="glyphicon glyphicon-user"></i>
            Data Notulensi Baru&nbsp;&nbsp;
            <a href="javascript:void(0);" onclick="deleteModal(this)" data-href="{!! route( 'pkk.notulensi.delete', $data['content']->id ) !!}" class="btn btn-danger btn-sm">
              <i class="fa fa-trash-o"></i>
              <span class="btn-title">&nbsp;Hapus Notulensi</span>
            </a>
          </h3>
        </div>
        {!! BootForm::open()->action( route( 'pkk.notulensi.update', $data['content']->id ) )->put() !!}
          {!! BootForm::bind( $data['content'] ) !!}
          @include( 'pages.pkk.pengurus.notulensi.form' )
        {!! BootForm::close() !!}
      </div>
    </div>
  </div>
  @include( 'layouts.scripts.delete-modal' )
@endsection
