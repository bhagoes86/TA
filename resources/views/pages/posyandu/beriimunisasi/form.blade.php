<div class="box-body">
  <div class="form-group {{$errors->has('id_imunisasi') ? ' has-error' : ''}}">
	{!! Form::label('Jenis Imunisasi', 'Pilih Jenis Imunisasi:') !!}
	  <select class="special-flexselect form-control" id="id_imunisasi" name="id_imunisasi" tabindex="1">
	    <option  id="id_imunisasi" value=""></option>
	    @foreach($imunisasi as $jenis)
	      @if(isset($beriimunisasi) && $beriimunisasi->id_imunisasi == $jenis->id)
	        <option id="id_imunisasi" value="{!! $jenis->id !!}" selected>{!! $jenis->jenis !!}</option>
	      @else
	        <option id="id_imunisasi" value="{!! $jenis->id !!}">{!! $jenis->jenis !!}</option>
	      @endif
	    @endforeach
	  </select>
	    @if($errors->has('id_imunisasi'))
			<p class="help-block" >
			Kolom jenis imunisasi <b>harus</b> diisi
			</p>
		@endif
  </div>
  {!! BootForm::text( 'Tanggal pemberian imunisasi:', 'tanggal' )->addClass( 'datepicker3' ) !!}
</div>
<div class="box-footer">
  {!! BootForm::submit( 'Simpan data' )->removeClass( 'btn-default' )->addClass( 'btn-primary' ) !!}
</div>
