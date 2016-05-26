<div class="box-body">
  {!! BootForm::text( 'Nama Pengurus:', 'nama' ) !!}
  {!! BootForm::text( 'No KTP:', 'no_ktp' ) !!}
  {!! BootForm::text( 'Alamat:', 'alamat' ) !!}
  {!! BootForm::text( 'No Telp:', 'telp' ) !!}
</div>
<div class="box-footer">
  {!! BootForm::submit( 'Simpan data' )->removeClass( 'btn-default' )->addClass( 'btn-primary' ) !!}
</div>
