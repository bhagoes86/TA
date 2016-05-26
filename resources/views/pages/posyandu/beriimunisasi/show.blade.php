@extends('posyandu/show')

@section('cardtitle')
  {{ $beriimunisasi->id_balita }}
@endsection

@section('cardsubtitle')
  No. KTP: {{ $beriimunisasi->id_pos }}
@endsection

@section('cardlist')
  <li class="list-group-item"><strong>Tanggal:</strong> {{ $beriimunisasi->tanggal }}</li>
  <li class="list-group-item"><strong>Jenis Imunisasi:</strong> {{ $beriimunisasi->id_imunisasi }}</li>
@endsection

@section('cardbuttons')
  <a style="width: 100px; margin-bottom: 10px" href="{!! route('posyandu.beriimunisasi.edit',$beriimunisasi->id) !!}" class="btn btn-warning">Perbarui</a>
  {!! Form::open(['method' => 'DELETE', 'route'=>['posyandu.beriimunisasi.destroy', $beriimunisasi->id]]) !!}
    {!! Form::submit('Hapus', ['class' => 'btn btn-danger', 'style' => 'width: 100px']) !!}
  {!! Form::close() !!}
@endsection