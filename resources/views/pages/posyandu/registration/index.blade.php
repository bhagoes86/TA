@extends( 'layouts.template' )

@section( 'title', 'Halaman Registrasi PKK' )

@section( 'css' )
  {!! HTML::style( 'adminlte/dist/css/AdminLTE.min.css' ) !!}
  @include( 'layouts.select2.head' )
@endsection

@section( 'script' )
  @include( 'layouts.select2.foot' )
  <script type="text/javascript">
    $( function() {
      $( 'form' ).bind( 'submit', function() {
        $( this ).find( '.location_select' ).prop( 'disabled', false );
      } );
    } );
  </script>
@endsection

@section( 'body-class', 'class="hold-transition register-page"' )

@section( 'content' )
  <div class="register-box">
    <div class="register-logo">
      <a href="{!! route( 'pkk' ) !!}">
        <img src="/img/pkk.png" style="max-height: 300px; width: auto; margin-bottom: 20px" class="img-responsive center-block" alt="Responsive image">
      </a>
    </div>
    <div class="register-box-body">
      <!-- back_to_main_emnu -->
      <p>
        <a href="{!! route( 'pkk' ) !!}" class="btn btn-info btn-block">
          <i class="glyphicon glyphicon-home"></i>
          &nbsp;&nbsp;&nbsp;&nbsp;
          Kembali ke halaman utama
          &nbsp;&nbsp;&nbsp;&nbsp;
          <i class="glyphicon glyphicon-home"></i>
        </a>
      </p>
      <!-- /back_to_main_emnu -->

      <hr>
      @include( 'layouts.adminlte.scripts.alert' )
      @if (count($errors) > 0)
        <div class="alert alert-danger" role="alert">
          <strong>Aksi gagal</strong>:
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
      <p class="register-box-msg">Registrasi PKK baru</p>

      <!-- registration_form -->
      {!! BootForm::open()->action( route( 'pkk.register' ) ) !!}
        {!! BootForm::bind( $data ) !!}
        {!! BootForm::hidden( 'step' ) !!}
        <!-- user_form -->
        @if( $data['step'] == 6 )
          <div class="form-group has-feedback">
            {!! Form::text( 'username' )->addClass( 'form-control' )->placeholder( 'Masukkan username' ) !!}
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            {!! Form::password( 'password' )->addClass( 'form-control' )->placeholder( 'Masukkan kata sandi' ) !!}
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            {!! Form::password( 're_password' )->addClass( 'form-control' )->placeholder( 'Masukkan ulang kata sandi' ) !!}
            <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
          </div>
          {!! Form::submit( 'Daftarkan PKK' )->addClass( 'btn btn-primary btn-block btn-flat' ) !!}
          <hr>
          <p align="center">- HASIL PILIHAN WILAYAH -</p>
        @endif
        <!-- /user_form -->
        <!-- location_pick -->
        <?php
          $sel_prov = BootForm::select( 'Pilih Provinsi:', 'prov_id', $data['location']['provinsi'] )->addClass( 'select2 location_select' );
          $sel_kab  = $data['step'] > 0 ? BootForm::select( 'Pilih Kabupaten/Kota:', 'kab_id', $data['location']['kabupaten'] )->addClass( 'select2 location_select' ) : null;
          $sel_kec  = $data['step'] > 1 ? BootForm::select( 'Pilih Kecamatan:', 'kec_id', $data['location']['kecamatan'] )->addClass( 'select2 location_select' ) : null;
          $sel_kel  = $data['step'] > 2 ? BootForm::select( 'Pilih Desa/Kelurahan:', 'kel_id', $data['location']['kelurahan'] )->addClass( 'select2 location_select' ) : null;
          $sel_rw   = $data['step'] > 3 ? BootForm::text( 'Nomor RW <small style="color:#FF7878">Kosongkan bila tidak perlu</small>', 'rw' )->addClass( 'location_select' )->value( $data['location']['rw'] ) : null;
          $sel_rt   = $data['step'] > 4 ? BootForm::text( 'Nomor RT <small style="color:#FF7878">Kosongkan bila tidak perlu</small>', 'rt' )->addClass( 'location_select' )->value( $data['location']['rt'] ) : null;

          if ( $data['step'] > 0 ) $sel_prov->disabled();
          if ( $data['step'] > 1 && $sel_kab ) $sel_kab->disabled();
          if ( $data['step'] > 2 && $sel_kec ) $sel_kec->disabled();
          if ( $data['step'] > 3 && $sel_kel ) $sel_kel->disabled();
          if ( $data['step'] > 4 && $sel_rw ) $sel_rw->disabled();
          if ( $data['step'] > 5 && $sel_rt ) $sel_rt->disabled();
        ?>
        {!! $sel_prov !!}
        {!! $sel_kab !!}
        {!! $sel_kec !!}
        {!! $sel_kel !!}
        {!! $sel_rw !!}
        {!! $sel_rt !!}
        <!-- /location_pick -->

        <!-- location_pick_button -->
        @if( $data['step'] != 6 )
          <div class="row">
            <div class="col-xs-12">
              {!! Form::submit( 'Lanjut' )->addClass( 'btn btn-primary btn-block btn-flat' ) !!}
            </div>
          </div>
        @endif
        @if( $data['step'] != 0 )
          <div class="row" style="margin-top: 8px">
            <div class="col-xs-12">
              <a href="{!! route( 'pkk.register' ) !!}" class="btn btn-danger btn-block btn-flat">Ulangi pilih Wilayah</a>
            </div>
          </div>
        @endif
        <!-- /location_pick_button -->
      {!! BootForm::close() !!}
      <!-- /registration_form -->
    </div>
  </div>
@endsection
