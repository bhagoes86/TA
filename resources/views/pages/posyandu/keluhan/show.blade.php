@extends('posyandu/show')

@section('cardtitle')
  {{ $keluhan->nama }}
@endsection

@section('cardsubtitle')
  No. KTP: @include('layout/others/nullvalue', ['data' => $keluhan->no_ktp])
@endsection

@section('cardlist')
  <li class="list-group-item"><strong>Judul Keluhan:</strong> {{ $keluhan->judul }}</li>
  <li class="list-group-item"><strong>Tanggal Keluhan:</strong> {{ $keluhan->tanggal }}</li>
  <li class="list-group-item"><strong>Isi Keluhan:</strong> {{ $keluhan->isi }}</li>
@endsection

@section('cardbuttons')
  {!! Form::open(['method' => 'DELETE', 'route'=>['posyandu.keluhan.destroy', $keluhan->id]]) !!}
    {!! Form::submit('Hapus', ['class' => 'btn btn-danger', 'style' => 'width: 100%']) !!}
  {!! Form::close() !!}
@endsection

@section('bottomcontent')
  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">Komentar</div>
        <div class="panel-body">
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th>Waktu</th>
                  <th>Isi Komentar &amp; Balasan</th>
                  <th>Penulis</th>
                  <th>Hapus</th>
                </tr>
              </thead>
              <tbody>
                @foreach($komentar as $baris)
                  <tr>
                    <td>{!! $baris->created_at !!}</td>
                    <td>{!! $baris->isi !!}</td>
                    <td>
                      @if($baris->user == '1')
                        Pengurus posyandu
                      @else
                        Orang tua balita
                      @endif
                    </td>
                    <td>
                      {!! Form::model($baris, ['method' => 'POST', 'url' => 'posyandu/hapusjawabkeluhan']) !!}
                        {!! Form::hidden('id') !!}
                        {!! Form::submit('Hapus', ['class' => 'btn btn-danger form-control', 'style' => 'margin-top: 5px']) !!}
                      {!! Form::close() !!}
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          {!! Form::model($keluhan, ['method' => 'POST', 'url' => 'posyandu/jawabkeluhan']) !!}
            {!! Form::hidden('id') !!}
            {!! Form::text('komentar', null, ['class' => 'form-control', 'placeholder' => 'Masukkan balasan/komentar baru...']) !!}
            {!! Form::submit('Simpan', ['class' => 'btn btn-primary form-control', 'style' => 'margin-top: 5px']) !!}
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
@endsection