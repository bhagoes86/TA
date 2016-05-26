<div class="box-body">
  {!! BootForm::text( 'Umur saat penimbangan:', 'umur' ) !!}
  <!-- {!! BootForm::text( 'Tanggal penimbangan:', 'tanggal_lahir' )->addClass( 'datepicker3' ) !!} -->
  {!! BootForm::text( 'Berat badan:', 'berat' ) !!}
  {!! BootForm::text( 'Tinggi badan:', 'tinggi' ) !!}
  {!! BootForm::label( 'ASI (Pemberian usia 0-6 bulan):') !!}
  <br>
        {!! Form::radio('asi', 'Yes') !!}&nbsp;Ya&nbsp;&nbsp;
        {!! Form::radio('asi', 'No') !!}&nbsp;Tidak
</div>
<div class="box-footer">
  {!! BootForm::submit( 'Simpan data' )->removeClass( 'btn-default' )->addClass( 'btn-primary' ) !!}
</div>
