@extends('layouts.main')

@section('content')

    <div class="content-header">
        <div class="container-fluid">

          <div class="row mb-0">
            <div class="col-sm-6">
                <h4 class="fw-bold poppins m-0">Rekapitulasi Absensi @can('guru') Saya @endcan</h4>
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
                <div class="col-12">
                  <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if ($pembelajaran->count() < 1)
                                Belum ada Data Pembelajaran!
                            @else
                                <div class="table-responsive">
                                    <table id="table1" class="table table-sm table-hover ">
                                        <thead>
                                            <tr class="bg-dark text-white">
                                                <th scope="col">#</th>
                                                <th scope="col">Mata Pelajaran</th>
                                                <th scope="col">Kelas</th>
                                                <th scope="col">Guru Pengampu</th>
                                                <th scope="col">Tahun Pelajaran</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pembelajaran as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->mapel->singkatan }}</td>
                                                    <td>{{ $item->kelas->name }}</td>
                                                    <td>{{ $item->guru->name }}
                                                    <td>{{ $item->kelas->tapel->tahun_pelajaran . ' - Semester ' . $item->kelas->tapel->semester  }}
                                                    </td>
                                                    <td>

                                                        @if($item->pertemuan->count() >= 1)
                                                        <form action="{{ route('rekapabsensi.print', ['role' => auth()->user()->role, 'id' => $item->id ]) }}" method="get" target="_blank">
                                                          {{-- @csrf --}}
                                                            <button type="submit" class="btn btn-primary btn-sm">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer-fill me-1" viewBox="0 0 16 16">
                                                                <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"/>
                                                                <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
                                                              </svg>
                                                              Cetak Rekapitulasi</button>
                                                          </form>
                                                        @endif

                                                    </td>

                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>

        </div>
    </section>

    <script>
      var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
      var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
      })
    </script>

@endsection
