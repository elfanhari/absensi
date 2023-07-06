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

             @if (auth()->user()->role == 'admin' || auth()->user()->role == 'guru')

              <li class="nav-header fw-bold mt-2">MASTER DATA</li>

              <li class="nav-item
                {{ Request::is( $user->role . '/datasiswa*') |
                   Request::is( $user->role . '/dataadmin*') |
                   Request::is( $user->role . '/dataguru*')
                ? 'menu-open' : '' }}"
                >

                  <a href="#" class="nav-link
                  {{ Request::is( $user->role . '/datasiswa*') |
                     Request::is( $user->role . '/dataadmin*') |
                     Request::is( $user->role . '/dataguru*')
                     ? 'active' : '' }}"
                  >

                      <i class="nav-icon fas fa-copy"></i>
                      <p>
                          BIODATA
                          <i class="right fas fa-angle-left"></i>
                      </p>
                  </a>
                  <ul class="nav nav-treeview">
                      @can('admin')
                      <li class="nav-item">
                          <a href="{{ '/' . $user->role . '/datasiswa' }}" class="nav-link {{ Request::is( $user->role . '/datasiswa*') ? 'active' : '' }}">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Data Siswa</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{ '/' . $user->role . '/dataguru' }}" class="nav-link {{ Request::is( $user->role . '/dataguru*') ? 'active' : '' }}">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Data Guru</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{ '/' . $user->role . '/dataadmin' }}" class="nav-link {{ Request::is( $user->role . '/dataadmin*') ? 'active' : '' }}">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Data Admin</p>
                          </a>
                      </li>
                      @endcan

                      @can('guru')
                      <li class="nav-item">
                        <a href="{{ '/' . $user->role . '/datasiswa' }}" class="nav-link {{ Request::is( $user->role . '/datasiswa*') ? 'active' : '' }}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Data Siswa</p>
                        </a>
                      </li>
                      @endcan

                  </ul>
              </li>


              @can('admin')

              <li class="nav-item
                    {{  Request::is( $user->role . '/datasekolah*') |
                    Request::is( $user->role . '/datakelas*') |
                    Request::is( $user->role . '/datamapel*') |
                    Request::is( $user->role . '/datapembelajaran*') |
                    Request::is( $user->role . '/datatapel*')
                    ? 'menu-open' : '' }}
              ">
                  <a href="#" class="nav-link
                      {{  Request::is( $user->role . '/datasekolah*') |
                      Request::is( $user->role . '/datakelas*') |
                      Request::is( $user->role . '/datamapel*') |
                      Request::is( $user->role . '/datapembelajaran*') |
                      Request::is( $user->role . '/datatapel*')
                      ? 'active' : '' }}
                  ">
                      <i class="nav-icon fas fa-table"></i>
                      <p>
                          ADMINISTRASI
                          <i class="right fas fa-angle-left"></i>
                      </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="{{ '/' . $user->role . '/datasekolah' }}" class="nav-link {{ Request::is( $user->role . '/datasekolah*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Data Sekolah</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{ '/' . $user->role . '/datatapel' }}" class="nav-link {{ Request::is( $user->role . '/datatapel*') ? 'active' : '' }}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Data Tahun Pelajaran</p>
                      </a>
                  </li>
                      <li class="nav-item">
                          <a href="{{ '/' . $user->role . '/datakelas' }}" class="nav-link {{ Request::is( $user->role . '/datakelas*') ? 'active' : '' }}">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Data Kelas</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{ '/' . $user->role . '/datamapel' }}" class="nav-link {{ Request::is( $user->role . '/datamapel*') ? 'active' : '' }}">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Data Mapel</p>
                          </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ '/' . $user->role . '/datapembelajaran' }}" class="nav-link {{ Request::is( $user->role . '/datapembelajaran*') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Data Pembelajaran</p>
                        </a>
                    </li>
                  </ul>
              </li>

              @endcan

             @endif


            {{-- WALI KELAS --}}
            @if (Auth::user()->role == 'guru')
              @if ($guru->kelas)
                <li class="nav-item
                {{  Request::is( $user->role . '/datakelas*')
                ? 'menu-open' : '' }}
                ">
                    <a href="#" class="nav-link
                    {{  Request::is( $user->role . '/datakelas*')
                      ? 'active' : '' }}
                    ">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            WALI KELAS
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ '/' . $user->role . '/datakelas' }}" class="nav-link {{ Request::is( $user->role . '/datakelas*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Kelas</p>
                            </a>
                        </li>
                    </ul>
                </li>
              @endif
            @endif
            {{-- END WALI KELAS --}}

            {{-- GURU MAPEL --}}
            @if (Auth::user()->role == 'guru')
              @if (count($guru->pembelajaran) > 0)
            <li class="nav-header mt-2 fw-bold">ABSENSI</li>

              <li class="nav-item">
                <a href="{{ '/guru/absensi' }}" class="nav-link {{ Request::is( 'guru/absensi*') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Kelola Absen</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ '/guru/rekapabsensi' }}" class="nav-link {{ Request::is( 'guru/rekapabsensi*') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Rekap Absen</p>
                </a>
            </li>
              @endif
            @endif
            {{-- END GURU MAPEL --}}

            @if (Auth::user()->role == 'guru' && is_null(Auth::user()->guru->kelas))

            @else


            @if (auth()->user()->role != 'guru')
            <li class="nav-header mt-2 fw-bold">ABSENSI</li>
              <li class="nav-item">
                      <a href="{{ '/' . $user->role . '/absensi' }}" class="nav-link {{ Request::is( $user->role . '/absensi*') ? 'active' : '' }}">
                      <i class="nav-icon fas fa-book"></i>
                      <p>
                          Absensi
                      </p>
                  </a>
              </li>
              @endif

            @endif

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
