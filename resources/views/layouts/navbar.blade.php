<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ URL::to('/') }}" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-user"></i>
        </a>
        <div class="dropdown-menu dropdown-menu dropdown-menu-right">
          <a href="{{ route('logout') }}" class="dropdown-item">
            <!-- Message Start -->
            {{-- <div class="media"> --}}
              {{-- <div class="media-body"> --}}
                <h3 class="dropdown-item-title">
                  <i class="nav-icon fas fa-sign-out-alt"></i>
                  Logout
                </h3>
              {{-- </div> --}}
            {{-- </div> --}}
            <!-- Message End -->
          </a>
          
      </li>
      
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>