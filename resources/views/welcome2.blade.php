<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>ABSENSI SMKN 54 JAKARTA</title>

    <link href="/docs/5.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/extensions/simple-datatables/style.css" rel="stylesheet">
    <link href="/extensions/simple-datatables.css" rel="stylesheet">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/docs/5.1/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/5.1/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/5.1/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/5.1/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="/docs/5.1/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
    <link rel="icon" href="/docs/5.1/assets/img/favicons/favicon.ico">
    <meta name="theme-color" content="#7952b3">

    <link href="https://fonts.googleapis.com/css2?family=Figtree:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <style>
      .fs-13{
        font-size: 13px;
      }
    </style>
    <link rel="stylesheet" href="my-css/style.css">
    <!-- Custom styles for this template -->
    <link href="carousel.css" rel="stylesheet">
</head>

<body style="font-family: 'Figtree'">

    <header>
        <nav class="navbar navbar-expand-md navbar-dark sticky-top bg-dark">
            <div class="container-fluid">
                <img src="/img/smkn54jkt-banner-logo.png" alt="" class="img-fluid" style="width: 150px">
                <div class="float-end">
                    <div class="d-flex text-end">
                        @auth
                            <a href="{{ route('dashboard.index', auth()->user()->role) }}" class="mt-1">Kelola</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary" type="button">Login</a>
                        @endauth
                    </div>

                </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="container marketing mt-5">

            <div class="px-4 py-5 my-5 text-center">
                <img class="d-block mx-auto mb-4" src="/img/logo.png" alt="" width="210">
                <h1 class="display-5 fw-bold">ABSENSI SMKN 54 JAKARTA</h1>
                <div class="col-lg-6 mx-auto">
                    <p class="lead mb-4">
                        Selamat datang di Website Absensi SMK Negeri 54 Jakarta! <br>
                        Silahkan masuk menggunakan akun terdaftar untuk mengetahui informasi lebih lanjut.

                    </p>
                </div>
            </div>

            @php
            $hariLibur = App\Models\HariLibur::get()->pluck('tgl');
            $akhirPekan = Carbon\Carbon::parse($tanggal);
            @endphp

            @if ($hariLibur->contains($tanggal) || $akhirPekan->dayOfWeek === 0 || $akhirPekan->dayOfWeek === 6)
            {{-- NULL --}}
            @else

              <hr class="featurette-divider">

              <div class="row">
                  <h3 class="text-center mt-3 mb-2 fw-bold">KETIDAKHADIRAN HARI INI</h3>
                  <div class="mb-3 text-center fw-bold">
                      {{ Carbon\Carbon::parse($tanggal)->locale('id_ID')->isoFormat('dddd, D MMMM Y') }}
                  </div>

                  <div class="container">

                    {{-- TABEL DEKSTOP --}}
                    <div class="d-xs-none">
                      <div class="table-responsive">
                          <table class="table table-sm table-bordered table-hover">
                              <thead>
                                  <tr class="bg-dark text-white">
                                      <th rowspan="2" class="text-center align-middle">Kelas</th>
                                      <th rowspan="2" class="text-center align-middle">Jumlah Siswa</th>
                                      <th colspan="3" class="text-center align-middle">Keterangan</th>
                                  </tr>
                                  <tr>
                                      <th class="text-center align-middle bg-primary text-white">Sakit</th>
                                      <th class="text-center align-middle bg-warning text-white">Izin</th>
                                      <th class="text-center align-middle bg-danger text-white">Alfa</th>
                                  </tr>
                              </thead>
                              <tbody>

                                  @foreach ($kelas as $item)
                                      <tr>
                                          <td style="min-width: 100px" class="text-center">{{ $item->name }}</td>
                                          <td style="min-width: 50px" class="text-center">
                                              {{ App\Models\Siswa::getSiswaAktifKelas($item->id)->count() }}</td>

                                          @php
                                              $siswaAbsen = App\Models\Absen::getSiswaByKelasAndTanggalAndKeterangan($item->id, $tanggal, 'H');
                                              $jumlahSiswaAbsen = $siswaAbsen->count();
                                          @endphp

                                          @if ($jumlahSiswaAbsen < 1)

                                            <td colspan="3" class="text-center">
                                              @if (in_array($tanggal, \App\Models\Absen::getAbsenHariIni($item->id, $tanggal)->toArray()))
                                                <span class="badge bg-success">
                                                  HADIR SEMUA
                                                </span>
                                              @else
                                              <span class="badge bg-info">
                                                BELUM INPUT
                                              </span>
                                              @endif
                                            </td>

                                          @else
                                            {{-- SAKIT --}}
                                            <td>
                                                @if (App\Models\Absen::getSiswaByKelasAndKeterangan($item->id, 'S', $tanggal)->count() < 1)
                                                    <div class="ps-3">-</div>
                                                @else
                                                    <ol style="min-width: 200px">
                                                        @foreach (App\Models\Absen::getSiswaByKelasAndKeterangan($item->id, 'S', $tanggal) as $absen)
                                                            <li>{{ $absen->siswa->name }}</li>
                                                        @endforeach
                                                    </ol>
                                                @endif
                                            </td>

                                            {{-- IZIN --}}
                                            <td>
                                                @if (App\Models\Absen::getSiswaByKelasAndKeterangan($item->id, 'I', $tanggal)->count() < 1)
                                                    <div class="ps-3">-</div>
                                                @else
                                                    <ol style="min-width: 200px">
                                                        @foreach (App\Models\Absen::getSiswaByKelasAndKeterangan($item->id, 'I', $tanggal) as $absen)
                                                            <li>{{ $absen->siswa->name }}</li>
                                                        @endforeach
                                                    </ol>
                                                @endif
                                            </td>

                                            {{-- ALFA --}}
                                            <td>
                                                @if (App\Models\Absen::getSiswaByKelasAndKeterangan($item->id, 'A', $tanggal)->count() < 1)
                                                    <div class="ps-3">-</div>
                                                @else
                                                    <ol style="min-width: 200px">
                                                        @foreach (App\Models\Absen::getSiswaByKelasAndKeterangan($item->id, 'A', $tanggal) as $absen)
                                                            <li>{{ $absen->siswa->name }}</li>
                                                        @endforeach
                                                    </ol>
                                                @endif
                                            </td>
                                          @endif

                                      </tr>
                                  @endforeach

                                  <tr>
                                    <td colspan="2" class="bg-dark text-white text-center align-middle fw-bold d-xs">Jml</td>

                                    {{-- SAKIT --}}
                                    <td class="bg-primary text-center align-middle text-white fw-bold">{{ App\Models\Absen::countKetidakhadiran($tanggal, 'S') }}</td>

                                    {{-- IZIN --}}
                                    <td class="bg-warning text-center align-middle text-white fw-bold">{{ App\Models\Absen::countKetidakhadiran($tanggal, 'I') }}</td>

                                    {{-- ALFA --}}
                                    <td class="bg-danger text-center align-middle text-white fw-bold">{{ App\Models\Absen::countKetidakhadiran($tanggal, 'A') }}</td>

                                  </tr>

                              </tbody>
                          </table>
                      </div>
                    </div>

                    {{-- TABEL MOBILE --}}
                    <div class="d-sm-none">
                      <div class="table-responsive">
                        <table class="table table-sm table-bordered table-hover fs-13">
                            <thead>
                                <tr class="bg-dark text-white">
                                    <th class="text-center align-middle" style="min-width: 100px">Kelas</th>
                                    <th class="text-center align-middle">Jumlah Siswa</th>
                                    <th class="text-center align-middle">Nama Siswa</th>
                                    <th class="text-center align-middle">Absensi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kelas as $kelasItem)
                                    @php
                                        $siswaAbsen = App\Models\Absen::getSiswaByKelasAndTanggalAndKeterangan($kelasItem->id, $tanggal, 'H');
                                        $jumlahSiswaAbsen = $siswaAbsen->count();
                                        $siswaAbsen = $siswaAbsen->sortBy(function ($siswa) {
                                            return $siswa->siswa->name;
                                        });

                                    @endphp

                                    @if ($jumlahSiswaAbsen < 1)
                                      <tr>
                                        <td rowspan="2" class="text-center">{{ $kelasItem->name }}</td>
                                        <td rowspan="2" class="text-center">{{ App\Models\Siswa::getSiswaAktifKelas($kelasItem->id)->count() }}</td>
                                      </tr>
                                    @else
                                      <tr>
                                        <td rowspan="{{ $jumlahSiswaAbsen + 1 }}" class="text-center"> {{ $kelasItem->name }}</td>
                                        <td rowspan="{{ $jumlahSiswaAbsen + 1 }}" class="text-center">{{ App\Models\Siswa::getSiswaAktifKelas($kelasItem->id)->count() }}</td>
                                      </tr>
                                    @endif

                                    @if ($jumlahSiswaAbsen < 1)

                                    <td colspan="2" class="text-center">
                                      @if (in_array($tanggal, \App\Models\Absen::getAbsenHariIni($kelasItem->id, $tanggal)->toArray()))
                                        <span class="badge bg-success">
                                          HADIR SEMUA
                                        </span>
                                      @else
                                      <span class="badge bg-info">
                                        BELUM INPUT
                                      </span>
                                      @endif
                                    </td>

                                    @else

                                      @foreach ($siswaAbsen as $absen)
                                              <tr>
                                                <td>{{ $absen->siswa->name }}</td>
                                                <td class="text-center">
                                                  @if ($absen->keterangan == 'S')
                                                    <span class="badge bg-primary">
                                                      SAKIT
                                                    </span>
                                                  @elseif ($absen->keterangan == 'I')
                                                    <span class="badge bg-warning text-dark">
                                                      IZIN
                                                    </span>
                                                  @elseif ($absen->keterangan == 'A')
                                                    <span class="badge bg-danger">
                                                      ALFA
                                                    </span>
                                                  @endif
                                                </td>
                                              </tr>
                                        @endforeach

                                    @endif

                                @endforeach
                            </tbody>
                        </table>
                      </div>
                    </div>

              </div>

              <hr class="featurette-divider">

              <!-- FOOTER -->
              <footer class="container">
                <p>&copy; 2023 SMKN 54 Jakarta.</p>
              </footer>
            @endif

        </div>

    </main>

    <script src="/bootstrap/js/bootstrap.min.js" rel="stylesheet"></script>
    <script src="/extensions/simple-datatables/umd/simple-datatables.js"></script>
    <script src="/extensions/simple-datatables.js"></script>


</body>

</html>
