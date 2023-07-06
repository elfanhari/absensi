@extends('layouts.main')

@section('content')
    @php
        use Carbon\Carbon;

    @endphp

    <div class="content-header">
        <div class="container-fluid">

            <div class="row">
              <div class="col-md-6">
                @if (session()->has('info'))
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    @include('_success')
                    {{ session('info') }}
                  </div>
                @endif
              </div>
            </div>

            <div class="row mb-0">
              <div class="col-sm-6">
                  <h4 class="fw-bold poppins m-0">
                    <button class="btn btn-sm btn-link p-0 me-1" onclick="history.back()">
                      <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor"
                          class="bi fw-bold bi-arrow-left" viewBox="0 0 16 16">
                          <path fill-rule="evenodd"
                              d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                      </svg>
                  </button>
                  Data Siswa</h4>
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
                            Tambah Data Siswa
                        </div>
                        <div class="card-body">
                          <form action="{{ route('datasiswa.store', $role) }}" method="POST">
                          @csrf

                            @include('pages.datasiswa._addform')

                          </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

     {{-- Modal Import Data --}}
     <div class="modal fade" id="importData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">

          <form action="#" method="POST" enctype="multipart/form-data">
          @csrf

              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title poppins fw-semibold" id="exampleModalLabel">Import Data Siswa</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      <div class="alert alert-info alert-dismissible fade show" role="alert">
                          <strong>Penting!</strong> File yang diunggah harus berupa dokumen Microsoft Excel dengan ekstensi
                          .xlsx
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                      <div class="input-group mb-3">
                          <input type="file" name="file" class="form-control" id="inputGroupFile01" required>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                      <button type="submit" class="btn btn-primary">Upload</button>
                  </div>
              </div>

          </form>

      </div>
  </div>

@endsection
