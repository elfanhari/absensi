@extends('layouts.main')

@section('content')
    @php
        use Carbon\Carbon;
    @endphp

    <div class="content-header">
        <div class="container-fluid">

          <div class="row mb-0">
            <div class="col-sm-6">
                <h4 class="fw-bold poppins m-0">Data Piket</h4>
            </div>
            <div class="col-sm-6 mt-xs-2">
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

                            <a href="{{ route('datapiket.create', $role) }}"
                                class="btn btn-sm float-left btn-primary btn-icon-split" data-bs-toggle="tooltip" data-bs-placement="right" title="Tambah Data Piket">
                                <span class="icon text-white-30 pe-1 pb-1 pt-0" style="padding-top: 0.20rem !important;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-plus-square" viewBox="0 0 16 16">
                                        <path
                                            d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                                        <path
                                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                    </svg>
                                </span>
                                <span class="text">Piket</span>
                            </a>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if ($piket->count() > 0)
                                <div class="table-responsive">
                                    <table id="table1" class="table table-sm table-hover ">
                                        <thead>
                                            <tr class="bg-dark text-white">
                                                <th scope="col">#</th>
                                                <th scope="col">Nama Piket</th>
                                                <th scope="col">Username</th>
                                                <th scope="col">Status</th>
                                                <th scope="col" class="aksi-large">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($piket as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->name }}</td>
                                                    <td>{{ $item->user->username }}</td>
                                                    <td>
                                                      @if ($item->user->is_aktif == 1)
                                                          <span class="badge px-1 bg-success">AKTIF</span>
                                                      @else
                                                          <span class="badge px-1 bg-danger">NON-AKTIF</span>
                                                      @endif
                                                  </td>
                                                    <td>
                                                        <a href="{{ route('datapiket.edit', ['datapiket' => $item->id, 'role' => $role]) }}"
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
                                                                        Piket: <p class="text-primary fw-bold">
                                                                            {{ $item->name }}
                                                                        </p>
                                                                        Apakah anda yakin data tersebut akan dihapus?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Batal</button>
                                                                        <form
                                                                            action="{{ route('datapiket.destroy', ['datapiket' => $item->id, 'role' => $role]) }}"
                                                                            method="POST" class="d-inline">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <input type="hidden" name="user_id"
                                                                                id=""
                                                                                value="{{ $item->user_id }}" hidden>
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

                                                    </td>

                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            @else
                                Belum ada Data Piket.
                            @endif
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>

        </div>
    </section>

@endsection
