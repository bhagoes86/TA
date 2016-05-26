@extends( 'pages.pkk.admin.template' )

@section( 'main-container-header-title', "Halaman Utama" )

@section( 'main-container-breadcrumb' )
  <li><a href="{!! route( 'pkk.admin' ) !!}"><i class="fa fa-dashboard"></i> Menu Utama</a></li>
  <li class="active">Halaman Utama</li>
@endsection

