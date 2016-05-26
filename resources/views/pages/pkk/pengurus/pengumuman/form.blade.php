<div class="box-body">
  {!! BootForm::text( 'Judul pengumuman:', 'judul' ) !!}
  {!! BootForm::textarea( 'Isi pengumuman:', 'isi' ) !!}
  {!! BootForm::text( 'Tautan:', 'link' ) !!}
</div>
<div class="box-footer">
  {!! BootForm::submit( 'Simpan data' )->removeClass( 'btn-default' )->addClass( 'btn-primary' ) !!}
</div>
