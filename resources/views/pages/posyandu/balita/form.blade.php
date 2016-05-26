<div class="box-body">
  {!! BootForm::text( 'Nama Balita:', 'nama' ) !!}
  {!! BootForm::text( 'Tanggal Lahir:', 'tanggal_lahir' )->addClass( 'datepicker3' ) !!}
  {!! BootForm::label( 'Jenis Kelamin:') !!}
  <br>
        {!! Form::radio('jenis_kelamin', 'L') !!}&nbsp;Laki-Laki&nbsp;&nbsp;
        {!! Form::radio('jenis_kelamin', 'P') !!}&nbsp;Perempuan
  <br><br>
  {!! BootForm::text( 'Anak Ke-:', 'anak_ke' ) !!}
  {!! BootForm::text( 'Berat badan (saat lahir):', 'bb_lahir' ) !!}
  {!! BootForm::text( 'Tinggi badan (saat lahir):', 'tb_lahir' ) !!}
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
