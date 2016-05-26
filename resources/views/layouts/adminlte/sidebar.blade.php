<section class="sidebar">
  <form action="#" method="get" class="sidebar-form">
    <div class="input-group">
      <input type="text" name="q" class="form-control" placeholder="Cari..."></input>
      <span class="input-group-btn">
        <button type="submit" name="search" id="search-btn" class="btn btn-flat">
          <i class="fa fa-search"></i>
        </button>
      </span>
    </div>
  </form>
  <ul class="sidebar-menu">
    <li class="header">Menu Utama</li>
    @yield( 'adminlte-menu-main' )
    <li class="header">Menu Sistem</li>
    @yield( 'adminlte-menu-system' )
  </ul>
</section>
