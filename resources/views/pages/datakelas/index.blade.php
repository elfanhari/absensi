@extends('layouts.main')

@section('content')

    <div class="content-header">
        <div class="container-fluid">

          <div class="row mb-0">
            <div class="col-sm-6">
                <h4 class="fw-bold poppins m-0">Data Kelas</h4>
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
                        <div class="card-header">

                            @can('admin')
                              <a href="{{ route('datakelas.create', $role) }}"
                              class="btn btn-sm float-left btn-primary btn-icon-split" data-bs-toggle="tooltip" data-bs-placement="right" title="Tambah Data Kelas">
                                  <span class="icon text-white-30 pe-1 pb-1 pt-0" style="padding-top: 0.20rem !important;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-plus-square" viewBox="0 0 16 16">
                                    <path
                                    d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                                    <path
                                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                  </svg>
                                </span>
                                <span class="text">Kelas</span>
                              </a>
                            @endcan


                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if ($kelas->count() < 1)
                              Belum ada Data Kelas.
                            @else
                            <div class="table-responsive">
                              <table id="table1" class="table table-sm table-hover ">
                                  <thead>
                                      <tr class="bg-dark text-white">
                                          <th scope="col">#</th>
                                          <th scope="col">Nama Kelas</th>
                                          <th scope="col">ID KELAS</th>
                                          <th scope="col">Wali Kelas</th>
                                          <th scope="col">Tahun Pelajaran</th>
                                          <th scope="col">Aksi</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @foreach ($kelas as $item)
                                          <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->id }}</td>
                                              <td>{{ $item->guru->name }}{{ $item->guru->gelar ? ', ' . $item->guru->gelar : '' }}</td>
                                              <td>{{ $item->tapel->tahun_pelajaran }} - Semester {{ $item->tapel->semester }}</td>
                                              <td>
                                                  <a href="{{ route('datakelas.show', ['datakela' => $item->id, 'role' => $role]) }}"
                                                      class="btn btn-success pb-1 pt-0 px-2">
                                                      <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                          height="16" fill="currentColor"
                                                          class="bi bi-list-columns-reverse" viewBox="0 0 16 16" >
                                                          <path fill-rule="evenodd"
                                                              d="M0 .5A.5.5 0 0 1 .5 0h2a.5.5 0 0 1 0 1h-2A.5.5 0 0 1 0 .5Zm4 0a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10A.5.5 0 0 1 4 .5Zm-4 2A.5.5 0 0 1 .5 2h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5Zm-4 2A.5.5 0 0 1 .5 4h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5Zm-4 2A.5.5 0 0 1 .5 6h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 0 1h-8a.5.5 0 0 1-.5-.5Zm-4 2A.5.5 0 0 1 .5 8h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 0 1h-8a.5.5 0 0 1-.5-.5Zm-4 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10a.5.5 0 0 1-.5-.5Zm-4 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5Zm-4 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5Z" />
                                                      </svg>
                                                  </a>


                                                  @can('admin')
                                                  <a href="{{ route('datakelas.edit', ['datakela' => $item->id, 'role' => $role]) }}" type="button"
                                                      class=" btn btn-primary pb-1 pt-0 px-2">
                                                      <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                          height="16" fill="currentColor"
                                                          class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                          <path
                                                              d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                          <path fill-rule="evenodd"
                                                              d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                      </svg>
                                                  </a>

                                                @if ($siswa->where('kelas_id', $item->id)->count() < 1)
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
                                                  @endcan

                                                  {{-- MODAL HAPUS --}}
                                                  <div class="modal fade" id="modalDelete/{{ $item->id }}"
                                                      tabindex="-1" aria-labelledby="exampleModalLabel"
                                                      aria-hidden="true">
                                                      <div class="modal-dialog">
                                                          <div class="modal-content">
                                                              <div class="modal-header">
                                                                  <h5 class="modal-title fw-semibold poppins"
                                                                      id="exampleModalLabel">Hapus Data
                                                                  </h5>
                                                                  <button type="button" class="btn-close"
                                                                      data-bs-dismiss="modal"
                                                                      aria-label="Close"></button>
                                                              </div>
                                                              <div class="modal-body">
                                                                  Data: <p class="text-primary fw-bold">
                                                                     Kelas {{ $item->name }}
                                                                  </p>
                                                                  Apakah anda yakin data tersebut akan dihapus?
                                                              </div>
                                                              <div class="modal-footer">
                                                                  <button type="button" class="btn btn-secondary"
                                                                      data-bs-dismiss="modal">Batal</button>
                                                                  <form
                                                                      action="{{ route('datakelas.destroy', ['datakela' => $item->id, 'role' => $role]) }}"
                                                                      method="POST" class="d-inline">
                                                                      @csrf
                                                                      @method('DELETE')
                                                                      <input type="hidden" name="name"
                                                                          id=""
                                                                          value="{{ $item->name }}" hidden>
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
                                                                <h5 class="modal-title fw-semibold poppins"
                                                                    id="exampleModalLabel">Peringatan
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Data: <p class="text-primary fw-bold">
                                                                   Kelas {{ $item->name }}
                                                                </p>
                                                               Data tersebut tidak dapat dihapus! Karena terdapat beberapa siswa di <b>Kelas - {{ $item->name }}</b>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-primary"
                                                                    data-bs-dismiss="modal">Oke</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

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

@endsection
