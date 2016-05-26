@extends( 'layouts.template' )

@section( 'css' )
  @include( 'layouts.adminlte.head' )
@endsection

@section( 'body-class', 'class="hold-transition skin-blue sidebar-mini"' )

@section( 'content' )
  <div class="wrapper">
    <!-- NAVBAR -->
    @include( 'layouts.adminlte.main-container' )

    <!-- SIDEBAR -->
    <aside class="main-sidebar">
      @include( 'layouts.adminlte.sidebar' )
    </aside>

    <!-- MAIN CONTAINER -->
    <div class="content-wrapper">
      @yield( 'main-container' )
    </div>
  </div>
@endsection

@section( 'script' )
  @include( 'layouts.adminlte.footer' )
@endsection
