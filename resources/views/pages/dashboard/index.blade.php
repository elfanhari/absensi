@extends('layouts.main')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-1">
                <div class="col-sm-6">
                    <h4 class="fw-bold poppins m-0">Dashboard</h4>
                </div>
                <div class="col-sm-6">
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
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer">Lihat detail
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
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer">Lihat detail
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
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer">Lihat detail
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
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer">Lihat detail
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
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer">Lihat detail
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-md-3 col-sm-4 col-6">
                    <div class="small-box bg-secondary">
                        <div class="inner">
                            <h3>{{ $mapel }}</h3>
                            <p>Data Mata Pelajaran</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer">Lihat detail
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                @endcan


                @if (auth()->user()->role == 'admin' || auth()->user()->role == 'guru')
                <div class="col-md-3 col-sm-4 col-6">
                    <div class="small-box bg-purple">
                        <div class="inner">
                            <h3>{{ $pembelajaran }}</h3>
                            <p>Data Pembelajaran</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer">Lihat detail
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                @endif

                @can('siswa')
                <div class="col-md-3 col-sm-4 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>Absensi</h3>
                            <p>Kehadiran Saya</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer">Lihat detail
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
                            <i class="ion ion-bag"></i>
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
