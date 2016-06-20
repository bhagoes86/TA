<div class="box-body">
  {!! BootForm::text( 'Nama Balita:', 'nama' ) !!}
  {!! BootForm::text( 'Tanggal Lahir:', 'tanggal_lahir' )->addClass( 'datepicker3' ) !!}
  {!! BootForm::select( 'Jenis Kelamin', 'jenis_kelamin' )->options(['' => '','L' => 'Laki-laki' , 'P' => 'Perempuan']) !!}
  {!! BootForm::text( 'Anak Ke-:', 'anak_ke' ) !!}
  {!! BootForm::text( 'Berat badan (saat lahir):<br><em>Gunakan titik (.) bila angka desimal (2 angka dibelakang koma)</em>', 'bb_lahir' ) !!}
  {!! BootForm::text( 'Tinggi badan (saat lahir):<br><em>Gunakan titik (.) bila angka desimal (2 angka dibelakang koma)</em>', 'tb_lahir' ) !!}
  {!! BootForm::text( 'Nama ayah:', 'nama_ayah' ) !!}
  {!! BootForm::text( 'Pekerjaan ayah:', 'pekerjaan_ayah' ) !!}
  {!! BootForm::text( 'Pekerjaan ibu:', 'pekerjaan_ibu' ) !!}
  {!! BootForm::label( 'ASI (Pemberian usia 0-6 bulan):') !!}
  <br>
        {!! Form::radio('asi', 'Yes') !!}&nbsp;Ya&nbsp;&nbsp;
        {!! Form::radio('asi', 'No') !!}&nbsp;Tidak
</div>
<div class="box-footer">
  {!! BootForm::submit( 'Simpan data' )->removeClass( 'btn-default' )->addClass( 'btn-primary' ) !!}
</div>
