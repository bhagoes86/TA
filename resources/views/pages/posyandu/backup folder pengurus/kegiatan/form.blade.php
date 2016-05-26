<div class="box-body">
  {!! BootForm::text( 'Nama Kegiatan:', 'nama' ) !!}
  {!! BootForm::text( 'Tanggal:', 'tanggal' )->addClass( 'datepicker3' ) !!}
</div>
<div class="box-footer">
  {!! BootForm::submit( 'Simpan data' )->removeClass( 'btn-default' )->addClass( 'btn-primary' ) !!}
</div>
