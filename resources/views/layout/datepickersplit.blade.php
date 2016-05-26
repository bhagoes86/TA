@section('css')
  @parent
  {!! HTML::style('css/jquery-ui.css') !!}
@endsection

@section('script')
  @parent
  {!! HTML::script('js/jquery-ui.js') !!}
  <script type="text/javascript">
    $( function() {
      $("#datepicker").datepicker({
        onSelect: function(dateText, inst) {
          //dateText comes in as MM/DD/YY
          var datePieces = dateText.split('/');
          var month = datePieces[0];
          var day = datePieces[1];
          var year = datePieces[2];
          //define select option values for
          //corresponding element
          $('select#month').val(month);
          $('select#day').val(day);
          $('select#year').val(year);
        }
      });
      $('#month,#day,#year').change(function() {
        $('#datepicker').datepicker('setDate', new Date($('#year').val() - 0, $('#month').val() - 1, $('#day').val() - 0));
      });
    } );
  </script>
@endsection