<?php $default = ['0' => "Tidak memilih anggota PKK"]; ?>
<div class="box-body">
  @if( $data['type'] )
    {!! BootForm::select( 'Pilih anggota PKK <small style="color:#FF7878">Kosongkan bila tidak perlu</small>', 'id_ibu', $default + $data['anggota'] )->addClass( 'select2' ) !!}
    <p class="text-muted well well-sm no-shadow">Anggota tidak terdaftar? Klik <a href="{!! route( 'pkk.ibu.create' ) !!}">di sini</a> untuk menambahkan anggota baru</p>
  @else
    {!! BootForm::hidden( 'id_ibu' )->value( 0 ) !!}
  @endif
  {!! BootForm::select( 'Pilih jenis iuran PKK', 'id_jenis_kas', $data['jeniskas'] )->addClass( 'select2' ) !!}
  <p class="text-muted well well-sm no-shadow">Tidak ada jenis iuran yang sesuai? Klik <a href="{!! route( 'pkk.jeniskas.create', $data['type'] ) !!}">di sini</a> untuk menambahkan jenis iuran baru</p>
  {!! BootForm::text( 'Nominal', 'nominal' ) !!}
</div>
<div class="box-footer">
  {!! BootForm::submit( 'Simpan data' )->removeClass( 'btn-default' )->addClass( 'btn-primary' ) !!}
</div>
