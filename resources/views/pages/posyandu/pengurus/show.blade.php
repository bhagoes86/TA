@extends('posyandu/show')

@section('cardtitle')
  {{ $pengurus->nama }}
@endsection

@section('cardsubtitle')
  No. KTP: {{ $pengurus->no_ktp }}
@endsection

@section('cardlist')
  <li class="list-group-item"><strong>Alamat:</strong> {{ $pengurus->alamat }}</li>
  <li class="list-group-item"><strong>No. Telp:</strong> {{ $pengurus->telp }}</li>
@endsection

@section('cardbuttons')
  <a style="width: 100px; margin-bottom: 10px" href="{!! route('posyandu.pengurus.edit',$pengurus->id) !!}" class="btn btn-warning">Perbarui</a>
  {!! Form::open(['method' => 'DELETE', 'route'=>['posyandu.pengurus.destroy', $pengurus->id]]) !!}
    {!! Form::submit('Hapus', ['class' => 'btn btn-danger', 'style' => 'width: 100px']) !!}
  {!! Form::close() !!}
@endsection