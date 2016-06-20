<div class="box-body">
    <div class="form-group {{$errors->has('id_balita') ? ' has-error' : ''}}">
      {!! Form::label('Pilih balita:') !!}
        <select class="special-flexselect form-control " id="id_balita" name="id_balita" tabindex="1">
          <option  id="id_balita" value=""></option>
          @foreach($balita as $databalita)
            @if(isset($absen) && $absen->id_balita == $databalita->id )
              <option id="id_balita" value="{!! $databalita->id !!}"  selected=>{!! $databalita->nama !!}</option>
            @else
              <option id="id_balita" value="{!! $databalita->id !!}">{!! $databalita->nama !!}</option>
            @endif
          @endforeach
        </select>
        @if ($errors->has('id_balita'))
          <p class="help-block" >
            <!-- {{$errors->first('id_balita')}} -->
            Kolom nama balita <b>harus diisi</b>
          </p>
        @endif
      </div>
    {!! BootForm::text( 'Tanggal absen:', 'tanggal' )->addClass( 'datepicker3' ) !!}
    {!! BootForm::submit( 'Simpan data' )->removeClass( 'btn-default' )->addClass( 'btn-primary' ) !!}
</div>