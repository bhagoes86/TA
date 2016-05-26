<div class="box-body">
	{!! Form::label('Umur Pemberian Kapsul', 'Pilih Usia Kapsul:') !!}
	  <select class="special-flexselect form-control" id="umur" name="umur" tabindex="1">
	    <option value=""></option>
	    <option value="6">6-11 Bulan</option>
	    <option value="12">12-23 Bulan</option>
	    <option value="24">24-35 Bulan</option>
	    <option value="36">36-47 Bulan</option>
	    <option value="48">48-59 Bulan</option>
	  </select>
  	<br>
	{!! BootForm::label( 'Jenis Kapsul:') !!}
  	<br>
        {!! Form::radio('jenis', 'Kapsul Biru') !!}&nbsp;Kapsul Biru&nbsp;&nbsp;
        {!! Form::radio('jenis', 'Kapsul Merah 1') !!}&nbsp;Kapsul Merah 1&nbsp;&nbsp;
        {!! Form::radio('jenis', 'Kapsul Merah 2') !!}&nbsp;Kapsul Merah 2
     <br>
     <br>
  {!! BootForm::text( 'Tanggal pemberian kapsul:', 'tanggal' )->addClass( 'datepicker3' ) !!}
</div>
<div class="box-footer">
  {!! BootForm::submit( 'Simpan data' )->removeClass( 'btn-default' )->addClass( 'btn-primary' ) !!}
</div>
