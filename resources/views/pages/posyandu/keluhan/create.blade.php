@extends('posyandu/form')

@include('layout/datepicker')

@section('pageheader')
  Masukkan Data Keluhan
@endsection

@section('form')
  {!! Form::open(['url' => 'posyandu/keluhan', 'role' => 'form']) !!}
    <div class="form-group">
      {!! Form::label('no_ktp', 'Nomor KTP Ibu:') !!}
      {!! Form::text('no_ktp', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
      {!! Form::label('judul', 'Judul Keluhan:') !!}
      {!! Form::text('judul', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
      {!! Form::label('tanggal', 'Tanggal keluhan:') !!}
      {!! Form::text('tanggal', null, ['class' => 'form-control', 'id' => 'datepicker', 'size' => '30'] ) !!}
    </div>
    <div class="form-group">
      {!! Form::label('isi', 'Isi keluhan:') !!}
      {!! Form::text('isi', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
      {!! Form::submit('Simpan', ['class' => 'btn btn-primary form-control']) !!}
    </div>
  {!! Form::close() !!}
@endsection