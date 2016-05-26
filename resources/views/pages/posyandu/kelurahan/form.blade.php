<div class="box-body ">
  {!! BootForm::text( 'Kode Kelurahan/Desa:', 'kode' ) !!}
  {!! BootForm::text( 'Nama Kelurahan/Desa:', 'nama' ) !!}
</div>
<div class="box-footer">
  {!! BootForm::submit( 'Simpan data' )->removeClass( 'btn-default' )->addClass( 'btn-primary' ) !!}
</div>
