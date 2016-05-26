<header class="main-header">
  <a href="#" class="logo">
    <span class="logo-mini">@yield( 'adminlte-logo-mini' )</span>
    <span class="logo-lg">@yield( 'adminlte-logo-lg' )</span>
  </a>
  <nav class="navbar navbar-static-top" role="navigation">
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <li class="dropdown user user-menu">
          <a href="@yield( 'adminlte-user-route' )">
            <span class="hidden-xs">Anda masuk sebagai&nbsp;&nbsp;<strong>@yield( 'adminlte-user' )</strong></span>
          </a>
        </li>
      </ul>
    </div>
  </nav>
</header>
