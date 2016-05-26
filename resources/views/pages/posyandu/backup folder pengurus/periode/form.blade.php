<div class="box-body">
  {!! BootForm::text( 'Tahun Mulai:', 'tahun_mulai' ) !!}
  {!! BootForm::text( 'Tahun Selesai:', 'tahun_selesai' ) !!}
</div>
<div class="box-footer">
  {!! BootForm::submit( 'Simpan data' )->removeClass( 'btn-default' )->addClass( 'btn-primary' ) !!}
</div>
