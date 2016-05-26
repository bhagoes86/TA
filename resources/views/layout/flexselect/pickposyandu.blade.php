<div class="form-group">
  {!! Form::label('id_posyandu', 'Pilih Posyandu:') !!}
  <select class="special-flexselect form-control" id="data-posyandu" name="id_pos" tabindex="1">
    <option value=""></option>
    @foreach($posyandu as $data)
      @if((isset($penimbangan) && $penimbangan->id_pos == $data->id) ||
          (isset($beriimunisasi) && $beriimunisasi->id_pos == $data->id) ||
          (isset($kas) && $kas->id_pos == $data->id) ||
          (isset($pengurus) && $pengurus->id_pos == $data->id) ||
          (isset($absen) && $absen->id_pos == $data->id) ||
          (isset($pengumuman) && $pengumuman->id_posyandu == $data->id))
        <option value="{!! $data->id !!}" selected>{!! $data->nama !!}, {!! $data->alamat !!}, {!! $data->kecamatan !!}</option>
      @else
        <option value="{!! $data->id !!}">{!! $data->nama !!}, {!! $data->alamat !!}, {!! $data->kecamatan !!}</option>
      @endif
    @endforeach
  </select>
</div>