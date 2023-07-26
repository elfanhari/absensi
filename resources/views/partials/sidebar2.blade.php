<!-- Main Sidebar Container -->
@php
    use App\Models\HariLibur;
    use Carbon\Carbon;

    $user = Auth::user();
    $admin = Auth::user()->admin;
    $guru = Auth::user()->guru;
    $siswa = Auth::user()->siswa;

@endphp

<aside class="main-sidebar sidebar-dark-primary elevation-4">

  <a class="brand-link">
      <img src="/adminlte/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
          class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light d-xs-none text-uppercase">{{ auth()->user()->role }}
      </span>
      <span class="brand-text font-weight-light d-sm-none">Absensi - <span
              style="text-transform: capitalize">{{  auth()->user()->role }}</span>
      </span>
  </a>

  <div class="sidebar">

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
                   Request::is( $user->role . '/datapiket*') |
                   Request::is( $user->role . '/dataguru*')
                ? 'menu-open' : '' }}"
                >

                  <a href="#" class="nav-link
                  {{ Request::is( $user->role . '/datasiswa*') |
                     Request::is( $user->role . '/dataadmin*') |
                     Request::is( $user->role . '/datapiket*') |
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
                        <li class="nav-item">
                            <a href="{{ '/' . $user->role . '/datapiket' }}" class="nav-link {{ Request::is( $user->role . '/datapiket*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Piket</p>
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
                    Request::is( $user->role . '/harilibur*') |
                    Request::is( $user->role . '/datatapel*')
                    ? 'menu-open' : '' }}
              ">
                  <a href="#" class="nav-link
                      {{  Request::is( $user->role . '/datasekolah*') |
                      Request::is( $user->role . '/datakelas*') |
                      Request::is( $user->role . '/harilibur*') |
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
                        <a href="{{ '/' . $user->role . '/harilibur' }}" class="nav-link {{ Request::is( $user->role . '/harilibur*') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Data Hari Libur</p>
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
                {{  Request::is( $user->role . '/datakelas*') |
                    Request::is( $user->role . '/absensi*') |
                    Request::is( $user->role . '/rekapabsensi')
                ? 'menu-open' : '' }}
                ">
                    <a href="#" class="nav-link
                    {{  Request::is( $user->role . '/datakelas*') |
                        Request::is( $user->role . '/absensi*') |
                        Request::is( $user->role . '/rekapabsensi')
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

                      @php

                        $role = Auth::user()->role;
                        $date = date('Y-m-d');
                        $month = Carbon::now()->format('m');

                        $dateString = $date;
                        list($year, $month, $day) = explode('-', $dateString);
                        $timestamp = mktime(0, 0, 0, $month, $day, $year);
                        $timestamp = strtotime($dateString);

                        $key = $timestamp . '_' . Str::random(10);

                        $hariLibur = HariLibur::get()->pluck('tgl');
                        $akhirPekan = Carbon::parse($date);

                      @endphp

                      @if ($hariLibur->contains($date) || $akhirPekan->dayOfWeek === 0 || $akhirPekan->dayOfWeek === 6)
                        <li class="nav-item">
                          <a href="{{ '/guru/absensi/' . $guru->kelas->id }}" class="nav-link {{ Request::is( 'guru/absensi*') ? 'active' : '' }}">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Kelola Absen</p>
                          </a>
                        </li>
                      @else
                        <li class="nav-item">
                          <a href="{{ route('absensi.kelas.day.get', [$role,  $guru->kelas->id, $month, $date, $key]) }}" class="nav-link {{ Request::is( 'guru/absensi*') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Kelola Absen</p>
                          </a>
                        </li>
                      @endif

                      <li class="nav-item">
                          <a href="{{ '/guru/rekapabsensi' }}" class="nav-link {{ Request::is( 'guru/rekapabsensi*') ? 'active' : '' }}">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Rekap Absen</p>
                          </a>
                      </li>

                    </ul>
                </li>
              @endif

            @endif

            {{-- END WALI KELAS --}}

            @if (Auth::user()->role == 'guru' && is_null(Auth::user()->guru->kelas))

            @else

            @if (auth()->user()->role != 'guru')
            <li class="nav-header mt-2 fw-bold">ABSENSI</li>

              @if (Auth::user()->role == 'siswa')
                <li class="nav-item">
                  <a href="{{ '/' . $user->role . '/absensi/' . $siswa->kelas_id }}" class="nav-link {{ Request::is( $user->role . '/absensi*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-book"></i>
                    <p>
                      Absensi
                    </p>
                  </a>
                </li>
              @else
                <li class="nav-item">
                  <a href="{{ '/' . $user->role . '/absensi' }}" class="nav-link {{ Request::is( $user->role . '/absensi*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-book"></i>
                    <p>
                      Absensi
                    </p>
                  </a>
                </li>
              @endif

                @can('admin')
                  <li class="nav-item">
                          <a href="{{ '/admin/rekapabsensi' }}" class="nav-link {{ Request::is( 'admin/rekapabsensi*') ? 'active' : '' }}">
                          <i class="nav-icon fas fa-file"></i>
                          <p>
                              Rekap Absensi
                          </p>
                      </a>
                  </li>
                @endcan

                @can('piket')
                  <li class="nav-item">
                          <a href="{{ '/piket/rekapabsensi' }}" class="nav-link {{ Request::is( 'piket/rekapabsensi*') ? 'active' : '' }}">
                          <i class="nav-icon fas fa-file"></i>
                          <p>
                              Rekap Absensi
                          </p>
                      </a>
                  </li>
                @endcan
              @endif

            @endif

              <li class="nav-header mt-2 fw-bold">NOTIFIKASI</li>

              <li class="nav-item">
                      <a href="{{ '/' . $user->role . '/notifikasi' }}" class="nav-link {{ Request::is( $user->role . '/notifikasi*') ? 'active' : '' }}">
                      <i class="nav-icon fas fa-bell"></i>
                      <p>
                          Notifikasi
                          @if ($notifBelumDibaca->count() >= 1)
                            <span class="badge badge-warning px-2 right">
                              {{ count($notifBelumDibaca) }}
                            </span>
                          @endif
                      </p>
                  </a>
              </li>

              <li class="nav-header mt-2 fw-bold">SAYA</li>

              <li class="nav-item">
                  <a href="{{ '/' . $user->role . '/profil' }}" class="nav-link {{ Request::is( $user->role . '/profil*') ? 'active' : '' }}">
                      <i class="nav-icon fas fa-user"></i>
                      <p>Profil</p>
                  </a>
              </li>

              <li class="nav-item mb-3">
                  <a href="#" data-bs-toggle="modal"
                  data-bs-target="#modal-logout" class="nav-link">
                    <i class="nav-icon ion ion-log-out"></i>
                      <p>Logout</p>
                  </a>
              </li>
          </ul>

      </nav>

  </div>

</aside>
