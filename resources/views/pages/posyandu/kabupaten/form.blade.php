<div class="box-body">
  {!! BootForm::text( 'Kode Kabupaten:', 'kode' ) !!}
  {!! BootForm::text( 'Nama Kabupaten:', 'nama' ) !!}
</div>
<div class="box-footer">
  {!! BootForm::submit( 'Simpan data' )->removeClass( 'btn-default' )->addClass( 'btn-primary' ) !!}
</div>
