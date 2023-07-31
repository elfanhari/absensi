@php
    use App\Models\HariLibur;
    use Carbon\Carbon;
@endphp

@extends('layouts.main')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-0">
                <div class="col-sm-6">
                    <h4 class="fw-bold poppins m-0 text-xs-center mt-xs-2">Dashboard</h4>
                </div>
                <div class="col-sm-6 mt-xs-2">
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
                            @include('_success')
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session()->has('login'))
                        <div class="alert alert-info alert-dismissible fade show mb-0" role="alert">
                            @include('_success')
                            Anda berhasil login sebagai <b class="text-uppercase"> {{ session('login') }} </b>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
              @if (auth()->user()->role == 'admin' || auth()->user()->role == 'guru')
                <div class="col-md-3 col-sm-4 col-6">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>{{ $siswa }}</h3>
                            <p>Data Siswa</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-person-stalker"></i>
                        </div>
                        <a href="{{ route('datasiswa.index', $role) }}" class="small-box-footer">Lihat detail
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                @endif

                @can('admin')
                <div class="col-md-3 col-sm-4 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $guru }}</h3>
                            <p>Data Guru</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-person-stalker"></i>
                        </div>
                        <a href="{{ route('dataguru.index', $role) }}" class="small-box-footer">Lihat detail
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-md-3 col-sm-4 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $admin }}</h3>
                            <p>Data Admin</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person"></i>
                        </div>
                        <a href="{{ route('dataadmin.index', $role) }}" class="small-box-footer">Lihat detail
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-md-3 col-sm-4 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $kelas }}</h3>
                            <p>Data Kelas</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-log-in"></i>
                        </div>
                        <a href="{{ route('datakelas.index', $role) }}" class="small-box-footer">Lihat detail
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-md-3 col-sm-4 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $tapel }}</h3>
                            <p>Data Tahun Pelajaran</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{ route('datatapel.index', $role) }}" class="small-box-footer">Lihat detail
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                @endcan

                @can('siswa')
                <div class="col-md-3 col-sm-4 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>Absensi</h3>
                            <p>Kehadiran Saya</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-file"></i>
                        </div>
                        <a href="{{ route('absensi.show', [$role, Auth::user()->siswa->kelas_id]) }}" class="small-box-footer">Lihat detail
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                @endcan
                @can('walikelas')
                  <div class="col-md-3 col-sm-4 col-6">
                      <div class="small-box bg-success">
                          <div class="inner">
                              <h3>Absensi</h3>
                              <p>Kehadiran Kelas Saya</p>
                          </div>
                          <div class="icon">
                              <i class="ion ion-file"></i>
                          </div>
                          <a href="{{ route('absensi.show', [$role, Auth::user()->guru->kelas->id]) }}" class="small-box-footer">Lihat detail
                              <i class="fas fa-arrow-circle-right"></i>
                          </a>
                      </div>
                  </div>

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

                  @if ($hariLibur->contains($date) || $akhirPekan->dayOfWeek === 0 || $akhirPekan->dayOfWeek == 6)
                  {{-- NULL --}}
                  @else
                    <div class="col-md-3 col-sm-4 col-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>Input</h3>
                                <p>Absen Hari Ini</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-file"></i>
                            </div>
                            <a href="{{ route('absensi.kelas.day.get', [Auth::user()->role,  Auth::user()->guru->kelas->id, $month, $date, $key]) }}" class="small-box-footer">Lihat detail
                                <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                  @endif

                @endcan
                @can('piket')
                <div class="col-md-3 col-sm-4 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>Absensi</h3>
                            <p>Kehadiran</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-file"></i>
                        </div>
                        <a href="{{ route('absensi.index', $role) }}" class="small-box-footer">Lihat detail
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                @endcan

                <div class="col-md-3 col-sm-4 col-6">
                    <div class="small-box bg-cyan">
                        <div class="inner">
                            <h3>Profil</h3>
                            <p>Profil Saya</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person"></i>
                        </div>
                        <a href="{{ '/' . auth()->user()->role . '/profil' }}" class="small-box-footer">Lihat detail
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
