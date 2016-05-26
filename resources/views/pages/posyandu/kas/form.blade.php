<div class="box-body">
	{!! BootForm::label( 'Jenis Kas:') !!}
  	<br>
        {!! Form::radio('id_jenis', '1') !!}&nbsp;Pemasukan&nbsp;&nbsp;
        {!! Form::radio('id_jenis', '2') !!}&nbsp;Pengeluaran
  	<br>
  	<br>
	{!! BootForm::text( 'Tanggal Kas:', 'tanggal' )->addClass( 'datepicker3' ) !!}
	{!! BootForm::text( 'Nominal:', 'nominal' ) !!}
	{!! BootForm::text( 'Keterangan:', 'keterangan' ) !!}
</div>
<div class="box-footer">
  {!! BootForm::submit( 'Simpan data' )->removeClass( 'btn-default' )->addClass( 'btn-primary' ) !!}
</div>
