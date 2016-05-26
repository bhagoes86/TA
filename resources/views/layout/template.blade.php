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
    {!! HTML::style( 'bower_components/bootstrap/dist/css/bootstrap.min.css' ) !!}
    {!! HTML::style( 'bower_components/font-awesome/css/font-awesome.min.css' ) !!}
    @yield( 'css' )
  </head>
  <body @yield( 'body-class' )>
    @yield( 'content' )

    <!-- SCRIPTS -->
    {!! HTML::script( 'bower_components/jquery/dist/jquery.min.js' ) !!}
    {!! HTML::script( 'bower_components/bootstrap/dist/js/bootstrap.min.js' ) !!}
    @yield( 'script' )
  </body>
</html>
