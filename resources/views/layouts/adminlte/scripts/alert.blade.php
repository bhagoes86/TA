@if( Session::has( 'success' ) || Session::has( 'danger' ) || Session::has( 'warning' ) || Session::has( 'info' ) )
  <div class="alert
    @if( Session::has( 'success' ) )
      alert-success
    @elseif( Session::has( 'danger' ) )
      alert-danger
    @elseif( Session::has( 'warning' ) )
      alert-warning
    @elseif( Session::has( 'info' ) )
      alert-info
    @endif
    " role="alert">
    <p>
    @if( Session::has( 'success' ) )
      {!! Session::get( 'success' ) !!}
    @elseif( Session::has('danger' ) )
      {!! Session::get( 'danger' ) !!}
    @elseif( Session::has('warning' ) )
      {!! Session::get( 'warning' ) !!}
    @elseif( Session::has('info' ) )
      {!! Session::get( 'info' ) !!}
    @endif
    </p>
  </div>
@endif
