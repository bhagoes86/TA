<div class="box-body">
  {!! BootForm::text( 'Nomor KTP:', 'no_ktp' ) !!}
  {!! BootForm::text( 'Nama Lengkap:', 'nama' ) !!}
  {!! BootForm::text( 'Alamat:', 'alamat' ) !!}
  {!! BootForm::text( 'Nomor Telepon:', 'telp' ) !!}
  <hr>
  <p class="text-muted well well-sm no-shadow">Kata sandi untuk akses aplikasi mobile, kosongkan bila tidak perlu</p>
  {!! BootForm::password( 'Kata sandi:', 'password_mobile' )->addClass( 'pass' ) !!}
  {!! BootForm::password( 'Masukkan ulang kata sandi:', 're_password' )->addClass( 'pass' ) !!}
</div>
<div class="box-footer">
  {!! BootForm::submit( 'Simpan data' )->removeClass( 'btn-default' )->addClass( 'btn-primary' ) !!}
</div>
