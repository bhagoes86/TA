<div class="box-body">
  {!! BootForm::text( 'Nama Puskesmas:', 'puskesmas' ) !!}
  {!! BootForm::text( 'Nama Posyandu:', 'nama' ) !!}
  {!! BootForm::text( 'Alamat Posyandu:', 'alamat' ) !!}
  {!! BootForm::text( 'No. Telp Posyandu:', 'telp' ) !!}
  {!! BootForm::text( 'No. RW:', 'rw' ) !!}
</div>
<div class="box-footer">
  {!! BootForm::submit( 'Simpan data' )->removeClass( 'btn-default' )->addClass( 'btn-primary' ) !!}
</div>
