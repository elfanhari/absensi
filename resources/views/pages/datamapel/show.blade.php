@extends('layouts.main')

@section('content')

    <div class="content-header">
        <div class="container-fluid">

          <div class="row mb-2">
            <div class="col-sm-6">
                <h4 class="fw-bold poppins m-0">
                    <button class="btn btn-sm btn-link p-0 me-1" onclick="history.back()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor"
                            class="bi fw-bold bi-arrow-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                        </svg>
                    </button>
                    Data Mapel: {{ $mapel->name }}
                </h4>
            </div>
        </div>

            <div class="row">
                <div class="col-md-6 offset-md-6">
                    @if (session()->has('info'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            @include('_success')
                            {!! session('info') !!}
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
                              Belum ada Pembelajaran pada Mapel <b> {{ $mapel->name }}. </b>
                            @else
                            <div class="table-responsive">
                              <table id="table1" class="table table-sm table-hover ">
                                  <thead>
                                      <tr class="bg-dark text-white">
                                          <th scope="col">#</th>
                                          <th scope="col">Nama Pembelajaran</th>
                                          <th scope="col">Guru Pengampu</th>
                                          <th scope="col">Aksi</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @foreach ($pembelajaran as $item)
                                          <tr>
                                              <td>{{ $loop->iteration }}</td>
                                              <td> <b>{{ $item->mapel->name }}</b> - {{ $item->kelas->name }}</td>
                                              <td>{{ $item->guru->name }}{{ $item->guru->gelar ? ', ' . $item->guru->gelar : '' }}
                                              </td>
                                              <td>
                                                  <a href="{{ route('absensi.show', ['absensi' => $item->id, 'role' => auth()->user()->role]) }}"
                                                      class="btn btn-success pb-1 pt-0 px-2">
                                                      <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                          height="16" fill="currentColor"
                                                          class="bi bi-list-columns-reverse" viewBox="0 0 16 16">
                                                          <path fill-rule="evenodd"
                                                              d="M0 .5A.5.5 0 0 1 .5 0h2a.5.5 0 0 1 0 1h-2A.5.5 0 0 1 0 .5Zm4 0a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10A.5.5 0 0 1 4 .5Zm-4 2A.5.5 0 0 1 .5 2h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5Zm-4 2A.5.5 0 0 1 .5 4h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5Zm-4 2A.5.5 0 0 1 .5 6h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 0 1h-8a.5.5 0 0 1-.5-.5Zm-4 2A.5.5 0 0 1 .5 8h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 0 1h-8a.5.5 0 0 1-.5-.5Zm-4 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10a.5.5 0 0 1-.5-.5Zm-4 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5Zm-4 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5Z" />
                                                      </svg>
                                                  </a>
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
