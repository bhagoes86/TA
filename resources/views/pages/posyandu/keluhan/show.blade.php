@extends( 'pages.posyandu.template' )

@section( 'main-container-header-title', "Data Keluhan" )

@section( 'main-container-breadcrumb' )
  <li><a href="{!! route( 'posyandu' ) !!}"><i class="fa fa-dashboard"></i> Menu Utama</a></li>
  <li><a href="{!! route( 'posyandu.keluhan' ) !!}">Keluhan</a></li>
  <li class="active">Rincian Data Keluhan</li>
@endsection

@section( 'main-content' )
  <div class="row">
    <div class="col-md-6">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">
            Rincian Data Keluhan&nbsp;&nbsp;&nbsp;
          </h3>
        </div>
        <div class="box-body">
          <li class="list-group-item"><strong>Judul Keluhan:</strong> <a class="pull-right">{{ $keluhan->judul }}</a></li>
          <li class="list-group-item"><strong>Tanggal Keluhan:</strong> <a class="pull-right">{{ $keluhan->created_at }}</a></li>
          <li class="list-group-item"><strong>Isi Keluhan:</strong> <a class="pull-right">{{ $keluhan->isi }}</a></li>
          <br>
            {!! BootForm::open()->action( route( 'posyandu.jawabkeluhan.create' , $keluhan->id))!!}
              {!! BootForm::text( 'Jawaban', 'komentar' ) !!}
              {!! BootForm::submit( 'Jawab' )->removeClass( 'btn-default' )->addClass( 'btn-primary pull-right' ) !!}
            {!! BootForm::close() !!}
        </div>

      </div>
    </div>
    <div class="col-md-6">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">
            Jawaban Keluhan&nbsp;&nbsp;&nbsp;
          </h3>
        </div>
        <div class="box-body">
          @foreach($komentar as $komen)
            @if($komen->user == 1)
              <li class="list-group-item"><strong>Admin</strong> <a>{{ $komen->isi }}</a>
                <a href="javascript:void(0);" onclick="deleteModal(this)" data-href="{!! route( 'posyandu.jawabkeluhan.delete', $komen->id ) !!}" class="btn btn-danger btn-sm pull-right" style="padding: 3px">Hapus</a>
              </li>
            @else
              <li class="list-group-item"><strong>Orangtua</strong> <a>{{ $komen->isi }}</a>
                <a href="javascript:void(0);" onclick="deleteModal(this)" data-href="{!! route( 'posyandu.jawabkeluhan.delete', $komen->id ) !!}" class="btn btn-danger btn-sm pull-right"  style="padding: 3px">Hapus</a>
              </li>
            @endif
          @endforeach
        </div>
      </div>
    </div>
  </div>
  @include( 'layouts.scripts.delete-modal' )
@endsection
