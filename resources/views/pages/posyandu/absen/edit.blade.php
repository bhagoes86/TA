@extends('posyandu/form')

@include('layout/combodate')
@include('layout/flexselect')

@section('pageheader')
  Perbarui Data Absen Balita
@endsection

@section('form')
  {!! Form::model($absen, ['method' => 'PATCH', 'route' => ['posyandu.absen.update', $absen->id]]) !!}
    @if($Sentinel->permissions)
      <div class="form-group">
        {!! Form::label('id_posyandu', 'Pilih Posyandu:') !!}
        <select class="special-flexselect form-control" id="data-posyandu" name="id_posyandu" tabindex="1">
          <option value=""></option>
          @foreach($posyandu as $data)
            @if(isset($absen) && $absen->id_posyandu == $data->id)
              <option value="{!! $data->id !!}" selected>{!! $data->nama !!}, {!! $data->alamat !!}</option>
            @else
              <option value="{!! $data->id !!}">{!! $data->nama !!}, {!! $data->alamat !!}</option>
            @endif
          @endforeach
        </select>
      </div>
    @else
      <div class="hidden"> 
        {!! Form::text('id_posyandu', $Sentinel->id_posyandu, ['class' => 'form-control']) !!}
      </div>
    @endif

    <div class="form-group">
        {!! Form::label('id_balita' , 'Nama Balita:') !!}
          <select class="special-flexselect form-control" id="data-posyandu" name="id_balita" tabindex="1">
            <option value=""></option>
            @foreach($balita as $databalita)
                @if(isset($absen) && $absen->id_posyandu == $databalita->id_posyandu)
                  <option value="{!! $databalita->id !!}" selected>{!! $databalita->nama !!}</option>
                @else
                  <option value="{!! $databalita->id !!}">{!! $databalita->nama !!},</option>
                @endif
            @endforeach
          </select>
      </div>
    <div class="form-group">
      {!! Form::label('tanggal', 'Tanggal Absen:') !!}
      {!! Form::text('tanggal', null, ['id' => 'combodate', 'class' => 'form-control']) !!}
    </div>
    <div class="form-group">
      {!! Form::submit('Simpan', ['class' => 'btn btn-primary form-control']) !!}
    </div>
  {!! Form::close() !!}
@endsection