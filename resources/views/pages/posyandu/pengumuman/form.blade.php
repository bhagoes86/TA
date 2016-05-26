<div class="box-body ">
  {!! BootForm::text( 'Judul Pengumuman:', 'judul' ) !!}
  {!! BootForm::text( 'Isi Pengumuman:', 'isi' ) !!}
  {!! BootForm::text( 'Tautan:', 'link' ) !!}
</div>
<div class="box-footer">
  {!! BootForm::submit( 'Simpan data' )->removeClass( 'btn-default' )->addClass( 'btn-primary' ) !!}
</div>
