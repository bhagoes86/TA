<div class="form-group">
  {!! Form::label('id_imunisasi', 'Pilih Jenis Imunisasi:') !!}
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
</div>