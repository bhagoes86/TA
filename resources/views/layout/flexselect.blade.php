@section('css')
  @parent
  {!! HTML::style('css/flexselect.css') !!}
@endsection

@section('script')
  @parent
  {!! HTML::script('js/liquidmetal.js') !!}
  {!! HTML::script('js/jquery.flexselect.js') !!}
  <script type="text/javascript">
    $(document).ready(function() {
      $("select.special-flexselect").flexselect({ hideDropdownOnEmptyInput: true });
    });
  </script>
@endsection