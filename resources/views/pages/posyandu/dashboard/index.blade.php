@extends( 'pages.posyandu.template' )

@section( 'main-container-header-title', "Halaman Utama" )

@section( 'main-container-breadcrumb' )
  <li><a href="{!! route( 'posyandu' ) !!}"><i class="fa fa-dashboard"></i> Menu Utama</a></li>
  <li class="active">Halaman Utama</li>
@endsection

