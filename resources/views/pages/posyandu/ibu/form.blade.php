<div class="box-body">
  {!! BootForm::text( 'Nama Ibu:', 'nama' ) !!}
  {!! BootForm::text( 'No KTP:', 'no_ktp' ) !!}
  {!! BootForm::text( 'Alamat:', 'alamat' ) !!}
  {!! BootForm::text( 'No Telp:', 'telp' ) !!}
  {!! BootForm::text( 'KB:', 'kb' ) !!}
  {!! BootForm::text( 'Tanggal Lahir:', 'tanggal_lahir' )->addClass( 'datepicker3' ) !!}
  {!! BootForm::password( 'Password Mobile:', 'password_mobile' ) !!}
</div>
<div class="box-footer">
  {!! BootForm::submit( 'Simpan data' )->removeClass( 'btn-default' )->addClass( 'btn-primary' ) !!}
</div>
