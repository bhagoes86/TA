<div class="box-body">
  {!! BootForm::text( 'Nama Jabatan:', 'nama' ) !!}
  {!! BootForm::textarea( 'Deskripsi:', 'deskripsi' ) !!}
</div>
<div class="box-footer">
  {!! BootForm::submit( 'Simpan data' )->removeClass( 'btn-default' )->addClass( 'btn-primary' ) !!}
</div>
