@extends('posyandu/show')

@section('cardtitle')
  {{ $kas->nama_pos }}
@endsection

@section('cardsubtitle')
  @include('layout/others/jeniskasdeterminer', ['data' => $kas->jenis_kas])
@endsection

@section('cardlist')
  <li class="list-group-item"><strong>Kategori Kas:</strong> {{ $kas->nama_jenis }}</li>
  <li class="list-group-item"><strong>Tanggal:</strong> {{ $kas->tanggal }}</li>
  <li class="list-group-item"><strong>Nominal:</strong> {{ $kas->nominal }}</li>
  <li class="list-group-item"><strong>Keterangan:</strong> {{ $kas->keterangan }}</li>
@endsection

@section('cardbuttons')
  <a style="width: 100px; margin-bottom: 10px" href="{!! route('posyandu.kas.edit',$kas->id) !!}" class="btn btn-warning">Perbarui</a>
  {!! Form::open(['method' => 'DELETE', 'route'=>['posyandu.kas.destroy', $kas->id]]) !!}
    {!! Form::submit('Hapus', ['class' => 'btn btn-danger', 'style' => 'width: 100px']) !!}
  {!! Form::close() !!}
@endsection