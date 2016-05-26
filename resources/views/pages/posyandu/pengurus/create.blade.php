@extends('pages.posyandu.template')

@section( 'main-container-header-title', "Masukkan Data Pengurus" )

@section( 'main-container-breadcrumb' )
  <li><a href="{!! route( 'posyandu' ) !!}"><i class="fa fa-dashboard"></i> Menu Utama</a></li>
  <li><a href="{!! route( 'posyandu.pengurus' ) !!}">Data Pengurus</a></li>
  <li class="active">Tambah Data Pengurus</li>
@endsection

@section( 'main-content' )
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="glyphicon glyphicon-user"></i> Data Pengurus</h3>
        </div>
          {!! BootForm::open()->action( route( 'posyandu.pengurus.store' ))!!}
          <div class="box-body">
            <div class="hidden"> 
              <select class="special-flexselect form-control" id="id_posyandu" name="id_posyandu" tabindex="1">
                <option value="{!! Auth::user()->id_posyandu !!}" selected>{!! Auth::user()->id_posyandu !!}</option>
              </select>
            </div>

          </div>
          @include( 'pages.posyandu.pengurus.form' )
        {!! BootForm::close() !!}
       </div>
    </div>
  </div>
@endsection 