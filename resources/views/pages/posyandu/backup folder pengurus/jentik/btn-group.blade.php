<div class="btn-group btn-group-justified">
  <div class="btn-group" role="group">
    <a href="{!! route( 'pkk.jentik.edit', [$month, $data['request']['id_ibu'], $data['request']['year']] ) !!}" class="btn btn-warning">
      <i class="fa fa-pencil-square-o"></i>
      <span class="btn-title">&nbsp;Ubah</span>
    </a>
  </div>
  <div class="btn-group" role="group">
    <a href="javascript:void(0);" onclick="deleteModal(this)" data-href="{!! route( 'pkk.jentik.delete', [$month, $data['request']['id_ibu'], $data['request']['year']] ) !!}" class="btn btn-danger">
      <i class="fa fa-trash-o"></i>
      <span class="btn-title">&nbsp;Hapus</span>
    </a>
  </div>
</div>
