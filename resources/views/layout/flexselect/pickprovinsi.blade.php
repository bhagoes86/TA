<div class="form-group">
  {!! Form::label('prov_id', 'Pilih Provinsi:') !!}
  <select class="special-flexselect form-control" id="data-provinsi" name="prov_id" tabindex="1">
    <option value=""></option>
    @foreach($provinsi as $lokasiProvinsi)
    	@if(isset($kabupaten) && $kabupaten->prov_id == $lokasiProvinsi->id)
      		<option value="{!! $lokasiProvinsi->id !!}" selected="">{!! $lokasiProvinsi->nama !!}</option>
    	@else
      		<option value="{!! $lokasiProvinsi->id !!}">{!! $lokasiProvinsi->nama !!}</option>
    	@endif
    @endforeach
  </select>
</div>