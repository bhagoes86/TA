@extends('layout/template')

@section('css')
  {!! HTML::style('css/style.css') !!}
  {!! HTML::style('bower_components/metisMenu/dist/metisMenu.min.css') !!}
  {!! HTML::style('bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css') !!}
  {!! HTML::style('bower_components/datatables-responsive/css/dataTables.responsive.css') !!}
  {!! HTML::style('dist/css/sb-admin-2.css') !!}
  {!! HTML::style('bower_components/font-awesome/css/font-awesome.min.css') !!}
@endsection

@section('script')
  {!! HTML::script('bower_components/metisMenu/dist/metisMenu.min.js') !!}
  {!! HTML::script('bower_components/datatables/media/js/jquery.dataTables.min.js') !!}
  {!! HTML::script('bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js') !!}
  {!! HTML::script('dist/js/sb-admin-2.js') !!}
@endsection

@section('content')
  <div id="wrapper">
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        @yield('brand')
      </div>
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right">
          <li>
            @yield('logout')
          </li>
        </ul>
      </div>
      <div class="navbar-default sidebar" role="navigation" style="height:1000%; overflow-y: auto;">
        <div class="sidebar-nav navbar-collapse" >
          <ul class="nav" id="side-menu">
            <!-- <li class="sidebar-search">
              <div class="input-group custom-search-form">
                <input type="text" class="form-control" placeholder="Cari...">
                <span class="input-group-btn">
                  <button class="btn btn-default" type="button">
                    <i class="fa fa-search"></i>
                  </button>
                </span>
              </div>
            </li> -->
            <h4 style="margin-left:25%">
              MENU UTAMA
            </h4>
            @yield('superadminsidebar')
            @yield('adminsidebar')
            @yield('membersidebar')
          </ul>
        </div>
      </div>
    </nav>
    @yield('pagecontent')
  </div>
@endsection