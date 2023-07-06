<nav class="main-header navbar navbar-expand navbar-white navbar-light poppins tracking-tight">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
      <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                  class="fas fa-bars"></i></a>
      </li>

      <li class="nav-item">
          <p class="mb-0 mt-2 fw-bold d-xs-none">Absensi MA Sumber Payung</p>
      </li>
  </ul>

  <ul class="navbar-nav ml-auto">
    <li class="nav-item">
      <div id="dropdownSubMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span
        class="d-xs-none p-2 fw-bold mt-1">{{ $userLogin->name }}</span>
    <span
        class="d-sm-none p-1 fw-bold mt-1">{{ Str::before($userLogin->name, ' ') }}</span>
    <img src="/img/{{ auth()->user()->foto }}" style="width: 35px; height: 35px; object-fit: cover;" class="img-circle elevation-1"
        alt="User Image">
      </div>
      <ul class="dropdown-menu dropdown-menu-right">
        <li>
          <a href="/{{auth()->user()->role}}/profil" class="dropdown-item" >Profil</a>
        </li>
        <li>
            <hr class="dropdown-divider">
        </li>
        <li><button class="dropdown-item" type="button" data-bs-toggle="modal"
                data-bs-target="#modal-logout">Logout</button></li>
      </ul>
    </li>
  </ul>

</nav>
