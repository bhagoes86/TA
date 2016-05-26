@section('css')
  @parent
  {!! HTML::style('css/jquery-ui.css') !!}
@endsection

@section('script')
  @parent
  {!! HTML::script('js/jquery-ui.js') !!}
  <script type="text/javascript">
    $( function() {
      $( "#datepicker" ).datepicker({
        changeMonth: true,
        changeYear: true,
        maxDate: "-5Y"
      }).datepicker( "option", "dateFormat", "yy-mm-dd" );
    } );
  </script>
@endsection