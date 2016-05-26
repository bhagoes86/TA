@extends('posyandu/show')

@section('cardtitle')
  {{ $kapsul->id_balita }}
@endsection

@section('cardsubtitle')
  No. KTP: {{ $kapsul->id_pos }}
@endsection

@section('cardlist')
  <li class="list-group-item"><strong>Tanggal Pemberian Kapsul:</strong> {{ $kapsul->tanggal }}</li>
  <li class="list-group-item"><strong>Umur Pemberian Kapsul:</strong> {{ $kapsul->umur }}</li>
  <li class="list-group-item"><strong>Jenis Kapsul:</strong> {{ $kapsul->jenis }}</li>
@endsection

@section('cardbuttons')
  <a style="width: 100px; margin-bottom: 10px" href="{!! route('posyandu.kapsul.edit',$kapsul->id) !!}" class="btn btn-warning">Perbarui</a>
  {!! Form::open(['method' => 'DELETE', 'route'=>['posyandu.kapsul.destroy', $kapsul->id]]) !!}
    {!! Form::submit('Hapus', ['class' => 'btn btn-danger', 'style' => 'width: 100px']) !!}
  {!! Form::close() !!}
@endsection