@extends('layouts.main')

@section('content')
    <div class="content-header">
        <div class="container-fluid">

            <div class="row mb-0">
                <div class="col-sm-6">
                    <h4 class="fw-bold poppins m-0">
                      <a href="{{ route('absensi.index', auth()->user()->role) }}" class="btn btn-sm btn-link p-0 me-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor"
                            class="bi fw-bold bi-arrow-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                        </svg>
                    </a>
                      Absensi: {{ $kelas->name }}
                    </h4>
                </div>
                <div class="col-sm-6">
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
                            @include('_success')
                            {!! session('success') !!}
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">

                            <div class="callout callout-warning my-1">
                                <div class="row">
                                    <div class="col">
                                        <div class="row">
                                          <div class="table-responsive">
                                            <table class="table-borderless">
                                              <tr>
                                                <td class="fw-bold">Kelas</td>
                                                <td style="width: 1px" class="px-2">:</td>
                                                <td>{{ $kelas->name }}</td>
                                              </tr>
                                              <tr>
                                                <td class="fw-bold">Wali Kelas</td>
                                                <td style="width: 1px" class="px-2">:</td>
                                                <td>{{ $kelas->guru->name }}</td>
                                              </tr>
                                              <tr>
                                                <td class="fw-bold">Tahun Pelajaran</td>
                                                <td style="width: 1px" class="px-2">:</td>
                                                <td>{{  $kelas->tapel->tahun_pelajaran  }} - Semester {{ $kelas->tapel->semester }}</td>
                                              </tr>
                                            </table>
                                          </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        @if($kelas->tapel->semester == 1)
                          <div class="card-body">
                              <div class="row">
                                  <div class="col-sm-6 col-md-4">
                                    <a href="{{ route('absensi.kelas.month', [$role, $kelas->id, 7]) }}" class="text-decoration-none">
                                      <div class="info-box">
                                        <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-calendar"></i></span>
                                        <div class="info-box-content">
                                          <span class="info-box-number">
                                            Juli {{ Str::before($kelas->tapel->tahun_pelajaran, '/') }}
                                          </span>
                                        </div>
                                      </div>
                                    </a>
                                  </div>
                                  <div class="col-sm-6 col-md-4">
                                    <a href="{{ route('absensi.kelas.month', [$role, $kelas->id, 8]) }}" class="text-decoration-none">
                                      <div class="info-box">
                                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-calendar"></i></span>
                                        <div class="info-box-content">
                                          <span class="info-box-number">
                                            Agustus {{ Str::before($kelas->tapel->tahun_pelajaran, '/') }}
                                          </span>
                                        </div>
                                      </div>
                                    </a>
                                  </div>
                                  <div class="col-sm-6 col-md-4">
                                    <a href="{{ route('absensi.kelas.month', [$role, $kelas->id, 9]) }}" class="text-decoration-none">
                                      <div class="info-box">
                                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-calendar"></i></span>
                                        <div class="info-box-content">
                                          <span class="info-box-number">
                                            September {{ Str::before($kelas->tapel->tahun_pelajaran, '/') }}
                                          </span>
                                        </div>
                                      </div>
                                    </a>
                                  </div>
                                  <div class="col-sm-6 col-md-4">
                                    <a href="{{ route('absensi.kelas.month', [$role, $kelas->id, 10]) }}" class="text-decoration-none">
                                      <div class="info-box">
                                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-calendar"></i></span>
                                        <div class="info-box-content">
                                          <span class="info-box-number">
                                            Oktober {{ Str::before($kelas->tapel->tahun_pelajaran, '/') }}
                                          </span>
                                        </div>
                                      </div>
                                    </a>
                                  </div>
                                  <div class="col-sm-6 col-md-4">
                                    <a href="{{ route('absensi.kelas.month', [$role, $kelas->id, 11]) }}" class="text-decoration-none">
                                      <div class="info-box">
                                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-calendar"></i></span>
                                        <div class="info-box-content">
                                          <span class="info-box-number">
                                            November {{ Str::before($kelas->tapel->tahun_pelajaran, '/') }}
                                          </span>
                                        </div>
                                      </div>
                                    </a>
                                  </div>
                                  <div class="col-sm-6 col-md-4">
                                    <a href="{{ route('absensi.kelas.month', [$role, $kelas->id, 12]) }}" class="text-decoration-none">
                                      <div class="info-box">
                                        <span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-calendar"></i></span>
                                        <div class="info-box-content">
                                          <span class="info-box-number">
                                            Desember {{ Str::before($kelas->tapel->tahun_pelajaran, '/') }}
                                          </span>
                                        </div>
                                      </div>
                                    </a>
                                  </div>
                              </div>
                          </div>
                        @else
                          <div class="card-body">
                              <div class="row">
                                  <div class="col-sm-6 col-md-4">
                                    <a href="{{ route('absensi.kelas.month', [$role, $kelas->id, 1]) }}" class="text-decoration-none">
                                      <div class="info-box">
                                        <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-calendar"></i></span>
                                        <div class="info-box-content">
                                          <span class="info-box-number">
                                            Januari {{ Str::after($kelas->tapel->tahun_pelajaran, '/') }}
                                          </span>
                                        </div>
                                      </div>
                                    </a>
                                  </div>
                                  <div class="col-sm-6 col-md-4">
                                    <a href="{{ route('absensi.kelas.month', [$role, $kelas->id, 2]) }}" class="text-decoration-none">
                                      <div class="info-box">
                                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-calendar"></i></span>
                                        <div class="info-box-content">
                                          <span class="info-box-number">
                                            Februari {{ Str::after($kelas->tapel->tahun_pelajaran, '/') }}
                                          </span>
                                        </div>
                                      </div>
                                    </a>
                                  </div>
                                  <div class="col-sm-6 col-md-4">
                                    <a href="{{ route('absensi.kelas.month', [$role, $kelas->id, 3]) }}" class="text-decoration-none">
                                      <div class="info-box">
                                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-calendar"></i></span>
                                        <div class="info-box-content">
                                          <span class="info-box-number">
                                            Maret {{ Str::after($kelas->tapel->tahun_pelajaran, '/') }}
                                          </span>
                                        </div>
                                      </div>
                                    </a>
                                  </div>
                                  <div class="col-sm-6 col-md-4">
                                    <a href="{{ route('absensi.kelas.month', [$role, $kelas->id, 4]) }}" class="text-decoration-none">
                                      <div class="info-box">
                                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-calendar"></i></span>
                                        <div class="info-box-content">
                                          <span class="info-box-number">
                                            April {{ Str::after($kelas->tapel->tahun_pelajaran, '/') }}
                                          </span>
                                        </div>
                                      </div>
                                    </a>
                                  </div>
                                  <div class="col-sm-6 col-md-4">
                                    <a href="{{ route('absensi.kelas.month', [$role, $kelas->id, 5]) }}" class="text-decoration-none">
                                      <div class="info-box">
                                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-calendar"></i></span>
                                        <div class="info-box-content">
                                          <span class="info-box-number">
                                            Mei {{ Str::after($kelas->tapel->tahun_pelajaran, '/') }}
                                          </span>
                                        </div>
                                      </div>
                                    </a>
                                  </div>
                                  <div class="col-sm-6 col-md-4">
                                    <a href="{{ route('absensi.kelas.month', [$role, $kelas->id, 6]) }}" class="text-decoration-none">
                                      <div class="info-box">
                                        <span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-calendar"></i></span>
                                        <div class="info-box-content">
                                          <span class="info-box-number">
                                            Juni {{ Str::after($kelas->tapel->tahun_pelajaran, '/') }}
                                          </span>
                                        </div>
                                      </div>
                                    </a>
                                  </div>
                              </div>
                          </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>

        </div>
    </section>

    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
@endsection
