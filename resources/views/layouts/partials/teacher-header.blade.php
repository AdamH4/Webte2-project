<header class="c-header c-header-light c-header-fixed c-header-with-subheader">
    <button class="c-header-toggler c-class-toggler d-lg-none mfe-auto" type="button" data-target="#sidebar" data-class="c-sidebar-show">
      <svg class="c-icon c-icon-lg">
        <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-menu"></use>
      </svg>
    </button><a class="c-header-brand d-lg-none" href="#">
      <svg width="118" height="46" alt="CoreUI Logo">
        <use xlink:href="assets/brand/coreui.svg#full"></use>
      </svg></a>
    <button class="c-header-toggler c-class-toggler mfs-3 d-md-down-none" type="button" data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true">
      <svg class="c-icon c-icon-lg">
        <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-menu"></use>
      </svg>
    </button>
    <ul class="c-header-nav d-md-down-none">
      <li class="c-header-nav-item px-3"><a class="c-header-nav-link" href="#">Bla</a></li>
      <li class="c-header-nav-item px-3"><a class="c-header-nav-link" href="#">Bla</a></li>
      <li class="c-header-nav-item px-3"><a class="c-header-nav-link" href="#">Bla</a></li>
    </ul>
    <ul class="c-header-nav ml-auto mr-4">
      <li class="c-header-nav-item d-md-down-none mx-2"><a class="c-header-nav-link" href="#"></a></li>
      <li class="c-header-nav-item d-md-down-none mx-2"><a class="c-header-nav-link" href="#">
          <svg class="c-icon">
            <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-list-rich"></use>
          </svg></a></li>
      <li class="c-header-nav-item d-md-down-none mx-2"><a class="c-header-nav-link" href="#">
          <svg class="c-icon">
            <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-envelope-open"></use>
          </svg></a></li>
      <li class="c-header-nav-item dropdown"><a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
          <div class="c-avatar">
              {{ auth()->user() ? auth()->user()->name : "adam testuje" }}
            </div>
        </a>
        <div class="dropdown-menu dropdown-menu-right pt-0">
          <div class="dropdown-header bg-light py-2"><strong>Účet</strong></div>
          <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Odhlásiť sa
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
        </div>
      </li>
    </ul>
    <div class="c-subheader px-3">
      <!-- Breadcrumb-->
      <ol class="breadcrumb border-0 bg-white m-0">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="#">Admin</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
        <!-- Breadcrumb Menu-->
      </ol>
    </div>
  </header>
