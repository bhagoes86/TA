<!DOCTYPE html>
<html>
  <head>
    <!-- METADATAS -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <!-- TITLE -->
    <title>@yield( 'title' )</title>

    <!-- CSS -->
    {!! HTML::style( 'adminlte/bootstrap/css/bootstrap.min.css' ) !!}
    {!! HTML::style( 'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css' ) !!}
    {!! HTML::style( 'https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css' ) !!}
    {!! HTML::style( 'adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.css' ) !!}
    {!! HTML::style( 'adminlte/dist/css/AdminLTE.min.css' ) !!}
    {!! HTML::style( 'adminlte/dist/css/skins/_all-skins.min.css' ) !!}
    {!! HTML::style( 'bower_components/bootstrap/dist/css/bootstrap.min.css' ) !!}
    {!! HTML::style( 'bower_components/font-awesome/css/font-awesome.min.css' ) !!}
    
    @yield( 'css' )
  </head>
  <body @yield( 'body-class' )>
    @yield( 'content' )

    <!-- SCRIPTS -->
    {!! HTML::script( 'adminlte/plugins/jQuery/jQuery-2.1.4.min.js' ) !!}
    {!! HTML::script( 'adminlte/bootstrap/js/bootstrap.min.js' ) !!}
    {!! HTML::script( 'adminlte/plugins/datatables/jquery.dataTables.min.js' ) !!}
    {!! HTML::script( 'admin/plugins/datatables/dataTables.bootstrap.min.js' ) !!}
    {!! HTML::script( 'adminlte/plugins/slimScroll/jquery.slimscroll.min.js' ) !!}
    {!! HTML::script( 'adminlte/plugins/fastclick/fastclick.js' ) !!}
    <!-- {!! HTML::script( 'adminlte/dist/js/app.min.js' ) !!} -->
    {!! HTML::script( 'adminlte/dist/js/demo.js' ) !!}
    {!! HTML::script( 'adminlte/plugins/sparkline/jquery.sparkline.min.js' ) !!}
    {!! HTML::script( 'adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js' ) !!}
    {!! HTML::script( 'adminlte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js' ) !!}
    {!! HTML::script( 'adminlte/plugins/chartjs/Chart.min.js' ) !!}
     {!! HTML::script( 'bower_components/jquery/dist/jquery.min.js' ) !!}
    {!! HTML::script( 'bower_components/bootstrap/dist/js/bootstrap.min.js' ) !!}
    @yield( 'script' )
    
  </body>
</html>
