@extends('posyandu/form')

@include('layout/combodate')
@include('layout/flexselect')

@section('pageheader')
  Masukkan Data Absen Balita
@endsection

@section('form')
  {!! Form::open(['url' => 'posyandu/absen', 'role' => 'form']) !!}
    @if($Sentinel->permissions)
      <div class="form-group">
        {!! Form::label('id_posyandu', 'Pilih Posyandu:') !!}
        <select class="special-flexselect form-control" id="data-posyandu" name="id_posyandu" tabindex="1">
          <option value=""></option>
          @foreach($posyandu as $data)
              <option value="{!! $data->id !!}">{!! $data->nama !!}, {!! $data->alamat !!}</option>
          @endforeach
        </select>
      </div>
    @else
      <div class="hidden"> 
        {!! Form::text('id_posyandu', $Sentinel->id_posyandu, ['class' => 'form-control']) !!}
      </div>
    @endif

    <div class="form-group">
        {!! Form::label('id_balita', 'Pilih Balita:') !!}
        <select class="special-flexselect form-control" id="data-posyandu" name="id_balita" tabindex="1">
          <option value=""></option>
          @foreach($balita as $databalita)
            @if($Sentinel->permissions)
              <option value="{!! $databalita->id !!}">{!! $databalita->nama !!}</option>
            @else
              @if(isset($databalita) && $databalita->id_posyandu == $Sentinel->id_posyandu)
                <option value="{!! $databalita->id !!}">{!! $databalita->nama !!}</option>
              @endif
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