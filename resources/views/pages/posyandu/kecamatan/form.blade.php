<div class="box-body ">
  {!! BootForm::text( 'Kode Kecamtan:', 'kode' ) !!}
  {!! BootForm::text( 'Nama Kecamatan:', 'nama' ) !!}
</div>
<div class="box-footer">
  {!! BootForm::submit( 'Simpan data' )->removeClass( 'btn-default' )->addClass( 'btn-primary' ) !!}
</div>
