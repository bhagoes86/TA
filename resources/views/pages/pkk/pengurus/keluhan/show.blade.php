@extends( 'pages.pkk.pengurus.template' )

@section( 'main-container-header-title', "Rincian Keluhan" )

@section( 'main-container-breadcrumb' )
  <li><a href="{!! route( 'pkk' ) !!}"><i class="fa fa-dashboard"></i> Menu Utama</a></li>
  <li><a href="{!! route( 'pkk.pengumuman.index' ) !!}">Keluhan PKK</a></li>
  <li class="active">Rincian Keluhan</li>
@endsection

@section( 'main-content' )
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="glyphicon glyphicon-bookmark"></i> {!! $data['content']->judul !!}</h3>
        </div>
        <div class="box-body">
          <p>{!! $data['content']->isi !!}</p>
          <hr>
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th class="col-xs-3">Waktu</th>
                  <th>Isi Komentar &amp; Balasan</th>
                  <th>Penulis</th>
                </tr>
              </thead>
              <tbody>
                @foreach( $data['content']->komentar as $row )
                  <tr>
                    <td>{!! $row->created_at !!}</td>
                    <td>{!! $row->isi !!}</td>
                    <td>
                      @if( $row->id_ibu )
                        {!! $row->ibu->nama !!}
                      @else
                        <span class="label label-primary">Pengurus PKK</span>
                      @endif
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <hr>
          {!! BootForm::open()->action( route( 'pkk.keluhan.comment', $data['content']->id ) ) !!}
            {!! BootForm::textarea( 'Balasan/komentar baru', 'isi' ) !!}
            {!! BootForm::submit( 'Simpan' ) !!}
          {!! BootForm::close() !!}
        </div>
        <div class="box-footer">
          <a href="{!! route( 'pkk.keluhan.index' ) !!}" class="btn btn-primary">Kembali</a>
          <a href="javascript:void(0);" onclick="deleteModal(this)" data-href="{!! route( 'pkk.keluhan.delete', $data['content']->id ) !!}" class="btn btn-danger">Hapus</a>
        </div>
      </div>
    </div>
  </div>
  @include( 'layouts.scripts.delete-modal' )
@endsection
