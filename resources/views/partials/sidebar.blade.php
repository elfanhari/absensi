<!-- Main Sidebar Container -->
@php
    use App\Models\Ekstrakurikuler;

    $user = Auth::user();

    $admin = Auth::user()->admin;
    $guru = Auth::user()->guru;
    $siswa = Auth::user()->siswa;

@endphp

<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a class="brand-link">
      <img src="/adminlte/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
          class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light d-xs-none text-uppercase">{{ auth()->user()->role }}
      </span>
      <span class="brand-text font-weight-light d-sm-none">Absensi - <span
              style="text-transform: capitalize">{{  auth()->user()->role }}</span>
      </span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
              data-accordion="false">

              <li class="nav-item mt-1">
                  <a href="{{ '/' . $user->role . '/dashboard' }}" class="nav-link {{ Request::is( $user->role . '/dashboard*') ? 'active' : '' }}">
                      <i class="nav-icon fas fa-tachometer-alt"></i>
                      <p>
                          Dashboard
                      </p>
                  </a>
              </li>
              <li class="nav-item mt-1">
                  <a href="{{ '/' . $user->role . '/datasiswa' }}" class="nav-link {{ Request::is( $user->role . '/datasiswa*') ? 'active' : '' }}">
                      <i class="fas fa-circle nav-icon "></i>
                      <p>
                          Data Siswa
                      </p>
                  </a>
              </li>
              <li class="nav-item mt-1">
                  <a href="{{ '/' . $user->role . '/dataguru' }}" class="nav-link {{ Request::is( $user->role . '/dataguru*') ? 'active' : '' }}">
                      <i class="fas fa-circle nav-icon "></i>
                      <p>
                          Data Guru
                      </p>
                  </a>
              </li>
              <li class="nav-item mt-1">
                  <a href="{{ '/' . $user->role . '/dataadmin' }}" class="nav-link {{ Request::is( $user->role . '/dataadmin*') ? 'active' : '' }}">
                      <i class="fas fa-circle nav-icon "></i>
                      <p>
                          Data Admin
                      </p>
                  </a>
              </li>
              <li class="nav-item mt-1">
                  <a href="{{ '/' . $user->role . '/datakelas' }}" class="nav-link {{ Request::is( $user->role . '/datakelas*') ? 'active' : '' }}">
                      <i class="fas fa-circle nav-icon "></i>
                      <p>
                          Data Kelas
                      </p>
                  </a>
              </li>
              <li class="nav-item mt-1">
                  <a href="{{ '/' . $user->role . '/datasekolah' }}" class="nav-link {{ Request::is( $user->role . '/datasekolah*') ? 'active' : '' }}">
                      <i class="fas fa-circle nav-icon "></i>
                      <p>
                          Data Sekolah
                      </p>
                  </a>
              </li>
              <li class="nav-item mt-1">
                  <a href="{{ '/' . $user->role . '/datatapel' }}" class="nav-link {{ Request::is( $user->role . '/datatapel*') ? 'active' : '' }}">
                      <i class="fas fa-circle nav-icon "></i>
                      <p>
                          Data Tapel
                      </p>
                  </a>
              </li>
              <li class="nav-item mt-1">
                  <a href="{{ '/' . $user->role . '/datamapel' }}" class="nav-link {{ Request::is( $user->role . '/datamapel*') ? 'active' : '' }}">
                      <i class="fas fa-circle nav-icon "></i>
                      <p>
                          Data Mapel
                      </p>
                  </a>
              </li>
              <li class="nav-item mt-1">
                  <a href="{{ '/' . $user->role . '/datapembelajaran' }}" class="nav-link {{ Request::is( $user->role . '/datapembelajaran*') ? 'active' : '' }}">
                      <i class="fas fa-circle nav-icon "></i>
                      <p>
                          Data Pembelajaran
                      </p>
                  </a>
              </li>
              <li class="nav-item mt-1">
                  <a href="{{ '/' . $user->role . '/absensi' }}" class="nav-link {{ Request::is( $user->role . '/absensi*') ? 'active' : '' }}">
                      <i class="fas fa-circle nav-icon "></i>
                      <p>
                          Absensi
                      </p>
                  </a>
              </li>

              <li class="nav-header mt-2 fw-bold">SAYA</li>
              <li class="nav-item mb-3">
                  <a href="{{ '/' . $user->role . '/profil' }}" class="nav-link {{ Request::is( $user->role . '/profil*') ? 'active' : '' }}">
                      <i class="nav-icon fas fa-user"></i>
                      <p>Profil</p>
                  </a>
              </li>

          </ul>
      </nav>
      <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
