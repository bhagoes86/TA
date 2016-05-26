@extends('posyandu/mainpage')

@section('pageheader')
  Daftar Absen Balita
@endsection

@section('tableheader')
  <th>Nama Balita</th>
  @if($Sentinel->permissions)
  <th>Posyandu</th>
  @endif
  <th>Tanggal</th>
  <th>Perbarui</th>
  <th>Hapus</th>
@endsection

@section('tablebody')
@if($Sentinel->permissions)
  @foreach($absen as $absenbalita)
    <tr>
      <td>{!! $absenbalita->nama_balita !!}</td>
      <td>{!! $absenbalita->nama_posyandu !!}</td>
      <td>{!! $absenbalita->tanggal !!}</td>
      <td><a href="{!! route('posyandu.absen.edit',$absenbalita->id) !!}" class="btn btn-warning">Perbarui</a></td>
      <td>
        {!! Form::open(['method' => 'DELETE', 'route'=>['posyandu.absen.destroy', $absenbalita->id]]) !!}
          {!! Form::submit('Hapus', ['class' => 'btn btn-danger']) !!}
        {!! Form::close() !!}
      </td>
    </tr>
  @endforeach
@else
  @foreach($absen as $absenbalita)
    @if(isset($absenbalita) && $absenbalita->id_posyandu == $Sentinel->id_posyandu)
      <tr>
        <td>{!! $absenbalita->nama_balita !!}</td>
        <td>{!! $absenbalita->tanggal !!}</td>
        <td><a href="{!! route('posyandu.absen.edit',$absenbalita->id) !!}" class="btn btn-warning">Perbarui</a></td>
        <td>
          {!! Form::open(['method' => 'DELETE', 'route'=>['posyandu.absen.destroy', $absenbalita->id]]) !!}
            {!! Form::submit('Hapus', ['class' => 'btn btn-danger']) !!}
          {!! Form::close() !!}
        </td>
      </tr>
    @endif
  @endforeach
@endif
@endsection
