@extends('layouts.main')

@section('content')
    @php
        use Carbon\Carbon;
    @endphp

    <div class="content-header">
        <div class="container-fluid">

            <div class="row mb-0">
              <div class="col-sm-6">
                <h4 class="fw-bold poppins m-0">
                    <a href="{{ '/' . auth()->user()->role . '/notifikasi' }}" class="btn btn-sm btn-link p-0 me-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor"
                            class="bi fw-bold bi-arrow-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                        </svg>
                    </a>
                    Notifikasi
                </h4>
            </div>
                <div class="col-sm-6">
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
                            @include('_success')
                            {!! session('success') !!}
                        </div>
                    @endif
                    @if (session()->has('failed'))
                        <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                            @include('_failed')
                            {!! session('failed') !!}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="row px-2">
            <div class="col-md-3">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Notifikasi Saya</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <ul class="nav nav-pills flex-column">
                            <li class="nav-item active">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-inbox me-2"></i> Belum Dibaca
                                    <span class="badge bg-warning float-right">{{ count($notifBelumDibaca) }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Keterangan</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <ul class="nav nav-pills flex-column">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle text-warning me-2"></i> Peringatan
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle text-primary me-2"></i>
                                    Informasi
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
              <div class="card card-primary card-outline">
                <div class="card-header">
                  <h3 class="card-title">Detail Notifikasi</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <div class="mailbox-read-info">
                    <h5 class="fw-bold">{{ $notif->judul }}</h5>
                    <h6>Dari:
                        @if ($notif->userPengirim->role == 'admin')
                          Administrator
                        @elseif ($notif->userPengirim->role == 'guru')
                          {{ $notif->userPengirim->guru->name }}
                        @elseif ($notif->userPengirim->role == 'piket')
                          {{ $notif->userPengirim->piket->name }}
                        @elseif ($notif->userPengirim->role == 'siswa')
                          {{ $notif->userPengirim->siswa->name }}
                        @endif
                      <span class="mailbox-read-time float-right">{{  Carbon::parse(Str::before($notif->created_at, ' '))->locale('id_ID')->isoFormat('dddd, D MMMM Y') }} Pukul {{ Carbon::parse(Str::after($notif->created_at, ' '))->format('H:i') }}</span></h6>
                  </div>
                  <div class="mailbox-read-message">
                    <p>
                      {{ $notif->isi }}
                    </p>
                  </div>
                  <!-- /.mailbox-read-message -->
                </div>
                <!-- /.card-body -->
              </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>

  </div>
@endsection
