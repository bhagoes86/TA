<table class="table table-bordered table-striped dataTable">
  <thead>
    <tr>
      <th class="col-xs-1">No</th>
      @if( !$admin )
        <th>Lokasi PKK</th>
      @endif
      <th>Username</th>
      <th>Terakhir login</th>
      <th class="col-xs-2">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php $a = 0; ?>
    @foreach( ( $admin ? $data['admin'] : $data['content'] ) as $row )
      <tr>
        <td>{!! ++$a !!}</td>
        @if( !$admin )
          <td>
            {!! $row->pkk->provinsi->nama !!}{!! $row->pkk->kabupaten_kota ? ', '.$row->pkk->kabupaten_kota->nama : null !!}{!! $row->pkk->kecamatan ? ', '.$row->pkk->kecamatan->nama : null !!}{!! $row->pkk->desa_kelurahan ? ', '.$row->pkk->desa_kelurahan->nama : null !!}{!! $row->pkk->rw ? ', RW '.sprintf( "%02d", $row->pkk->rw ) : null !!}{!! $row->pkk->rt ? ', RT '.sprintf( "%02d", $row->pkk->rt ) : null !!}
          </td>
        @endif
        <td>{!! $row->username !!}</td>
        <td>{!! $row->last_login !!}</td>
        <td>
          <div class="btn-group btn-group-justified">
            <div class="btn-group" role="group">
              <a href="{!! route( 'pkk.admin.edit', $row->id ) !!}" class="btn btn-warning">
                <i class="fa fa-pencil-square-o"></i>
                <span class="btn-title">&nbsp;Ubah</span>
              </a>
            </div>
            <div class="btn-group" role="group">
              <a href="javascript:void(0);" onclick="deleteModal(this)" data-href="{!! route( 'pkk.admin.delete', $row->id ) !!}" class="btn btn-danger">
                <i class="fa fa-trash-o"></i>
                <span class="btn-title">&nbsp;Hapus</span>
              </a>
            </div>
          </div>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
