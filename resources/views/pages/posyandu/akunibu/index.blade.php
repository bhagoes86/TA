@extends( 'pages.posyandu.template' )

@section( 'custom-css' )
  @include( 'layouts.datatables.head' )
@endsection

@section( 'custom-footer' )
  @include( 'layouts.datatables.foot' )
@endsection

@section( 'main-container-header-title', "Daftar Akun Ibu" )

@section( 'main-container-breadcrumb' )
  <li><a href="{!! route( 'posyandu' ) !!}"><i class="fa fa-dashboard"></i> Menu Utama</a></li>
  <li class="active">Profil Posyandu</li>
@endsection

@section( 'main-content')
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">
              Detail Profil Posyandu&nbsp;&nbsp;&nbsp;
            </h3>
          </div>
          <div class="box-body">
            <table class="table table-bordered table-striped dataTable">
              <thead>
                <tr>
                  <th class="col-xs-1">No</th>
                  <th>Nama Ibu</th>
                  <th>Telp</th>
                  <th>Password</th>
                  <th class="col-xs-4">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $a = 0; ?>
                @if(Auth::user()->id == '1')
                  @foreach($ibu as $dataibu)
                    <tr>
                      <td>{!! ++$a !!}</td>
                      <td>{!! $dataibu->nama !!}</td>
                      <td>{!! $dataibu->telp !!}</td>
                      <td>{!! $dataibu->password_mobile !!}</td>
                      <td>
                        <div class="btn-group btn-group-justified">
                          <div class="btn-group" role="group">
                            <a href="{!! route( 'posyandu.ibu.edit', $dataibu->id ) !!}" class="btn btn-warning">
                              <i class="fa fa-pencil-square-o"></i>
                              &nbsp;Ubah
                            </a>
                          </div>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                @else
                  @foreach($ibu as $dataibu)
                    @if(isset($dataibu) && $dataibu->id_posyandu == Auth::user()->id_posyandu)
                    <tr>
                      <td>{!! ++$a !!}</td>
                      <td>{!! $dataibu->nama !!}</td>
                      <td>{!! $dataibu->telp !!}</td>
                      <td>{!! $dataibu->password_mobile !!}</td>
                      <td>
                        <div class="btn-group btn-group-justified">
                          <div class="btn-group" role="group">
                            <a href="{!! route( 'posyandu.ibu.edit', $dataibu->id ) !!}" class="btn btn-warning">
                              <i class="fa fa-pencil-square-o"></i>
                              &nbsp;Ubah
                            </a>
                          </div>
                        </div>
                      </td>
                    </tr>
                    @endif
                  @endforeach
                @endif
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  @include( 'layouts.scripts.delete-modal' )
@endsection