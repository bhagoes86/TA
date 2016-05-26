<div class="box-body">
  {!! BootForm::text( 'Username:', 'username' ) !!}
  {!! BootForm::password( 'Kata sandi:', 'password' ) !!}
  {!! BootForm::password( 'Masukkan ulang kata sandi:', 're_password' ) !!}
</div>
<div class="box-footer">
  {!! BootForm::submit( 'Simpan data' )->removeClass( 'btn-default' )->addClass( 'btn-primary' ) !!}
</div>
