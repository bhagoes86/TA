<div class="form-group">
  {!! Form::label('id_ibu', 'Pilih Ibu Balita:') !!}
  <select class="special-flexselect form-control" id="ibu-balita" name="id_ibu" tabindex="1">
    <option value=""></option>
    @foreach($ibu as $ibubalita)
      @if((isset($balita) && $balita->id_ibu == $ibubalita->id) ||
          (isset($users) && $users->no_ktp == $ibubalita->no_ktp))
        <option value="{!! $ibubalita->id !!}" selected>{!! $ibubalita->no_ktp !!} - {!! $ibubalita->nama !!}</option>
      @else
        <option value="{!! $ibubalita->id !!}">{!! $ibubalita->no_ktp !!} - {!! $ibubalita->nama !!}</option>
      @endif
    @endforeach
  </select>
</div>