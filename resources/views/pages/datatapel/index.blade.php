@extends('layouts.main')

@section('content')

@php
  use Carbon\Carbon;
@endphp

    <div class="content-header">
        <div class="container-fluid">

          <div class="row mb-0">
            <div class="col-sm-6">
                <h4 class="fw-bold poppins m-0">Data Tahun Pelajaran</h4>
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
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">

                            <button  data-bs-toggle="modal"
                                     data-bs-target="#modalTambah"
                                class="btn btn-sm float-left btn-primary btn-icon-split" data-bs-placement="right" title="Tambah Tahun Pelajaran">
                                <span class="icon text-white-30 pe-1 pb-1 pt-0" style="padding-top: 0.20rem !important;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-plus-square" viewBox="0 0 16 16">
                                        <path
                                            d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                                        <path
                                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                    </svg>
                                </span>
                                <span class="text">Tahun Pelajaran</span>
                            </button>


                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if (count($tapel) < 1)
                                Belum ada Data Tahun Pelajaran.
                            @else
                                <div class="table-responsive">
                                    <table id="table1" class="table table-sm table-hover ">
                                        <thead>
                                            <tr class="bg-dark text-white">
                                                <th scope="col">#</th>
                                                <th scope="col">Tahun Pelajaran</th>
                                                <th scope="col">Semester</th>
                                                <th scope="col">Jumlah Kelas</th>
                                                <th scope="col">Aksi</th>
                                            </tr>

                                        </thead>
                                        <tbody>
                                            @foreach ($tapel as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->tahun_pelajaran }}</td>
                                                    <td>{{ $item->semester == 1 ? 'Ganjil' : 'Genap' }}</td>
                                                    <td>{{ $item->kelas->count() }}</td>
                                                    <td>

                                                        @if ($item->kelas->count() < 1)
                                                            <button type="button"
                                                                class=" btn btn-danger pb-1 pt-0 px-2 d-inline"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#modalDelete/{{ $item->id }}">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor"
                                                                    class="bi bi-trash3-fill pt-0" viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                                                </svg>
                                                            </button>
                                                        @else
                                                            <button type="button"
                                                                class=" btn btn-danger pb-1 pt-0 px-2 d-inline"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#modalGagalDelete/{{ $item->id }}">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor"
                                                                    class="bi bi-trash3-fill pt-0" viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                                                </svg>
                                                            </button>
                                                        @endif

                                                        {{-- MODAL HAPUS --}}
                                                        <div class="modal fade" id="modalDelete/{{ $item->id }}"
                                                            tabindex="-1" aria-labelledby="exampleModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title fw-bold poppins"
                                                                            id="exampleModalLabel">Konfirmasi Hapus Data
                                                                        </h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Data: <p class="text-primary fw-bold">
                                                                            Tahun Pelajaran {{ $item->tahun_pelajaran }} - Semester
                                                                            {{ $item->semester == 1 ? 'Ganjil' : 'Genap' }}
                                                                        </p>
                                                                        Apakah anda yakin data tersebut akan dihapus?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Batal</button>
                                                                        <form
                                                                            action="{{ route('datatapel.destroy', $item->id) }}"
                                                                            method="POST" class="d-inline">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit"
                                                                                class="btn btn-primary">Hapus</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        {{-- MODAL TIDAK DAPAT DIHAPUS --}}
                                                        <div class="modal fade" id="modalGagalDelete/{{ $item->id }}"
                                                            tabindex="-1" aria-labelledby="exampleModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title fw-bold poppins"
                                                                            id="exampleModalLabel">Peringatan
                                                                        </h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Data: <p class="text-primary fw-bold">
                                                                            Tahun Pelajaran {{ $item->tahun_pelajaran }} - Semester
                                                                            {{ $item->semester == 1 ? 'Ganjil' : 'Genap' }}
                                                                        </p>
                                                                        Data tersebut tidak dapat dihapus! Karena terdapat
                                                                        beberapa siswa di Tahun Pelajaran <b>
                                                                            {{ $item->tahun_pelajaran }} - Semester
                                                                            {{ $item->semester == 1 ? 'Ganjil' : 'Genap' }}
                                                                        </b>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-primary"
                                                                            data-bs-dismiss="modal">Oke</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                           {{-- MODAL EDIT --}}
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

          {{-- MODAL TAMBAH --}}
          <div class="modal fade" id="modalTambah"
          tabindex="-1" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog">

            <form action="{{ route('datatapel.store') }}" method="POST">
              @csrf

              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title fw-bold poppins"
                          id="exampleModalLabel">Tambah Data Tapel
                      </h5>
                      <button type="button" class="btn-close"
                          data-bs-dismiss="modal"
                          aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    @include('pages.datatapel._addform')
                  </div>
                  <div class="modal-footer">
                      <button type="submit" class="btn btn-primary"
                          >Simpan</button>
                  </div>
              </div>

            </form>

          </div>
      </div>

    </section>

@endsection
