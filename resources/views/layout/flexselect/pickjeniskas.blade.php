<div class="form-group">
  {!! Form::label('id_jenis', 'Pilih Jenis Kas:') !!}
  <select class="special-flexselect form-control" id="jenis_kas" name="id_jenis" tabindex="1">
    <option value=""></option>
    @foreach($jeniskas as $jenis)
      @if(isset($kas) && $kas->id_jenis == $jenis->id)
        <option value="{!! $jenis->id !!}" selected>{!! $jenis->nama !!}</option>
      @else
        <option value="{!! $jenis->id !!}">{!! $jenis->nama !!}</option>
      @endif
    @endforeach
  </select>
  <!-- <a href="{!! route('posyandu.jeniskas.create') !!}" style="margin-top: 5px" class="btn btn-primary">Tambah Jenis Kas Baru</a> -->
</div>