<div class="box-body">
	{!! Form::label('Jenis Imunisasi', 'Pilih Jenis Imunisasi:') !!}
	  <select class="special-flexselect form-control" id="imunisasi" name="id_imunisasi" tabindex="1">
	    <option value=""></option>
	    @foreach($imunisasi as $jenis)
	      @if(isset($beriimunisasi) && $beriimunisasi->id_imunisasi == $jenis->id)
	        <option value="{!! $jenis->id !!}" selected>{!! $jenis->jenis !!}</option>
	      @else
	        <option value="{!! $jenis->id !!}">{!! $jenis->jenis !!}</option>
	      @endif
	    @endforeach
	  </select>
  {!! BootForm::text( 'Tanggal penimbangan:', 'tanggal' )->addClass( 'datepicker3' ) !!}
</div>
<div class="box-footer">
  {!! BootForm::submit( 'Simpan data' )->removeClass( 'btn-default' )->addClass( 'btn-primary' ) !!}
</div>
