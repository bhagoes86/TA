<div class="box-body">
  {!! BootForm::text( 'Nama Jenis Imunisasi:', 'jenis' ) !!}
  {!! BootForm::text( 'Umur Pemberian Imunisasi:', 'umur' ) !!}
</div>
<div class="box-footer">
  {!! BootForm::submit( 'Simpan data' )->removeClass( 'btn-default' )->addClass( 'btn-primary' ) !!}
</div>
