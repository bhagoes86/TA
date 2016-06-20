<div class="box-body">
 	{!! BootForm::select( 'Pilih Usia Pemberian Kapsul', 'umur' )->options(['' => '',	'6' => '6-11 Bulan', '12' => '12-23 Bulan', '24' => '24-35 Bulan', '36' => '36-47 Bulan', '48' => '48-59 Bulan',]) !!}
	<div class="form-group {{$errors->has('jenis') ? ' has-error' : ''}}">
		{!! Form::label('Pilih Jenis Kapsul: <br><em>Kapsul biru hanya untuk usia 6-11 Bulan</em>') !!}
        <br>
        {!! Form::radio('jenis', 'Kapsul Biru') !!}&nbsp;Kapsul Biru&nbsp;&nbsp;
        {!! Form::radio('jenis', 'Kapsul Merah 1') !!}&nbsp;Kapsul Merah 1&nbsp;&nbsp;
        {!! Form::radio('jenis', 'Kapsul Merah 2') !!}&nbsp;Kapsul Merah 2
		    @if($errors->has('jenis'))
				<p class="help-block" >
					Kolom jenis kapsul <b>harus</b> dipilih
				</p>
			@endif
	  </div>
  {!! BootForm::text( 'Tanggal pemberian kapsul: <br><em>Pemberian di bulan Februari atau Agustus</em>', 'tanggal' )->addClass( 'datepicker3' ) !!}
</div>
<div class="box-footer">
  {!! BootForm::submit( 'Simpan data' )->removeClass( 'btn-default' )->addClass( 'btn-primary' ) !!}
</div>
