@section('script')
  @parent
  {!! HTML::script('js/moment.js') !!}
  {!! HTML::script('js/combodate.js') !!}
  <script type="text/javascript">
    $( function() {
      $( "#combodate" ).combodate( {
        format: "YYYY-MM-DD",
        template: "YYYY MMM DD",
        smartDays: true
      } );
    } );
  </script>
@endsection