@extends('layouts.main')

@section('content')
    @php
        use Carbon\Carbon;
    @endphp

    <div class="content-header">
        <div class="container-fluid">

            <div class="row mb-0">
                <div class="col-sm-6">
                    <h4 class="fw-bold poppins m-0">Notifikasi</h4>
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

              @if (Auth::user()->role != 'siswa')
                <button type="button" class="btn btn-primary btn-block mb-3" data-bs-toggle="modal"
                    data-bs-target="#kirimNotifikasi">
                    Kirim Notifikasi
                </button>
              @endif

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
                                    <span class="badge bg-warning float-right px-2">{{ count($notifBelumDibaca) }}</span>
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
                        <h3 class="card-title">Notifikasi Saya</h3>
                        <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">

                      @if (count($allMyNotif) < 1)
                        <div class="ms-3 my-3 badge badge-primary">
                          Belum ada notifikasi.
                        </div>
                      @else

                        <div class="mailbox-controls">
                            <!-- Check all button -->
                            <div class="text-start my-2 ms-2">
                              <form action="{{ route('notifikasi.destroy', ['role' => Auth::user()->role, 'notifikasi' =>  Auth::user()->id]) }}" method="POST">
                              @csrf
                              @method('DELETE')
                              <input type="hidden" name="hapus_untuk" value="all" id="" hidden>
                                <button type="submit" class="btn btn-danger btn-sm">
                                  <i class="far fa-trash-alt me-1"></i> Hapus Semua
                                </button>
                              </form>
                            </div>
                            <!-- /.btn-group -->


                            <!-- /.float-right -->
                        </div>
                        <div class="table-responsive mailbox-messages">

                            <table class="table table-hover">
                                <tbody>
                                  @foreach ($allMyNotif as $item)
                                    <tr class="{{ $item->dibaca == false ? 'bg-belum-dibaca' : '' }}">
                                        <td style="min-width: 120px">
                                          <form action="{{ route('notifikasi.destroy', ['role' => Auth::user()->role, 'notifikasi' =>  $item->id]) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="hapus_untuk" value="single" id="" hidden>
                                              <button type="submit" class="btn btn-danger btn-sm d-inline" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus">
                                                <i class="far fa-trash-alt pe-0"></i>
                                              </button>
                                            </form>

                                            <a href="{{ route('notifikasi.show', ['role' => Auth::user()->role, 'notifikasi' =>  $item->id]) }}" type="submit"  class="ms-3 btn btn-primary btn-sm d-inline" data-bs-toggle="tooltip" data-bs-placement="top" title="Detail">
                                              <svg xmlns="http://www.w3.org/2000/svg" width="12"
                                              height="13" fill="currentColor"
                                              class="bi bi-list-columns-reverse" viewBox="0 0 16 16">
                                              <path fill-rule="evenodd"
                                                  d="M0 .5A.5.5 0 0 1 .5 0h2a.5.5 0 0 1 0 1h-2A.5.5 0 0 1 0 .5Zm4 0a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10A.5.5 0 0 1 4 .5Zm-4 2A.5.5 0 0 1 .5 2h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5Zm-4 2A.5.5 0 0 1 .5 4h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5Zm-4 2A.5.5 0 0 1 .5 6h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 0 1h-8a.5.5 0 0 1-.5-.5Zm-4 2A.5.5 0 0 1 .5 8h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 0 1h-8a.5.5 0 0 1-.5-.5Zm-4 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10a.5.5 0 0 1-.5-.5Zm-4 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5Zm-4 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5Z" />
                                          </svg>
                                            </a>
                                        </td>
                                        <td class="mailbox-star">
                                          @if ($item->kategori == 'Informasi')
                                            <i class="far fa-circle text-primary mb-0"></i>
                                            @else
                                            <i class="far fa-circle text-warning mb-0"></i>
                                          @endif
                                        </td>
                                        <td class="mailbox-subject"><b>{{ $item->judul }}</b>: {{ Str::limit($item->isi, 40, '...') }}
                                        </td>
                                        <td class="mailbox-attachment"></td>
                                        <td class="mailbox-date">{{ $item->created_at->diffForHumans() }}</td>
                                    </tr>
                                  @endforeach
                                </tbody>
                            </table>
                            <!-- /.table -->
                        </div>

                      @endif

                        <!-- /.mail-box-messages -->
                    </div>
                    <!-- /.card-body -->

                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>


    @if (Auth::user()->role != 'siswa')
    {{-- MODAL KIRIM NOTIFIKASI --}}
    <div class="modal fade" id="kirimNotifikasi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">

            <form action="{{ route('notifikasi.store', $role) }}" method="POST">
                @csrf

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold poppins" id="exampleModalLabel">Kirim Notifikasi
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @include('pages.notifikasi._sendform')
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </div>

            </form>

        </div>
    </div>
    @endif

  </div>
@endsection
