@extends('layouts.main')

@section('content')

    <div class="content-header">
        <div class="container-fluid">

            <div class="row mb-0">
                <div class="col-sm-6">
                    <h4 class="fw-bold poppins m-0">Rekapitulasi Absensi @can('guru')
                            Saya
                        @endcan
                    </h4>
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
                      @if (Auth::user()->role == 'admin' || Auth::user()->role == 'piket')
                        <div class="card-header">
                          <button class="btn btn-sm float-left btn-primary btn-icon-split" data-bs-target="#perangkatan"
                            data-bs-toggle="modal" >
                            <span class="text">Rekap Per-Tingkat</span>
                          </button>
                        </div>
                      @endif
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if ($kelas->count() < 1)
                                Belum ada Data Pembelajaran!
                            @else
                                <div class="table-responsive">
                                    <table id="table1" class="table table-sm table-hover ">
                                        <thead>
                                            <tr class="bg-dark text-white">
                                                <th scope="col">#</th>
                                                <th scope="col">Kelas</th>
                                                <th scope="col">Wali Kelas</th>
                                                <th scope="col">Tahun Pelajaran</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($kelas as $item)
                                                @php
                                                    if ($item->tapel->semester == 1) {
                                                        $year = intval(Str::before($item->tapel->tahun_pelajaran, '/'));
                                                    } else {
                                                        $year = intval(Str::after($item->tapel->tahun_pelajaran, '/'));
                                                    }
                                                @endphp

                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->name }}</td>
                                                    <td>{{ $item->guru->name }}
                                                    <td>{{ $item->tapel->tahun_pelajaran . ' - Semester ' . $item->tapel->semester }}
                                                    </td>
                                                    <td>
                                                        <button type="submit" class="btn btn-primary btn-sm"
                                                            data-bs-target="#rekap/{{ $item->id }}"
                                                            data-bs-toggle="modal">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor"
                                                                class="bi bi-printer-fill me-1" viewBox="0 0 16 16">
                                                                <path
                                                                    d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z" />
                                                                <path
                                                                    d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" />
                                                            </svg>
                                                            Cetak Rekapitulasi
                                                        </button>

                                                        {{-- PILIH PERIODE --}}
                                                        <div class="modal fade" id="rekap/{{ $item->id }}"
                                                            tabindex="-1" aria-labelledby="exampleModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title fw-bold poppins"
                                                                            id="exampleModalLabel">REKAPITULASI ABSENSI
                                                                        </h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="">
                                                                            Kelas : <b> {{ $item->name }} </b> <br>
                                                                            Tahun Pelajaran : <b>
                                                                                {{ $item->tapel->tahun_pelajaran . ' - Semester ' . $item->tapel->semester }}
                                                                            </b>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer justify-content-between">
                                                                        <button class="btn btn-primary btn-sm"
                                                                            data-bs-target="#per1bulan/{{ $item->id }}"
                                                                            data-bs-toggle="modal">Per
                                                                            1 Bulan</button>
                                                                        <button class="btn btn-primary btn-sm"
                                                                            data-bs-target="#per3bulan/{{ $item->id }}"
                                                                            data-bs-toggle="modal">Per
                                                                            3 Bulan</button>
                                                                        <button class="btn btn-primary btn-sm"
                                                                            data-bs-target="#persemester/{{ $item->id }}"
                                                                            data-bs-toggle="modal">Per
                                                                            Semester</button>

                                                                        @if ($item->tapel->semester == 2)
                                                                            <form
                                                                                action="{{ route('rekapabsensi.pertahun.print', [$role, $item->id]) }}"
                                                                                target="_blank">
                                                                                <input type="hidden" name="year"
                                                                                    id=""
                                                                                    value="{{ $year }}">
                                                                                <input type="hidden" name="bulan"
                                                                                    id="" value="7-6">
                                                                                <button type="submit"
                                                                                    class="btn btn-primary btn-sm">Per
                                                                                    Tahun</button>
                                                                            </form>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        {{-- PER 1 BULAN: PILIH BULAN --}}
                                                        <div class="modal fade" id="per1bulan/{{ $item->id }}"
                                                            tabindex="-1" aria-labelledby="exampleModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title fw-bold poppins"
                                                                            id="exampleModalLabel">REKAPITULASI ABSENSI: PER
                                                                            1 BULAN
                                                                        </h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <form
                                                                        action="{{ route('rekapabsensi.per1bulan.print', [$role, $item->id]) }}"
                                                                        method="get" target="_blank">
                                                                        <div class="modal-body">
                                                                            <div class="">
                                                                                Kelas : <b> {{ $item->name }} </b> <br>
                                                                                Tahun Pelajaran : <b>
                                                                                    {{ $item->tapel->tahun_pelajaran . ' - Semester ' . $item->tapel->semester }}
                                                                                </b>
                                                                            </div>
                                                                            <div class="mt-3">
                                                                                <label for="tahun_pelajaran"
                                                                                    class="form-label">Bulan</label>
                                                                                <select name="bulan" id=""
                                                                                    class="form-control form-select"
                                                                                    required>
                                                                                    <option value="">-- Pilih --
                                                                                    </option>
                                                                                    @if ($item->tapel->semester == 2)
                                                                                        <option value="1">Januari
                                                                                            {{ $year }}</option>
                                                                                        <option value="2">Februari
                                                                                            {{ $year }}</option>
                                                                                        <option value="3">Maret
                                                                                            {{ $year }}</option>
                                                                                        <option value="4">April
                                                                                            {{ $year }}</option>
                                                                                        <option value="5">Mei
                                                                                            {{ $year }}</option>
                                                                                        <option value="6">Juni
                                                                                            {{ $year }}</option>
                                                                                    @else
                                                                                        <option value="7">Juli
                                                                                            {{ $year }}</option>
                                                                                        <option value="8">Agustus
                                                                                            {{ $year }}</option>
                                                                                        <option value="9">September
                                                                                            {{ $year }}</option>
                                                                                        <option value="10">Oktober
                                                                                            {{ $year }}</option>
                                                                                        <option value="11">November
                                                                                            {{ $year }}</option>
                                                                                        <option value="12">Desember
                                                                                            {{ $year }}</option>
                                                                                    @endif
                                                                                </select>
                                                                                <input type="hidden" name="year"
                                                                                    id=""
                                                                                    value="{{ $year }}">
                                                                                <label for="tahun_pelajaran"
                                                                                    class="form-label mt-3">Jenis
                                                                                    Cetak</label>
                                                                                <select name="jenis" id=""
                                                                                    class="form-control form-select"
                                                                                    disabled>
                                                                                    <option value="">-- Pilih --
                                                                                    </option>
                                                                                    <option value="pdf" selected
                                                                                        disabled>PDF</option>
                                                                                    <option value="excel">Excel</option>
                                                                                </select>

                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer justify-content-end">
                                                                            <button type="submit"
                                                                                class="btn btn-md btn-primary">
                                                                                Rekap
                                                                            </button>
                                                                        </div>
                                                                    </form>

                                                                </div>
                                                            </div>
                                                        </div>

                                                        {{-- PER 3 BULAN: PILIH BULAN --}}
                                                        <div class="modal fade" id="per3bulan/{{ $item->id }}"
                                                            tabindex="-1" aria-labelledby="exampleModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title fw-bold poppins"
                                                                            id="exampleModalLabel">REKAPITULASI ABSENSI:
                                                                            PER 3 BULAN
                                                                        </h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <form
                                                                        action="{{ route('rekapabsensi.per3bulan.print', [$role, $item->id]) }}"
                                                                        method="get" target="_blank">

                                                                        <div class="modal-body">
                                                                            <div class="">
                                                                                Kelas : <b> {{ $item->name }} </b> <br>
                                                                                Tahun Pelajaran : <b>
                                                                                    {{ $item->tapel->tahun_pelajaran . ' - Semester ' . $item->tapel->semester }}
                                                                                </b>
                                                                            </div>
                                                                            <div class="mt-3">
                                                                                <label for="bulan"
                                                                                    class=" col-form-label">Bulan</label>
                                                                                <select name="bulan" id=""
                                                                                    class="form-control form-select"
                                                                                    required>
                                                                                    <option value="" selected
                                                                                        disabled>-- Pilih --</option>
                                                                                    @if ($item->tapel->semester == 1)
                                                                                        <option value="7-9">Juli
                                                                                            {{ $year }} - September
                                                                                            {{ $year }}</option>
                                                                                        <option value="10-12">Oktober
                                                                                            {{ $year }} - Desember
                                                                                            {{ $year }}</option>
                                                                                    @else
                                                                                        <option value="1-3">Januari
                                                                                            {{ $year }} - Maret
                                                                                            {{ $year }}</option>
                                                                                        <option value="4-6">April
                                                                                            {{ $year }} - Juni
                                                                                            {{ $year }}</option>
                                                                                    @endif
                                                                                </select>
                                                                                <input type="hidden" name="year"
                                                                                    id=""
                                                                                    value="{{ $year }}">
                                                                                <label for="tahun_pelajaran"
                                                                                    class="form-label mt-3">Jenis
                                                                                    Cetak</label>
                                                                                <select name="jenis" id=""
                                                                                    class="form-control form-select"
                                                                                    disabled>
                                                                                    <option value="">-- Pilih --
                                                                                    </option>
                                                                                    <option value="pdf" selected
                                                                                        disabled>PDF</option>
                                                                                    <option value="excel">Excel</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer justify-content-end">
                                                                            <button type="submit"
                                                                                class="btn btn-md btn-primary">
                                                                                Rekap
                                                                            </button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        {{-- PER SEMESTER --}}
                                                        <div class="modal fade" id="persemester/{{ $item->id }}"
                                                            tabindex="-1" aria-labelledby="exampleModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title fw-bold poppins"
                                                                            id="exampleModalLabel">REKAPITULASI ABSENSI:
                                                                            PER SEMESTER
                                                                        </h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <form
                                                                        action="{{ route('rekapabsensi.persemester.print', [$role, $item->id]) }}"
                                                                        method="get" target="_blank">

                                                                        <div class="modal-body">
                                                                            <div class="">
                                                                                Kelas : <b> {{ $item->name }} </b> <br>
                                                                                Tahun Pelajaran : <b>
                                                                                    {{ $item->tapel->tahun_pelajaran . ' - Semester ' . $item->tapel->semester }}
                                                                                </b>
                                                                            </div>
                                                                            <div class="mt-3">
                                                                                <label for="bulan"
                                                                                    class=" col-form-label">Periode</label>
                                                                                <select name="" id=""
                                                                                    class="form-control form-select"
                                                                                    disabled>
                                                                                    <option value="" selected
                                                                                        disabled>Semester
                                                                                        {{ $item->tapel->semester }}
                                                                                    </option>
                                                                                </select>

                                                                                @if ($item->tapel->semester == 2)
                                                                                    <input type="hidden" name="bulan"
                                                                                        id="bulan" value="1-6">
                                                                                @else
                                                                                    <input type="hidden" name="bulan"
                                                                                        id="bulan" value="7-12">
                                                                                @endif

                                                                                <input type="hidden" name="year"
                                                                                    id=""
                                                                                    value="{{ $year }}">

                                                                                <label for="tahun_pelajaran"
                                                                                    class="form-label mt-3">Jenis
                                                                                    Cetak</label>
                                                                                <select name="jenis" id=""
                                                                                    class="form-control form-select"
                                                                                    disabled>
                                                                                    <option value="">-- Pilih --
                                                                                    </option>
                                                                                    <option value="pdf" selected
                                                                                        disabled>PDF</option>
                                                                                    <option value="excel">Excel</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer justify-content-end">
                                                                            <button type="submit"
                                                                                class="btn btn-md btn-primary">
                                                                                Rekap
                                                                            </button>
                                                                        </div>
                                                                </div>
                                                                </form>
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
        {{-- PER ANGKATAN --}}
        <div class="modal fade" id="perangkatan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold poppins" id="exampleModalLabel">REKAPITULASI ABSENSI: PER ANGKATAN
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('rekapabsensi.perangkatan', $role) }}" method="POST" target="_blank">
                      @csrf

                        <div class="modal-body">
                            <div class="">
                                <label for="bulan" class="col-form-label">Tanggal</label>
                                <div class="row">
                                    <div class="col-5">
                                      <input type="date" value="{{ old('tglawal') }}"
                                        class="form-control form-date @error('tglawal') is-invalid @enderror " name="tglawal"
                                        id="tglawal"  required>
                                      @error('tglawal')
                                          <span class="invalid-feedback mt-1">
                                              {{ $message }}
                                          </span>
                                      @enderror
                                    </div>
                                    <div class="col-2 text-center align-middle pt-1">
                                      s/d
                                    </div>
                                    <div class="col-5">
                                      <input type="date" value="{{ old('tglakhir') }}"
                                      class="form-control @error('tglakhir') is-invalid @enderror" name="tglakhir"
                                      id="tglakhir" placeholder="Masukkan tanggal" required>
                                      @error('tglakhir')
                                          <span class="invalid-feedback mt-1">
                                              {{ $message }}
                                          </span>
                                      @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <label for="jenis" class="form-label">Jenis Cetak</label>
                                <select name="jenis" id="" class="form-control form-select" disabled>
                                    <option value="">-- Pilih --</option>
                                    <option value="pdf" selected disabled>PDF</option>
                                    <option value="excel">Excel</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-end">
                            <button type="submit" class="btn btn-md btn-primary">
                                Rekap
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        </div>
    </section>

    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>

@endsection
