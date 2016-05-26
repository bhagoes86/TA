<div class="form-group">
  {!! Form::label('id_balita', 'Pilih Anak:') !!}
  <select class="special-flexselect form-control" id="balita" name="id_balita" tabindex="1">
    <option value=""></option>
    @foreach($balita as $anak)
      @if((isset($beriimunisasi) && $beriimunisasi->id_balita == $anak->id) ||
          (isset($absen) && $absen->id_balita == $anak->id))
        <option value="{!! $anak->id !!}" selected>{!! $anak->no_kk !!} - {!! $anak->nama !!}</option>
      @else
        <option value="{!! $anak->id !!}">{!! $anak->no_kk !!} - {!! $anak->nama !!}</option>
      @endif
    @endforeach
  </select>
</div>