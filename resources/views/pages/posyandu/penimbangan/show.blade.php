@extends('posyandu/show')

@section('cardtitle')
  {{ $penimbangan->nama }}
@endsection

@section('cardsubtitle')
  No. KK: {{ $penimbangan->no_kk }}
@endsection

@section('cardlist')
  <li class="list-group-item"><strong>Umur Saat Penimbangan:</strong> {{ $penimbangan->umur }}</li>
  <li class="list-group-item"><strong>Tanggal Penimbangan:</strong> {{ $penimbangan->tanggal }}</li>
  <li class="list-group-item"><strong>Berat Badan:</strong> {{ $penimbangan->berat }}</li>
  <li class="list-group-item"><strong>Tinggi Badan:</strong> {{ $penimbangan->tinggi }}</li>
  <li class="list-group-item"><strong>Pemberian ASI:</strong> {{ $penimbangan->asi }}</li>
@endsection

@section('cardbuttons')
  <a style="width: 100px; margin-bottom: 10px" href="{!! route('posyandu.penimbangan.edit',$penimbangan->id) !!}" class="btn btn-warning">Perbarui</a>
  {!! Form::open(['method' => 'DELETE', 'route'=>['posyandu.penimbangan.destroy', $penimbangan->id]]) !!}
    {!! Form::submit('Hapus', ['class' => 'btn btn-danger', 'style' => 'width: 100px']) !!}
  {!! Form::close() !!}
@endsection