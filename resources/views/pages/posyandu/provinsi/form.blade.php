<div class="box-body">
  {!! BootForm::text( 'Kode Provinsi:', 'kode' ) !!}
  {!! BootForm::text( 'Nama Provinsi:', 'nama' ) !!}
</div>
<div class="box-footer">
  {!! BootForm::submit( 'Simpan data' )->removeClass( 'btn-default' )->addClass( 'btn-primary' ) !!}
</div>
