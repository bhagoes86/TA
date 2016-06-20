<div class="box-body">
  {!! BootForm::select( 'Jenis Kas:', 'id_jenis' )->options(['' => '','1' => 'Pemasukan' , '2' => 'Pengeluaran']) !!}
	{!! BootForm::text( 'Tanggal Kas:', 'tanggal' )->addClass( 'datepicker3' ) !!}
	{!! BootForm::text( 'Nominal:', 'nominal' ) !!}
	{!! BootForm::text( 'Keterangan:', 'keterangan' ) !!}
</div>
<div class="box-footer">
  {!! BootForm::submit( 'Simpan data' )->removeClass( 'btn-default' )->addClass( 'btn-primary' ) !!}
</div>
