<div class="box-body">
  {!! BootForm::select( 'Pilih anggota PKK:', 'id_ibu', $data['anggota'] )->addClass( 'select2' ) !!}
  <p class="text-muted well well-sm no-shadow">Anggota tidak terdaftar? Klik <a href="{!! route( 'pkk.ibu.create' ) !!}">di sini</a> untuk menambahkan anggota baru</p>
  {!! BootForm::select( 'Pilih periode kepengurusan:', 'id_periode', $data['periode'] )->addClass( 'select2' ) !!}
  <p class="text-muted well well-sm no-shadow">Periode kepengurusan tidak terdaftar? Klik <a href="{!! route( 'pkk.periode.create' ) !!}">di sini</a> untuk menambahkan periode kepengurusan baru</p>
  {!! BootForm::select( 'Pilih jabatan:', 'id_jabatan', $data['jabatan'] )->addClass( 'select2' ) !!}
  <p class="text-muted well well-sm no-shadow">Jabatan kepengurusan tidak terdaftar? Klik <a href="{!! route( 'pkk.periode.create' ) !!}">di sini</a> untuk menambahkan jabatan kepengurusan baru</p>
</div>
<div class="box-footer">
  {!! BootForm::submit( 'Simpan data' )->removeClass( 'btn-default' )->addClass( 'btn-primary' ) !!}
</div>
