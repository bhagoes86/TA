<?php
  $title = $data['type'] ? 'Pemasukan' : 'Pengeluaran';
?>

@extends( 'pages.pkk.pengurus.template' )

@section( 'custom-css' )
  @include( 'layouts.select2.head' )
@endsection

@section( 'custom-footer' )
  @include( 'layouts.select2.foot' )
@endsection

@section( 'main-container-header-title', "Tambah Iuran ".$title." PKK" )

@section( 'main-container-breadcrumb' )
  <li><a href="{!! route( 'pkk' ) !!}"><i class="fa fa-dashboard"></i> Menu Utama</a></li>
  <li><a href="{!! route( 'pkk.kas' ) !!}">Iuran PKK</a></li>
  <li class="active">Tambah Iuran {!! $title !!} PKK</li>
@endsection

@section( 'main-content' )
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="glyphicon glyphicon-tag"></i> Data Iuran {!! $title !!} PKK Baru</h3>
        </div>
        {!! BootForm::open()->action( route( 'pkk.kas.store', $data['type'] ) ) !!}
          @include( 'pages.pkk.pengurus.kas.form' )
        {!! BootForm::close() !!}
      </div>
    </div>
  </div>
@endsection
