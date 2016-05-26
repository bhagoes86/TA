@extends('posyandu/show')

@section('cardtitle')
  Posyandu {{ $posyandu->nama }}
@endsection

@section('cardsubtitle')
  Puskesmas {{ $posyandu->puskesmas }}
@endsection

@section('cardlist')
  <li class="list-group-item"><strong>Alamat:</strong> {{ $posyandu->alamat }}</li>
  <li class="list-group-item"><strong>No. Telp.:</strong> {{ $posyandu->telp }}</li>
  <li class="list-group-item"><strong>RW:</strong> {{ $posyandu->rw }}</li>
  <li class="list-group-item"><strong>Kelurahan / Desa:</strong> {{ $kelurahan->nama }}</li>
  <li class="list-group-item"><strong>Kecamatan:</strong> {{ $kecamatan->nama }}</li>
  <li class="list-group-item"><strong>Kabupaten / Kota:</strong> {{ $kabupaten->nama }}</li>
  <li class="list-group-item"><strong>Provinsi:</strong> {{ $provinsi->nama }}</li>
  <li class="list-group-item"><strong>Username:</strong> {{ $posyandu->username }}</li>
  <li class="list-group-item"><strong>Password Website:</strong> {{ $posyandu->password_website }}</li>
@endsection

@section('cardbuttons')
  <a style="width: 100px; margin-bottom: 10px" href="{!! route('posyandu.data.edit',$posyandu->id) !!}" class="btn btn-warning">Perbarui</a>
  {!! Form::open(['method' => 'DELETE', 'route'=>['posyandu.data.destroy', $posyandu->id]]) !!}
    {!! Form::submit('Hapus', ['class' => 'btn btn-danger', 'style' => 'width: 100px']) !!}
  {!! Form::close() !!}
@endsection