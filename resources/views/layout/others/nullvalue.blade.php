@if($data == "" || $data == "0000-00-00")
  <em style="font-weight: lighter; color: red">kosong</em>
@else
  {{ $data }}
@endif